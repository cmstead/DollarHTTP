<?php

class DollarHttp{

    protected $url = "";
    protected $requestMethod = "GET";
    protected $arguments = array();
    protected $headers = array();
    protected $body = "";
    protected $curlHandle = null;
    protected $curlResponse = null;
    protected $curlStatusCode = "";

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

    public function prepareArguments(){
        $preparedArguments = null;

        if(sizeof($this->arguments)){
            foreach($this->arguments as $key=>$value){
                $preparedArguments = ($preparedArguments === null) ? "" : $preparedArguments . "&";
                $preparedArguments .= urlencode($key) . "=" . urlencode($value);
            }
        }

        return $preparedArguments;
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

    public function prepareHeaders(){
        $customHeaders = array();

        if(sizeof($this->headers)){
            foreach($this->headers as $key=>$value){
                $customHeaders[] = "$key: $value";
            }
        }

        return $customHeaders;
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

    /* General request methods */
    public function sendRequest(){
        $url = $this->compileUrl();

        return $this->curlRequest($url);
    }

    public function compileUrl(){
        $arguments = null;
        $url = $this->url;

        if($this->requestMethod === 'GET'){
            $arguments = $this->prepareArguments();
            $url .= ($arguments !== null) ? "?" . $arguments : "";
        }

        return $url;
    }

    public function getLastRequest(){
        $response = null;

        if($this->curlResponse !== ""){
            $response = array(
                "content" => $this->curlResponse,
                "status" => $this->curlStatusCode
            );
        }

        return $response;
    }

    /* cURL setup and use */
    public function curlRequest($url){
        $this->curlHandle = curl_init();

        $this->setCurlOpts($url);
        $this->setHeaderOpts();
        $this->setPostOpts();

        $this->curlResponse = curl_exec($this->curlHandle);
        $this->curlStatusCode = curl_getInfo($this->curlHandle, CURL_HTTP_CODE);

        curl_close($this->curlHandle);

        return array(
            "content" => $this->curResponse,
            "status" => $this->curlStatusCode
        );
    }

    public function setCurlOpts($url){
        curl_setopt($this->curlHandle, CURLOPT_URL, $url);
        curl_setopt($this->curlHandle, CURLOPT_CUSTOMREQUEST, $this->requestMethod);
        curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, true);
    }

    public function setPostOpts(){
        $pattern = "/^P(U|OS)T$/";
        $content = ($this->body !== "") ? $this->body : $this->prepareArguments();

        if(preg_match($pattern, $this->requestMethod)){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        }
    }

    public function setHeaderOpts(){
        $headers = $this->prepareHeaders();

        if(sizeof($headers)){
            curl_setopt($this->curlHandle, CURLOPT_HTTPHEADER, $headers);
        }
    }

}

?>