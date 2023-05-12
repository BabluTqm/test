<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TransactionFixture
 */
class TransactionFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'transaction';
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
                'amount' => 'Lorem ipsum dolor sit amet',
                'transaction_id' => 'Lorem ipsum dolor sit amet',
                'created_date' => 1682925096,
            ],
        ];
        parent::init();
    }
}
