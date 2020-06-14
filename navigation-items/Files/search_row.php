<form method="post" class="form-group">
    <label class="form-label">Filename</label>
    <input type="text" class="form-control" name="filename" placeholder="Code"/><br>
    <label class="form-label">Code</label>
    <input type="text" class="form-control" name="code" placeholder="Code"/>

    <input type="submit" value="Search by code"/>
</form>

<?php

try
{
    include_once "././libraries/file_library.php";

    if (!isset($_POST["filename"]) || !isset($_POST["code"]))
        throw new Exception("Complete all information!");

    if (!file_exists($_POST["filename"]))
        throw new Exception("(<b>" . $_POST["filename"] . "</b>) doesn't exist!");

    $row = searchCode($_POST["filename"], $_POST["code"]);

    if ($row == null)
        throw new Exception("(<b>" . $_POST["code"] . "</b>) doesn't exist in the file!");

    ?>

    <div class="form-group">
        <label class="form-label">Code</label>
        <input type="text" value="<?php echo $row["code"]; ?>" class="form-control"><br>
        <label class="form-label">Name</label>
        <input type="text" value="<?php echo $row["name"]; ?>" class="form-control"><br>
        <label class="form-label">City</label>
        <input type="text" value="<?php echo $row["city"]; ?>" class="form-control">
    </div>

    <?php
}
catch (Exception $e)
{
    echo "<div class='alert alert-danger'>". $e->getMessage() ."</div>";
}