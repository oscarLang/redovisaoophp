<?php

/**
* inits the game with a Guess object.
*
*/
$app->router->get("dice/init", function () use ($app) {
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

$app->router->post("dice/form-input", function () use ($app) {
    $game = $app->session->get("game");
    if ($app->request->getPost("playerRoll")) {
        $game->play();
    } elseif ($app->request->getPost("playerSave")) {
        $game->save("Player");
    } elseif ($app->request->getPost("botRoll")) {
        $game->play();
    } else {
        echo "Error";
    }
    $app->session->set("game", $game);
    return $app->response->redirect("dice/start");
});
$app->router->post("dice/reset", function () use ($app) {
    if ($app->request->getPost("reset")) {
        $app->response->redirect("dice/init");
    }
});
