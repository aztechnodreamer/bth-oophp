<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><h1>Lägg till film</h1>

<form class="movieEdit" method="post">
    <p>
        <label>Title:<br>
        <input type="text" name="movieTitle"/>
        </label>
    </p>

    <p>
        <label>Year:<br>
        <input type="number" name="movieYear" min="1900" max="2100"/>
    </p>

    <p>
        <label>Image:<br>
        <input type="text" name="movieImage"/>
        </label>
    </p>

    <p>
        <input type="submit" name="doAdd" value="Lägg till">
        <input type="submit" name="doCancel" value="Avbryt">
    </p>
</form>
