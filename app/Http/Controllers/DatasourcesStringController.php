<?php

namespace App\Http\Controllers;

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
use CsCannon\Blockchains\Klaytn\BaobabProvider;
use CsCannon\Blockchains\Klaytn\OfficialProvider;

class DatasourcesStringController extends Controller
{

    private static $getBalanceCompatibles = [
        'CrystalSuiteDataSource',
        'XchainDataSource',
        'XchainOnBcy',
        'BlockscoutAPI'
    ];

    private static $txHistoryCompatibles = [

    ];

    public static function getCompatiblesDataSources(array $datasources, string $function){


        if($function === 'getBalance'){

            $compatibles = self::$getBalanceCompatibles;
            $goodAttribute = 'getDatasourceUrlBalance';

        }else{

            $compatibles = self:: $txHistoryCompatibles;
            $goodAttribute = 'getDatasourceUrlTxHistory';
        }

        
        foreach($datasources as $datasource){
            
            if(in_array($datasource['name'], $compatibles)){

                $dataSourcesArray[$datasource['name']] = self::$goodAttribute($datasource['name']);

            }

        }
        
        return $dataSourcesArray;

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
                return new InfuraProvider();
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

    public static function getDatasourceUrlBalance(string $datasource){

        switch($datasource){

            case 'CrystalSuiteDataSource':
                return 'https://baster.bitcrystals.com/api/v1/tokens/balances/{address}';
            break;

            case 'XchainDataSource':
                return "https://xchain.io/api/balances/{address}";
            break;

            case 'XchainOnBcy':
                return "https://xchain.io/api/balances/{address}";
            break;

            case 'BlockscoutAPI':
                return 'https://blockscout.com/eth/mainnet/api?module=account&action=tokenlist&address={address}';
            break;

            case 'InfuraProvider':
                return 'https://mainnet.infura.io/v3/';
            break;

            case 'InfuraProviderRinkeby':
                return 'https://rinkeby.infura.io/v3/';
            break;

            case 'InfuraRopstenProvider':
                return 'https://ropsten.infura.io/v3/';
            break;

            case 'OpenSeaImporter':
                return 'https://api.opensea.io/api/v1/';
            break;

            case 'OpenSeaRinkebyDatasource':
                return 'https://rinkeby-api.opensea.io/api/v1/';
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

        }
    }


}