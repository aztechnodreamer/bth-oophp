<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><h1>Guess my number</h1>

<p>Guess a number between 1 and 100, you have <?= $tries ?> tries left.</p>
<form method="post">
    <input type="text" name="guess">
    <input <?= ($tries >= 1) ? "type='submit'" : "type='hidden'" ?> name="doGuess" value="Make a Guess">
    <input <?= ($tries >= 1) ? "type='submit'" : "type='hidden'" ?> name="doCheat" value="Cheat">
    <input style="margin-left: 20px;" type="submit" name="doInit" value="New Game">
</form>

<p>
    <?php if ($res) : ?>
        <?= $res ?>
    <?php endif; ?>

    <?php if ($doCheat) : ?>
        <b>CHEAT:</b> Current number is <?= $number ?>.
    <?php endif; ?>
</p>
