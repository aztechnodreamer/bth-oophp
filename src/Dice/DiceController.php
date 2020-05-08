<?php

namespace Seva19\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A controller to play the game Dice 100.
 * The controller is mounted on a particular route and can handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;


    /**
     * @var string $db a sample member variable that gets initialised
     */
    //private $db = "not active";


    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : object
    {
        $response = $this->app->response;

        // Deal with the action and return a response.
        return $response->redirect("dice/init");
    }


    /**
     * This method it the handler for route:
     * ANY METHOD mountpoint/init
     *
     * @return string
     */
    public function initAction() : object
    {
        $response = $this->app->response;
        $session = $this->app->session;

        $session->destroy();

        return $response->redirect("dice/play");
    }


    /**
     * This method it the handler for route:
     * GET mountpoint/play
     *
     * @return string
     */
    public function playActionGet() : object
    {
        $title = "Tärning 100";
        $page = $this->app->page;
        $session = $this->app->session;

        $gameInit = false;
        if ($session->has("game")) {
            $gameInit = true;
            $data = [
                "gameInit" => $gameInit,
                "dices" => $session->get("dices") ?? null,
                "protocol" => $session->get("game")->protocol() ?? null,
                "currPlayer" => $session->get("game")->currPlayer() ?? null,
                "roll" => $session->get("roll") ?? null,
                "histogram" => $session->get("histogram") ?? null,
                "sum" => $session->get("sum") ?? null,
                "status" => $session->get("game")->checkStatus() ?? null    //$session->get("status") ?? null
            ];
        } else {
            $data = ["gameInit" => $gameInit];
        }

        $page->add("dice/play", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This method it the handler for route:
     * POST mountpoint/play
     *
     * @return string
     */
    public function playActionPost() : object
    {
        //$title = "Tärning 100";
        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;

        // Deal with incoming variables
        $doInit  = $request->getPost("doInit");
        $doComputer  = $request->getPost("doComputer");
        $doRoll  = $request->getPost("doRoll");
        $endTurn  = $request->getPost("endTurn");
        $doCancel  = $request->getPost("doCancel");

        if ($doInit) {
            $session->set("dices", $request->getPost("dices"));
            $session->set("game", new DiceGame($session->get("dices"), $request->getPost("players")));
        }

        if ($doComputer) {
            $session->set("dices", $request->getPost("dices"));
            $session->set("game", new DiceGame($session->get("dices"), 1));
        }

        if ($doRoll) {
            $session->set("roll", $session->get("game")->roll());
            $session->set("sum", $session->get("game")->sum());
            $session->set("histogram", $session->get("game")->getHistogram());
        }

        if ($endTurn) {
            $session->get("game")->updatePoints();
            $session->set("protocol", $session->get("game")->protocol());

            if ($session->get("game")->checkStatus() != "win") {
                $session->get("game")->changePlayer();
                $session->set("sum", $session->get("game")->sum());
            }
        }

        if ($doCancel) {
            return $response->redirect("dice/init");
        }
        return $response->redirect("dice/play");
    }


    /**
     * This method it the handler for route:
     * ANY METHOD mountpoint/debug
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game!";
    }
}
