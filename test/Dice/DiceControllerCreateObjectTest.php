<?php

namespace Seva19\Dice;

// use Anax\Controller\SampleAppController;
use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the controller like it would be used from the router,
 * simulating the actual router paths and calling it directly.
 */
class DiceControllerCreateObjectTest extends TestCase
{
    private $controller;

    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        global $di;

        // Init service container $di to contain $app as a service
        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $app = $di;
        $di->set("app", $app);

        // Create and initiate the controller
        $this->controller = new DiceController();
        $this->controller->setApp($app);
        // $this->controller->initialize();
    }


    // /**
    //  * Call the controller index action.
    //  */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }



    /**
     * Call the controller init action.
     */
    public function testInitAction()
    {
        $res = $this->controller->initAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }



    /**
     * Call the controller play action.
     */
    public function testPlayActionGet()
    {
        $res = $this->controller->playActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Call the controller play action post.
     */
    public function testPlayActionPost()
    {
        $res = $this->controller->playActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }



    // /**
    //  * Call the controller debug action.
    //  */
    public function testDebugAction()
    {
        $res = $this->controller->debugAction();
        $this->assertIsString($res);
        $this->assertStringEndsWith("Debug my game!", $res);
    }
}
