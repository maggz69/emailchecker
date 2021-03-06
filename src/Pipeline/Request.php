<?php

namespace EmailChecker\Pipeline;

class Request{

    private $config;
    private $client;

    public function __construct($config,$client){

        if(isset($config)){
            $this->config = $config;
        }else{
            $this->setDefaultConfig();
        }

        $this->client = $client;
    }

    private function setDefaultConfig(){
        $config = [
            'host'=>config('emailchecker.host','email-checker.p.rapidapi.com'),
            'key'=>config('emailchecker.key',env('RAPID_API_KEY',null)),
            'url'=>config('emailchecker.url','https://email-checker.p.rapidapi.com/verify/v1'),
        ];

        $this->config = $config;

        $this->checkConfigValidity();
    }

    private function checkConfigValidity(){
        foreach ($this->config as $key=>$value){
            if(!isset($value)){
                throw new \Exception("The $key in the config is empty. Have you published the vendor config file? Is there a key in .env?");
            }
        }
    }

    private function sendRequestToRapidAPI($email){
        $response = $this->client->request('GET',
        $this->config['url'].'?email='.$email,
             ['headers'=>
                ['X-RapidAPI-Key'=>$this->config['key'],
                   'X-RapidAPI-Host'=>$this->config['host']
                ]
             ]
          );

        $result = $this->validateResponse($response);

       $response1 = $result;

       return json_decode(json_encode($result),true);
    }

    public function checkEmailExistence($email){
        $email1 = $email;
        return $this->sendRequestToRapidAPI($email1);
    }

    private function validateResponse($response){
        return [
            'response'=>[
                'code'=>$response->getStatusCode(),
                'response'=>$response
            ],
            'mailbox'=>json_decode($response->getBody())
        ];
    }

}
