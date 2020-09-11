<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BlockchainController extends Controller
{

    public function index(){

        $blockchain = DB::table('blockchain')->exists();
        $datasource = DB::table('datasource')->exists();

        if(!$datasource || !$blockchain){

            $init = AppController::init();
        }

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

    }





}