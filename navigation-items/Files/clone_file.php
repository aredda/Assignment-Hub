<form class="form-group" method="post">
    <label class="form-label">Filename</label>
    <input name="filename" type="text" class="form-control" placeholder="Filename"/>
    <br>
    <label class="form-label">Clone Filename</label>
    <input type="text" class="form-control" placeholder="Filename" name="cloneFilename"/>
    <input type="submit" value="Clone file"/>
</form>

<?php

include "././libraries/file_library.php";

$fileName = _post("filename");
$cloneFileName = _post("cloneFilename");

if ($fileName == null || $cloneFileName == null)
    echo "Complete all information!";
else
{
    if (!file_exists($fileName))
        echo "$fileName doesn't exist!";
    else if (file_exists($cloneFileName))
        echo "$cloneFileName does exist!";
    else
    {
        // Create the file with the content
        copyFile($fileName, $cloneFileName);

        echo "$cloneFileName is created successfully!";
    }
}