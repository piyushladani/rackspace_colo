<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ColocationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ColocationsTable Test Case
 */
class ColocationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ColocationsTable
     */
    public $Colocations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.colocations',
        'app.customers',
        'app.locations',
        'app.racks',
        'app.shelfs',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Colocations') ? [] : ['className' => ColocationsTable::class];
        $this->Colocations = TableRegistry::get('Colocations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Colocations);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
