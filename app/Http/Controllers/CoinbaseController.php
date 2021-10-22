<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
class CoinbaseController extends Controller
{
    public function BitcoinConversion(Request $request){
        $amount = $request->amount;
        // init curl object        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.commerce.coinbase.com/charges');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n       \"name\": \"The Sovereign Individual\",\n       \"description\": \"Mastering the Transition to the Information Age\",\n       \"local_price\": {\n         \"amount\": \"$amount\",\n         \"currency\": \"USD\"\n       },\n       \"pricing_type\": \"fixed_price\",\n       \"metadata\": {\n         \"customer_id\": \"id_1005\",\n         \"customer_name\": \"Satoshi Nakamoto\"\n       },\n       \"redirect_url\": \"https://charge/completed/page\",\n       \"cancel_url\": \"https://charge/canceled/page\"\n     }");
        
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'X-Cc-Api-Key: <<Api-key>>';
        $headers[] = 'X-Cc-Version: 2018-03-22';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $result = curl_exec($ch);

        // also get the error and response code
        $errors = curl_error($ch);
        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        $json = json_decode($result,true);
        $data['dynamicAddress']=$json['data']['addresses']['bitcoincash'];
        $data['bitcoinAmount'] = $json['data']['pricing']['bitcoin']['amount'];
        $data['bitcoinCurrency'] = $json['data']['pricing']['bitcoin']['currency'];
        $data['localAmount'] = $json['data']['pricing']['local']['amount'];
        $data['localCurrency'] = $json['data']['pricing']['local']['currency'];

        $data['imgSrc']='http://chart.googleapis.com/chart?chs=125x125&cht=qr&chl='.$json['data']['addresses']['bitcoincash'];
        return view('data')->with('data', $data);
    }
}
