<?php

declare(strict_types=1);

namespace App\Model\Entity;
use Cake\ORM\Entity;

class UserProduct extends Entity
{
    protected $_accessible = [
        'user_id' => true,
        'product_id' => true,
        'created_date' => true,
        'user' => true,
        'product' => true,

       
    ];
}