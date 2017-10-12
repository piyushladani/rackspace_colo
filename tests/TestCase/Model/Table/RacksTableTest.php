<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RacksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RacksTable Test Case
 */
class RacksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RacksTable
     */
    public $Racks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.racks',
        'app.locations',
        'app.colocations',
        'app.customers',
        'app.shelfs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Racks') ? [] : ['className' => RacksTable::class];
        $this->Racks = TableRegistry::get('Racks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Racks);

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
