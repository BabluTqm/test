<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProjectsFixture
 */
class ProjectsFixture extends TestFixture
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
                'project_name' => 'Lorem ipsum dolor sit amet',
                'contractor' => 1,
                'project_address1' => 'Lorem ipsum dolor sit amet',
                'project_address2' => 'Lorem ipsum dolor sit amet',
                'state' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'property_type' => 'Lorem ipsum dolor sit amet',
                'pincode' => 1,
                'assigned_status' => 'Lorem ipsum dolor sit amet',
                'accept_status' => 'Lorem ipsum dolor sit amet',
                'delete_status' => 'Lorem ipsum dolor sit amet',
                'created_date' => '2023-04-10 09:11:52',
            ],
        ];
        parent::init();
    }
}
