<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class AppController extends Controller
{

    public function init(){

        $blockchain = DB::statement('CREATE TABLE IF NOT EXISTS `blockchain` (
            `blockchain_id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(60) NULL,
            PRIMARY KEY (`blockchain_id`));');

        $datasource = DB::statement('CREATE TABLE IF NOT EXISTS `datasource` (
            `datasource_id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(60) NULL,
            `blockchain` INT,
            PRIMARY KEY (`datasource_id`));');


            $stringToReturn = '';

            $stringToReturn .= $datasource;
            $stringToReturn .= $blockchain;

            return response($stringToReturn);

    }




}