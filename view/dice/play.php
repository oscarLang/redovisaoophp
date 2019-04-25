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
$i = 1;
?>
<h1>Dice100!</h1>
<h2>current player: <?=$current?></h2>
<?php foreach ($faces as $face) : ?>
    <?php if($i == 6): ?>
        <p><?=$face?> </p>
    <?php else: ?>
        <p>dice<?=$i++?> : <?=$face?> </p>
    <?php endif; ?>
<?php endforeach; ?>
<form method="post" action="form-input">
    <?php if ($current == "Player") :  ?>
        <input type="submit" name="playerRoll" value="Roll dice">
        <input type="submit" name="playerSave" value="Stay & save">
    <?php else : ?>
        <input type="submit" name="botRoll" value="Give dice to computer">
    <?php endif; ?>
</form>
