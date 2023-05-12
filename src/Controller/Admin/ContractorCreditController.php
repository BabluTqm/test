<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Entity\Service;

class ContractorCreditController extends AppController
{

    /*************set initial function to load all required Models and layout**************/
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('SetCredit');
        $this->loadModel('Users');
        $this->loadModel('UserProfile');
        $this->loadModel('UserServices');
        $this->loadModel('UserProduct');
        $this->loadModel('Services');
    }

    /*************set credit globaly**************/

    public function setCredit()
    {
        $this->viewBuilder()->setLayout('dashboard_layout');
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $credit = $this->SetCredit->find('all')->where(['user_id' => $uid])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $credit = $this->SetCredit->patchEntity($credit, $this->request->getData());
            // dd($credit);

            if ($this->SetCredit->save($credit)) {
                // $this->Flash->success(__('The credit has been saved.'));
                // return $this->redirect(['action' => 'setCredit', $uid]);
                echo json_encode(array(
                    "status" => 1,
                    "message" => "The credit has been saved.",
                ));
                exit;
            } else {
                echo json_encode(array(
                    "status" => 0,
                    "message" => "The credit could not be saved. Please, try again.",
                ));
                exit;
                // $this->Flash->error(__('The credit could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('credit', 'admin'));
    }

    /************* all credit assign gc and sc**************/
    public function assignCredit()
    {
        $this->viewBuilder()->setLayout('dashboard_layout');
        // for navbar use 
        $auth = $this->Authentication->getIdentity();
        $admin = $this->Users->get($auth->id, ['contain' => ['UserProfile']]);
        // total $credits get 
        $total_service = $this->Services->find('all')->toArray();
        $service_get = array();
        foreach ($total_service as $credits) {
            $service_get[] = $credits->id;
        }
        // assign credit list 
        $gc_credit = $this->UserServices->find('all')->distinct('UserServices.user_id')->contain(['Users.UserProfile', 'Users' => function ($q) {
            return $q->where(['Users.user_type' => 2, 'Users.status' => 1, 'Users.delete_status' => 1, 'Users.approve_status' => 1]);
        }])->where(['service_id IN' => $service_get])->toArray();
        // sc credit
        $sc_credit = $this->UserServices->find('all')->distinct('UserServices.user_id')->contain(['Users.UserProfile', 'Users' => function ($q) {
            return $q->where(['Users.user_type' => 3, 'Users.status' => 1, 'Users.delete_status' => 1, 'Users.approve_status' => 1]);
        }])->where(['service_id IN' => $service_get])->toArray();

        // mp credit
        $mp_credit = $this->UserProduct->find('all')->distinct('UserProduct.user_id')->contain(['Users.UserProfile', 'Users' => function ($q) {
            return $q->where(['Users.user_type' => 4, 'Users.status' => 1, 'Users.delete_status' => 1, 'Users.approve_status' => 1]);
        }])->where(['product_id IN' => $service_get])->toArray();

        $this->set(compact('admin', 'gc_credit', 'sc_credit', 'mp_credit'));
    }

    /*************get credit add**************/
    public function getGcCredit()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $id = $this->request->getQuery('id');
            $check_assign_credit = $this->ContractorCredit->find('all')->where(['user_id' => $id])->first();
            if ($check_assign_credit) {
                echo json_encode([
                    'status' => 1,
                    'data' => $check_assign_credit
                ]);
            } else {
                echo  json_encode([
                    'status' => 0,
                    'data' => $id
                ]);
            }
        }
    }

    public function addCredits()
    {
        $this->autoRender = false;
        $users = $this->Users->find()->first();
        if ($this->request->is('ajax')) {

            $id = $this->request->getData('user_id');
            $credit = $this->ContractorCredit->find()->contain(['Users'])->where(['user_id' => $id])->first();
            $amout = $_POST['total_credit'];
            $uid = $credit->user_id;
            if ($credit->user->user_type == 2 || $credit->user->user_type == 3) {
                $array = array();
                $array['user_id'] = $uid;
                $array['message'] = $amout . ' $ credit in your account.';
                $array['message_for'] = 2;
                $notification = $this->Notifications->newEntity($array);
                $this->Notifications->save($notification);
            }
            if ($credit->user->user_type == 4) {
                $array = array();
                $array['user_id'] = $uid;
                $array['message'] = $amout . ' $ credit in your account.';
                $array['message_for'] = 3;
                $notification = $this->Notifications->newEntity($array);
                $this->Notifications->save($notification);
            }
            if ($credit) {
                $credit->total_credit += $this->request->getData('total_credit');
                if ($this->ContractorCredit->save($credit)) {

                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                $credits = $this->ContractorCredit->newEmptyEntity();
                $data = array();
                if ($this->request->is('post')) {
                    $data['user_id'] = $this->request->getData('user_id');
                    $data['total_credit'] = $this->request->getData('total_credit');
                    $credits = $this->ContractorCredit->patchEntity($credits, $data);
                    if ($this->ContractorCredit->save($credits)) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                }
            }
        }
    }

    /*****************Credit Managment ************** */
    public function  totalCredit()
    {
        // $auth = $this->Authentication->getIdentity();
        // $uid = $auth->id;
        // $user = $this->Users->get($auth->id);
        // if ($user->complete_status == 1) {
        //     $this->viewBuilder()->setLayout('contractor_dashboard');
        //     $result = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        // } else {
        //     $this->Flash->error(__('First you have to complete your profile Then you can Access that page'));
        //     return $this->redirect(['controller' => 'contractors', 'action' => 'editProfile/' . $auth->id]);
        // }
        // $this->set(compact('result'));
    }

    /***************************************** */
    /************************************** */

    public function purchasedCredit()
    {

        // $auth = $this->Authentication->getIdentity();
        // $uid = $auth->id;
        // $user = $this->Users->get($auth->id);
        // if ($user->complete_status == 1) {
        //     $this->viewBuilder()->setLayout('contractor_dashboard');
        //     $result = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        // } else {
        //     $this->Flash->error(__('First you have to complete your profile Then you can Access that page'));
        //     return $this->redirect(['controller' => 'contractors', 'action' => 'editProfile/' . $auth->id]);
        // }
        // $this->set(compact('result'));

    }
    /********************************************* */
}
