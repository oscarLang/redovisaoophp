<?php

/**
* inits the game with a Guess object.
*
*/
$app->router->get("guess/init", function () use ($app) {
    // TODO: init game
    $game = new Osln\Guess\Guess();
    return $app->response->redirect("guess/start");
});


$app->router->get("guess/start", function () use ($app) {
    $title = "Play the game";
    $data = [
        "class" => "hello-world",
        "content" => "start the game",
    ];

    $app->page->add("guess/play", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});
