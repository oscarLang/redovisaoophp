<?php
namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

// Prepare classes
$classes[] = "article";
if (isset($class)) {
    $classes[] = $class;
}
$current = $game->getCurrentAsString();
$faces = $game->getLatestRolls() ?? [];
$scores = $game->getScores() ?? [];
$winner = $game->hasWinner();
$i = 1;
?>
<h1>Dice100!</h1>
<?php if($winner) : ?>
    <h2><?=$winner?> won!</h2>
<?php else: ?>
    <h2>current player: <?=$current?></h2>
    <p>
    <?php foreach ($faces as $face) : ?>
            <?php if($i == 6): ?>
                <br><?=$face?>
            <?php else: ?>
                Dice<?=$i++?> : <?=$face?>,
            <?php endif; ?>
    <?php endforeach; ?>
    </p>
    <b>Scores</b>
    <?php foreach ($scores as $key => $value) : ?>
        <p>
            <?=$key?> : <?=$value?>
        </p>
    <?php endforeach; ?>
    <form method="post" action="form-input">
        <?php if ($current == "Player") :  ?>
            <input type="submit" name="playerRoll" value="Roll dice">
            <input type="submit" name="playerSave" value="Stay & save">
        <?php else : ?>
            <input type="submit" name="botRoll" value="Give dice to computer">
        <?php endif; ?>
    </form>
<?php endif ?>
