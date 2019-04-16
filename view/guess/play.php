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
<h1>Make a guess!</h1>
<p>You have <?=$guess->tries()?> tries left!</p>
<form method="post">
    <input type="number" name="input">
    <!-- <input type="submit" name="makeGuess" value="Make a guess"> -->
    <input type=<?=$inputstate?> name="makeGuess" value="Make a guess">
</form>
<form method="post" action="cheat">
    <input type="submit" name="cheat" value="cheat">
</form>
<form action="reset" method="post">
    <input type="submit" name="reset" value="reset">
</form>
