<?php

namespace EmailChecker\Commands;

use EmailChecker\Checker;
use Illuminate\Console\Command;

class CheckEmailCommand extends Command{

    protected $signature = 'email:check {email}';

    protected $description = 'Check whether a mailbox exists from the command line';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(){
        $checker = new Checker();
        $email = $this->argument('email');
        $result = $checker->check($email);
        $response = $checker->lastResponse();

        //TODO: Enable response option at a later time
//        if($this->argument('response') == true){
//            $this->info($response);
//        }

        if($result == true){
            $this->info("The email address : $email is a valid address");
        }else{
            $this->error("The email address : $email is not a valid address!");
        }
    }
}
