<?php
namespace HiperTweetAPI\DAOS;

use HiperTweetAPI\Models\IndexModel;

class IndexDAO 
{
    private $c;
    private $logger;

    public function __construct($c){
	    $this->c = $c;
        $this->logger = $c->get('logger');  
        //$this->logger->info(__CLASS__.":".__FUNCTION__."();");		
	}

    public function saludar() {
        return "Bienvenido a la API de HiperTweet";
    }

	function __destruct() {
        //$this->logger->info(__CLASS__.":".__FUNCTION__."();");      
	}

}
?>