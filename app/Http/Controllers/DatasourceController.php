<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatasourceController extends Controller
{

    /**
     * Find the compatibles datasources and url, can make a curl request
     * 
     * @param String $address Blockchain address
     * @param String $blockchain Blockchain name     
     * @param String $function Function name
     * @param Bool $curlCall True for curl request, false for have only datasources names
     * 
     * @return Array of datasources or curl result
     */
    public function callDatasources(string $address, string $blockchain, string $function, bool $curlCall = true){
    
        // get the datasources associated at blockchain
        $datasources = DB::table('blockchain')
                        ->where('blockchain.name', $blockchain)
                        ->join('datasource', 'blockchain_id', '=', 'datasource.blockchain')
                        ->select(['blockchain.name', 'datasource.name'])
                        ->get();
        
        $myDatasources = json_decode(json_encode($datasources), true);

        // find the url of datasources
        $datasourceUrls = DatasourcesStringController::getCompatiblesDataSources($myDatasources, $function);

        // if param $curlCall false, return array of urls and datasources name
        if($curlCall === false){

            return $datasourceUrls;
        }

        $datasourceResult = array();

        foreach($datasourceUrls as $datasourceName => $datasourceUrl){
            
            // add $address in url
            $urlToCall = str_replace('{address}', $address, $datasourceUrl);
            // header for curl
            $headers = DatasourcesStringController::findHeader($function, $datasourceName, $address);

            
            $startTime = microtime(true);

            $result = CurlController::curlCreator($urlToCall, $headers);

            $endTime = microtime(true);
            $timeForRequest = ['time' => round(($endTime - $startTime), 5)];

            
            if(!is_null($result)){

                $datasourceResult[$datasourceName] = $result;
                $datasourceResult[$datasourceName] = $timeForRequest + $datasourceResult[$datasourceName];
            }else{

                $datasourceResult[$datasourceName] = 'Something is bad with this request';
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
        $howTotest = $request->input('howToTest');
       
        $datasourceToCall = $this->callDatasources($address, $blockchain, $function, false);
        
        return view('datasource/results', [
            'datasources'   => $datasourceToCall,
            'function'      => $function,
            'address'       => $address,
            'blockchain'    => $blockchain,
            'howToTest'     => $howTotest
        ]);

    }



    /**
     * Curl request for Ajax
     * 
     * @param String $address Blockchain address
     * @param String $blockchain Blockchain name     
     * @param String $function Function name
     */
    public function dataSourceJson(string $blockchain, string $function, string $address){
        
        return response()->json(
            $this->callDatasources($address, $blockchain, $function)
        );
    }



}