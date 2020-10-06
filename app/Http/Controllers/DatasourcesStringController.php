<?php

namespace App\Http\Controllers;

use CsCannon\Blockchains\Counterparty\DataSource\XchainDataSource;
use CsCannon\Blockchains\DataSource\CrystalSuiteDataSource;
use CsCannon\Blockchains\Ethereum\DataSource\BlockscoutAPI;
use CsCannon\Blockchains\Ethereum\DataSource\InfuraProvider;
use CsCannon\Blockchains\Ethereum\DataSource\InfuraProviderRinkeby;
use CsCannon\Blockchains\Ethereum\DataSource\InfuraRopstenProvider;
use CsCannon\Blockchains\Ethereum\DataSource\OpenSeaImporter;
use CsCannon\Blockchains\Ethereum\DataSource\OpenSeaRinkebyDatasource;
use CsCannon\Blockchains\Ethereum\DataSource\phpWeb3;
use CsCannon\Blockchains\Klaytn\BaobabProvider;
use CsCannon\Blockchains\Klaytn\OfficialProvider;

class DatasourcesStringController extends Controller
{

    // datasources compatibles with getBalance
    private static $getBalanceCompatibles = [
        'CrystalSuiteDataSource',
        'XchainDataSource',
        'XchainTestnetDataSource',
        'BlockscoutAPI',
        'OpenSeaImporter',
        'OpenSeaRinkebyDatasource',
        'BlockchainInfo',
        'CryptoApis',
    ];

    // datasources compatibles with TxHistory
    private static $txHistoryCompatibles = [
        'XchainDataSource',
        'XchainTestnetDataSource',
        'BlockscoutAPI',
        'OpenSeaImporter',
        'OpenSeaRinkebyDatasource',
        'BlockchainInfo',
        'CryptoApis',
    ];



    /**
     * Find the compatibles datasources depend of function
     *
     * @param array $datasources
     * @param String $function
     *
     * @return array with the compatibles datasources
     */
    public static function getCompatiblesDataSources(string $net, string $function){

        $myNet = str_replace(' ', '_', $net);

        // get Datasources from net
        $datasources = BlockchainController::getDatasourcesFromNet($myNet);

        // determine the compatibles datasources
        if($function === 'getBalance'){

            $compatibles = self::$getBalanceCompatibles;
            $functionToCall = 'getDatasourceUrlBalance';

        }elseif($function === 'TxHistory'){

            $compatibles = self::$txHistoryCompatibles;
            $functionToCall = 'getDatasourceUrlTxHistory';
        }

        $dataSourcesArray = array();

        // return an array datasource => url
        foreach($datasources as $datasource){

            if(in_array($datasource['name'], $compatibles)){

                $dataSourcesArray[$datasource['name']] = self::$functionToCall($datasource['name']);

            }
        }

        return $dataSourcesArray;
    }



    /**
     * return the good header for the curl request
     *
     * @param String $function
     * @param String $datasource
     * @param String $address
     *
     * @return array header
     */
    public static function findHeader(string $function, string $datasource, string $address){

        // if(strstr($datasource, 'Infura')){

        //     if($function === 'getBalance'){

        //         return [
        //             'Content-Type : application/json',
        //             'jsonrpc'   => '2.0',
        //             'method'    => 'eth_getBalance',
        //             'params'    => [
        //                 $address,
        //                 'latest'
        //             ]
        //         ];

        //     }elseif($function === 'TxHistory'){

        //         return [
        //             'Accepts: application/json'
        //         ];
        //     }

        // }else
        if($datasource == 'CryptoApis'){

            return [
                'Accepts: application/json',
                'X-API-Key: '.env('CRYPTO_API_KEY')
            ];

        }else{

            return [
                'Accepts: application/json'
            ];
        }
    }


    /**
     * return datasource object for CsCannon functions
     *
     * @param String $datasource
     */
    public static function getDatasourceClass(string $datasource){

        switch($datasource){

            case 'CrystalSuiteDataSource':
                return new CrystalSuiteDataSource;
            break;

            case 'XchainDataSource':
                return new XchainDataSource;
            break;

            case 'BlockscoutAPI':
                // return new BlockscoutAPI;
                return null;
            break;

            case 'InfuraProvider':
                // return new InfuraProvider();
                return null;
            break;

            case 'InfuraProviderRinkeby':
                return new InfuraProviderRinkeby();
            break;

            case 'InfuraRopstenProvider':
                return new InfuraRopstenProvider();
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
                return new BaobabProvider();
            break;

            case 'OfficialProvider':
                return new OfficialProvider();
            break;

        }

    }


    /**
     * find the url for getBalance
     *
     * @param String $datasource
     */
    public static function getDatasourceUrlBalance(string $datasource){

        switch($datasource){

            case 'CrystalSuiteDataSource':
                return 'https://baster.bitcrystals.com/api/v1/balances/{address}';
            break;

            case 'XchainDataSource':
                return "https://xchain.io/api/balances/{address}";
            break;

            case 'XchainTestnetDataSource':
                return "https://testnet.xchain.io/api/balances/{address}";
            break;

            case 'BlockscoutAPI':
                return 'https://api.etherscan.io/api?module=account&action=txlist&address={address}&startblock=0&endblock=999999999&sort=desc&apikey='.env('ETHERSCAN_API_KEY');

            case 'InfuraProvider':
                return 'https://mainnet.infura.io/v3/'.env('INFURA_PROJECT_ID');
            break;

            case 'InfuraProviderRinkeby':
                return 'https://rinkeby.infura.io/v3/'.env('INFURA_PROJECT_ID');
            break;

            case 'InfuraRopstenProvider':
                return 'https://ropsten.infura.io/v3/'.env('INFURA_PROJECT_ID');
            break;

            case 'OpenSeaImporter':
                return 'https://api.opensea.io/api/v1/collections/?asset_owner={address}&offset=0&limit=300';
            break;

            case 'OpenSeaRinkebyDatasource':
                return 'https://rinkeby-api.opensea.io/api/v1/collections/?asset_owner={address}&offset=0&limit=300';
            break;

            case 'phpWeb3':
                return null;
            break;

            case 'BaobabProvider':
                return 'https://api.baobab.klaytn.net:8651/';
            break;

            case 'OfficialProvider':
                return null;
            break;

            case 'BlockchainInfo':
                return 'https://blockchain.info/balance?active={address}';
            break;

            case 'CryptoApis':
                return 'https://api.cryptoapis.io/v1/bc/btc/mainnet/address/{address}';
            break;

        }
    }


    /**
     * find the url for TxHistory
     *
     * @param String $datasource
     *
     * @return String
     */
    public static function getDatasourceUrlTxHistory(string $datasource){


        switch($datasource){

            case 'CrystalSuiteDataSource':
                return null;
            break;

            case 'XchainDataSource':
                return "https://xchain.io/api/history/{address}";
            break;

            case 'XchainTestnetDataSource':
                return "https://testnet.xchain.io/api/history/{address}";
            break;

            case 'BlockscoutAPI':
                return 'https://api.etherscan.io/api?module=account&action=txlist&address={address}&startblock=0&endblock=999999999&sort=desc&apikey='.env('ETHERSCAN_API_KEY');
            break;

            case 'InfuraProvider':
                return 'https://mainnet.infura.io/v3/'.env('INFURA_PROJECT_ID');
            break;

            case 'InfuraProviderRinkeby':
                return 'https://rinkeby.infura.io/v3/'.env('INFURA_PROJECT_ID');
            break;

            case 'InfuraRopstenProvider':
                return 'https://ropsten.infura.io/v3/'.env('INFURA_PROJECT_ID');
            break;

            case 'OpenSeaImporter':
                return 'https://api.opensea.io/api/v1/events/?account_address={address}&only_opensea=false&offset=0&limit=20';
            break;

            case 'OpenSeaRinkebyDatasource':
                return 'https://rinkeby-api.opensea.io/api/v1/events/?account_address={address}&only_opensea=false&offset=0&limit=20';
            break;

            case 'phpWeb3':
                return null;
            break;

            case 'BaobabProvider':
                return 'https://api.baobab.klaytn.net:8651/';
            break;

            case 'OfficialProvider':
                return null;
            break;

            case 'BlockchainInfo':
                return 'https://blockchain.info/rawaddr/{address}';
            break;

            case 'CryptoApis':
                return 'https://api.cryptoapis.io/v1/bc/btc/mainnet/address/{address}/transactions';
            break;
        }


    }


}
