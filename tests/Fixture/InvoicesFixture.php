<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InvoicesFixture
 */
class InvoicesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'storage_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'invoicetype_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'partner_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'currency' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'sale' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null],
        'number' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'fk_invoices_partners1_idx' => ['type' => 'index', 'columns' => ['partner_id'], 'length' => []],
            'fk_invoices_invoicetypes1_idx' => ['type' => 'index', 'columns' => ['invoicetype_id'], 'length' => []],
            'fk_invoices_storages1_idx' => ['type' => 'index', 'columns' => ['storage_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_invoices_invoicetypes1' => ['type' => 'foreign', 'columns' => ['invoicetype_id'], 'references' => ['invoicetypes', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_invoices_partners1' => ['type' => 'foreign', 'columns' => ['partner_id'], 'references' => ['partners', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_invoices_storages1' => ['type' => 'foreign', 'columns' => ['storage_id'], 'references' => ['storages', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'storage_id' => 1,
                'invoicetype_id' => 1,
                'partner_id' => 1,
                'date' => '2019-09-29',
                'currency' => 'HUF',
                'sale' => 0,            // purchase
                'number' => 'INV/1'
            ],
            [
                'id' => 2,
                'storage_id' => 1,
                'invoicetype_id' => 1,
                'partner_id' => 1,
                'date' => '2019-09-29',
                'currency' => 'HUF',
                'sale' => 1,
                'number' => 'INV/2'
            ],
            [
                'id' => 3,
                'storage_id' => 1,
                'invoicetype_id' => 1,
                'partner_id' => 1,
                'date' => '2019-09-30',
                'currency' => 'HUF',
                'sale' => 0,            // purchase
                'number' => 'INV/3'
            ],
        ];
        parent::init();
    }
}
