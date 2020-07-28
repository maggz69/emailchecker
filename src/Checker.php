<?php 

namespace EmailChecker;

use EmailChecker\Pipeline\Request;
use GuzzleHttp\Client;


class Checker{
    /**
     * Check email function that sends a request and checks on the status of the email
     */

     public $guzzleClient;

     public function __construct()
     {
        $guzzle = new Client();
        $this->guzzleClient = $guzzle;
     }

     public function check($email){
         $request = new Request(null,$this->guzzleClient);
         $response =  $request->checkEmailExistence($email);
         $this->lastResponse = $response;

         if($response['mailbox']['status'] == 'invalid'){
            return false;
         }elseif($response['mailbox']['status'] == 'valid'){
            return true;
         }else{
            return $response;
         }
     }

}
