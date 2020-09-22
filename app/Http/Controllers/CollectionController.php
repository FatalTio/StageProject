<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

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

        $blockchain = $request->input('blockchain');
        $function = $request->input('function');
        $address = $request->input('address');
        $net = str_replace(' ', '_', $request->input('net'));
        $howToTest = $request->input('howToTest');
        
        return view('collection/collection_display', [
            'blockchain'    => $blockchain,
            'function'      => $function, 
            'address'       => $address,
            'net'           => $net,
            'howToTest'     => $howToTest
        ]);
    }




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
            // 'net'           => $net,
            'datasources'   => $datasources,
            // 'address'       => $address,
            // 'function'      => $function
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