<?php

/**
* inits the game with a Guess object.
*
*/
$app->router->get("guess/init", function () use ($app) {
    // TODO: init game
    $guess = new Osln\Guess\Guess();
    $_SESSION["guess"] = $guess;
    $_SESSION["status"] = null;
    $_SESSION["cheat"] = false;
    $_SESSION["reset"] = false;
    $_SESSION["inputstate"] = "submit";
    return $app->response->redirect("guess/start");
});

$app->router->get("guess/start", function () use ($app) {
    $title = "Play the game";
    $data = [
        "guess" => $_SESSION["guess"],
        "inputstate" => $_SESSION["inputstate"]
    ];
    $app->page->add("guess/play", $data);
    if (isset($_SESSION["status"])) {
        $data["status"] = $_SESSION["status"];
        $app->page->add("guess/status", $data);
    }
    if (isset($_SESSION["cheat"])) {
        if ($_SESSION["cheat"]) {
            $app->page->add("guess/cheat", $data);
        }
    }
    // $app->page->add("guess/debug");
    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("guess/start", function () use ($app) {
    $guess = $_SESSION["guess"];
    if (isset($_POST["input"])) {
        $inputNumber = $_POST["input"];
        try {
            $_SESSION["status"] = $guess->makeGuess($inputNumber);
            if ($inputNumber == $guess->number()) {
                $_SESSION["inputstate"] = "hidden";
            }
            if ($guess->tries() < 1) {
                $_SESSION["inputstate"] = "hidden";
            }
        } catch (GuessException $e) {
            echo "Got exception: " . get_class($e) . "<hr>";
        }
    }
    return $app->response->redirect("guess/start");
});

$app->router->post("guess/cheat", function () use ($app) {
    if (isset($_POST["cheat"])) {
        $_SESSION["cheat"] = true;
    }
    $app->response->redirect("guess/start");
});

$app->router->post("guess/reset", function () use ($app) {
    if (isset($_POST["reset"])) {
        $_SESSION["reset"] = true;
    }
    $app->response->redirect("guess/init");
});
