<?php

require_once("../simpletest/autorun.php");
require_once("../../src/dollarhttp.php");

class TestConstructorBehavior extends UnitTestCase{

    public function testConstructorDoesNotThrowException(){
        $http = null;
        $exceptionThrown = null;

        try{
            $http = new DollarHttp();
        } catch (Exception $e){
            $exceptionThrown = $e;
        }

        $this->assertEqual($exceptionThrown, null);
    }

    public function testObjectIsConstructable(){
        $http = new DollarHttp();

        $this->assertNotEqual($http, null);
    }

    public function testConstructorSetsUrl(){
        $http = new DollarHttp("http://www.google.com");
        $returnedValue = $http->getUrl();

        $this->assertEqual($returnedValue, "http://www.google.com");
    }

    public function testConstructorSetsRequestMethod(){
        $http = new DollarHttp("http://www.google.com", "POST");
        $returnedValue = $http->getRequestMethod();

        $this->assertEqual($returnedValue, 'POST');
    }

    public function testConstructorThrowsExceptionIfArgumentsIsNotAnArray(){
        $http = null;
        $exception = null;

        try{
            $http = new DollarHttp("http://www.google.com", 'post', 'test');
        } catch(Exception $e){
            $exception = $e;
        }

        $this->assertNotEqual($exception, null);
    }

    public function testConstructorSetsArguments(){
        $arguments = array("test" => "testValue");
        $http = new DollarHttp("http://www.google.com", 'post', $arguments);
        $returnedValue = $http->getArgument("test");

        $this->assertEqual($returnedValue, "testValue");
    }

    public function testConstructorSetsBody(){
        $arguments = array("test" => "testValue");
        $body = '{ "key": "This is some JSON" }';
        $http = new DollarHttp("http://www.google.com", 'post', $arguments, $body);
        $returnedValue = $http->getBody();

        $this->assertEqual($returnedValue, $body);
    }

    public function testConstructorThrowsExceptionIfHeadersIsNotAnArray(){
        $http = null;
        $exception = null;
        $arguments = array("test" => "testValue");
        $body = '{ "key": "This is some JSON" }';

        try{
            $http = new DollarHttp("http://www.google.com", 'post', $arguments, $body, 'test');
        } catch(Exception $e){
            $exception = $e;
        }

        $this->assertNotEqual($exception, null);
    }

    public function testConstructorSetsHeaders(){
        $arguments = array("test" => "testValue");
        $body = '{ "key": "This is some JSON" }';
        $http = new DollarHttp("http://www.google.com", 'post', $arguments, $body, $arguments);
        $returnedValue = $http->getHeader("test");

        $this->assertEqual($returnedValue, "testValue");
    }

}

?>