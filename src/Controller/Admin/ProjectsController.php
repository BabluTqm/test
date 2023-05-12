<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Form\ContactForm;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\View\View;

class ProjectsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('UserProfile');
        $this->loadModel('Users');
        $this->loadModel('Projects');
        $this->loadModel('OwnerServices');
        $this->loadModel('UserServices');
        $this->loadModel('Services');
        $this->loadModel('SetCredit');
        $this->loadModel('AssignedUsers');
        $this->loadModel('ContractorCredit');
        $this->loadModel('UserProduct');
    }

    /********************Un Assign Project**************/
    public function unAssignProject()
    {
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $this->viewBuilder()->setLayout('dashboard_layout');
        $projects =  $this->paginate($this->Projects->find('all')->contain(['Users', 'UserProfile'])->where(['OR' => ['assigned_status' => 0, 'accept_status' => 0]])->order(['Projects.id' => 'DESC']));
        $this->set(compact(['projects', 'admin']));
    }

    /*********************************/

    public function unAssignDateFilter()
    {
        if ($this->request->is('ajax')) {
            $start_date = $_REQUEST['startdate'];
            $end_date =   $_REQUEST['enddate'];
            $unAssignDate = $this->Projects->find('all')->contain(['Users', 'UserProfile'])->where(['assigned_status' => 0])
                ->where(function ($exp) use ($start_date, $end_date) {
                    return $exp->between('created_date', $start_date, $end_date);
                })->all();
            // echo '<pre>';
            // print_r($unAssignDate);
            // echo '</pre>';
            // die();
            echo json_encode(array(
                "status" => 1,
                "results" => $unAssignDate,
            ));
            exit;
        }
    }
    /**********************************/

    /**********************Project View************/
    public function projectView($id = null)
    {
        $this->viewBuilder()->setLayout('dashboard_layout');
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $project = $this->Projects->get($id, ['contain' => ['Users', 'UserProfile'],]);
        $owner_services = $this->OwnerServices->find('all')->contain(['Services'])->where(['project_id' => $id])->all();
        $servicearray = array();
        foreach ($owner_services as $owner_servicess) {
            $servicearray[] = +$owner_servicess->service_id;
        }
        $contractor = $project->contractor;

        $users = $this->UserServices->find('all')->distinct('UserServices.user_id')->contain(['Users.UserProfile', 'Users' => function ($q) use ($contractor) {
            return $q->where(['Users.user_type' => $contractor, 'Users.status' => 1, 'Users.delete_status' => 1, 'Users.approve_status' => 1]);
        }])->where(['service_id IN' => $servicearray])->toArray();

        $mp = $this->UserProduct->find('all')->distinct('UserProduct.user_id')->contain(['Users.UserProfile', 'Users' => function ($q) {
            return $q->where(['Users.status' => 1, 'Users.delete_status' => 1, 'Users.approve_status' => 1]);
        }])->toArray();

        $credit = $this->SetCredit->find()->where(['user_id' => $uid])->first();
        $allusers = $this->Users->find('all')->contain(['UserProfile'])->where(['Users.user_type' => $contractor])->all();
        $assignuser = $this->AssignedUsers->find('all')->where(['project_id' => $id])->toArray();
        $already_assigned_users = array_column($assignuser, 'user_id');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                echo json_encode(array(
                    "status" => 1,
                    "message" => "The project has been updated.",
                ));
                exit;
            } else {
                echo json_encode(array(
                    "status" => 0,
                    "message" => "Project not updated. Please, try again.",
                ));
                exit;
            }
        }
        $this->set(compact('project', 'owner_services', 'users', 'assignuser', 'admin', 'already_assigned_users', 'allusers', 'credit', 'mp'));
    }

    /*****************************Service view******************/
    public function serviceView()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $id = $this->request->getQuery('id');
            $user_services = $this->UserServices->find('all')->contain(['Services'])->where(['user_id' => $id])->all();
            $data = "";
            foreach ($user_services as $user) {
                $data = '<tr>
               <td>' . $user->service->service . '</td>
               </tr>';
                echo $data;
            }
        }
    }
    /*****************************Product view******************/
    public function productView()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $id = $this->request->getQuery('id');
            $user_product = $this->UserProduct->find('all')->contain(['Products'])->where(['user_id' => $id])->all();
            $data = "";
            foreach ($user_product as $user) {
                $data = '<tr>
               <td>' . $user->product->product_name . '</td>
               </tr>';
                echo $data;
            }
        }
    }

    /**************** accecpt project************************/
    public function accectOwnerProject($id = null)
    {
        $this->autoRender = false;
        $project = $this->Projects->get($id, ['contain' => ['Users'],]);
        $project_name = $project->project_name;
        $uid = $project->user->id;
        $project->accept_status = 1;
        if ($this->Projects->save($project)) {
            $array = array();
            $array['user_id'] = $uid;
            $array['message'] = 'Your Project ' . $project_name . ' is accepted.';
            $array['message_for'] = 1;
            $notification = $this->Notifications->newEntity($array);
            $this->Notifications->save($notification);
            $mailer = new Mailer('default');
            $mailer->setTransport('gmail'); //your email configuration name
            $mailer->setFrom(['teqkd09@gmail.com' => 'Contractor']);
            $mailer->setTo($project->user->email);
            $mailer->setEmailFormat('text');
            $mailer->setSubject('Approve Your Account');
            $mailer->deliver('Dear Owener Your Project is Accepted');
        }
    }

    /***************project delete recover**********************/
    public function projectDeleteRecover($id = null)
    {
        $this->autoRender = false;
        $project = $this->Projects->get($id, ['contain' => ['Users'],]);
        if ($project->delete_status == 1) {
            $project->delete_status = 0;
            if ($this->Projects->save($project)) {
                return $this->redirect(['controller' => 'Projects',  'prefix' => 'Admin', 'action' => 'assignProject']);
            }
        } else {
            $project->delete_status = 1;
            if ($this->Projects->save($project)) {
                return $this->redirect(['controller' => 'Projects',  'prefix' => 'Admin', 'action' => 'assignProject']);
            }
        }
    }

    /***********unAssignProject delete recover*****************/
    public function unassignProjectDeleteRecover($id = null)
    {
        $this->autoRender = false;
        $project = $this->Projects->get($id, ['contain' => ['Users'],]);
        if ($project->delete_status == 1) {
            $project->delete_status = 0;
            if ($this->Projects->save($project)) {
                return $this->redirect(['controller' => 'Projects',  'prefix' => 'Admin', 'action' => 'unAssignProject']);
            }
        } else {
            $project->delete_status = 1;
            if ($this->Projects->save($project)) {
                return $this->redirect(['controller' => 'Projects',  'prefix' => 'Admin', 'action' => 'unAssignProject']);
            }
        }
    }

    //============ project assign send mail to contractor =============
    public function mail_send($email, $project)
    {
        $project_name = $project['project_name'];
        $owner_name = $project->user_profile['first_name'];
        $owner_contact = $project->user_profile['phone'];
        $mailer = new Mailer('default');
        $mailer->setTransport('gmail'); //your email configuration name
        $mailer->setFrom(['teqkd09@gmail.com' => 'Contractor']);
        $mailer->setTo($email);
        $mailer->setEmailFormat('html');
        $mailer->setSubject('Assign Project');
        $mailer->deliver('You have received a new lead<br>' . 'Project Name =' . $project_name . '<br>' . 'Owner Name =' . $owner_name . '<br>' . 'Owner Contact =' . $owner_contact);
        if ($mailer) {
            return true;
        }
    }

    // not credit mail send mail_send
    public function credit_send_mail($email)
    {
        $mailer = new Mailer('default');
        $mailer->setTransport('gmail'); //your email configuration name
        $mailer->setFrom(['teqkd09@gmail.com' => 'Contractor']);
        $mailer->setTo($email);
        $mailer->setEmailFormat('html');
        $mailer->setSubject('Assign Project');
        $mailer->deliver('Dear Contractor Your Account Balance is not sufficient');
        if ($mailer) {
            return true;
        }
    }

    //============ project assign send mail to owner =============
    public function owner_mail_send($email, $user_data)
    {
        $array_data = implode(',<br>', $user_data);
        $mailer = new Mailer('default');
        $mailer->setTransport('gmail'); //your email configuration name
        $mailer->setFrom(['teqkd09@gmail.com' => 'Contractor']);
        $mailer->setTo($email);
        $mailer->setEmailFormat('html');
        $mailer->setSubject('Assign Project');
        $mailer->deliver('Your Project is assigned your contractor detail<br><p>' . $array_data . '</p>');
        if ($mailer) {
            return true;
        }
    }

    /****************get all information of owner and contractors and sending them an email separately and assign project****************/
    public function assign()
    {
        $this->autoRender = false;
        $assigned = $this->AssignedUsers->newEmptyEntity();
        if ($this->request->is('ajax')) {
            // $owner_user_id = $this->request->getData('owner_user_id');
            $project_id = $this->request->getData('project_id');
            $owner_email = $this->request->getData('owner_email'); // owner mail get for mail purpose
            $user_id = $this->request->getData('user_id');
            $debit = $this->request->getData('credit');
            $combine = array_combine($user_id, $debit); // user id and credit value combine
            $count = array();
            $count_mail_send = array();
            $user_data = array();
            $project = $this->Projects->get($project_id, ['contain' => ['Users', 'UserProfile']]);
            $project_name = $project->project_name;
            $owner_id = $project->user_id;
            $contractor_id = $user_id;
            //check project accept status is 1/ 
            $project_accecpt_status = $this->Projects->find('all')->where(['id' => $project_id, 'accept_status' => 1])->first();
            if ($project_accecpt_status) {
                $project->assigned_status = 1;
                $this->Projects->save($project); // assign status changes when a click
                // user_id is key and credit value is values
                foreach ($combine as $key => $value) {
                    //  save notification for owner and scgc 
                    $contractor = $this->Users->find('all')->contain(['UserProfile'])->where(['Users.id ' => $key])->first();
                    $name = $contractor->user_profile->first_name . ' ' . $contractor->user_profile->last_name;
                    $data = [];
                    $data[] = [
                        'user_id' => $owner_id,
                        'message' => 'Your project ' . $project_name . ' is Assigned to ' . $name . ' .',
                        'message_for' => 1,
                    ];
                    $data[] = [
                        'user_id' => $contractor->id,
                        'message' => 'New project ' . $project_name . ' is Assigned .',
                        'message_for' => 2,
                    ];

                    $notification = $this->Notifications->newEntities($data);
                    $this->Notifications->saveMany($notification);

                    $credit = $this->ContractorCredit->find('all')->where(['user_id' => $key])->first(); //check credit value 
                    if ($credit->total_credit >= $value) {
                        $credit->total_credit = $credit->total_credit - $value; // credit cut 
                        if ($this->ContractorCredit->save($credit)) {
                            $user_data[] = $this->Users->find('all')->contain('UserProfile')->select(['UserProfile.first_name', 'email', 'UserProfile.phone',])->where(['Users.id' => $key])->first();
                            $email = $this->Users->find('all')->select(['email'])->where(['id' => $key])->first();
                            $assigned = $this->AssignedUsers->newEmptyEntity();
                            $assigned->owner_user_id = $this->request->getData('owner_user_id');
                            $assigned->project_id = $this->request->getData('project_id');
                            $assigned->user_id = $key;
                            $assigned->credit_status = 1;
                            $assign_user = $this->AssignedUsers->find('all')->where(['project_id' => $project_id])->first();
                            // $contractor = $this->Users->find('all')->contain(['UserProfile'])->where(['id IN' => $key])->first();

                            if (empty($assign_user)) {
                                if ($this->mail_send($email->email, $project)) {
                                    $this->AssignedUsers->save($assigned);
                                    $count[] = +1;
                                }
                            } else {
                                if ($assign_user->user_id == $key) {
                                } else {
                                    if ($this->mail_send($email->email, $project)) {
                                        $this->AssignedUsers->save($assigned);
                                        $count[] = +1;
                                    }
                                }
                            }
                        }
                        $count_mail_send[] = +1;
                    } else {
                        // not cut credit
                        $email = $this->Users->find('all')->select(['email'])->where(['id' => $key])->first();
                        $assigned = $this->AssignedUsers->newEmptyEntity();
                        $assigned->owner_user_id = $this->request->getData('owner_user_id');
                        $assigned->project_id = $this->request->getData('project_id');
                        $assigned->user_id = $key;
                        $assigned->credit_status = 0;
                        $assign_user = $this->AssignedUsers->find('all')->where(['project_id' => $project_id])->first();
                        if (empty($assign_user)) {
                            if ($this->credit_send_mail($email->email, $project)) {
                                $this->AssignedUsers->save($assigned);
                                $count[] = +1;
                            }
                        } else {
                            if ($assign_user->user_id == $key) {
                            } else {
                                if ($this->credit_send_mail($email->email, $project)) {
                                    $this->AssignedUsers->save($assigned);
                                    $count[] = +1;
                                }
                            }
                        }
                    }
                }
                if (!empty($count_mail_send)) {
                    $owner_email = $this->request->getData('owner_email');
                    if (isset($owner_email)) {
                        // owner mail send 
                        $this->owner_mail_send($owner_email, $user_data);
                        //end owner mail send
                    }
                }
                if (!empty($count)) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
        }
    }
    /*********** assign project ***************************/

    public function assignProject()
    {
        $this->viewBuilder()->setLayout('dashboard_layout');
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $projects =  $this->paginate($this->Projects->find('all')->contain(['Users', 'UserProfile'])->where(['AND' => ['assigned_status' => 1, 'accept_status' => 1]])->order(['Projects.id' => 'DESC']));
        $this->set(compact(['projects', 'admin']));
    }

    /*****************Project assign view*****************/
    public function projectAssignView($id = null)
    {
        $this->viewBuilder()->setLayout('dashboard_layout');
        $project = $this->Projects->get($id, [
            'contain' => ['Users', 'UserProfile'],
        ]);
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $assignuser = $this->AssignedUsers->find('all')->contain(['Users.UserProfile'])->where(['project_id' => $id])->all();
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $contractor = $project->contractor;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                echo json_encode(array(
                    "status" => 1,
                    "message" => "The project has been updated.",
                ));
                exit;
            } else {
                echo json_encode(array(
                    "status" => 0,
                    "message" => "Project not updated. Please, try again.",
                ));
                exit;
            }
        }
        $this->set(compact('project', 'admin', 'assignuser'));
    }

    // public $paginate = [
    //     'limit' => 4
    // ];
}
