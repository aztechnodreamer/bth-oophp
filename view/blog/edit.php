<h1>Redigera</h1>

<?php foreach ($resultset as $content) : ?>
    <form method="post">
        <fieldset class="blog-left">
            <input type="hidden" name="contentId" value="<?= $content->id ?>"/>

            <p>
                <label>Titel:</label><br />
                <input type="text" name="contentTitle" value="<?= $content->title ?>" required />
            </p>

            <p>
                <label>Text:</label><br />
                <textarea name="contentData"><?= $content->data ?></textarea>
            </p>
        </fieldset>

        <fieldset class="blog-right">
            <p>
                <label>Path:</label><br />
                <input type="text" name="contentPath" value="<?= $content->path ?>"/>
            </p>

            <p>
                <label>Slug:</label><br />
                <input type="text" name="contentSlug" value="<?= $content->slug ?>"/>
            </p>

            <p>
                <label>Publicera:</label><br />
                <input type="datetime" name="contentPublish" value="<?= $content->published ?>"/>
            </p>

            <p>
                <label>Typ:</label><br />
                <select name="contentType">
                    <option value="post" <?= ($content->type == "post") ? "selected='selected'" : "" ?>>Blogginlägg</option>
                    <option value="page" <?= ($content->type == "page") ? "selected='selected'" : "" ?>>Sida</option>
                </select>
            </p>

            <p>
                <label>Filter:</label><br />
                <?php $filter = explode(",", $content->filter); ?>
                <label class="checkbox">bbcode <input type="checkbox" name="contentFilter[]" value="bbcode"
                    <?= (in_array("bbcode", $filter)) ? "checked" : "" ?>/></label>
                <label class="checkbox">link <input type="checkbox" name="contentFilter[]" value="link"
                    <?= (in_array("link", $filter)) ? "checked" : "" ?>/></label>
                <label class="checkbox">markdown <input type="checkbox" name="contentFilter[]" value="markdown"
                    <?= (in_array("markdown", $filter)) ? "checked" : "" ?>/></label>
                <label class="checkbox">nl2br <input type="checkbox" name="contentFilter[]" value="nl2br"
                    <?= (in_array("nl2br", $filter)) ? "checked" : "" ?>/></label>
            </p>
        </fieldset>

        <fieldset class="blog-submit">
            <p>
                <input type="submit" name="doSave" value="Spara">
                <button type="reset">Återställ</button>
                <input style="margin-left: 10px;" type="submit" name="doCancel" value="Avbryt" formnovalidate>
                <input style="margin-left: 30px;" type="submit" name="doDelete" value="Radera" formnovalidate>
            </p>
        </fieldset>
    </form>
<?php endforeach; ?>
