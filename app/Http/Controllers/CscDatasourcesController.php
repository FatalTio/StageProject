<?php

namespace App\Http\Controllers;

use CsCannon\AssetCollection;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CsCannon\AssetCollectionFactory;
use CsCannon\AssetFactory;
use CsCannon\BlockchainRouting;
use CsCannon\Blockchains\BlockchainAddress;
use CsCannon\Blockchains\Counterparty\DataSource\XchainDataSource;
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


    public function functionsTest(string $howToTest)
    {
        $blockchains = BlockchainController::getBlockchains();

        return view('blockchain/index', [
            'howToTest'     => $howToTest,
            'blockchains'   => $blockchains
        ]);
    }


    
    /**
     * return a view after calling csc functions
     * 
     * @param Request POST
     */
    public function testAllDatasources(Request $request)
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
        $net = $request->input('net');
        $howToTest = $request->input('howToTest');

        $results = self::calltoArray($net, $address, $function);
        
        return view('blockchain/balance_results', [
            'results'       => $results,
            'function'      => $function,
            'blockchain'    => $blockchain,
            'net'           => $net,
            'address'       => $address,
            'howTotest'     => $howToTest
        ]);

    }


    public static function calltoArray(string $net, string $address, string $function)
    {

        $netForSearch = str_replace(' ', '_', $net);
        
        // get the datasources associated at blockchain
        $datasourcesFromNet = BlockchainController::getDatasourcesFromNet($netForSearch);
        
        $datasources = json_decode(json_encode($datasourcesFromNet), true);
        
        // Initialize CsCannon System and populate
        $sandra = new System('', true, env('DB_HOST').':'.env('DB_PORT'), env('DB_SANDRA'), env('DB_USERNAME'), env('DB_PASSWORD'));
        SandraManager::setSandra($sandra);
        
        $assetCollection = new AssetCollectionFactory($sandra);
        $assetCollection->populateLocal();

        $assetFactory = new AssetFactory();
        $assetFactory->populateLocal();

        $contractFactory = new GenericContractFactory;
        $contractFactory->populateLocal();

        $addressFactory = BlockchainRouting::getAddressFactory($address);
        $addressToQuery = $addressFactory->get($address);

        $results = array();

        // call the differents datasources
        foreach($datasources as $datasource){

            $myDatasource = DatasourcesStringController::getDatasourceClass($datasource['name']);
            
            if($myDatasource != null){

                $addressToQuery->setDataSource($myDatasource);
                $results[$datasource['name']] = self::callFunction($addressToQuery, $function);
            }
        }
       
        return $results;
    }

    /**
     * call the function needed with string (input) function
     * 
     * @param BlockchainAddress $address
     * @param String $function
     * 
     * @return Array of results
     */
    public static function callFunction(BlockchainAddress $address, string $function)
    {

        $startTime = microtime(true);
        
        $cscResponse = $address->getBalance();

        $result = array();

        if($function == 'returnObsByCollection'){

            $obsByCollection = $cscResponse->returnObsByCollections();

            $endTime = microtime(true);

            $timeForRequest = round(($endTime - $startTime), 5);
        
            
            if(!empty($obsByCollection['collections'])){

                $result['time'] = $timeForRequest . ' sec';
                $result['collections'] = $obsByCollection['collections'];
            }

        }else{

            $endTime = microtime(true);
            $timeForRequest = round(($endTime - $startTime), 5);

            foreach($cscResponse->contracts as $blockchain){

                foreach($blockchain as $name => $contract){
                    
                    unset($contract['']['token']);

                    $contractArray[$name] = $contract;
                }
            }

            $result['time'] = $timeForRequest . ' sec';
            $result['results'] = $contractArray;

        }

        return $result;

    }

    /**
     * create a Json
     * 
     * @param String $datasource
     * @param String $function
     * @param String $address
     * 
     * @return Json of results
     */
    public function viewJson(string $datasource, string $function, string $address)
    {

        // $sandra = new System('', true, env('DB_HOST').':'.env('DB_PORT'), env('DB_SANDRA'), env('DB_USERNAME'), env('DB_PASSWORD'));
        // SandraManager::setSandra($sandra);

        // $assetCollection = new AssetCollectionFactory(SandraManager::getSandra());

        $addressFactory = BlockchainRouting::getAddressFactory($address);
        $addressToQuery = $addressFactory->get($address);

        $myDatasource = DatasourcesStringController::getDatasourceClass($datasource);
        $addressToQuery->setDataSource($myDatasource);

        $array = self::callFunction($addressToQuery, $function);

        return response()->json($array);
    }


}