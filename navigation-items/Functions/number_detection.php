<form method='post' class='form-group'>
    <label class="form-label">Text</label>
    <input class="form-control" placeholder="Enter the text" name='txt' /><br/>
    <label class="form-label">Index</label>
    <input class="form-control" type="number" placeholder="Specifiy where the number starts" name='index' />
    <input type='submit' value="Detect Number">
</form>

<?php

function search_number($text, $start)
{
    $length = 0;
    for ($i=$start; $i < strlen($text); $i++, $length++) 
        if (!is_numeric($text[$i])) break;

    return substr($text, $start, $length);
}

if (!empty($_POST['txt']) && !empty($_POST['index']))
{
    $text = $_POST['txt'];
    $index = $_POST['index'];

?>
    <div class="form-group">
        <label class="form-label">Result</label>
        <input class="form-control" value="<?php echo search_number($text, $index); ?>" /><br />
        <label class="form-label">Nbr</label>
        <input class="form-control" value="<?php echo strlen (search_number($text, $index));  ?>"/>
    </div>
<?php
}