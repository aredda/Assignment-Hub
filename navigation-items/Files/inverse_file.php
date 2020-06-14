<form class="form-group" method="post">
    <label class="form-label">Filename</label>
    <input name="filename" type="text" class="form-control" placeholder="Filename"/>
    <br>
    <label class="form-label">Inverse Filename</label>
    <input type="text" class="form-control" placeholder="Filename" name="inverseFilename"/>
    <input type="submit" value="Inverse file"/>
</form>

<?php

include "././libraries/file_library.php";

$fileName = _post("filename");
$inverseFileName = _post("inverseFilename");

if ($fileName == null || $inverseFileName == null)
    echo "Complete all information!";
else
{
    if (!file_exists($fileName))
        echo "$fileName doesn't exist!";
    else if (file_exists($inverseFileName))
        echo "$inverseFileName does exist!";
    else
    {
        // Create the file with the content
        inverseFile($fileName, $inverseFileName);

        echo "$inverseFileName is created successfully!";
    }
}