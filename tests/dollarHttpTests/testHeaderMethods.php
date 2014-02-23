<?php

require_once("../simpletest/autorun.php");
require_once("../../src/dollarhttp.php");

class TestHeaderMethods extends UnitTestCase{

    var $http;

    public function setUp(){
        $this->http = new DollarHttp();
    }


    public function testGetHeaderIsCallable(){
        $isCallable = is_callable(array($this->http, 'getHeader'));

        $this->assertTrue($isCallable);
    }

    public function testGetHeaderReturnsCorrectValue(){
        $returnedValue = null;

        $this->http->setHeader("test", "testValue");
        $returnedValue = $this->http->getHeader("test");

        $this->assertEqual($returnedValue, "testValue");
    }

    public function testGetHeaderReturnsNullIfKeyIsNotSet(){
        $returnedValue = $this->http->getHeader("test");

        $this->assertEqual($returnedValue, null);
    }


    public function testSetHeaderIsCallable(){
        $isCallable = is_callable(array($this->http, 'setHeader'));

        $this->assertTrue($isCallable);
    }

    public function testSetHeaderSetsAValueToAKey(){
        $returnedValue = null;

        $this->http->setHeader("testKey", "testValue");
        $returnedValue = $this->http->getHeader("testKey");

        $this->assertEqual($returnedValue, "testValue");
    }

    public function testSetHeaderCanSetMoreThanOneKeyValuePair(){
        $returnedValue = null;

        $this->http->setHeader("test1", "testValue1");
        $this->http->setHeader("test2", "testValue2");

        $returnedValue = $this->http->getHeader("test1");
        $returnedValue .= ", " . $this->http->getHeader("test2");

        $this->assertEqual($returnedValue, "testValue1, testValue2");
    }


    public function testDeleteHeaderIsCallable(){
        $isCallable = is_callable(array($this->http, 'deleteHeader'));

        $this->assertTrue($isCallable);
    }

    public function testDeleteHeaderDoesNotBombWhenAttemptingToDeleteValueNotAvailable(){
        $returnedValue = null;

        $this->http->deleteHeader("test");
        $returnedValue = $this->http->getHeader("test");

        $this->assertEqual($returnedValue, null);
    }

    public function testDeleteHeaderDeletesKeyedRecord(){
        $returnedValue = null;

        $this->http->setHeader("test", "testValue");
        $returnedValue = $this->http->getHeader("test");

        $this->assertEqual($returnedValue, "testValue");

        $this->http->deleteHeader("test");
        $returnedValue = $this->http->getHeader("test");

        $this->assertEqual($returnedValue, null);
    }


    public function testClearHeadersIsCallable(){
        $isCallable = is_callable(array($this->http, 'clearHeaders'));

        $this->assertTrue($isCallable);
    }

    public function testClearHeadersCorrectlyClearsHeaderKeyValuePairs(){
        $returnedValue = null;

        $this->http->setHeader("test1", "testValue1");
        $this->http->setHeader("test2", "testValue2");

        $returnedValue = $this->http->getHeader("test1");
        $returnedValue .= ", " . $this->http->getHeader("test2");

        $this->assertEqual($returnedValue, "testValue1, testValue2");

        $this->http->clearHeaders();

        $returnedValue = $this->http->getHeader("test1");
        $returnedValue = ($returnedValue === null) ? $this->http->getHeader("test2") : $returnedValue;

        $this->assertEqual($returnedValue, null);
    }

}

?>