<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Invoice Entity
 *
 * @property int $id
 * @property int $storage_id
 * @property int $invoicetype_id
 * @property int $partner_id
 * @property \Cake\I18n\FrozenDate|null $date
 * @property string $currency
 * @property bool|null $sale
 * @property string $number
 *
 * @property \App\Model\Entity\Storage $storage
 * @property \App\Model\Entity\Invoicetype $invoicetype
 * @property \App\Model\Entity\Partner $partner
 * @property \App\Model\Entity\Item[] $items
 */
class Invoice extends Entity
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
        'storage_id' => true,
        'invoicetype_id' => true,
        'partner_id' => true,
        'date' => true,
        'currency' => true,
        'sale' => true,
        'number' => true,
        'storage' => true,
        'invoicetype' => true,
        'partner' => true,
        'items' => true
    ];
}
