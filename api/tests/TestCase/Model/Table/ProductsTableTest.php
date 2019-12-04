<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductsTable;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductsTable Test Case
 */
class ProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductsTable
     */
    public $Products;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Products',
        'app.Items',
        'app.Invoices'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Products') ? [] : ['className' => ProductsTable::class];
        $this->Products = TableRegistry::getTableLocator()->get('Products', $config);

        Configure::write('company_id', 1);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Products);
        parent::tearDown();
    }

    public function testFindLastPurchasePrice()
    {
        $actual = $this->Products->find('lastPurchasePrice', ['currency' => 'HUF']);

        $expected = [
            1 => 95,
            2 => 115
        ];
        $this->assertEquals($expected, $actual->combine('id', 'lastPurchasePrice')->toArray());
    }

    public function testFindAvaragePurchasePrice()
    {
        $actual = $this->Products->find('avaragePurchasePrice', ['currency' => 'HUF']);
        $expected = [
            1 => (100+95)/2,
            2 => 115.0
        ];
        $this->assertEquals($expected, $actual->combine('id', 'avaragePurchasePrice')->toArray());
    }

    public function testFindPurchasePrice()
    {
        $actual = $this->Products->find('purchasePrice', ['currency' => 'HUF']);

        $expected = [
            1 => '97.5 :: 95',
            2 => '115.0 :: 115'
        ];

        $this->assertEquals(
            $expected,
            $actual->combine('id', function ($entity) {
                return $entity->avaragePurchasePrice . ' :: ' . $entity->lastPurchasePrice;
            })->toArray()
        );
    }

}
