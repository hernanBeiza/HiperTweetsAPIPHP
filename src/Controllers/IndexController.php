<?php
namespace HiperTweetAPI\Controllers;

use HiperTweetAPI\Models\IndexModel;

class IndexController 
{
	private $c;
	private $logger;

    public function __construct($c)
    {
	    $this->c = $c;
        $this->logger = $c->get('logger');  
        //$this->logger->info(__CLASS__.":".__FUNCTION__."();");		
	}

	public function saludar($request)
	{
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
        $model = new IndexModel();
    	$respuesta = $this->c->IndexDAO->saludar();
	    return $respuesta;
	}	

	function __destruct() {
        //$this->logger->info(__CLASS__.":".__FUNCTION__."();");      
	}

}
?>