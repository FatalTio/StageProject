<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatasourceController extends Controller
{

    public function callDatasources(string $address, string $blockchain, string $function){
    
        // get the datasources associated at blockchain
        $datasources = DB::table('blockchain')
            ->where('blockchain.name', $blockchain)
            ->join('datasource', 'blockchain_id', '=', 'datasource.blockchain')
            ->select(['blockchain.name', 'datasource.name'])
            ->get();

        $myDatasources = json_decode(json_encode($datasources), true);

        // find the url of datasources
        $datasourceUrls = DatasourcesStringController::getCompatiblesDataSources($myDatasources, $function);


        $datasourceResult = array();

        foreach($datasourceUrls as $datasourceName => $datasourceUrl){
            
            $urlToCall = str_replace('{address}', $address, $datasourceUrl);

            // header for curl
            $headers = DatasourcesStringController::findHeader($function, $datasourceName, $address);


            $startTime = microtime(true);

            $result = CurlController::curlCreator($urlToCall, $headers);
            
            $endTime = microtime(true);

            $timeForRequest = round(($endTime - $startTime), 5);

            // replace key of results by 'data'
            if(!empty($result) && array_key_exists('result', $result)){

                $result['data'] = $result['result'];
                unset($result['result']);
            }
            
            if(!is_null($result)){

                $datasourceResult[$datasourceName] = $result;
                $datasourceResult[$datasourceName]['time'] = $timeForRequest;
            }

        }

        return $datasourceResult;
    }

    /**
     * call each datasources compatibles with curl
     * 
     * @param Request POST
     */
    public function testCurlDatasources(Request $request){

        $address = $request->input('address');
        $blockchain = $request->input('blockchain');
        $function = $request->input('function');


        $datasourceResult = $this->callDatasources($address, $blockchain, $function);

        // dd($datasourceResult);
        return view('datasource/results', [
            'results'       => $datasourceResult,
            'function'      => $function,
            'address'       => $address,
            'blockchain'    => $blockchain,
            'howToTest'     => $request->input('howToTest')
        ]);

    }

    public function dataSourceJson(string $address, string $blockchain, string $function){

        $datasourceResult = $this->callDatasources($address, $blockchain, $function);
        
        return response()->json($datasourceResult);
    }

    /**
     * create a Json with the datasource datas
     * 
     * @param String $datasource
     * @param String $function
     * @param String $address
     * 
     * @return Json
     */
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