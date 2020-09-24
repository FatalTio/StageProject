<?php

namespace App\Http\Controllers;

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

    // private function __autoload($className){
    //     if(file_exists($className . '.php')){
    //         require_once $className . '.php';
    //         return true;
    //     }
    //     return false;
    // }

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


    public function factoryToTableView(string $entity){

        $sandra = new System('', true, env('DB_HOST').':'.env('DB_PORT'), env('DB_SANDRA'), env('DB_USERNAME'), env('DB_PASSWORD'));
        SandraManager::setSandra($sandra);


        // $class = new ReflectionClass($entity);
        // dd($class->getParentClass());

        $classToFind = "CsCannon'";
        $string = addslashes($classToFind) . $entity;
        $factory = str_replace("'", "", $string);

        if($entity == 'CsCannon\AssetCollectionFactory'){
            $entityFactory = new AssetCollectionFactory(SandraManager::getSandra());
        }else{
            $entityFactory = new $factory;
        }

        
        $entityFactory->populateLocal();
        $entityFactory->createViewTable($entity . '_view');
        // die;



        foreach($entityFactory->sandraReferenceMap as $concept){

            /** @var \SandraCore\Concept $concept  */
            $columnArray[] = $concept->getShortname();
        }

        return view('collection/collection_display', [
            'refMap'    => $columnArray,
            'entity'    => get_class($entityFactory)
        ]);

    }

    public function dbToJson(string $tableName){

        $myDatas = DB::table( env('DB_SANDRA') . '.' . $tableName)->select('*')->get();

        return $myDatas;
    }


    public function makeJsonForTable(string $entity){

        $sandra = new System('', true, env('DB_HOST').':'.env('DB_PORT'), env('DB_SANDRA'), env('DB_USERNAME'), env('DB_PASSWORD'));
        SandraManager::setSandra($sandra);

        $classToFind = "CsCannon'";
        $string = addslashes($classToFind) . $entity;
        $factory = str_replace("'", "", $string);


        if($factory == 'CsCannon\AssetCollectionFactory'){
            $entityFactory = new AssetCollectionFactory(SandraManager::getSandra());
        }else{
            $entityFactory = new $factory;
        }

        $entityFactory->populateLocal();
        $content = $entityFactory->getDisplay('array');


        foreach($entityFactory->sandraReferenceMap as $concept){
            $columnArray[] = $concept->getShortname();
        }


        foreach($content as $myContent){
            foreach($columnArray as $collumnTitle){
                if(!array_key_exists($collumnTitle, $myContent)){
                    $myContent[$collumnTitle] = null;
                }
            }
            $newResponse[] = $myContent;
        }

        $jsonContent['draw'] = 1;
        $jsonContent['recordsTotal'] = count($newResponse);
        $jsonContent['recordsFiltered'] = count($newResponse);
        $jsonContent['data'] = $newResponse;

        return response()->json($jsonContent);
    }


}