<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;


class SetCredit extends Entity
{
    
    protected $_accessible = [
        'user_id' => true,
        'credit' => true,
        'mp_credit' => true,
        'user' => true,
        'min_credit' => true,

    ];
}
