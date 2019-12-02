<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Partner Entity
 *
 * @property int $id
 * @property int $company_id
 * @property int $group_id
 * @property string|null $name
 * @property string|null $zip
 * @property string|null $city
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $taxnumber
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\Group $group
 * @property \App\Model\Entity\Invoice[] $invoices
 */
class Partner extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'company_id' => true,
        'group_id' => true,
        'name' => true,
        'zip' => true,
        'city' => true,
        'address' => true,
        'phone' => true,
        'email' => true,
        'taxnumber' => true,
        'company' => true,
        'group' => true,
        'invoices' => true
    ];
}
