<?php

require_once("../simpletest/autorun.php");
require_once("../../src/dollarhttp.php");

class TestRequestMethodMethods extends UnitTestCase{

    private $http;

    public function setUp(){
        $this->http = new DollarHttp();
    }


    public function testGetRequestMethodIsCallable(){
        $isCallable = is_callable(array($this->http, 'getRequestMethod'));

        $this->assertTrue($isCallable);
    }

    public function testDefaultRequestMethodIsGet(){
        $returnedRequestMethod = $this->http->getRequestMethod();

        $this->assertEqual($returnedRequestMethod, "GET");
    }


    public function testSetRequestMethodIsCallable(){
        $isCallable = is_callable(array($this->http, 'setRequestMethod'));

        $this->assertTrue($isCallable);
    }

    public function testSetRequestMethodUpdatesRequestMethod(){
        $returnedRequestMethod = null;

        $this->http->setRequestMethod('POST');
        $returnedRequestMethod = $this->http->getRequestMethod();

        $this->assertEqual($returnedRequestMethod, 'POST');
    }

    public function testSetRequestMethodTransformsStringToUpperCase(){
        $returnedRequestMethod = null;

        $this->http->setRequestMethod('post');
        $returnedRequestMethod = $this->http->getRequestMethod();

        $this->assertEqual($returnedRequestMethod, 'POST');
    }

    public function testSetRequestMethodValidatesPassedString(){
        $returnedRequestMethod = null;

        $this->http->setRequestMethod("TEST");
        $returnedRequestMethod = $this->http->getRequestMethod();

        $this->assertEqual($returnedRequestMethod, "GET");
    }


    public function testClearRequestMethodIsCallable(){
        $isCallable = is_callable(array($this->http, 'clearRequestMethod'));

        $this->assertTrue($isCallable);
    }

    public function testClearRequestMethodSetsRequestMethodToGet(){
        $returnedRequestMethod = null;

        $this->http->setRequestMethod("POST");
        $returnedRequestMethod = $this->http->getRequestMethod();

        $this->assertEqual($returnedRequestMethod, 'POST');

        $this->http->clearRequestMethod();
        $returnedRequestMethod = $this->http->getRequestMethod();

        $this->assertEqual($returnedRequestMethod, 'GET');
    }

}

?>