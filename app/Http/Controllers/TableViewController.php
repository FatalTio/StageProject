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




    public static function getWithPagination(string $table, int $nbPerPage)
    {

        $tableExists = self::checkExists($table);

        if($tableExists){

            $datas = DB::table(self::getTableName($table))
                    ->select('*')
                    ->get();
            
            if(count($datas) > $nbPerPage){

                $datas->chunk($nbPerPage);
            }
            return $datas;
        }
                    
        return $tableExists;
        
    }




    public static function search(string $table, string $search, string $column)
    {
        return DB::table(self::getTableName($table))
                ->select()
                ->where($column, '=', $search)
                ->get();
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