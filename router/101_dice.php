<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));


/**
 * Init a new game of "Gissa mitt nummer" and redirect to play-page.
 */
$app->router->get("dice/init", function () use ($app) {
    // Init the game-session
    $_SESSION = [];

    return $app->response->redirect("dice/play");
});


/**
 * Showing the game staus for "Gissa mitt nummer".
 */
 $app->router->get("dice/play", function () use ($app) {
     $title = "Tärning 100";

     $dices = $_SESSION["dices"] ?? null;
     $protocol = $_SESSION["protocol"] ?? null;
     $currPlayer = $_SESSION["currPlayer"] ?? null;
     $roll = $_SESSION["roll"] ?? null;
     $sum = $_SESSION["sum"] ?? null;
     $status = $_SESSION["status"] ?? null;

     $data = [
         "dices" => $dices ?? null,
         "protocol" => (isset($_SESSION["game"]) ? $_SESSION["game"]->protocol() : null),
         "currPlayer" => (isset($_SESSION["game"]) ? $_SESSION["game"]->currPlayer() : null),
         "roll" => $roll ?? null,
         "sum" => $sum ?? null,
         "status" => $status ?? null
     ];

     $app->page->add("dice/play", $data);
     //$app->page->add("dice/debug");

     return $app->page->render([
         "title" => $title,
     ]);
 });


/**
 * Making a guess in "Gissa mitt nummer".
 */
 $app->router->post("dice/play", function () use ($app) {
     $title = "Tärning 100";

     // Deal with incoming variables
     $doInit  = $_POST["doInit"] ?? null;
     $doRoll  = $_POST["doRoll"] ?? null;
     $endTurn  = $_POST["endTurn"] ?? null;
     $doCancel  = $_POST["doCancel"] ?? null;

    if ($doInit) {
         $_SESSION["dices"]  = $_POST["dices"];
         $_SESSION["game"] = new Seva19\Dice\DiceGame($_SESSION["dices"], $_POST["players"]);
         $_SESSION["game"]->setFirstPlayer();
    }

    if ($doRoll) {
         $_SESSION["roll"] = $_SESSION["game"]->roll();
         $_SESSION["sum"] = $_SESSION["game"]->sum();
    }

    if ($endTurn) {
         $_SESSION["game"]->updatePoints();
         $_SESSION["protocol"] = $_SESSION["game"]->protocol();
         $_SESSION["status"] = $_SESSION["game"]->checkStatus();

        if ($_SESSION["game"]->checkStatus() != "win") {
             $_SESSION["game"]->changePlayer();
             $_SESSION["sum"] = $_SESSION["game"]->sum();
        }
    }

    if ($doCancel) {
         return $app->response->redirect("dice/init");
    }

    return $app->response->redirect("dice/play");
 });
