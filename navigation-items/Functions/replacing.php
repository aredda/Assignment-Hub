<form method='post' class="form-group">
    <label class="form-label">Text</label>
    <input class="form-control" placeholder="Enter the text" onchange='updateSelect("x", this.value)' name='txt' /><br>
    <label class="form-label">X (The letter to be replaced)</label>
    <select class="form-control" name='x'></select><br/>
    <label class="form-label">Y</label>
    <input class="form-control" placeholder="The letter to replace with" name='y' />
    <input type='submit' value='Remplacer X par Y' />
</form>

<?php

if (!empty($_POST['txt']) && !empty($_POST['x']) && !empty($_POST['y']))
{
    echo "<div class='form-group'>";
    echo "<label class='form-label'>Result</label>";
    echo "<input class='form-control' value='". str_replace($_POST['x'], $_POST['y'], $_POST['txt']) ."'/>";
    echo "</div>";
}