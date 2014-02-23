<?php

require_once("../simpletest/autorun.php");
require_once("../../src/dollarhttp.php");

class TestBodyMethods extends UnitTestCase{

    private $http;

    public function setUp(){
        $this->http = new DollarHttp();
    }


    public function testGetBodyIsCallable(){
        $isCallable = is_callable(array($this->http, 'getBody'));

        $this->assertTrue($isCallable);
    }

    public function testDefaultBodyIsEmpty(){
        $returnedBody = $this->http->getBody();

        $this->assertEqual($returnedBody, "");
    }


    public function testSetBodyIsCallable(){
        $isCallable = is_callable(array($this->http, 'setBody'));

        $this->assertTrue($isCallable);
    }

    public function testBodyCanBeSet(){
        $setBody = '{ "key": "This is some JSON." }';
        $returnedBody = null;

        $this->http->setBody($setBody);
        $returnedBody = $this->http->getBody();

        $this->assertEqual($returnedBody, $setBody);
    }


    public function testClearBodyIsCallable(){
        $isCallable = is_callable(array($this->http, 'clearBody'));

        $this->assertTrue($isCallable);
    }

    public function testBodyCanBeCleared(){
        $setBody = '{ "key": "This is some JSON." }';
        $returnedBody = null;

        $this->http->setBody($setBody);
        $returnedBody = $this->http->getBody();

        $this->assertEqual($returnedBody, $setBody);

        $this->http->clearBody();
        $returnedBody = $this->http->getBody();

        $this->assertEqual($returnedBody, "");
    }

}

?>