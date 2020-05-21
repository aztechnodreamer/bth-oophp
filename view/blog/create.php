<h1>Skapa ny</h1>

<form method="post">
    <p>
        <label>Titel:</label>
        <input style="width: 50%;" type="text" name="contentTitle" default="A Title" required />

        <label>Typ:</label>
        <select name="contentType">
            <option value="" disabled selected>--Välj typ--</option>
            <option value="post">Blogginlägg</option>
            <option value="page">Sida</option>
        </select>
    </p>

    <p>
        <input type="submit" name="doCreate" value="Skapa" />
        <button type="reset">Återställ</button>
        <input style="margin-left: 10px;" type="submit" name="doCancel" value="Avbryt" formnovalidate>
    </p>
</form>
