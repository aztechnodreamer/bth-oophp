<?php
/**
 * Guess my number, a POST game.
 */
require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";


session_name("seva19");
session_start();

if (!isset($_SESSION["game"])) {
    $_SESSION["game"] = new Guess();
}

$game = $_SESSION["game"];
$number = $game->number();         // Get number
$tries = $game->tries();           // Get tries


// Deal with incoming variables
$guess   = $_POST["guess"] ?? null;
$doInit  = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;

if ($doInit) {
    // Destroy current session and init new one
    session_unset();
    session_destroy();
    header("Location: index.php");
} elseif ($doGuess) {
    // Make a guess
    $res = $game->makeGuess($guess);
    $tries = $game->tries();       // Get updated tries
}


// Render the page
require __DIR__ . "/view/guess_number.php";
