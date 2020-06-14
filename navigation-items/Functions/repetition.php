<form method='post' class='form-group'>
    <label class="form-label">Text</label>
    <input name='txt' placeholder="Enter the text" class='form-control' /><br/>
    <label class="form-label">Index</label>
    <input class='form-control' placeholder="Specify the index" name='index' />
    <input type='submit' value='Detect Repetition'>
</form>

<?php

if (!empty($_POST['txt']) && !empty($_POST['index']))
{
    $length = 0;

    for ($i=$_POST['index']; $i < strlen($_POST['txt']); $i++)
    {
        $current = $_POST['txt'][$i];
        $substr = $_POST['txt'][$_POST['index']];
        
        if ($current != $substr)
            break; 

        $length++;
    }

    echo "<div class='form-group'>";
    echo "<label class='form-label'>Number of redundancies</label>";
    echo "<input class='form-control' value='". substr_count($_POST['txt'], $_POST['txt'][$_POST['index']], $_POST['index'], $length) ."'>";
    echo "</div>";
}


?>