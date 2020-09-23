<?php

namespace App\Http\Controllers;

use CsCannon\AssetFactory;
use CsCannon\SandraManager;
use Validator;
use Illuminate\Http\Request;
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


    public function factoryToTableView(string $entity){

        $sandra = new System('', true, env('DB_HOST').':'.env('DB_PORT'), env('DB_SANDRA'), env('DB_USERNAME'), env('DB_PASSWORD'));
        SandraManager::setSandra($sandra);

        $classToFind = "CsCannon'";

        $string = addslashes($classToFind) . $entity;

        $factory = str_replace("'", "", $string);

        $entityFactory = new $factory;
        
        $entityFactory->populateLocal();

        foreach($entityFactory->sandraReferenceMap as $concept){

            /** @var \SandraCore\Concept $concept  */
            $columnArray[] = $concept->getShortname();
        }

        return view('collection/collection_display', [
            'refMap'    => $columnArray,
            'entity'    => get_class($entityFactory)
        ]);

    }


    public function makeJsonForTable(string $entity){

        $entityFactory = new $entity;

        $content = $entityFactory->getDisplay();

        return response()->json($content);
    }


}