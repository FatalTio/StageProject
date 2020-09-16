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

        $collections = collect($cscResult);
        // dd($collections);
        return view('collection/collection', [
            'collections'    => $collections,
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

    // public function callCscDatasources(string $datasource, string $net, string $address)
    // {

    //     $netForDb = str_replace(' ', '_', $net);

    //     $sandra = new System('', true, env('DB_HOST').':'.env('DB_PORT'), env('DB_SANDRA'), env('DB_USERNAME'), env('DB_PASSWORD'));
    //     SandraManager::setSandra($sandra);

    //     $assetCollection = new AssetCollectionFactory(SandraManager::getSandra());
    //     $assetCollection->populateLocal();
        
    //     $assetFactory = new AssetFactory();
    //     $assetFactory->populateLocal();

    //     $contractFactory = new GenericContractFactory;
    //     $contractFactory->populateLocal();

    //     $addressFactory = BlockchainRouting::getAddressFactory($address);
    //     $addressToQuery = $addressFactory->get($address);

    //     $objectDatasource = DatasourcesStringController::getDatasourceClass($datasource);

    //     $addressToQuery->setDatasource($objectDatasource);



    // }

}