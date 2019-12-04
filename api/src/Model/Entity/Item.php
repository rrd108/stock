<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property int $invoice_id
 * @property int $product_id
 * @property float|null $quantity
 * @property float|null $price
 *
 * @property \App\Model\Entity\Invoice $invoice
 * @property \App\Model\Entity\Product $product
 */
class Item extends Entity
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
        'invoice_id' => true,
        'product_id' => true,
        'quantity' => true,
        'price' => true,
        'invoice' => true,
        'product' => true
    ];
}
