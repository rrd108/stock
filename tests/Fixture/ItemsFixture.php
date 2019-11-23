<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ItemsFixture
 */
class ItemsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'invoice_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'product_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'quantity' => ['type' => 'decimal', 'length' => 6, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'price' => ['type' => 'decimal', 'length' => 8, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'fk_moves_invoices1_idx' => ['type' => 'index', 'columns' => ['invoice_id'], 'length' => []],
            'fk_moves_products1_idx' => ['type' => 'index', 'columns' => ['product_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_moves_invoices1' => ['type' => 'foreign', 'columns' => ['invoice_id'], 'references' => ['invoices', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_moves_products1' => ['type' => 'foreign', 'columns' => ['product_id'], 'references' => ['products', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_hungarian_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'invoice_id' => 1,
                'product_id' => 1,
                'quantity' => 3,
                'price' => 100,
            ],
            [
                'id' => 2,
                'invoice_id' => 1,
                'product_id' => 2,
                'quantity' => 10,
                'price' => 115,
            ],
            [
                'id' => 3,
                'invoice_id' => 2,
                'product_id' => 2,
                'quantity' => 8,
                'price' => 555,
            ],
            [
                'id' => 4,
                'invoice_id' => 3,
                'product_id' => 1,
                'quantity' => 8,
                'price' => 95,
            ],
        ];
        parent::init();
    }
}
