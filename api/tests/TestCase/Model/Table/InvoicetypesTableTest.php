<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvoicetypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InvoicetypesTable Test Case
 */
class InvoicetypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InvoicetypesTable
     */
    public $Invoicetypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Invoicetypes',
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
        $config = TableRegistry::getTableLocator()->exists('Invoicetypes') ? [] : ['className' => InvoicetypesTable::class];
        $this->Invoicetypes = TableRegistry::getTableLocator()->get('Invoicetypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Invoicetypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
