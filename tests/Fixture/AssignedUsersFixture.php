<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AssignedUsersFixture
 */
class AssignedUsersFixture extends TestFixture
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
                'owner_user_id' => 1,
                'project_id' => 1,
                'user_id' => 1,
                'credit_status' => 'Lorem ipsum dolor sit amet',
                'created_date' => '2023-04-10 09:10:20',
            ],
        ];
        parent::init();
    }
}
