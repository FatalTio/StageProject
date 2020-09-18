<?php

namespace App\Http\Controllers;

use CsCannon\AssetCollectionFactory;
use CsCannon\AssetFactory;
use CsCannon\BlockchainRouting;
use CsCannon\Blockchains\Generic\GenericContractFactory;
use CsCannon\SandraManager;
use SandraCore\System;

class CollectionController extends Controller
{

    

    public function cscToCollection(string $net, string $address, string $function)
    {
        $netToDb = str_replace(' ', '_', $net);

        $cscResult = CscDatasourcesController::calltoArray($netToDb, $address, $function);

        foreach($cscResult as $datasource => $datas){
            $datasources[] = $datasource;
        }

        // $datasourceToDisplay[array_key_first($cscResult)] = array_shift($cscResult);

        // dd($datasources);

        $collections = collect($cscResult)->filter(function($quantity, $key){
            return $quantity > 10;
        });
        // dd($collections);
        return view('collection/collections', [
            'collections'   => $collections,
            'net'           => $net,
            'datasources'   => $datasources,
            'address'       => $address,
            'function'      => $function
        ]);
    }



    public static function makeCollection(array $array, string $net = '')
    {
        $collection = collect($array);
        // dd($collection);
        return view('collection/collection', [
            'collection'    => $collection,
            'net'           => $net
            // 'datasources'   => $datasources
        ]);
    }


}