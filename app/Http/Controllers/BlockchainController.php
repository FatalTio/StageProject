<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BlockchainController extends Controller
{

    public function index(){

        $datasources = DB::table('datasources')
                        ->select()
                        ->get();

        return view('index', [
            'datasources'   => $datasources
        ]);
    }

    public static function getBlockchains(){

        $blockchains = DB::table('blockchains')
                        ->select()
                        ->get();

        return $blockchains;
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

    }





}