<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int $company_id
 * @property string|null $name
 * @property string|null $size
 * @property float|null $vat
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\Item[] $items
 * @property \App\Model\Entity\Group[] $groups
 */
class Product extends Entity
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
        'name' => true,
        'code' => true,
        'size' => true,
        'vat' => true,
        'company' => true,
        'items' => true,
        'groups' => true
    ];
}
