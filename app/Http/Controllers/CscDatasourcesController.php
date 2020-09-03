<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CsCannon\AssetCollectionFactory;
use CsCannon\AssetFactory;
use CsCannon\BlockchainRouting;
use CsCannon\Blockchains\BlockchainAddress;
use CsCannon\Blockchains\Counterparty\DataSource\XchainDataSource;
use CsCannon\Blockchains\Counterparty\DataSource\XchainOnBcy;
use CsCannon\Blockchains\DataSource\CrystalSuiteDataSource;
use CsCannon\Blockchains\Ethereum\DataSource\BlockscoutAPI;
use CsCannon\Blockchains\Ethereum\DataSource\InfuraProvider;
use CsCannon\Blockchains\Ethereum\DataSource\InfuraProviderRinkeby;
use CsCannon\Blockchains\Ethereum\DataSource\InfuraRopstenProvider;
use CsCannon\Blockchains\Ethereum\DataSource\OpenSeaImporter;
use CsCannon\Blockchains\Ethereum\DataSource\OpenSeaRinkebyDatasource;
use CsCannon\Blockchains\Ethereum\DataSource\phpWeb3;
use CsCannon\Blockchains\Generic\GenericContractFactory;
use CsCannon\Blockchains\Klaytn\BaobabProvider;
use CsCannon\Blockchains\Klaytn\OfficialProvider;
use CsCannon\SandraManager;
use SandraCore\System;

class CscDatasourcesController extends Controller
{


    public function functionsTest(string $howToTest){

        $blockchains = DB::table('blockchain')
                        ->select()
                        ->get();

        return view('blockchain/index', [
            'testToDo'      => $howToTest,
            'blockchains'   => $blockchains
        ]);
    }

    public function testAllDatasources(Request $request){

        $blockchain = $request->input('blockchain');
        $function = $request->input('function');
        $address = $request->input('address');

        $myBlockchain = strtolower($blockchain);
        $blockchain = ucfirst($myBlockchain);

        $blockchains = DB::table('blockchain')
                        ->where('blockchain.name', $blockchain)
                        ->join('datasource', 'blockchain_id', '=', 'datasource.blockchain')
                        ->select(['blockchain.name', 'datasource.name'])
                        ->get();

        $datasources = json_decode(json_encode($blockchains), true);


        $sandra = new System('', true, env('DB_HOST').':'.env('DB_PORT'), env('DB_SANDRA'), env('DB_USERNAME'), env('DB_PASSWORD'));
        SandraManager::setSandra($sandra);

        $assetCollection = new AssetCollectionFactory(SandraManager::getSandra());
        $assetCollection->populateLocal();

        $assetFactory = new AssetFactory();
        $assetFactory->populateLocal();

        $contractFactory = new GenericContractFactory;
        $contractFactory->populateLocal();

        $addressFactory = BlockchainRouting::getAddressFactory($address);
        $addressToQuery = $addressFactory->get($address);


        foreach($datasources as $datasource){

            $myDatasource = self::getDatasourceClass($datasource['name']);
            $addressToQuery->setDataSource($myDatasource);

            $results[$datasource['name']] = $this->callFunction($addressToQuery, $function);

        }


        return view('blockchain/balance_results', [
            'results'       => $results,
            'function'      => $function,
            'address'       => $address
        ]);

    }


    private function callFunction(BlockchainAddress $address, string $function){

        $startTime = time();

        $cscResponse = $address->getBalance();

        if($function == 'returnObsByCollection'){

            $obsByCollection = $cscResponse->returnObsByCollections();

            $endTime = time();
            $timeForRequest = $endTime - $startTime;
                
            $result['time'] = $timeForRequest . ' sec';
            $result['collections'] = $obsByCollection['collections'];

        }else{

            $endTime = time();
            $timeForRequest = $endTime - $startTime;

            // foreach($cscResponse->contracts as $blockchain){

            //     foreach($blockchain as $name => $contract){
                    
            //         unset($contract['']['token']);

            //         $contractArray[$name] = $contract;
            //     }
            //     $blockchainArray[$blockchain] = $contractArray;
            // }

            $result['time'] = $timeForRequest . ' sec';
            $result['results'] = $cscResponse->contracts;

        }


        return ;

    }


    public function viewJson(string $datasource, string $function, string $address){

        $sandra = new System('', true, env('DB_HOST').':'.env('DB_PORT'), env('DB_SANDRA'), env('DB_USERNAME'), env('DB_PASSWORD'));
        SandraManager::setSandra($sandra);

        $assetCollection = new AssetCollectionFactory(SandraManager::getSandra());

        $addressFactory = BlockchainRouting::getAddressFactory($address);
        $addressToQuery = $addressFactory->get($address);

        $myDatasource = self::getDatasourceClass($datasource);
        $addressToQuery->setDataSource($myDatasource);

        $array = $this->callFunction($addressToQuery, $function);



        dd($array);

        return ;
    }


    public static function getDatasourceClass(string $datasource){

        switch($datasource){

            case 'CrystalSuiteDataSource':
                return new CrystalSuiteDataSource;
            break;

            case 'XchainDataSource':
                return new XchainDataSource;
            break;

            case 'XchainOnBcy':
                return new XchainOnBcy;
            break;

            case 'BlockscoutAPI':
                return new BlockscoutAPI;
            break;

            case 'InfuraProvider':
                return new InfuraProvider;
            break;

            case 'InfuraProviderRinkeby':
                return new InfuraProviderRinkeby;
            break;

            case 'InfuraRopstenProvider':
                return new InfuraRopstenProvider;
            break;

            case 'OpenSeaImporter':
                return new OpenSeaImporter;
            break;

            case 'OpenSeaRinkebyDatasource':
                return new OpenSeaRinkebyDatasource;
            break;

            case 'phpWeb3':
                return new phpWeb3;
            break;

            case 'BaobabProvider':
                return new BaobabProvider;
            break;

            case 'OfficialProvider':
                return new OfficialProvider;
            break;

        }


    }


}