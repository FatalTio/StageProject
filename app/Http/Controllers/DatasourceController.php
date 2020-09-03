<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DatasourceController extends Controller
{

    public function testCurlDatasources(){

        $blockchains = DB::table('blockchain')
                        ->select()
                        ->get();

        return view('datasource/index', [
        'blockchains'   => $blockchains
        ]);
    }


}