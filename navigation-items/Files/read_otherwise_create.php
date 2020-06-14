<form class="form-group" method="post">
    <label class="form-label">Filename</label>
    <input name="filename" type="text" class="form-control" placeholder="Filename"/>
    <br>
    <label class="form-label">Alternative content</label>
    <textarea name="content" class="form-control"></textarea>
    <input type="submit" value="Execute action"/>
</form>

<?php

include "././libraries/file_library.php";

$fileName = _post("filename");
$content = _post("content");

if ($fileName == null || $content == null)
    echo "Complete all information!";
else
{
    if (!file_exists($fileName))
    {
        // Create the file
        createFile($fileName, $content);

        echo "$fileName has been created successfully!";
    }
    else
    {
?>
    <label class="form-label">Content</label>
    <textarea name="content" class="form-control"><?php displayFile($fileName); ?></textarea>
<?php
    }
}