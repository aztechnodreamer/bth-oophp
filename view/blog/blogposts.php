<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

if (!$resultset) {
    return;
}
?>

<article style="margin-bottom: 20px;">
    <?php foreach ($resultset as $row) : ?>
    <section>
        <header>
            <h1><a href="blog/post?slug=<?= $row->slug ?>"><?= $row->title ?></a></h1>
            <p><i>Published: <time datetime="<?= $row->published_iso8601 ?>" pubdate><?= $row->published ?></time></i></p>
        </header>
        <?= $row->data ?>
    </section>
    <?php endforeach; ?>
</article>
