<?php
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

session_name("osln17");
session_start();

if (!isset($_SESSION["guess"])) {
    $_SESSION["guess"] = new Guess();
}
if (!isset($_SESSION["inputstate"])) {
    $_SESSION["inputstate"] = "submit";
}
//if form reset i submited
if (isset($_SESSION["reset"])) {
    if ($_SESSION["reset"]) {
        $_SESSION["guess"] = new Guess();
        $_SESSION["reset"] = false;
        $_SESSION["inputstate"] = "submit";
    }
}
//loads object guess from session
$guess = $_SESSION["guess"];

/**
* if true, game over. Sets button "Make a guess" as hidden
**/

if ($guess->tries() < 1) {
    $_SESSION["inputstate"] = "hidden";
    $status = "Game over";
    include(__DIR__ . "/view/guess.php");
}

/**
 * Includes the form view.
 * @var string $inputstate  a string containing either hidden or submit.
 */

$inputstate = $_SESSION["inputstate"];
include(__DIR__ . "/view/form.php");

//show status of current input
if (isset($_SESSION["status"])) {
    $status = $_SESSION["status"];
    include(__DIR__ . "/view/guess.php");
}

//shows the random number in Guess, a cheat.
if (isset($_SESSION["cheat"])) {
    if ($_SESSION["cheat"]) {
        $number = $guess->number();
        include(__DIR__ . "/view/cheat.php");
        $_SESSION["cheat"] = false;
    }
}
