<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatasourceController extends Controller
{

    public function testCurlDatasources(Request $request){

        $address = $request->input('address');
        $blockchain = $request->input('blockchain');
        $function = $request->input('function');


        $datasources = DB::table('blockchain')
                        ->where('blockchain.name', $blockchain)
                        ->join('datasource', 'blockchain_id', '=', 'datasource.blockchain')
                        ->select(['blockchain.name', 'datasource.name'])
                        ->get();

        $myDatasources = json_decode(json_encode($datasources), true);


        $datasourceUrls = DatasourcesStringController::getCompatiblesDataSources($myDatasources, $function);

        
        $datasourceResult = array();

        foreach($datasourceUrls as $datasourceName => $datasourceUrl){
            
            $urlToCall = str_replace('{address}', $address, $datasourceUrl);

            $headers = DatasourcesStringController::findHeader($function, $datasourceName, $address);


            $startTime = microtime(true);

            $result = CurlController::curlCreator($urlToCall, $headers);

            $endTime = microtime(true);

            $timeForRequest = round(($endTime - $startTime), 5);


            $datasourceResult[$datasourceName] = $result;
            $datasourceResult[$datasourceName]['time'] = $timeForRequest;

        }

        return view('datasource/result', [
            'results'       => $datasourceResult,
            'function'      => $function,
            'address'       => $address,
            'howToTest'     => $request->input('howToTest')
        ]);

    }


    public function viewJson(string $datasource, string $function, string $address){

        if($function === 'getBalance'){

            $url = DatasourcesStringController::getDatasourceUrlBalance($datasource);

        }elseif($function === 'TxHistory'){

            $url = DatasourcesStringController::getDatasourceUrlTxHistory($datasource);
        }

        $urlToCall = str_replace('{address}', $address, $url);


        $headers = DatasourcesStringController::findHeader($function, $datasource, $address);

        $curlResult = CurlController::curlCreator($urlToCall, $headers);


        return response()->json($curlResult);

    }

}