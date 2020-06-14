<form class="form-group" method="post">
    <label class="form-label">Filename</label>
    <input name="filename" type="text" class="form-control" placeholder="Filename"/>
    <input type="submit" value="Calculate vowels and consonants"/>
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
    $r = calculateVowelsConsonants($fileName);
?>
    <div class="form-group">
        <label class="form-label">Number of vowels</label>
        <input value="<?php echo $r[0]; ?>" type="text" class="form-control"/>
        <br>
        <label class="form-label">Number of consonants</label>
        <input value="<?php echo $r[1]; ?>" type="text" class="form-control"/>
    </div>
<?php
}