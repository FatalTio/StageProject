<?php

namespace App\Http\Controllers;

use Validator;
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
        $datasources = DB::table('blockchains')
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

        $datas = $request->all();

        $validator = Validator::make($datas, [
            'address'       => 'required|max:255',
            'blockchain'    => 'required',
            'function'      => 'required'
        ]);

        $errors = $validator->messages();
        // dd($errors);
        if($validator->fails()){

            return view('blockchain/index', [
                'howToTest'     => $request->input('howToTest'),
                'blockchains'   => BlockchainController::getBlockchains()
            ])
            ->withErrors($errors)
            ;
        }


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


    public function getNets(string $blockchain){

        $nets = DB::table('blockchains')
                    ->where('blockchains.name', $blockchain)
                    ->join('nets', 'nets.nets_blockchain_id', '=', 'blockchains.id')
                    ->select(['blockchains.name', 'nets.name'])
                    ->get();


        return response()->json($nets);
    }

    public function getDatasources(string $net){

        $datasources = DB::table('nets')
                            ->where('nets.name', $net)
                            ->join('datasources', 'datasources.datasource_net_id', '=', 'nets.net_id')
                            ->select(['nets.name', 'datasources.name'])
                            ->get();

        return response()->json($datasources);
    }



}