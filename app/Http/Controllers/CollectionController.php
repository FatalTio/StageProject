<?php

namespace App\Http\Controllers;

use App\Http\Ressources\TableView;
use CsCannon\AssetCollectionFactory;
use CsCannon\Blockchains\Generic\GenericContractFactory;
use CsCannon\AssetFactory;
use CsCannon\SandraManager;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ReflectionClass;
use SandraCore\EntityFactory;
use SandraCore\System;

class CollectionController extends Controller
{


    public function htmlTableView(Request $request)
    {
        $datas = $request->all();

        // Check the form
        $validator = Validator::make($datas, [
            'address'       => 'required|max:255',
            'blockchain'    => 'required',
            'function'      => 'required'
        ]);

        $errors = $validator->messages();
        
        if($validator->fails()){

            return view('blockchain/index', [
                'howToTest'     => $request->input('howToTest'),
                'blockchains'   => BlockchainController::getBlockchains()
            ])
            ->withErrors($errors)
            ->withInput();
        }

        $function = $request->input('function');
        $address = $request->input('address');
        $net = str_replace(' ', '_', $request->input('net'));
        $howToTest = $request->input('howToTest');
        
        return view('collection/collection_display', [
            'function'      => $function, 
            'address'       => $address,
            'net'           => $net,
            'howToTest'     => $howToTest
        ]);
    }




    public static function createViewTable(string $entity)
    {
        $sandra = new System('', true, env('DB_HOST').':'.env('DB_PORT'), env('DB_SANDRA'), env('DB_USERNAME'), env('DB_PASSWORD'));
        SandraManager::setSandra($sandra);

        $classToFind = "CsCannon'";
        $string = addslashes($classToFind) . $entity;
        $factory = str_replace("'", "", $string);

        if($entity == 'CsCannon\AssetCollectionFactory'){
            $entityFactory = new AssetCollectionFactory(SandraManager::getSandra());
        }else{
            $entityFactory = new $factory;
        }

        /** @var \SandraCore\EntityFactory $entityFactory */

        $entityFactory->populateLocal();
        $entityFactory->createViewTable($entity . '_cscview');

        return $entityFactory;
    }



    public function factoryToTableView(string $entity){

        
        $entityFactory = self::createViewTable($entity);

        foreach($entityFactory->sandraReferenceMap as $concept){

            /** @var \SandraCore\Concept $concept  */
            $columnArray[] = $concept->getShortname();
        }

        return view('collection/collection_display', [
            'refMap'    => $columnArray,
            'table'     => $entity
        ]);

    }
    



    public function dbToJson(string $tableName){

        $myDatas = TableViewController::getWithPagination($tableName, 500);

        if(!$myDatas){
            return [];
        }

        $response['draw'] = 1;
        $response['recordsTotal'] = count($myDatas);
        $response['data'] = $myDatas;

        return $response;
    }



}