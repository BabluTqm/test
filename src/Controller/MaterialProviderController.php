<?php

declare(strict_types=1);

namespace App\Controller;

class MaterialProviderController extends AppController

{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('material_dashboard');
        $this->loadModel('Users');
        $this->loadModel('Products');
        $this->loadModel('UserProfile');
        $this->loadModel('Projects');
        // $this->loadModel('UserServices');
        // $this->loadModel('Services');
        $this->loadModel('OwnerServices');
        $this->loadModel('AssignedUsers');
        $this->loadModel('ContractorCredit');
        $this->loadModel('Products');
        $this->loadModel('UserProduct');
    }

    /******************************************************* **/
    public function assignedProjectList()
    {
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $user = $this->Users->get($auth->id);
        $result = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        if ($user->complete_status == 1) {
            $this->viewBuilder()->setLayout('material_dashboard');
            $result = $this->Users->get($uid, ['contain' => ['UserProfile']]);
            $abc = $this->AssignedUsers->find('all')->contain(['ContractorCredit'])->all();
            $assignedUsers =  $this->AssignedUsers->find('all')->contain(['Projects.Users', 'Projects.UserProfile'])->where(['AssignedUsers.user_id' => $auth->id, 'AssignedUsers.credit_status' => 0])->toArray();
            $this->set(compact('assignedUsers', 'result'));
        } else {
            $this->Flash->error(__('First you have to complete your profile Then you can Access that page'));
            return $this->redirect(['action' => 'editProfile/' . $auth->id]);
        }
    }
    /******************************************************* **/
    public function purchagedProjectList()
    {
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $user = $this->Users->get($auth->id);
        // if ($user->complete_status == 1) {
        //     $this->viewBuilder()->setLayout('material_dashboard');
        $result = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        //     //dd($result->own_status);
        $purchedUsers =   $this->paginate($this->AssignedUsers->find('all')->contain(['Projects.Users', 'Projects.UserProfile', 'Users', 'UserProfile', 'Users.ContractorCredit', 'Projects' => function ($q) {
            return $q->where(['assigned_status' => 1, 'delete_status' => 1]);
        }])->where(['AssignedUsers.user_id' => $auth->id]));
        //     $purchedUsers =  $this->AssignedUsers->find('all')->contain(['Projects.Users', 'Projects.UserProfile'])->where(['AssignedUsers.user_id' => $auth->id, 'AssignedUsers.credit_status' => 1])->toArray();
        //     //dd($assignedUsers);
        $this->set(compact('purchedUsers', 'result'));
        // } else {
        //     $this->Flash->error(__('First you have to complete your profile Then you can Access that page'));
        //     return $this->redirect(['controller' => 'contractors', 'action' => 'editProfile/' . $auth->id]);
        // }
    }
    /******************************************************* **/
    public function mpProfile()
    {
        $auth = $this->Authentication->getIdentity();
        $id = $auth->id;
        $result = $this->Users->get($id, ['contain' => ['UserProfile']]);
        // $services = $this->paginate($this->Services->find('all')->contain(['UserServices'])->where(['service_status'=>1]));
        $services = $this->Products->find('all')->contain(['UserProduct' => function ($q) use ($id) {
            return $q->where(['UserProduct.user_id' => $id]);
        }])->all();

        $userservices = $this->UserProduct->find('all')->contain('Products')->where(['user_id' => $id])->all();
        //  dd($userservices);

        $this->viewBuilder()->setLayout('material_dashboard');
        $gcsc = $this->Users->get($id, ['contain' => ['UserProfile']]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();
            if ($result->complete_status == 0) {
                $data['complete_status'] = 1;
            }
            $user = $this->Users->patchEntity($gcsc, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The contractor profile has been updated .'));
                return $this->redirect(['controller' => 'contractors', 'action' => 'assigned-project-list']);
            }
            $this->Flash->error(__('The contractor could not be updated. Please, try again.'));
        }
        $this->set(compact('gcsc', 'services', 'auth', 'userservices', 'result'));
    }
    /******************************************************* **/
    public function editProfile($id = null)
    {
        $this->viewBuilder()->setLayout('material_dashboard');
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $result = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $products = $this->Products->find('all')->contain(['UserProduct' => function ($q) use ($id) {
            return $q->where(['UserProduct.user_id' => $id]);
        }])->all();
        $user = $this->Users->get($id, [
            'contain' => ['UserProduct'],
        ]);

        $data = $this->request->getData();
        $dataArray = array();
        foreach ($user['user_product'] as $user_product) {
            $dataArray[] = +$user_product['product_id'];
        }

        $users = $this->Users->get($id, [
            'contain' => ['UserProduct', 'UserProfile'],
        ]);

        $users_profile = $this->UserProfile->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {

            if ($users->complete_status == 0) {
                $data['complete_status'] = 1;
                $users = $this->Users->patchEntity($users, $data);
                $this->Users->save($users);
            }
            if (empty($dataArray)) {
                foreach ($data['user_product'] as $product) {
                    $user_product = $this->UserProduct->newEmptyEntity();
                    $user_product->user_id = $uid;
                    $user_product->product_id = $product['product_id'];
                    $this->UserProduct->save($user_product);
                }
            } else {

                foreach ($data['user_product'] as $product) {
                    if (in_array($product['product_id'], $dataArray)) {
                        continue;
                    } else {
                        $user_product = $this->UserProduct->newEmptyEntity();
                        $user_product->user_id = $uid;
                        $user_product->product_id = $product['product_id'];
                        $this->UserProduct->save($user_product);
                    }
                }
            }

            $this->Users->save($users);
            $users_profile = $this->UserProfile->patchEntity($users_profile, $data['user_profile']);
            if ($this->UserProfile->save($users_profile)) {
                echo json_encode(array(
                    "status" => 1,
                    "message" => "Profile Details has been updated.",
                ));
                exit;
            } else {
                echo json_encode(array(
                    "status" => 0,
                    "message" => "Profile Details could not be update. Please, try again.",
                ));
                exit;
            }
        }
        $this->set(compact('users', 'products', 'result', 'auth'));
    }
    /***************************MP Total Credit******************** */
    public function  totalCredit()
    {
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $user = $this->Users->get($auth->id);
        if ($user->complete_status == 1) {
            $this->viewBuilder()->setLayout('material_dashboard');
            $result = $this->Users->get($uid, ['contain' => ['UserProfile', 'ContractorCredit']]);
            $result = $this->Users->get($uid, ['contain' => ['UserProfile', 'ContractorCredit']]);

            //dd($result);
        } else {
            $this->Flash->error(__('First you have to complete your profile Then you can Access that page'));
            return $this->redirect(['controller' => 'materialProvider', 'action' => 'editProfile/' . $auth->id]);
        }
        $this->set(compact('result'));
    }

    /*************************************************************** */
    public function purchasedCredit()
    {

        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $user = $this->Users->get($auth->id);
        if ($user->complete_status == 1) {
            $this->viewBuilder()->setLayout('material_dashboard');
            $result = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        } else {
            $this->Flash->error(__('First you have to complete your profile Then you can Access that page'));
            return $this->redirect(['action' => 'totalCredit']);
        }
        $this->set(compact('result'));
    }

    public function deleteProduct()
    {
        $this->autoRender = false;
        $id = $this->request->getQuery('id');
        $uid = $this->request->getQuery('uid');
        $products = $this->UserProduct->find('all')->where(['user_id' => $uid, 'product_id' => $id])->first();
        //  dd($services);
        if ($products) {
            if ($this->UserProduct->delete($products)) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    /*********************************************************/
    public function mpStatus($id = null, $own_status)
    {
        $this->request->allowMethod(['post']);
        $user = $this->Users->get($id);
        if ($own_status == 1)
            $user->own_status = 0;
        else
            $user->own_status = 1;
        if ($this->Users->save($user)) {
            echo json_encode(array(
                "status" => 1,
                "message" => "Account status has been changed.",
            ));
            exit;
        } else {
            echo json_encode(array(
                "status" => 0,
                "message" => "Account status could not be update.",
            ));
            exit;
        }
    }
    /*********************************************************/
}
