<?php

/**
* inits the game with a Guess object.
*
*/
$app->router->get("dice/init", function () use ($app) {
    // TODO: init game
    $game = new Osln\Dice\Protocol();
    $game->chooseStarter();
    $app->session->set("game", $game);
    return $app->response->redirect("dice/start");
});

$app->router->get("dice/start", function () use ($app) {
    $title = "Play the game";
    $data = [
        "game" => $app->session->get("game"),
    ];
    $app->page->add("dice/play", $data);

    $app->page->add("dice/debug");
    return $app->page->render([
        "title" => $title,
    ]);
});
