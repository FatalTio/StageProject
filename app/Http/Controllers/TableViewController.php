<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use PDOException;

class TableViewController extends Controller
{

    private static $tableName;


    private static function getTableName(string $table)
    {
        self::$tableName = env('DB_SANDRA') . '._view_' . $table . '_cscview';
        return self::$tableName;
    }


    public static function countTable(string $table)
    {

        $tableExists = self::checkExists($table);

        if($tableExists){

            dd(DB::table(self::getTableName($table))->count());

            return DB::table(self::getTableName($table))
                ->count();
        }

        return $tableExists;

    }


    public static function get(string $table)
    {

        $tableExists = self::checkExists($table);

        if($tableExists){

            return DB::table(self::getTableName($table))
                ->select('*')
                ->get();
        }
        return $tableExists;
    }


    private static function checkExists(string $table)
    {
        $checkExists = DB::table(self::getTableName($table))->exists();

        if(!$checkExists){
            try{
                $createTable = CollectionController::createViewTable($table);

            }catch(PDOException $e){

                return false;
            }
            return true;
        }
        return $checkExists;
    }



}