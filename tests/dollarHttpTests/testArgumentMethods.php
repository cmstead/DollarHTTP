<?php

require_once("../simpletest/autorun.php");
require_once("../../src/dollarhttp.php");

class TestArgumentMethods extends UnitTestCase{

    var $http;

    public function setUp(){
        $this->http = new DollarHttp();
    }


    public function testGetArgumentIsCallable(){
        $isCallable = is_callable(array($this->http, 'getArgument'));

        $this->assertTrue($isCallable);
    }

    public function testGetArgumentReturnsCorrectValue(){
        $returnedValue = null;

        $this->http->setArgument("test", "testValue");
        $returnedValue = $this->http->getArgument("test");

        $this->assertEqual($returnedValue, "testValue");
    }

    public function testGetArgumentReturnsNullIfKeyIsNotSet(){
        $returnedArgument = $this->http->getArgument("test");

        $this->assertEqual($returnedArgument, null);
    }


    public function testSetArgumentIsCallable(){
        $isCallable = is_callable(array($this->http, 'setArgument'));

        $this->assertTrue($isCallable);
    }

    public function testSetArgumentSetsAValueToAKey(){
        $returnedValue = null;

        $this->http->setArgument("testKey", "testValue");
        $returnedValue = $this->http->getArgument("testKey");

        $this->assertEqual($returnedValue, "testValue");
    }

    public function testSetArgumentCanSetMoreThanOneKeyValuePair(){
        $returnedValue = null;

        $this->http->setArgument("test1", "testValue1");
        $this->http->setArgument("test2", "testValue2");

        $returnedValue = $this->http->getArgument("test1");
        $returnedValue .= ", " . $this->http->getArgument("test2");

        $this->assertEqual($returnedValue, "testValue1, testValue2");
    }


    public function testSetArgumentsIsCallable(){
        $isCallable = is_callable(array($this->http, 'setArguments'));

        $this->assertTrue($isCallable);
    }

    public function testSetArgumentsThrowsExceptionWhenArgumentsIsNotAnArray(){
        $exception = null;

        try{
            $this->http->setArguments("");
        } catch (Exception $e){
            $exception = $e;
        }

        $this->assertNotEqual($exception, null);
    }

    public function testSetArgumentsSetsArrayKeyValuePairs(){
        $arguments = array("test" => "testValue");
        $returnedValue = null;

        $this->http->setArguments($arguments);

        $returnedValue = $this->http->getArgument('test');

        $this->assertEqual($returnedValue, "testValue");
    }

    public function testSetArgumentsSetsArrayWithoutDestroyingExistingValues(){
        $arguments = array("test1" => "testValue1");
        $returnedValue = null;

        $this->http->setArgument("test2", "testValue2");
        $this->http->setArguments($arguments);

        $returnedValue = $this->http->getArgument("test1");
        $returnedValue .= ", " . $this->http->getArgument("test2");

        $this->assertEqual($returnedValue, "testValue1, testValue2");
    }


    public function testDeleteArgumentIsCallable(){
        $isCallable = is_callable(array($this->http, 'deleteArgument'));

        $this->assertTrue($isCallable);
    }

    public function testDeleteArgumentDoesNotBombWhenAttemptingToDeleteValueNotAvailable(){
        $returnedValue = null;

        $this->http->deleteArgument("test");
        $returnedValue = $this->http->getArgument("test");

        $this->assertEqual($returnedValue, null);
    }

    public function testDeleteArgumentDeletesKeyedRecord(){
        $returnedValue = null;

        $this->http->setArgument("test", "testValue");
        $returnedValue = $this->http->getArgument("test");

        $this->assertEqual($returnedValue, "testValue");

        $this->http->deleteArgument("test");
        $returnedValue = $this->http->getArgument("test");

        $this->assertEqual($returnedValue, null);
    }


    public function testClearArgumentsIsCallable(){
        $isCallable = is_callable(array($this->http, 'clearArguments'));

        $this->assertTrue($isCallable);
    }

    public function testClearArgumentsCorrectlyClearsArgumentKeyValuePairs(){
        $returnedValue = null;

        $this->http->setArgument("test1", "testValue1");
        $this->http->setArgument("test2", "testValue2");

        $returnedValue = $this->http->getArgument("test1");
        $returnedValue .= ", " . $this->http->getArgument("test2");

        $this->assertEqual($returnedValue, "testValue1, testValue2");

        $this->http->clearArguments();

        $returnedValue = $this->http->getArgument("test1");
        $returnedValue = ($returnedValue === null) ? $this->http->getArgument("test2") : $returnedValue;

        $this->assertEqual($returnedValue, null);
    }

}

?>