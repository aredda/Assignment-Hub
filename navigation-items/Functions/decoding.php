<form method='post'>
    <label class='form-label'>Text</label> 
    <input class='form-control' placeholder="Enter the encoded text" name='txt' />
    <input type='submit' value='Decode'>
</form>

<?php

function search_number($text, $start)
{
    $length = 0;
    for ($i=$start; $i < strlen($text); $i++, $length++) 
        if (!is_numeric($text[$i])) break;

    return substr($text, $start, $length);
}

if (!empty($_POST['txt']))
{
    $text = $_POST['txt'];

    $decoding = "";
    for ($i=0; $i < strlen($text); $i++) 
    { 
        $r = search_number($text, $i);

        for($j=0; $j<$r; $j++)
            $decoding .= $text[$i + strlen($r)];
        
        $i += strlen($r);
    }

    echo "<div class='form-group'>";
    echo "<label class='form-label'>Decoded Result</label>";
    echo "<input class='form-control' value='". $decoding ."' />";
    echo "</div>";
}

?>