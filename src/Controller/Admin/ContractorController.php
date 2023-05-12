<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Form\ContactForm;
use App\Model\Entity\Service;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\View\View;

class ContractorController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('UserProfile');
        $this->loadModel('Users');
        $this->loadModel('UserServices');
        $this->loadModel('Services');
        $this->loadModel('Products');
        $this->loadModel('UserProduct');
        // $this->loadModel('Project');

    }
    // gc work
    public function generalListing()
    {
        $this->viewBuilder()->setLayout('dashboard_layout');
        $auth = $this->Authentication->getIdentity();
        if ($auth->user_type != 0) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login', 'prefix' => 'Admin']);
        }
        $uid = $auth->id;
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $users =  $this->paginate($this->Users->find('all')->contain(['UserProfile'])->where(['user_type' => 2])->order(['Users.id' => 'DESC']));
        foreach ($users as $user) {
            if ($user->token == null) {
                $data[] = $user;
            }
        }
        $this->set(compact('data', 'admin'));
    }

    // gc approve
    public function approv($id = null)
    {
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
                $mailer->setSubject('Approp Your Account');
                $mailer->deliver('Dear  ' . $user->user_profile->first_name . ' ' . $user->user_profile->last_name . ',<br>Your Account is Approved.<br> Now you can Login');

                $this->Flash->success(__('Appropped Successfully'));

                return $this->redirect(['controller' => 'Contractor', 'action' => 'generalListing', 'prefix' => 'Admin']);
            }
        }
    }
    // soft delete 
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
            return $this->redirect(['controller' => 'Contractor', 'action' => 'generalListing', 'prefix' => 'Admin']);
        }
    }

    /***************** general Contractor edit************************/
    public function generalContractorEdit($id = null)
    {
        $this->viewBuilder()->setLayout('dashboard_layout');
        $user = $this->Users->get($id, [
            'contain' => ['UserProfile', 'UserServices'],
        ]);
        $users = $this->Users->get($id, [
            'contain' => ['UserProfile', 'UserServices'],
        ]);
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $service_name = $this->UserServices->find('all')->distinct('user_id')->where(['user_id' => $id])->toArray();
        $services = $this->Services->find('all')->contain(['UserServices' => function ($q) use ($id) {
            return $q->where(['UserServices.user_id' => $id]);
        }])->all();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $users = $this->Users->patchEntity($users, $this->request->getData());
            foreach ($users->user_services as $services) {
                foreach ($user->user_services as $service) {
                    if ($services->service_id == $service->service_id) {
                        $del_service = $this->UserServices->get($service->id, []);
                        $this->UserServices->delete($del_service);
                    }
                }
            }
            if ($this->Users->save($users)) {
                echo json_encode(array(
                    "status" => 2,
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
        $this->set(compact('user', 'service_name', 'admin', 'services'));
    }

    /*****************************Active Inactive  function**************************/
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
            return $this->redirect(['controller' => 'Contractor', 'action' => 'generalListing', 'prefix' => 'Admin']);
        }
    }

    /*================ SC Management ===================== */

    // sc work
    public function subListing()
    {
        $this->viewBuilder()->setLayout('dashboard_layout');
        $auth = $this->Authentication->getIdentity();
        if ($auth->user_type != 0) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login', 'prefix' => 'Admin']);
        }
        $uid = $auth->id;
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $users =  $this->paginate($this->Users->find('all')->contain(['UserProfile'])->where(['user_type' => 3])->order(['Users.id' => 'DESC']));
        foreach ($users as $user) {
            if ($user->token == null) {
                $data[] = $user;
            }
        }
        $this->set(compact('data', 'admin'));
    }

    //=========================== material provider list ======================
    public function mpListing()
    {
        $this->viewBuilder()->setLayout('dashboard_layout');
        $auth = $this->Authentication->getIdentity();
        if ($auth->user_type != 0) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login', 'prefix' => 'Admin']);
        }
        $data = array();
        $uid = $auth->id;
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $users =  $this->paginate($this->Users->find('all')->contain(['UserProfile'])->where(['user_type' => 4])->order(['Users.id' => 'DESC']));
        foreach ($users as $user) {
            if ($user->token == null) {
                $data[] = $user;
            }
        }
        $this->set(compact('data', 'admin'));
    }

    //=================== delete recover material provider =========================
    public function mpDeleteRecover($id = null)
    {
        $users = $this->Users->get($id);
        if ($users->delete_status == 1) {
            $users->delete_status = 0;
        } else {
            $users->delete_status = 1;
        }
        if ($this->Users->save($users)) {
            return $this->redirect(['controller' => 'Contractor', 'action' => 'mpListing', 'prefix' => 'Admin']);
        }
    }

    //======================== active inactive material provider ==================
    public function mpActiveInactive($id)
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
            return $this->redirect(['controller' => 'Contractor', 'action' => 'mpListing', 'prefix' => 'Admin']);
        }
    }

    //======================= approve material provider account ============================
    public function mpApprov($id = null)
    {
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
                $mailer->setSubject('Approp Your Account');
                $mailer->deliver('<div>Dear  ' . $user->user_profile->first_name . ' ' . $user->user_profile->last_name . ',<br>Your Account is Approved.<br> Now you can Login</div>');
                $this->Flash->success(__('Appropped Successfully'));
                return $this->redirect(['controller' => 'Contractor', 'action' => 'mpListing', 'prefix' => 'Admin']);
            }
        }
    }

    //==================== update material provider profile ==========================    
    public function mpEdit($id = null)
    {
        $this->viewBuilder()->setLayout('dashboard_layout');
        $user = $this->Users->get($id, [
            'contain' => ['UserProfile', 'UserProduct'],
        ]);
        $users = $this->Users->get($id, [
            'contain' => ['UserProfile', 'UserProduct'],
        ]);
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $product_name = $this->UserProduct->find('all')->distinct('user_id')->where(['user_id' => $id])->toArray();
        $products = $this->Products->find('all')->contain(['UserProduct' => function ($q) use ($id) {
            return $q->where(['UserProduct.user_id' => $id]);
        }])->all();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $users = $this->Users->patchEntity($users, $this->request->getData());
            // dd($users);
            foreach ($users->user_product as $products) {
                foreach ($user->user_product as $product) {
                    if ($products->product_id == $product->product_id) {
                        $del_product = $this->UserProduct->get($product->id, []);
                        $this->UserProduct->delete($del_product);
                    }
                }
            }
            if ($this->Users->save($users)) {
                echo json_encode(array(
                    "status" => 2,
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
        $this->set(compact('user', 'product_name', 'admin', 'products'));
    }

    // ==================== remove exist products from mp profile by admin ===========================
    public function deteleProduct()
    {
        $this->autoRender = false;
        $id = $this->request->getQuery('id');
        $uid = $this->request->getQuery('uid');
        $products = $this->UserProduct->find('all')->where(['user_id' => $uid, 'Product_id' => $id])->first();
        if ($products) {
            if ($this->UserProduct->delete($products)) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function subApprov($id = null)
    {
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
                $mailer->setSubject('Approp Your Account');
                $mailer->deliver('<div>Dear  ' . $user->user_profile->first_name . ' ' . $user->user_profile->last_name . ',<br>Your Account is Approved.<br> Now you can Login</div>');
                $this->Flash->success(__('Appropped Successfully'));
                return $this->redirect(['controller' => 'Contractor', 'action' => 'subListing', 'prefix' => 'Admin']);
            }
        }
    }
    /*********************soft delete******************/
    public function subDeleteRecover($id = null)
    {
        $users = $this->Users->get($id);
        if ($users->delete_status == 1) {
            $users->delete_status = 0;
        } else {
            $users->delete_status = 1;
        }
        if ($this->Users->save($users)) {
            return $this->redirect(['controller' => 'Contractor', 'action' => 'subListing', 'prefix' => 'Admin']);
        }
    }

    /***************sub contractor edit********************/
    public function subContractorEdit($id = null)
    {
        $this->viewBuilder()->setLayout('dashboard_layout');
        $user = $this->Users->get($id, [
            'contain' => ['UserProfile', 'UserServices'],
        ]);
        $users = $this->Users->get($id, [
            'contain' => ['UserProfile', 'UserServices'],
        ]);
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $service_name = $this->UserServices->find('all')->contain('Services')->all();
        $services = $this->Services->find('all')->contain(['UserServices' => function ($q) use ($id) {
            return $q->where(['UserServices.user_id' => $id]);
        }])->all();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $users = $this->Users->patchEntity($users, $this->request->getData());
            foreach ($users->user_services as $services) {
                foreach ($user->user_services as $service) {
                    if ($services->service_id == $service->service_id) {
                        $del_service = $this->UserServices->get($service->id, []);
                        $this->UserServices->delete($del_service);
                    }
                }
            }
            if ($this->Users->save($users)) {
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
        $this->set(compact('user', 'service_name', 'admin', 'services'));
    }

    /**********************Active Inactive  function*******************/

    public function subActiveInactive($id)
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
            return $this->redirect(['controller' => 'Contractor', 'action' => 'subListing', 'prefix' => 'Admin']);
        }
    }


    /**********************deteleServices of contractors*******************/
    public function deteleServices()
    {
        $this->autoRender = false;
        $id = $this->request->getQuery('id');
        $uid = $this->request->getQuery('uid');
        $services = $this->UserServices->find('all')->where(['user_id' => $uid, 'service_id' => $id])->first();
        if ($services) {
            if ($this->UserServices->delete($services)) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    // public $paginate = [
    //     'limit' => 4
    // ];
}
