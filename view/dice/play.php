<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><h1>Dice 100</h1>
<?php if (!isset($_SESSION["game"])) : ?>
    <p>Play a game of dice.</p>
    <form method="post">
        <label>Number of dices: </label>
        <input type="number" name="dices" value="3" min="1">
        <label>Number of players: </label>
        <input type="number" name="players" value="2" min="2">
        <input type="submit" name="doInit" value="Start game">
    </form>

    <h3 style="text-align: center;">Rules</h3>
    <p class="rules"><b>Number of players:</b> two or more.<br />
    <b>Number of dice:</b> one or more.<br /><br />
    <b>Goal:</b> First to get 100 points wins.</p>

    <p>A round begins by a player throwing all the dices. Dices with 2-6 pips are
    summed and added to the total for the current game round. Each pip gives one
    point; a 2 is worth two points and a 6 is worth six points etc.</p>

    <p>The player decides whether to throw again to try to collect more points,
    or whether to end the round. All collected points during the round will then
    be added to the record.</p>

    <p>If the player throws a 1, the round of play is automatically ended. The
    player lose all points collected in the current round and the turn goes to
    the next player in line. First to a hundred points wins.</p>

<?php endif; ?>

<?php if (isset($_SESSION["game"])) : ?>
    <div class="roll">
    <?php if ($status != "win") : ?>
        <p><b>Dices/turn:</b> <?= $dices ?> |
        <b>Number of players:</b> <?= count($protocol) ?></p>

        <form method="post">
            <input style="margin-left: 20px;" type="submit" name="doCancel" value="End game">
        </form>

        <?php if (isset($roll)) : ?>
            <p class="dice-utf8">
            <?php foreach ($roll as $value) : ?>
                <span class="<?= $value ?>"></span>
            <?php endforeach; ?>
            </p>
        <?php endif; ?>

        <p><b><?= (is_numeric($sum) ? (($sum != 0) ? "Sum of rolls: " . $sum : "Time for " .
        $currPlayer . " to roll the dices." ) : "" ) ?></b></p>

        <form method="post">
            <input type='submit' name='doRoll' value='Throw the dices <?= $currPlayer ?>'>
            <input style="margin-left: 20px;" type='submit' name='endTurn' value='End turn'
                <?=(($sum == 0) ? "disabled" : "" )?>>
        </form>

    <?php else : ?>
        <p class="winner"><?= $currPlayer ?> wins!</p>
        <form method="post">
            <input style="margin-left: 20px;" type="submit" name="doCancel" value="New game">
        </form>
    <?php endif;

    if (!is_null($protocol)) {
        echo "<h3 style='margin-top: 30px;'>Record</h3><div class='protocol'>";
        foreach ($protocol as $key => $value) {
            if ($currPlayer == $key) {
                echo "<p class='player currPlayer'><b>" . $key . ":</b> ";
            } else {
                echo "<p class='player'><b>" . $key . ":</b> ";
            }
            $first = true;
            foreach ($protocol[$key] as $points) {
                if ($first) {
                    echo $points . " points total.</p>";
                    $first = false;
                }
            }
        }
        echo "</div>";
    }
    echo "</div>";
endif; ?>
