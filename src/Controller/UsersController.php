<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\ContactForm;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\View\View;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Model = $this->loadModel('UserProfile');
        $this->Model = $this->loadModel('Services');
        $this->Model = $this->loadModel('ContractorCredit');
        $this->Model = $this->loadModel('SetCredit');
        $this->Model = $this->loadModel('Notifications');
    }

    //===================== All Owners and Contractors Sign Up==========================//
    public function signUp()
    {
        $this->viewBuilder()->setLayout('user_signup');
        $result = $this->Authentication->getIdentity();
        $user = $this->Users->newEmptyEntity();
        $error = '';
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($user->user_type == 1) {
                $user_type = 'Owner';
            } elseif ($user->user_type == 2) {
                $user_type = 'General Contractor';
            } elseif ($user->user_type == 2) {
                $user_type = 'Sub Contractor';
            } else {
                $user_type = 'Material Provider';
            }
            $result1 = $this->Users->checkEmailExist($user->email);
            if ($result1) {
                $error = "Email Aleardy Exits";
            } else {
                $enc = rand();
                $token = sha1('$enc');
                $mailer = new Mailer('default');
                $mailer->setTransport('gmail'); //your email configuration name
                $mailer->setFrom(['teqkd09@gmail.com' => 'Contractor']);
                $mailer->setTo($user->email);
                $mailer->setEmailFormat('html');
                $mailer->setSubject('Verify New Account');
                $mailer->deliver('<a href="http://localhost:8765/users/set-password/' . $token . '">Click here & Set Passowrd</a>');
                if ($mailer == true) {
                    $save = $this->Users->save($user);
                    if ($save == true) {
                        $uid = $save->id;
                        $array = array();
                        $array['user_id'] = $uid;
                        $array['message'] = 'New Registration for ' . $user_type . '.';
                        $array['message_for'] = 0;
                        $notification = $this->Notifications->newEntity($array);
                        $this->Notifications->save($notification);
                        if ($this->Users->insertToken($user->email, $token)) {
                            $this->Flash->success(__('Regitration successfully , Open Mail and Set Password'));
                            return $this->redirect(['action' => 'login']);
                        }
                    } else {
                        $this->Flash->error(__('Regitration Failed'));
                    }
                } else {
                    $this->Flash->error(__('Regitration Failed'));
                }
            }
        }
        $this->set(compact(['user', 'error']));
    }

    //==================Set New Password=====================//
    public function setPassword($token)
    {
        $this->viewBuilder()->setLayout('user_signup');
        $user = $this->Users->find('all')->where(['token' => $token])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user->token = null;
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The Password has been saved.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The Password not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    //====================login for all owners and Contractors================//
    public function login($id = null)
    {

        $this->viewBuilder()->setLayout('user_login');
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $user = $this->Authentication->getIdentity();
            $min_credit = $this->SetCredit->find('all')->first();
            $user_credit = $this->ContractorCredit->find('all')->where(['user_id' => $user->id])->first();
            if ($user_credit != null) {
                if ($user_credit->total_credit < $min_credit->min_credit) {
                    $this->loadComponent('Notification');
                    $result = $this->Notification->notificationemail($user->email);
                    $this->Flash->success('Your credit is not enough! an mail with link to update credit has been sent to your email (' . $user->email . '), please check your email');
                    $notificationAll = $this->Notifications->find()
                        ->where([
                            'user_id' => $user->id,
                            'message' => 'Your credit is not enough! please refill it'
                        ])
                        ->first();
                    if (empty($notificationAll)) {

                        $notification = $this->Notifications->newEmptyEntity();
                        $notification->user_id = $user->id;
                        $notification->message = 'Your credit is not enough! please refill it';
                        $notification->message_for = $user->user_type;
                        $notification->status = 1;
                        $this->Notifications->save($notification);
                    }
                }
            }

            if ($user->user_type == 1 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 0) {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'users',
                    'action' => 'owner-profile',
                ]);
                return $this->redirect($redirect);
            } else if ($user->user_type == 1 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 1) {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Projects',
                    'action' => 'requested-project-list',
                ]);
                return $this->redirect($redirect);
            } else if ($user->user_type == 1 && $user->status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Deactivate'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 1 && $user->delete_status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Suspended'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 1 && $user->approve_status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is not Approved by Admin'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            }

            //general contractor login
            if ($user->user_type == 2 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 0) {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'contractors',
                    'action' => 'edit-profile/' . $user->id,
                ]);
                return $this->redirect($redirect);
            } else if ($user->user_type == 2 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 1) {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'contractors',
                    'action' => 'assigned-project-list',
                ]);
                return $this->redirect($redirect);
            } else if ($user->user_type == 2 && $user->status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Deactivate'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 2 && $user->delete_status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Suspended'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 2 && $user->approve_status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is not Approved by Admin'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            }
            // sc login
            if ($user->user_type == 3 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 0) {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'contractors',
                    'action' => 'edit-profile/' . $user->id,
                ]);
                return $this->redirect($redirect);
            } else if ($user->user_type == 3 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 1) {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'contractors',
                    'action' => 'assigned-project-list',
                ]);
                return $this->redirect($redirect);
            } else if ($user->user_type == 3 && $user->status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Deactivate'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 3 && $user->delete_status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Suspended'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 3 && $user->approve_status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is not Approved by Admin'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            }
            // mp login
            if ($user->user_type == 4 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 0) {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'materialProvider',
                    'action' => 'edit-profile/' . $user->id,
                ]);
                return $this->redirect($redirect);
            } else if ($user->user_type == 4 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 1) {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'materialProvider',
                    'action' => 'assigned-project-list',
                ]);
                return $this->redirect($redirect);
            } else if ($user->user_type == 4 && $user->status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Deactivate'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 4 && $user->delete_status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Suspended'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 4 && $user->approve_status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is not Approved by Admin'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            }
            // admin logout 
            if ($user->user_type == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Invalid email or password'));
            }
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Authentication->logout();
            $this->Flash->error(__('Invalid email or password'));
        }
    }
    //=================Owner Profile===================//
    public function ownerProfile()
    {
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $result = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        if ($auth->user_type == 1) {
            $this->viewBuilder()->setLayout('owner_dashboard');
            $owner = $this->Users->get($uid, ['contain' => ['UserProfile']]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();
                if ($owner->complete_status == 0) {
                    $data['complete_status'] = 1;
                }
                $user = $this->Users->patchEntity($owner, $data);

                if ($this->Users->save($user)) {
                    // $this->Flash->success(__('The user has been saved.'));
                    // return $this->redirect(['controller' => 'projects', 'action' => 'requested-project-list']);
                    echo json_encode(array(
                        "status" => 1,
                        "message" => "Owner Details has been updated.",
                    ));
                    exit;
                } else {
                    echo json_encode(array(
                        "status" => 0,
                        "message" => "Owner Details could not be update. Please, try again.",
                    ));
                    exit;
                    // $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('owner', 'result'));
        } else {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    //=================Owner Profile===================//
    public function editProfile($id = null)
    {
        $this->autoRender = false;
        $users = $this->Users->get($id);
        if ($users->complete_status == 1) {
            $users->complete_status = 0;
        }
        if ($this->Users->save($users)) {
            return $this->redirect(['controller' => 'users', 'action' => 'owner-profile']);
        }
    }
    //===================Owner Logout===================//
    public function logout()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    public function readNotification($id = null)
    {
        $notification = $this->Notifications->get($id);
        $notification->status = 1;
        if ($this->Notifications->save($notification)) {
            echo json_encode(array(
                "status" => 1,
                "message" => "Notification status changed.",
            ));
            exit;
        } else {
            echo json_encode(array(
                "status" => 0,
                "message" => "Notification status not changed.",
            ));
            exit;
        }
        // }
    }
}
