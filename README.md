One Variable Under two UserType
 $all_contractor = $this->Users->find('all', array(
            'order' => 'Users.created_at DESC',
            'user_type IN' =>  [2, 3]
        ))->contain(['UserProfile'])->all();