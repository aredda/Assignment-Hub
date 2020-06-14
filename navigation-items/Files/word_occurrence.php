<form class="form-group" method="post">
    <label class="form-label">Filename</label>
    <input name="filename" type="text" class="form-control" placeholder="Filename"/>
    <br>
    <label class="form-label">Word</label>
    <input type="text" class="form-control" placeholder="Word" name="word"/>
    <input type="submit" value="Count word's occurrence"/>
</form>

<?php

include "././libraries/file_library.php";

$filename = _post("filename");
$word = _post("word");

if ($filename == null || $word == null)
    echo "Complete all information!";
else if (!file_exists($filename))
    echo "$filename doesn't exist!";
else
{
?>
    <div class="form-group">
        <label class="form-label">Number of word's occurrence</label>
        <input value="<?php echo searchWord($filename, $word); ?>" type="text" class="form-control"/>
    </div>
<?php
}