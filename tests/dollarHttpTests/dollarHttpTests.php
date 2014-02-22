<?php

require_once("../simpletest/autorun.php");
require_once("../../src/dollarhttp.php");

class DollarHttpTestSuite extends TestSuite{

    function DollarHttpTestSuite(){
        $this->TestSuite('DollarHttpTestSuite');
        $this->addFile("./testUrlMethods.php");
    }

}

?>