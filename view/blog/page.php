<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<article style="margin-bottom: 20px;">
    <?php foreach ($resultset as $content) : ?>
        <header>
            <h1><?= $content->title ?></h1>
            <p><i>Latest update: <time datetime="<?= $content->modified_iso8601 ?>" pubdate><?= $content->modified ?></time></i></p>
        </header>
        <?= $content->data ?>
    <?php endforeach; ?>
</article>
