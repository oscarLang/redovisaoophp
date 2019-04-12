<h1>Make a guess!</h1>
<p>You have <?=$guess->tries()?> tries left!</p>
<form action="redirect.php" method="post">
    <input type="number" name="input">
    <input type="<?=$inputstate?>" name="makeGuess" value="Make a guess">
</form>
<form action="redirect.php" method="post">
    <input type="submit" name="cheat" value="cheat">
</form>

<form action="redirect.php" method="post">
    <input type="submit" name="reset" value="reset">
</form>
