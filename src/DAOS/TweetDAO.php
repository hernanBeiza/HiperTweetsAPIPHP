<?php
namespace HiperTweetAPI\DAOS;

use HiperTweetAPI\Models\IndexModel;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

class TweetDAO 
{
    private $c;
    private $logger;

    public function __construct($c){
	    $this->c = $c;
        $this->logger = $c->get('logger');  
       // $this->logger->info(__CLASS__.":".__FUNCTION__."();");		
	}

    public function obtenerToken($request) {
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");

        $postData = array(
            "grant_type"  => "client_credentials"
        );

        $userName = "nll2OYLrB6SazewBrkByEay0x";
        $password = "81KwpOM2Pc6jy7u7QXoy4mgcwNIDuuPWmRG6Xk1OrE8eGOyvrq";
        $urlToken ="https://api.twitter.com/oauth2/token";
        $this->logger->info($urlToken);
        //Llamar a otro servidor
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlToken);
        curl_setopt($ch, CURLOPT_POST, true);
        
        curl_setopt($ch, CURLOPT_USERPWD, $userName . ":" . $password);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($ch, CURLOPT_VERBOSE, 1);

        $rowData = curl_exec($ch);
        if(curl_errno($ch)){
            $errors = curl_error($ch);
            $this->logger->info($errors);
            $result = array(
                "result"=>false,
                "token"=>null,
                "mensaje"=>$errors
            );
        } else {
            $this->logger->info($rowData);            
            $dataJSON = json_decode($rowData);
            if($dataJSON->errors>0){
                $codigo = $dataJSON->errors[0]->code;
                $mensaje = $dataJSON->errors[0]->message;
                $this->logger->info($codigo);
                $this->logger->info($mensaje);
                $result = array(
                    "result"=>false,
                    "token"=>null,
                    "mensaje"=>$mensaje
                );
            } else {
                $token = $dataJSON->access_token;
                $_SESSION["token"] = $token;
                $result = array(
                    "result"=>true,
                    "token"=>$token,
                    "mensaje"=>"Token generado correctamente"
                );
            }
        }
        curl_close($ch);

        return $result;
    }

    public function obtenerTweets($request) {
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
        if($_SESSION["token"]){
            $result = $this->getTweets($_SESSION["token"]);
        } else {
            $resultToken = $this->obtenerToken($request);
            if($resultToken["result"]){
                $result = $this->getTweets($resultToken["token"]);
            } else {
                $result = $resultToken;
            }
        }        
        return $result;
    }

    private function getTweets($token){
        $this->logger->info(__CLASS__.":".__FUNCTION__."();");
        $urlTweets = "https://api.twitter.com/1.1/search/tweets.json?q=%23bancochile";
        //Llamar a otro servidor
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlTweets);
        // Prepare Autorisation Token
        $authorization = "Authorization: Bearer ".$token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $rowData = curl_exec($ch);
        if(curl_errno($ch)){
            $errors = curl_error($ch);
            $this->logger->info($errors);
            $result = array(
                "result"=>false,
                "tweets"=>null,
                "mensaje"=>$errors
            );
        } else {
            //$this->logger->info($rowData);
            $dataJSON = json_decode($rowData);
            $tuits = [];
            $tweets = $dataJSON->statuses;

            $this->logger->info(count($tweets));
            
            for ($i=0; $i <count($tweets); $i++) { 
                $tweet = $tweets[$i];
                $tuit = array(
                    "id"=>$tweet->id,
                    "usuario"=>$tweet->user->name,
                    "mensaje"=>$tweet->text);
                array_push($tuits, $tuit);
            }
            $result = array(
                "result"=>true,
                "tweets"=>$tuits,
                "mensaje"=>"Tweets encontrados correctamente"
            );
        }
        return $result;
    }

	function __destruct() {
        //$this->logger->info(__CLASS__.":".__FUNCTION__."();");      
	}

}
?>