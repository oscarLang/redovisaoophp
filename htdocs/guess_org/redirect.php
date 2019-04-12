<?php
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");
session_name("osln17");
session_start();
$guess = $_SESSION["guess"];
if (isset($_POST["input"])) {
    $inputNumber = $_POST["input"];
    try {
        $_SESSION["status"] = $guess->makeGuess($inputNumber);
        if ($inputNumber == $guess->number) {
            $_SESSION["inputstate"] = "hidden";
        }
    } catch (GuessException $e) {
        echo "Got exception: " . get_class($e) . "<hr>";
    }
} else if (isset($_POST["cheat"])) {
    $_SESSION["cheat"] = true;
} else if (isset($_POST["reset"])) {
    $_SESSION["reset"] = true;
}
header('Location: index.php');
