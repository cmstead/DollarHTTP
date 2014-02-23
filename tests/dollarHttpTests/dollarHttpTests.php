<?php

require_once("../simpletest/autorun.php");
require_once("../../src/dollarhttp.php");

class DollarHttpTestSuite extends TestSuite{

    function DollarHttpTestSuite(){

        $this->TestSuite('DollarHttpTestSuite');

        $this->addFile("./testConstructorBehavior.php");
        $this->addFile("./testUrlMethods.php");
        $this->addFile("./testRequestMethodMethods.php");
        $this->addFile("./testArgumentMethods.php");
        $this->addFile("./testHeaderMethods.php");
        $this->addFile("./testBodyMethods.php");
    }

}

?>