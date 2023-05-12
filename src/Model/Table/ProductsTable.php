<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProductsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('products');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Services', [
            'foreignKey' => 'service_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('UserProduct', [
            'foreignKey' => 'product_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('service_id')
            ->notEmptyString('service_id');

        // $validator
        //     ->scalar('product_name')
        //     ->maxLength('product_name', 255)
        //     ->allowEmptyString('product_name')
        //     ->add('product_name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        // $validator
        //     ->scalar('delete_status')
        //     ->notEmptyString('delete_status');

        return $validator;
    }


    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['product_name'], ['allowMultipleNulls' => true]), ['errorField' => 'product_name']);
        $rules->add($rules->existsIn('service_id', 'Services'), ['errorField' => 'service_id']);

        return $rules;
    }
}
