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

<h1>Filmdatabas</h1>

<form style="float: left; margin-bottom: 10px;" method="post">
    <lable>Titel: </lable>
    <input style="margin-right: 20px;" type="search" name="searchTitle" value="">

    <lable>Årtal: </lable>
    <input type="number" name="year1" value="1900" min="1900" max="2100" required/>
    -
    <input style="margin-right: 20px;" type="number" name="year2" value="2100" min="1900" max="2100" required/>

    <input style="margin-right: 20px;" type="submit" name="doSearch" value="Sök">
</form>

<a style="float: left;" href="movie"><button>Visa alla</button><a>

<table class="movie" >
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
        <td>
            <form method="post">
                <input type="hidden" name="id" value="<?= $row->id ?>"/>
                <input type="submit" name="doEdit" value="Redigera">
            </form>
        </td>
    </tr>
<?php endforeach; ?>
</table>

<a href="movie/create"><button style="margin: 20px 0;">Lägg till film</button></a>
