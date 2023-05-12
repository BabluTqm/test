<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContractorCreditFixture
 */
class ContractorCreditFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'contractor_credit';
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
                'total_credit' => 1,
                'credit_status' => 'Lorem ipsum dolor sit amet',
                'credited_date' => '2023-04-10 09:11:10',
            ],
        ];
        parent::init();
    }
}
