<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Product extends Entity
{
    protected $_accessible = [
        'service_id' => true,
        'product_name' => true,
        'delete_status' => true,
        'created' => true,
        'updated' => true,
        'service' => true,
    ];
}
