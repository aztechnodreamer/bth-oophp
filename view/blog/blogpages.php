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

<h1>Sidor</h1>

<table class="pages">
    <tr class="first">
        <!-- <th>Id</th> -->
        <th>Titel</th>
        <th>Textfilter</th>
        <th>Skapad</th>
        <th>Publicerad</th>
        <th>Uppdaterad</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <!-- <td><?= $row->id ?></td> -->
        <td><a href="page?path=<?= $row->path ?>"><?= $row->title ?></a></td>
        <td><?= $row->filter ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->updated ?></td>
    </tr>
<?php endforeach; ?>
</table>
