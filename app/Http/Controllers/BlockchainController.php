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

    /**
     * find the nets of the blockchain for input
     * 
     * @param String $blockchain
     * @return Json
     */
    public static function getNetsFromBlockchain(string $blockchain){

        $nets = DB::table('blockchains')
                ->where('blockchains.name', $blockchain)
                ->join('nets', 'nets.nets_blockchain_id', '=', 'blockchains.id')
                ->select(['blockchains.name', 'nets.name'])
                ->get();

        return response()->json($nets);
    }

    /**
     * find the datasources of the net
     * 
     * @param String $net
     * @return Array with datasources
     */
    public static function getDatasourcesFromNet(string $net){

        $datasources = DB::table('nets')
                        ->where('nets.name', $net)
                        ->join('datasources', 'datasources.datasource_net_id', '=', 'nets.net_id')
                        ->select(['nets.name', 'datasources.name'])
                        ->get();

        return $datasources;
    }


    public static function getBlockchainFromNet(string $net)
    {
        $blockchain = DB::table('nets')
                        ->where('nets.name', $net)
                        ->join('blockchains', 'blockchains.id', '=', 'nets.nets_blockchain_id')
                        ->select(['blockchains.name'])
                        ->get();

        return $blockchain;
    }


}