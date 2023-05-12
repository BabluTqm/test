<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transaction Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $amount
 * @property string $transaction_id
 * @property \Cake\I18n\FrozenTime $created_date
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Transaction[] $transaction
 */
class Transaction extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'user_id' => true,
        'amount' => true,
        'transaction_id' => true,
        'created_date' => true,
        'user' => true,
        'transaction' => true,
    ];
}
