<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class UserProductTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('user_product');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
    }


    public function validationDefault(Validator $validator): Validator
    {
        // $validator
        //     ->integer('id')
        //     ->requirePresence('id', 'create')
        //     ->notEmptyString('id');

        // $validator
        //     ->integer('user_id')
        //     ->notEmptyString('user_id');

        // $validator
        //     ->integer('product_id')
        //     ->notEmptyString('product_id');

        // $validator
        //     ->dateTime('created_date')
        //     ->requirePresence('created_date', 'create')
        //     ->notEmptyDateTime('created_date');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn('product_id', 'Products'), ['errorField' => 'product_id']);

        return $rules;
    }
}
