<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Validator;
use Illuminate\Http\Request;

class DatasourceController extends Controller
{

    /**
     * Find the compatibles datasources and url, can make a curl request
     *
     * @param String $address Blockchain address
     * @param String $net Net name
     * @param String $function Function name
     *
     * @return array of datasources or curl result
     */
    public function callDatasources(string $address, string $net, string $function){

        // find the url of datasources
        $datasourceUrls = DatasourcesStringController::getCompatiblesDataSources($net, $function);

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



    public function testCurlDatasources(Request $request){

        $datas = $request->all();

        // Check the form
        $validator = Validator::make($datas, [
            'address'       => 'required|max:255',
            'blockchain'    => 'required',
            'function'      => 'required'
        ]);

        $errors = $validator->messages();

        if($validator->fails()){

            return view('blockchain/index', [
                'howToTest'     => $request->input('howToTest'),
                'blockchains'   => BlockchainController::getBlockchains()
            ])
            ->withErrors($errors);
        }

        $net = $request->input('net');
        $function = $request->input('function');

        $datasourceToCall = DatasourcesStringController::getCompatiblesDataSources($net, $function);

        return view('datasource/results', [
            'datasources'   => $datasourceToCall,
            'function'      => $function,
            'address'       => $request->input('address'),
            'blockchain'    => $request->input('blockchain'),
            'net'           => $net,
            'howToTest'     => $request->input('howToTest')
        ]);

    }



    /**
     * Curl request for Ajax
     * @param String $net
     * @param String $function
     * @param String $address
     *
     * @return JsonResponse
     */
    public function dataSourceJson(string $net, string $function, string $address){

        return response()->json(
            $this->callDatasources($address, $net, $function)
        );
    }



}
