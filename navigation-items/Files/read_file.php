<form class="form-group" method="post">
    <label class="form-label">Filename</label>
    <input name="filename" type="text" class="form-control" placeholder="Filename"/>
    <input type="submit" value="Read file"/>
</form>

<?php

include "././libraries/file_library.php";

$fileName = _post("filename");

if ($fileName == null)
    echo "Complete all information!";
else
{
    if (!file_exists($fileName))
        echo "$fileName doesn't exist!";
    else
    {
?>
    <label class="form-label">Content</label>
    <textarea name="content" class="form-control"><?php displayFile($fileName); ?></textarea>
<?php
    }
}