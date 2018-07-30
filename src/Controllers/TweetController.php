<?php
namespace HiperTweetAPI\Controllers;

//use HiperTweetAPI\Models\IndexModel;

class TweetController 
{
	private $c;
	private $logger;

    public function __construct($c)
    {
	    $this->c = $c;
        $this->logger = $c->get('logger');  
        //$this->logger->info(__CLASS__.":".__FUNCTION__."();");		
	}

	public function obtenerToken($request)
	{
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
        //$model = new IndexModel();
    	$respuesta = $this->c->TweetDAO->obtenerToken($request);
	    return $respuesta;
	}	
	public function obtenerTweets($request)
	{
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
        //$model = new IndexModel();
    	$respuesta = $this->c->TweetDAO->obtenerTweets($request);
	    return $respuesta;
	}	

	function __destruct() {
        //$this->logger->info(__CLASS__.":".__FUNCTION__."();");      
	}

}
?>