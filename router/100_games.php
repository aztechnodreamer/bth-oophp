<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));


/**
 * Init a new game of "Gissa mitt nummer" and redirect to play-page.
 */
$app->router->get("guess/init", function () use ($app) {
    // Init the game-session
    $game = new Seva19\Guess\Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();

    return $app->response->redirect("guess/play");
});


/**
 * Showing the game staus for "Gissa mitt nummer".
 */
 $app->router->get("guess/play", function () use ($app) {
     $title = "Gissa mitt nummer";

     $res = $_SESSION["res"] ?? null;
     $_SESSION["res"] = null;

     $doCheat = $_SESSION["doCheat"] ?? null;
     $_SESSION["doCheat"] = null;

     $data = [
         "number" => $_SESSION["number"],
         "tries" => $_SESSION["tries"],
         "res" => $res,
         "doCheat" => $doCheat
     ];

     $app->page->add("guess/play", $data);
     //$app->page->add("guess/debug");

     return $app->page->render([
         "title" => $title,
     ]);
 });


/**
 * Making a guess in "Gissa mitt nummer".
 */
 $app->router->post("guess/play", function () use ($app) {
     $title = "Gissa mitt nummer";

     // Deal with incoming variables
     $guess   = $_POST["guess"] ?? null;
     $doInit  = $_POST["doInit"] ?? null;
     $doGuess = $_POST["doGuess"] ?? null;
     $doCheat = $_POST["doCheat"] ?? null;

    if ($doInit) {
          return $app->response->redirect("guess/init");
    }

    if ($doGuess) {
         // Make a guess
         $game = new Seva19\Guess\Guess($_SESSION["number"], $_SESSION["tries"]);
         $res = $game->makeGuess($guess);
         $_SESSION["res"] = $res;
         $_SESSION["tries"] = $game->tries();
    } elseif ($doCheat) {
         $_SESSION["doCheat"] = $doCheat;
    }
    
     return $app->response->redirect("guess/play");
 });
