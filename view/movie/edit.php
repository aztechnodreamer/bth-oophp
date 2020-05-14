<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><h1>Redigera film</h1>

<?php foreach ($resultset as $movie) : ?>
    <form class="movieEdit" method="post">
        <input type="hidden" name="movieId" value="<?= $movie->id ?>"/>

        <p>
            <label>Title:<br>
            <input type="text" name="movieTitle" value="<?= $movie->title ?>"/>
            </label>
        </p>

        <p>
            <label>Year:<br>
            <input type="number" name="movieYear" value="<?= $movie->year ?>" min="1900" max="2100"/>
        </p>

        <p>
            <label>Image:<br>
            <input type="text" name="movieImage" value="<?= $movie->image ?>"/>
            </label>
        </p>

        <p>
            <input type="submit" name="doSave" value="Spara">
            <a style="margin-right: 80px;" href="movie"><button>Avbryt</button><a>

            <input type="submit" name="doDelete" value="Radera film">
        </p>
    </form>
<?php endforeach; ?>
