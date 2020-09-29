<?php

namespace Tests\Unit;

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\TableViewController;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{

    public function testCreateViewTable(){

        $tableToTest = 'assetFactory';
        $collection = new CollectionController;

        $tableView = $collection->createViewTable($tableToTest);
        $this->assertIsObject($tableView, 'CsCannon\AssetFactory');
        
        $table = TableViewController::get($tableToTest);
        $this->assertIsObject($table, '\Illuminate\Support\Collection');

        $count = $collection->countDatas($tableToTest);
        $this->assertIsInt($count);

        $tableJson = $collection->dbToJson($tableToTest);
        $this->assertArrayHasKey('recordsTotal', $tableJson);
        $this->assertArrayHasKey('data', $tableJson);


    }

}