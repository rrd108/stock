<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CakeDCUsersPhinxlogTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CakeDCUsersPhinxlogTable Test Case
 */
class CakeDCUsersPhinxlogTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CakeDCUsersPhinxlogTable
     */
    public $CakeDCUsersPhinxlog;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CakeDCUsersPhinxlog'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CakeDCUsersPhinxlog') ? [] : ['className' => CakeDCUsersPhinxlogTable::class];
        $this->CakeDCUsersPhinxlog = TableRegistry::getTableLocator()->get('CakeDCUsersPhinxlog', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CakeDCUsersPhinxlog);

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
