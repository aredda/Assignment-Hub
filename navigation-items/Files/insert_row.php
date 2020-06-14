<form method="post" class="form-group">
    <label class="form-label">Filename</label>
    <input type="text" class="form-control" name="filename" placeholder="Nom du fichier"/><br>
    <label class="form-label">Code</label>
    <input type="text" class="form-control" name="code" placeholder="Code"/><br>
    <label class="form-label">Name</label>
    <input type="text" class="form-control" name="name" placeholder="Nom"/><br>
    <label class="form-label">City</label>
    <input type="text" class="form-control" name="city" placeholder="Ville"/>
    <input type="submit" value="Insert new row"/>
</form>

<?php

try
{
    include_once "././libraries/file_library.php";

    $keys = ["filename", "code", "name", "city"];
    $row = [];

    foreach ($keys as $key)
    {
        if (!isset($_POST[$key]))
            throw new Exception("Complete all information!");

        if (strcmp($key, "filename") != 0)
            $row[$key] = $_POST[$key];
    }

    if (file_exists($_POST["filename"]))
        if (searchCode($_POST["filename"], $row["code"]) != null)
            throw new Exception("This code is already reserved!");

    saveData($_POST["filename"], [$row]);

    echo "<div class='alert alert-success'><b>". implode(" | ", $row) ."</b> Added successfully!</div>";
}
catch(Exception $e)
{
    echo "<div class='alert alert-danger'><b>". $e->getMessage() ."</b></div>";
} 