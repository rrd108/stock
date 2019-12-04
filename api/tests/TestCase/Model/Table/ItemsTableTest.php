<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemsTable Test Case
 */
class ItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemsTable
     */
    public $Items;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Items') ? [] : ['className' => ItemsTable::class];
        $this->Items = TableRegistry::getTableLocator()->get('Items', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Items);
        parent::tearDown();
    }
}
