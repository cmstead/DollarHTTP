<?php

class DollarHttp{

    protected $url = "";
    protected $requestMethod = "GET";
    protected $arguments = array();
    protected $headers = array();
    protected $body = "";

    public function DollarHttp($url = null, $requestMethod = null, $arguments = null, $body = null, $headers = null){

        if($url !== null){
            $this->setUrl($url);
        }

        if($requestMethod !== null){
            $this->setRequestMethod($requestMethod);
        }

        if($arguments !== null){
            try{
                $this->setArguments($arguments);
            } catch(Exception $e){
                throw $e;
            }
        }

        if($body !== null){
            $this->setBody($body);
        }

        if($headers !== null){
            try{
                $this->setHeaders($headers);
            } catch(Exception $e){
                throw $e;
            }
        }
    }

    /* URL management */
    public function getUrl(){
        return $this->url;
    }

    public function setUrl($url){
        $this->url = $url;
    }

    public function clearUrl(){
        $this->url = "";
    }

    /* Request method management */
    public function getRequestMethod(){
        return $this->requestMethod;
    }

    public function setRequestMethod($method){
        $method = strtoupper($method);

        //Ensure passed method is a supported REST method
        if(strpos("||DELETE|GET|POST|PUT||", $method)){
            $this->requestMethod = $method;
        }
    }

    public function clearRequestMethod(){
        $this->requestMethod = "GET";
    }

    /* Argument management */
    public function getArgument($key){
        $returnValue = null;

        if(isset($this->arguments[$key])){
            $returnValue = $this->arguments[$key];
        }

        return $returnValue;
    }

    public function setArgument($key, $value){
        $this->arguments[$key] = $value;
    }

    public function setArguments($arguments){
        if(is_array($arguments)){
            foreach($arguments as $key=>$value){
                $this->arguments[$key] = $value;
            }
        } else {
            throw new Exception("Variable \$arguments must be an array.");
        }
    }

    public function deleteArgument($key){
        unset($this->arguments[$key]);
    }

    public function clearArguments(){
        $this->arguments = array();
    }

    /* Header management */
    public function getHeader($key){
        $returnValue = null;

        if(isset($this->headers[$key])){
            $returnValue = $this->headers[$key];
        }

        return $returnValue;
    }

    public function setHeader($key, $value){
        $this->headers[$key] = $value;
    }

    public function setHeaders($headers){
        if(is_array($headers)){
            foreach($headers as $key=>$value){
                $this->headers[$key] = $value;
            }
        } else {
            throw new Exception("Variable \$headers must be an array.");
        }
    }

    public function deleteHeader($key){
        unset($this->headers[$key]);
    }

    public function clearHeaders(){
        $this->headers = array();
    }

    /* Request body management */
    public function getBody(){
        return $this->body;
    }

    public function setBody($body){
        $this->body = $body;
    }

    public function clearBody(){
        $this->body = "";
    }

    /* cURL setup and use */

}

?>