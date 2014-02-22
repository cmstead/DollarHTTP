<?php

class DollarHttp{

    protected $url = "";
    protected $method = "GET";
    protected $arguments = array();
    protected $headers = array();
    protected $body = "";

    public function __construct($url = null, $method = null, $arguments = null, $body = null){

    }

    /* URL management */
    public function getUrl(){
        return $this->$url;
    }

    public function setUrl($url){
        $this->url = $url;
    }

    public function clearUrl(){
        $this->$url = "";
    }

    /* Method management */
    public function getMethod(){
        return $this->method;
    }

    //Todo: validate request method before setting.
    public function setMethod($method){
        $this->method = $method;
    }

    public function clearMethod(){
        $this->method = "GET";
    }

    /* Argument management */
    public function getArgument($key){
        return $this->arguments[$key];
    }

    public function setArgument($key, $value){
        $this->arguments[$key] = $value;
    }

    public function deleteArgument($key){
        unset($this->arguments[$key]);
    }

    public function clearArguments(){
        $this->arguments = array();
    }

    /* Header management */
    public function getHeader($key){
        return $this->headers[$key];
    }

    public function setHeader($key, $value){
        $this->headers[$key] = $value;
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

}

?>