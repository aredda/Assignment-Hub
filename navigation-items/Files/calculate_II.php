<form class="form-group" method="post">
    <label class="form-label">Filename</label>
    <input name="filename" type="text" class="form-control" placeholder="Filename"/>
    <input type="submit" value="Calculate digits and letters"/>
</form>

<?php

include "././libraries/file_library.php";

$fileName = _post("filename");

if ($fileName == null)
    echo "Complete all information!";
else if (!file_exists($fileName))
    echo "$fileName doesn't exist!";
else
{
    $r = calculate($fileName);
?>
    <div class="form-group">
        <label class="form-label">Number of digits</label>
        <input value="<?php echo $r["Digits"]; ?>" type="text" class="form-control"/>
        <br>
        <label class="form-label">Number of letters</label>
        <input value="<?php echo $r["Letters"]; ?>" type="text" class="form-control"/>
    </div>
<?php
}