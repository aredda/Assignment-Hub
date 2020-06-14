<form method='post' class="form-group">
    <label class="form-label">Text</label>
    <input class="form-control" placeholder="Enter the text" name='txt' />
    <input value="Encode" type='submit'>
</form>

<?php

function encode($text)
{
    $stats = array();
    $counter = 1;

    for ($i=0; $i < strlen($text) - 1; $i++) 
    { 
        if ($text[$i] != $text[$i+1])
        {
            array_push($stats, [$text[$i], $counter]);

            $counter = 1;
        }
        else if ($i == strlen($text) - 2)
        {
            $counter++;
            
            array_push($stats, [$text[$i], $counter]);
        }
        else $counter++;
    }

    $encoding = "";
    for ($i=0; $i < count($stats); $i++) { 
        $encoding .=  $stats[$i][1] . $stats[$i][0];
    }

    return $encoding;
}

if (!empty($_POST['txt']))
{
    echo "<div class='form-group'>";
    echo "<label class='form-label'>Result</label>";
    echo "<input class='form-control' value='". encode($_POST['txt']) ."' />";
    echo "</div>";
}

