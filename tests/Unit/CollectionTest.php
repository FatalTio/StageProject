<?php

namespace Tests\Unit;

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\TableViewController;
use Tests\TestCase;

class CollectionTest extends TestCase
{

    public function testCreateViewTable(){

        $tableToTest = 'assetFactory';
        $collection = new CollectionController;


        $tableView = $collection->createEntityAndViewTable($tableToTest);
        $this->assertIsObject($tableView, 'SandraCore\EntityFactory');

        $dbTable = json_decode(TableViewController::get($tableToTest), true);
        $this->assertIsArray($dbTable);
        $this->assertArrayHasKey('assetId', $dbTable[0]);
        $this->assertArrayHasKey('imgURL', $dbTable[0]);
        $this->assertArrayHasKey('assetName', $dbTable[0]);
        
        
        $blockchainTable = $collection->createEntityAndViewTable('BlockchainEventFactory');
        $this->assertIsObject($blockchainTable, 'CsCannon\Blockchains\BlockchainBlockFactory');

        $falseTable = $collection->createEntityAndViewTable('falseTable');
        $this->assertFalse($falseTable);


        $count = $collection->countDatas($tableToTest);
        $this->assertIsInt($count);


        $tableJson = $collection->dbToJson($tableToTest);
        $this->assertArrayHasKey('recordsTotal', $tableJson);
        $this->assertArrayHasKey('data', $tableJson);


    }

}