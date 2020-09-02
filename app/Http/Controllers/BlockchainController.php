<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BlockchainController extends Controller
{

    public function index(){

        $datasources = DB::table('datasource')
                        ->select()
                        ->get();

        return view('index', [
            'datasources'   => $datasources
        ]);
    }

    public function getBlockchainsSources($blockchainId){

        $myBlockchain = strtolower($blockchainId);
        $blockchain = ucfirst($myBlockchain);

        $blockchains = DB::table('blockchain')
                        ->where('blockchain.name', $blockchain)
                        ->join('datasource', 'blockchain_id', '=', 'datasource.blockchain')
                        ->select(['blockchain.name', 'datasource.name'])
                        ->get();

        $result = json_decode(json_encode($blockchains), true);

        // return view()
    }


    public function cscFunctionstest(){

        $blockchains = DB::table('blockchain')
                        ->select()
                        ->get();

        return view('blockchain/index', [
            'blockchains'   => $blockchains
        ]);
    }


}