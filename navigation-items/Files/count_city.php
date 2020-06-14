<form method="post" class="form-group">
    <label class="form-label">Filename</label>
    <input type="text" class="form-control" name="filename" placeholder="Code"/><br>
    <label class="form-label">City</label>
    <input type="text" class="form-control" name="city" placeholder="Ville"/>
    <input type="submit" value="Count city occurrence"/>
</form>

<?php

include "././libraries/file_library.php";

try 
{
    if (!isset($_POST["filename"]) || !isset($_POST["city"]))
        throw new Exception("Complete all information!");

    if (!file_exists($_POST["filename"]))
        throw new Exception("<b>".$_POST["filename"]."</b> doesn't exist!");

    $result = filterCity($_POST["filename"], $_POST["city"]);

    ?>
    
    <div class="form-group">
        <label class="form-label">City's occurrence</label>
        <input type="text" class="form-control" value="<?php echo count($result); ?>"/>
    </div>

    <?php
} 
catch (Exception $e) 
{
    echo "<div class='alert alert-danger'><b>". $e->getMessage() ."</b></div>";
}