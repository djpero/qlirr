<?php 
    require_once ('PHPUnit/Autoload.php');
    require_once ('PHPUnit/Framework/Assert.php');
    require_once ('PHPUnit/Framework/Test.php');
    require_once ('PHPUnit/Framework/SelfDescribing.php');
    require_once ('PHPUnit/Framework/TestCase.php');
    require_once ('PHPUnit/Extensions/SeleniumTestCase.php');
    require_once 'PHPUnit/Extensions/SeleniumTestCase/Driver.php';
    class ScreenShots extends PHPUnit_Extensions_SeleniumTestCase
    {
        protected $captureScreenshotOnFailure = TRUE;
        protected $screenshotPath = '/ws/test/peydo/code/';
        protected $screenshotUrl = 'http://localhost/screenshots';

        function setUp(){
            parent::setUp();
            echo 'test';
            $this->setBrowser("*firefox /usr/bin/firefox");
            $this->setBrowserUrl("http://www.citiboard.se");
            $this->start();
            //sleep(1);
        }

        public function testTitle()
        {
            $this->start();
            $this->open('/shorts,1622467');
            $this->windowMaximize();
            $this->captureScreenshot("t123.jpg");
        }
        
        public function testA() {            
            $this->start();
            $this->open('/');
            $this->windowMaximize();
            $this->focus("link=Ask a question");
            $this->captureScreenshot("ta.jpg");
            //$this->assertTitle('Example WWW Page');
        }

        function testMyTestCase()
        {
            $this->open("/");
            $this->type("q", "selenium rc");
            $this->click("btnG");
            $this->waitForPageToLoad("30000");
            $this->assertTrue($this->isTextPresent("Results * for selenium rc"));
        }
}