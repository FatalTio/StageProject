<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CsCannon\AssetCollectionFactory;
use CsCannon\AssetFactory;
use CsCannon\BlockchainRouting;
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

            $startTime = time();

            $myDatasource = $this->getDatasourceClass($datasource['name']);
            $addressToQuery->setDataSource($myDatasource);

            $cscResponse = $addressToQuery->$function();

            $endTime = time();

            $timeForRequest = $endTime - $startTime;

            $results[$datasource['name']]['time'] = $timeForRequest . ' sec';
            $results[$datasource['name']]['contracts'] = $cscResponse->contracts;

        }

        // dd($results);
        return view('blockchain/results', [
            'results' => $results
        ]);

    }


    private function getDatasourceClass(string $datasource){

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