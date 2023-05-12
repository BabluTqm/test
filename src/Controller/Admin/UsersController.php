<?php

namespace App\Controller\Admin;

use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationResult;
use Authentication\Middleware\AuthenticationMiddleware;
use Cake\Http\ServerRequest;
use Cake\Http\Response;
use App\Controller\AppController;
use App\Form\ContactForm;
use Cake\Http\Client\Request;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\View\View;
use Psr\Http\Message\ServerRequestInterface;

class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    /***************Admin Login**************** */
    public function login()
    {

        $this->viewBuilder()->setLayout('admin_login');
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $user = $this->Authentication->getIdentity();
            if (!$user) {
                $user = $this->Authentication->getResult()->getData();
            } else if ($user->user_type == 0 && $user->status == 1) {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'users',
                    'action' => 'dashboard',
                    'prefix' => 'Admin'
                ]);

                return $this->redirect($redirect);
            } else {
                $this->Flash->error(__('Invalid Credentials'));
                $this->Authentication->logout();
                return $this->redirect(['controller' => 'Users', 'action' => 'login', 'prefix' => 'Admin']);
            }
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid Credentials'));
        }
    }


    /***************Admin Dashboard**************** */

    public function dashboard()
    {

        $auth = $this->Authentication->getIdentity();
        if ($auth->user_type != 0) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login', 'prefix' => 'Admin']);
        }
        $uid = $auth->id;
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $users =  $this->Users->find('all')->contain(['UserProfile'])->all();
        $this->viewBuilder()->setLayout('main_dashboard');
        // $owners =  $this->Users->find('all', ['limit' => 5])->contain(['UserProfile'])->where(['user_type' => 1])->order(['Users.id' => 'DESC']);
        $owners =  $this->Users->find('all')->contain(['UserProfile'])->where(['user_type' => 1])->order(['Users.id' => 'DESC']);
        // find data from same table where column name is same
        // $all_contractor = $this->Users->find('all', array('user_type' =>  2, 3))->contain(['UserProfile'])->order(['Users.id' => 'DESC']);
        $all_contractor = $this->Users->find('all', array(
            'order' => 'Users.created_at DESC',
            'user_type IN' =>  [2, 3]
        ))->contain(['UserProfile'])->all();
        $this->set(compact('owners', 'admin', 'all_contractor', 'users'));
    }

    // nofifications read by admin 
    public function readNotification($id = null)
    {
        $notification = $this->Notifications->get($id);
        $notification->status = 1;

        $status = 0;
        if ($this->Notifications->save($notification)) {
            $notify = $this->Notifications->find()->contain([
                'Users', 'Users.Projects' => function ($q) use ($status) {
                    return $q->where(['Projects.accept_status' => $status]);
                }
            ])->where(['Notifications.id' => $id])->first();
            if ($notify->user->user_type == 1 && empty($notify->user->projects)) {
                return $this->redirect(['controller' => 'Users', 'action' => 'ownerManagement', 'prefix' => 'Admin']);
            }
            if ($notify->user->user_type == 1 && $notify->user->projects[0]['accept_status'] == 0) {
                return $this->redirect(['controller' => 'projects', 'action' => 'unAssignProject', 'prefix' => 'Admin']);
            }
            if ($notify->user->user_type == 2) {
                return $this->redirect(['controller' => 'contractor', 'action' => 'generalListing', 'prefix' => 'Admin']);
            }
            if ($notify->user->user_type == 3) {
                return $this->redirect(['controller' => 'contractor', 'action' => 'subListing', 'prefix' => 'Admin']);
            }
            if ($notify->user->user_type == 4) {
                return $this->redirect(['controller' => 'contractor', 'action' => 'mpListing', 'prefix' => 'Admin']);
            }
        }
    }

    //          2023-04-20 04:03:24

    /****************Owner date Filter*************** */
    public function ownerDateFilter()
    {
        if ($this->request->is('ajax')) {
            $start_date = $_REQUEST['startdate'];
            $end_date =   $_REQUEST['enddate'];
            $owner = $this->Users->find('all')->contain(['UserProfile'])->where(['user_type' => 1])
                ->where(function ($exp) use ($start_date, $end_date) {
                    return $exp->between('created_at', $start_date, $end_date);
                })->all();
            echo json_encode(array(
                "status" => 1,
                "results" => $owner,
            ));
            exit;
        }
    }
    /****************** GC dateFilter************* */



    /***************Owner Managment**************** */
    public function ownerManagement()
    {

        $auth = $this->Authentication->getIdentity();
        if ($auth->user_type != 0) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login', 'prefix' => 'Admin']);
        }
        $uid = $auth->id;
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $this->set(compact('admin'));
        $this->viewBuilder()->setLayout('dashboard_layout');
        $users =  $this->paginate($this->Users->find('all')->contain(['UserProfile'])->where(['user_type' => 1])->order(['Users.id' => 'DESC']));
        foreach ($users as $user) {
            if ($user->token == null) {
                $data[] = $user;
            }
        }
        $this->set(compact('data', 'admin'));
    }

    /*****************admin logout************************/
    public function logout()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login', 'prefix' => 'Admin']);
        }
    }

    /**********************proxy login**************/
    public function proxylogin($id = null)
    {
        //$this->Authentication->logout();
        // $session = $this->request->getSession();
        $getUserData = $this->request->getSession()->read();
        $getUser = $getUserData['Auth'];
        $user = $this->Users->get($id);
        $getUser['id'] = (int)$id;
        $getUser['email'] = $user->email;
        $getUser['password'] = $user->password;
        $getUser['own_status'] = $user->own_status;
        $getUser['delete_status'] = $user->delete_status;
        $getUser['user_type'] = $user->user_type;
        $getUser['token'] = $user->token;
        $getUser['approve_status'] = $user->approve_status;
        $getUser['complete_status'] = $user->complete_status;
        $getUser['created_at'] = $user->created_at;
        $getUser['modified_at'] = $user->modified_at;

        $result = $this->Authentication->getResult();
        // dd($result);

        if ($result->isValid()) {
            $user = $this->Authentication->getIdentity();
            /*****Owner Login******* */
            if ($user->user_type == 1 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 0) {
                return $this->redirect('/users/ownerProfile');
            } else if ($user->user_type == 1 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 1) {
                return $this->redirect('/projects/requested-project-list');
            } else if ($user->user_type == 1 && $user->status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Deactivate'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 1 && $user->delete_status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Suspended'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 1 && $user->approve_status == 0) {
                // $this->Authentication->logout();
                $this->Flash->error(__('Your Account is not Approved by Admin'));
                return $this->redirect(['controller' => 'users', 'action' => 'dashboard', 'prefix' => 'Admin']);
            }

            //general contractor login
            if ($user->user_type == 2 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 0) {
                // $redirect = $this->request->getQuery('redirect', [
                //     'controller' => 'contractors',
                //     'action' => 'edit-profile/' . $user->id,
                // ]);
                return $this->redirect('contractors/edit-profile/' . $user->id);
            } else if ($user->user_type == 2 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 1) {
                // $redirect = $this->request->getQuery('redirect', [
                //     'controller' => 'contractors',
                //     'action' => 'assigned-project-list',
                // ]);
                return $this->redirect('/contractors/assigned-project-list/');
            } else if ($user->user_type == 2 && $user->status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Deactivate'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 2 && $user->delete_status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Suspended'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 2 && $user->approve_status == 0) {
                // $this->Authentication->logout();
                $this->Flash->error(__('Your Account is not Approved by Admin'));
                return $this->redirect(['controller' => 'contractor', 'action' => 'generalListing', 'prefix' => 'Admin']);
            }
            // sc login
            if ($user->user_type == 3 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 0) {
                // $redirect = $this->request->getQuery('redirect', [
                //     'controller' => 'contractors',
                //     'action' => 'edit-profile/' . $user->id,
                // ]);
                return $this->redirect('/contactors/edit-profile/');
            } else if ($user->user_type == 3 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 1) {
                // $redirect = $this->request->getQuery('redirect', [
                //     'controller' => 'contractors',
                //     'action' => 'assigned-project-list',
                // ]);
                return $this->redirect('/contractors/assigned-project-list');
            } else if ($user->user_type == 3 && $user->status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Deactivate'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 3 && $user->delete_status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Suspended'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 3 && $user->approve_status == 0) {
                // $this->Authentication->logout();
                $this->Flash->error(__('Your Account is not Approved by Admin'));
                return $this->redirect(['controller' => 'contractor', 'action' => 'subListing', 'prefix' => 'Admin']);
                // return $this->redirect(['controller' => 'users', 'action' => 'login']);
            }

            //==================================== mp login ===============================
            if ($user->user_type == 4 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 0) {
                return $this->redirect('/materialProvider/edit-profile/' . $user->id);
            } else if ($user->user_type == 4 && $user->status == 1 && $user->delete_status == 1 && $user->approve_status == 1 && $user->complete_status == 1) {
                return $this->redirect('/materialProvider/assigned-project-list');
            } else if ($user->user_type == 4 && $user->status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Deactivate'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 4 && $user->delete_status == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Your Account is Suspended'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else if ($user->user_type == 4 && $user->approve_status == 0) {
                $this->Flash->error(__('Your Account is not Approved by Admin'));
                return $this->redirect(['controller' => 'materialProvider', 'action' => 'mpListing', 'prefix' => 'Admin']);
            }

            // admin logout
            if ($user->user_type == 0) {
                $this->Authentication->logout();
                $this->Flash->error(__('Invalid email or password'));
            }
        }
    }
    /********************* owner approve************************* */
    public function approv($id = null)
    {
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $this->set(compact('admin'));
        $this->autoRender = false;
        $user = $this->Users->get($id, [
            'contain' => ['UserProfile'],
        ]);
        if ($user->approve_status == 0) {
            $user->approve_status = 1;
            if ($this->Users->save($user)) {
                $mailer = new Mailer('default');
                $mailer->setTransport('gmail'); //your email configuration name
                $mailer->setFrom(['teqkd09@gmail.com' => 'Contractor']);
                $mailer->setTo($user->email);
                $mailer->setEmailFormat('html');
                $mailer->setSubject('Approved Your Account');
                $mailer->deliver('Dear  ' . $user->user_profile->first_name . ' ' . $user->user_profile->last_name . ',<br>Your Account is Approved.<br> Now you can Login');
                $this->Flash->success(__('Appropped Successfully'));
                return $this->redirect(['controller' => 'Users', 'action' => 'ownerManagement', 'prefix' => 'Admin']);
            }
        }
    }

    /************************soft delete ************************************ */
    public function deleteRecover($id = null)
    {

        $this->autoRender = false;

        $users = $this->Users->get($id);
        if ($users->delete_status == 1) {
            $users->delete_status = 0;
        } else {
            $users->delete_status = 1;
        }
        if ($this->Users->save($users)) {
            return $this->redirect(['controller' => 'Users', 'action' => 'ownerManagement', 'prefix' => 'Admin']);
        }
    }

    /*******************owner edit********************/
    public function ownerEdit($id = null)
    {
        $auth = $this->Authentication->getIdentity();
        if ($auth->user_type == 0) {
            $uid = $auth->id;
            $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
            $this->set(compact('admin'));
            $this->viewBuilder()->setLayout('dashboard_layout');
            $user = $this->Users->get($id, [
                'contain' => ['UserProfile'],
            ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $user = $this->Users->patchEntity($user, $this->request->getData());
                if ($this->Users->save($user)) {
                    echo json_encode(array(
                        "status" => 1,
                        "message" => "The User has been saved.",
                    ));
                    exit;
                } else {
                    echo json_encode(array(
                        "status" => 0,
                        "message" => "User  could not be saved. Please, try again.",
                    ));
                    exit;
                }
            }
            // dd($user);
            $this->set(compact('user'));
        } else {
            $this->Flash->error(__('You are not authorize to access that page'));
            return $this->redirect(['controller' => 'users', 'action' => 'logout', 'prefix' => 'Admin']);
        }
    }

    /*******************Active Inactive function********************/

    public function activeInactive($id)
    {
        $this->autoRender = false;

        $users = $this->Users->get($id);
        if ($users->status == 1) {
            $data = array('id' => $id, 'status' => 0);
        } else {
            $data = array('id' => $id, 'status' => 1);
        }
        $users = $this->Users->patchEntity($users, $data);

        if ($this->Users->save($users, ['modified' => false])) {
            return $this->redirect(['controller' => 'Users', 'action' => 'ownerManagement', 'prefix' => 'Admin']);
        }
    }
    //  paginate set 
    // public $paginate = [
    //     'limit' => 4
    // ];

}
