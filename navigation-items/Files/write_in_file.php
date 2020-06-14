<form class="form-group" method="post">
    <label class="form-label">Filename</label>
    <input name="filename" type="text" class="form-control" placeholder="Filename"/>
    <br>
    <label class="form-label">Content</label>
    <textarea name="content" class="form-control"></textarea>
    <input type="submit" value="Write in file"/>
</form>

<?php

include "././libraries/file_library.php";

$fileName = _post("filename");
$content = _post("content");

if ($fileName == null || $content == null)
    echo "Complete all information!";
else
{
    // Create the file with the content
    createFile($fileName, $content);

    echo "$fileName is created successfully!";
}

# Test A
// createFile("x1.txt", "Mission Accomplished!");
# Test B
// displayFile("x1.txt");
# Test C
// readOrCreateFile("x2.txt", "I am created! Yuuupie!");
# Test D
// copyFile("x1.txt", "x3.txt");
# Test E
// calculateVowelsConsonants("x1.txt");
# Test F
# Test G
// sortAndPrint("x1.txt");
# Test H
// echo searchWord("x1.txt", "Mission");
# Test I
// inverseFile("x1.txt", "x4.txt");
# Test J
// saveData("info.txt", [[
//     "code"=>1,
//     "nom"=>"areda",
//     "ville"=>"Tanger"
// ], [
//     "code"=>2,
//     "nom"=>"harraf",
//     "ville"=>"Tanger"
// ], [
//     "code"=>3,
//     "nom"=>"ouadrassi",
//     "ville"=>"Tanger"
// ]]);
# Test K
// echo implode (" | ", searchCode("info.txt", 1));
# Test L
// echo count(filterCity("info.txt", "Tanger"));