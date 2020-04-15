<h1>Guess my number</h1>

<p>Guess a number between 1 and 100, you have <?= $tries ?> tries left.</p>
<form method="post">
    <input type="text" name="guess">
    <input <?= ($tries >= 1) ? "type='submit'" : "type='hidden'" ?> name="doGuess" value="Make a Guess">
    <input <?= ($tries >= 1) ? "type='submit'" : "type='hidden'" ?> name="doCheat" value="Cheat">
    <input style="margin-left: 20px;" type="submit" name="doInit" value="New Game">
</form>

<?php if ($doGuess) : ?>
    <?= $res ?>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p><b>CHEAT:</b> Current number is <?= $number ?>.</p>
<?php endif; ?>

<!--
<pre>
<?= var_dump($_POST) ?>
