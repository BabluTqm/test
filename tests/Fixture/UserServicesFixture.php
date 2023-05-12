<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserServicesFixture
 */
class UserServicesFixture extends TestFixture
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
                'user_id' => 1,
                'service_id' => 1,
                'created_date' => '2023-04-10 09:08:52',
            ],
        ];
        parent::init();
    }
}
