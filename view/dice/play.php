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

?>
<h1>Dice100!</h1>
<p><?=$game->play()?></p>
<form method="post">
    <?php if($game->getNextAsString() == "Player") :  ?>
        <input type="submit" name="playerRoll" value="Roll dice">
        <input type="submit" name="playerSave" value="Stay & save">
    <?php else : ?>
        <input type="submit" name="botRoll" value="Give dice to computer">
    <?php endif; ?>
</form>
