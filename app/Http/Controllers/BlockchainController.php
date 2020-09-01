<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BlockchainController extends Controller
{

    public function getBlockchains(){

        $blockchains = DB::table('blockchain')
                        ->select()
                        ->get();

        return view('welcome', [
            'blockchains'   => $blockchains
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


}