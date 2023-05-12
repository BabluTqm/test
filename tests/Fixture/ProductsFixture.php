<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductsFixture
 */
class ProductsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'service_id' => 1,
<<<<<<< HEAD
                'product_name' => 'Lorem ipsum dolor sit amet',
                'delete_status' => 'Lorem ipsum dolor sit amet',
                'created' => 1683195530,
                'updated' => 1683195530,
=======
                'products' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
<<<<<<< HEAD
                'created' => 1683181465,
                'updated' => 1683181465,
=======
                'created' => 1683190169,
                'updated' => 1683190169,
>>>>>>> ca17cb0614d77525e63f39b2e0223323e1d0d0e3
>>>>>>> a7cbff0c00c0eb239ec128dd3c472818682bccbf
            ],
        ];
        parent::init();
    }
}
