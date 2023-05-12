<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
// use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;

class NotificationComponent extends Component
{

    public function notificationemail($email)
    {
        $mailer = new Mailer('default');
        $mailer->setTransport('gmail');
        $mailer->setFrom(['shalini.17bcs2061@gmail.com'])
            ->setTo($email)
            ->setEmailFormat('html')
            ->setSubject('Your credit is not enough')
            ->deliver('Hello<br/>Your account has  insufficient credit.<br>Please purchased Credit in your Account</br>
                        <a href="">Click Here</a>');
    }
}
