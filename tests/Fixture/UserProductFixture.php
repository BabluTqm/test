<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserProductFixture
 */
class UserProductFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'user_product';
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
                'user_id' => 1,
                'product_id' => 1,
                'created_date' => '2023-05-04 08:49:54',
            ],
        ];
        parent::init();
    }
}
