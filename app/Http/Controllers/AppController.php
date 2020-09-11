<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use PDOException;

class AppController extends Controller
{

    public static function init(){

        $database = DB::statement('CREATE DATABASE IF NOT EXISTS '. env('DB_DATABASE') .';');

        if($database){

            try{

                $blockchain = DB::statement('CREATE TABLE IF NOT EXISTS `blockchain` (
                    `blockchain_id` INT NOT NULL AUTO_INCREMENT,
                    `name` VARCHAR(60) NULL,
                    PRIMARY KEY (`blockchain_id`));');

                if($blockchain){

                    DB::statement('INSERT INTO `blockchain`(name)
                        VALUES
                            (`Bitcoin`),
                            (`Counterparty`),
                            (`Ethereum`),
                            (`Klaytn`);'
                        );
                }
        
                $datasource = DB::statement('CREATE TABLE IF NOT EXISTS `datasource` (
                    `datasource_id` INT NOT NULL AUTO_INCREMENT,
                    `name` VARCHAR(60) NULL,
                    `blockchain` INT,
                    PRIMARY KEY (`datasource_id`));');

                if($datasource){

                    DB::statement('INSERT INTO `datasource`(name, blockchain)
                        VALUES
                            (`CrystalSuiteDataSource`, 1),
                            (`XchainDataSource`, 2),
                            (`BlockscoutAPI`, 3),
                            (`InfuraProvider`, 3),
                            (`InfuraProviderRinkeby`, 3),
                            (`InfuraRopstenProvider`, 3)
                            (`OpenSeaImporter`, 3)
                            (`OpenSeaRinkebyDatasource`, 3)
                            (`phpWeb3`, 3)
                            (`BaobabProvider`, 4)
                            (`OfficialProvider`, null);'
                        );

                }

            }catch(PDOException $e){

                return $e->getMessage();

            }

        }

    }




}