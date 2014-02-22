<?php

require_once("../simpletest/autorun.php");
require_once("../../src/dollarhttp.php");

class TestUrlMethods extends UnitTestCase{

    private $http;

    public function setUp(){
        $this->http = new DollarHttp();
    }


    public function testGetUrlIsCallable(){
        $isCallable = is_callable(array($this->http, 'getUrl'));

        $this->assertTrue($isCallable);
    }

    public function testDefaultUrlIsEmpty(){
        $returnedUrl = $this->http->getUrl();

        $this->assertEqual($returnedUrl, "");
    }


    public function testSetUrlIsCallable(){
        $isCallable = is_callable(array($this->http, 'setUrl'));

        $this->assertTrue($isCallable);
    }

    public function testUrlCanBeSet(){
        $setUrl = "http://www.gooogle.com";
        $returnedUrl = "";

        $this->http->setUrl($setUrl);
        $returnedUrl = $this->http->getUrl();

        $this->assertEqual($returnedUrl, $setUrl);
    }


    public function testClearUrlIsCallable(){
        $isCallable = is_callable(array($this->http, 'clearUrl'));

        $this->assertTrue($isCallable);
    }

    public function testUrlCanBeCleared(){
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