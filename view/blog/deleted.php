<h1>Papperskorg</h1>

<a href="admin"><button>Tillbaka</button></a>

<?php if (!$resultset) : ?>
    <p>Inga raderade blogginlägg eller sidor.</p>
<?php endif; ?>

<?php if ($resultset) : ?>
    <table class="admin">
        <tr class="first">
            <th>Id</th>
            <th>Titel</th>
            <th>Typ</th>
            <th>Path</th>
            <th>Slug</th>
            <th>Skapad</th>
            <th>Publicerad</th>
            <th>Uppdaterad</th>
            <th>Raderad</th>
        </tr>
    <?php $id = -1; foreach ($resultset as $row) :
        $id++; ?>
        <tr>
            <td><?= $row->id ?></td>
            <td><?= $row->title ?></td>
            <td><?= $row->type ?></td>
            <td><?= $row->path ?></td>
            <td><?= $row->slug ?></td>
            <td><?= $row->created ?></td>
            <td><?= $row->published ?></td>
            <td><?= $row->updated ?></td>
            <td><?= $row->deleted ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $row->id ?>"/>
                    <input type="submit" name="doRestore" value="Återställ">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
