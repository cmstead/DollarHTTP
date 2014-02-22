<?php

require_once("../simpletest/autorun.php");
require_once("../../src/dollarhttp.php");

class TestUrlMethods extends UnitTestCase{

    private $http;

    function setUp(){
        $this->http = new DollarHttp();
    }

    function testGetUrlIsCallable(){

        //If the call fails, this test will fail
        $emptyUrl = $this->http->getUrl();

        $this->assertEqual($emptyUrl, "");
    }

    function testUrlCanBeSet(){
        $setUrl = "http://www.gooogle.com";
        $returnedUrl = "";

        $this->http->setUrl($setUrl);
        $returnedUrl = $this->http->getUrl();

        $this->assertEqual($returnedUrl, $setUrl);
    }

    function testUrlCanBeCleared(){
        $setUrl = "http://www.google.con";
        $returnedUrl = "";

        $this->http->setUrl($setUrl);
        $returnedUrl = $this->http->getUrl();

        //This is to ensure a URL was set so we can verify that it was cleared
        //This assert should only fail if the previous test fails
        $this->assertEqual($returnedUrl, $setUrl);

        $this->http->clearUrl();
        $returnedUrl = $this->http->getUrl();

        $this->assertEqual($returnedUrl, "");
    }

}

?>