<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<h1>My text filters</h1>

<h2>bbcode2html</h2>
<p><b>Original:</b> <?= $original[0]; ?></p>
<p><b>Filter:</b> <?= $filter[0]; ?></p>

<h2>makeClickable</h2>
<p><b>Original:</b> <?= $original[1]; ?></p>
<p><b>Filter:</b> <?= $filter[1]; ?></p>

<h2>markdown</h2>
<p><b>Original:</b> <?= $original[2]; ?></p>
<p><b>Filter:</b> <?= $filter[2]; ?></p>

<h2>nl2br</h2>
<p><b>Original:</b> <?= $original[3]; ?></p>
<p><b>Filter:</b> <?= $filter[3]; ?></p>

<h2>All text filters</h2>
<p><b>Original:</b> <?= $original[4]; ?></p>
<p><b>Filter:</b> <?= $filter[4]; ?></p>
