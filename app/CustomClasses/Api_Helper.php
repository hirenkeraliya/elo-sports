<?php
namespace App\CustomClasses;
class Api_Helper {
    public $url;
    public $headers;
    public $curl_opt_return_transfer;
    public $toArray;
    public $postData;
    public function __construct($url, $headers, $curl_opt_return_transfer, $toArray)
    {
        $this->url = $url;
        $this->headers = $headers;
        $this->curl_opt_return_transfer = $curl_opt_return_transfer;
        $this->toArray = $toArray;
    }

    public function CallApi()
    {
        
    
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, $this->curl_opt_return_transfer);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, $this->toArray);
  
        return $data;
    }
    public function CallPostApi($data){

        $encodedData = json_encode($data);
        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt( $curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $encodedData);

        $result = curl_exec($curl);
        curl_close($curl);
        dd($result);
        $data = json_decode($result, $this->toArray);

        return $data;
        }
}