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
    return $app->response->redirect("guess/start");
});


$app->router->get("guess/start", function () use ($app) {
    $title = "Play the game";
    $data = [
        "guess" => $_SESSION["guess"],
        "content" => "start the game",
    ];

    $app->page->add("guess/play", $data);
    if(isset($_SESSION["status"])) {
        $data["status"] = $_SESSION["status"];
        $app->page->add("guess/status", $data);
    }
    $app->page->add("guess/debug");
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
            if ($inputNumber == $guess->number) {
                $_SESSION["inputstate"] = "hidden";
            }
        } catch (GuessException $e) {
            echo "Got exception: " . get_class($e) . "<hr>";
        }
    }
    return $app->response->redirect("guess/start");
});

$app->router->get("guess/cheat", function () use ($app) {
    $data = [
        "number" => 2
    ];
    $app->page->add("guess/cheat", $data);
    return $app->response->redirect("guess/start");
});
