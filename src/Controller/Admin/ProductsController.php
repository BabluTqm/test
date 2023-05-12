<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\View\View;


class ProductsController extends AppController
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
        $this->loadModel('AssignedUsers');
        $this->loadModel('Products');
    }

    //===================== product listing ================================
    public function productManagement()
    {
        $this->viewBuilder()->setLayout('dashboard_layout');
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $admin = $this->Users->get($uid, ['contain' => ['UserProfile']]);
        $products = $this->Products->find()->contain(['Services'])->order(['Products.id' => 'DESC'])->all();
        $this->set(compact('admin', 'products'));
    }

    //======================= Add products ===============================
    public function addProduct()
    {
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $product_name = $this->request->getData('product_name');
            $product_exist = $this->Products->find()->where(['product_name' => $product_name, 'delete_status' => 1])->all();
            if (count($product_exist) == 0) {

                $data['service_id'] = $this->request->getData('service_id');
                $product = $this->Products->patchEntity($product, $data);
                if ($this->Products->save($product)) {
                    echo json_encode(array(
                        "status" => 1,
                        "message" => "product saved"
                    ));
                    die;
                }
                echo json_encode(array(
                    "status" => 0,
                    "message" => "product not saved"
                ));
                die;
            } else {
                echo json_encode(array(
                    "status" => 2,
                    "message" => "product name already exist"
                ));
                die;
            }
        }
    }

    //================================= get product details in modal =====================
    public function getProduct()
    {
        $id = $this->request->getQuery('id');
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $product = $this->Products->get($id, [
                'contain' => [],
            ]);
            echo json_encode($product);
            exit;
        }
    }

    //================================= update product details =====================
    public function updateProduct()
    {
        if ($this->request->is('ajax')) {
            $data = $this->request->getData();
            $id = $this->request->getData('id');

            $product = $this->Products->get($id, [
                'contain' => [],
            ]);

            $product = $this->Products->patchEntity($product, $data);
            if ($this->Products->save($product)) {
                echo json_encode(array(
                    "status" => 1,
                    "message" => "Product has been saved.",
                ));
                exit;
            } else {
                echo json_encode(array(
                    "status" => 0,
                    "message" => "Product not Updated. Please, try again.",
                ));
                exit;
            }
        }
    }

    //================================ soft delete/recover products ===========================
    public function deleteRecoverProduct($id = null)
    {
        $this->autoRender = false;
        $product = $this->Products->get($id);
        if ($product->delete_status == 1) {
            $data = array('id' => $id, 'delete_status' => 0);
        } else {
            $data = array('id' => $id, 'delete_status' => 1);
        }
        $product = $this->Products->patchEntity($product, $data);
        if ($this->Products->save($product)) {
            $this->redirect(['controller' => 'products', 'prefix' => 'Admin', 'action' => 'productManagement']);
        }
    }
}
