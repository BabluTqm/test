<?php

declare(strict_types=1);


namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Routing\Router;
// use Cake\Controller\Controller;
class AppController extends Controller
{
    //Admin prefix set
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication', [
            'unauthenticatedRedirect' => Router::url([
                'prefix' => 'Admin',
                'plugin' => null,
                'controller' => 'Users',
                'action' => 'login',
            ]),
            'loginUrl' => Router::url([
                'prefix' => 'Admin',
                'plugin' => null,
                'controller' => 'Users',
                'action' => 'login',
            ]),

        ]);
        $this->Model = $this->loadModel('Notifications');

        if ($this->Authentication->getIdentity() != null) {
            $result = $this->Authentication->getIdentity();
            $role = $result->user_type;
            if ($role == 0) {
                $notifications = $this->Notifications->find('all')->where(['message_for' => 0, 'Notifications.status' => 0])->order(['Notifications.id' => 'DESC'])->all();
                $this->set(compact('notifications'));
            }
            if ($role == 1) {
                $notifications1 = $this->Notifications->find('all')->where(['message_for' => 1, 'Notifications.user_id' => $result->id, 'Notifications.status' => 0])->order(['Notifications.id' => 'DESC'])->all();
                $this->set(compact('notifications1'));
            }
            if ($role == 2 || $role == 3) {
                $notifications2 = $this->Notifications->find('all')->where(['message_for' => 2, 'Notifications.user_id' => $result->id, 'Notifications.status' => 0])->order(['Notifications.id' => 'DESC'])->all();
                $this->set(compact('notifications2'));
            }
            if ($role == 4) {
                $notifications3 = $this->Notifications->find('all')->where(['message_for' => 3, 'Notifications.user_id' => $result->id, 'Notifications.status' => 0])->order(['Notifications.id' => 'DESC'])->all();
                $this->set(compact('notifications3'));
            }
        }
    }
}
