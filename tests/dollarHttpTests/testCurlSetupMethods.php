<?php

require_once("../simpletest/autorun.php");
require_once("../../src/dollarhttp.php");

class TestCurlSetupMethods extends UnitTestCase{

    var $http;

    public function setUp(){
        $this->http = new DollarHttp();
    }


    public function testCompileUrlIsCallable(){
        $isCallable = is_callable(array($this->http, 'compileUrl'));

        $this->assertTrue($isCallable);
    }

    public function testCompuleUrlBuildsArgumentsForGetRequests(){
        $requestUrl = null;

        $this->http->setUrl("http://www.google.com");
        $this->http->setArgument("test", "test value");
        $requestUrl = $this->http->compileUrl();

        $this->assertEqual($requestUrl, "http://www.google.com?test=test+value");
    }

    public function testCompuleUrlDoesNotBuildArgumentsForGetRequests(){
        $requestUrl = null;

        $this->http->setUrl("http://www.google.com");
        $this->http->setRequestMethod('POST');
        $this->http->setArgument("test", "test value");
        $requestUrl = $this->http->compileUrl();

        $this->assertEqual($requestUrl, "http://www.google.com");
    }

}

?>