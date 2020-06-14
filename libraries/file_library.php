<?php

const FILE_DIR = "files/";

if (isset($_POST["filename"]))
    $_POST["filename"] = FILE_DIR . $_POST["filename"];

function _post($key)
{
    if (isset($_POST[$key]) && !empty($_POST[$key]))
        return $_POST[$key];
    
    return null;
}

function getVowels()
{
    return array("a", "e", "i", "o", "u");
}

# Exercise 01
function createFile($fileName, $content)
{
    // Create a file
    $file = fopen($fileName, "w");
    // Write in that file
    fwrite($file, $content);
    // Close the file
    fclose($file);
}

# Exercise 02
function displayFile($fileName)
{
    // Open the file
    $file = fopen($fileName, "r");

    while (!feof($file))
        echo fgets($file) . "<br>";

    fclose($file);
}

# Exercice 03
function readOrCreateFile($fileName, $content)
{
    if (file_exists($fileName))
        displayFile($fileName);
    else
        createFile($fileName, $content);
}

# Exercice 04
function copyFile($original, $clone)
{
    $fo = fopen($original, "r");
    $fc = fopen((FILE_DIR . $clone), "w");

    while (!feof($fo))
        fwrite($fc, fgets($fo) . "\r\n");

    fclose($fo);
    fclose($fc);
}

# Exercice 05
function calculateVowelsConsonants($fileName)
{
    // Open
    $f = fopen($fileName, "r");

    $consonants = 0;
    $vowels = 0;
    while (!feof($f))
    {
        // Read one line
        $line = fgets($f);
        // Fetch
        for ($i=0; $i < strlen($line); $i++)
            if (ctype_alpha($line[$i]))
                if (in_array($line[$i], getVowels()))
                    $vowels++;
                else
                    $consonants++;
    }

    // Close
    fclose($f);
    // Return the result
    return array($vowels, $consonants);
}

# Exercice 06 + 07
function calculate($fileName)
{
    // Open
    $f = fopen($fileName, "r");

    $lines = 0;
    $digits = 0;
    $letters = 0;
    while (!feof($f))
    {
        // Read one line
        $line = fgets($f);
        // Increment the number of lines
        $lines++;
        // Fetch for
        for ($i=0; $i < strlen($line); $i++)
            if (ctype_alpha($line[$i]))
                $letters++;
            else if (is_numeric($line[$i]))
                $digits++;
    }

    // Close
    fclose($f);
    // Return the result
    return ["Digits"=>$digits, "Letters"=>$letters, "Lines"=>$lines];
}

# Exercice 07
function sortAndPrint($fileName)
{
    // Open
    $fr = fopen(FILE_DIR . "result.txt", "w");

    // Sort result
    $calcs = calculate($fileName);
    if (asort($calcs))
        foreach($calcs as $k => $v)
            fwrite($fr, "$k: $v\r\n");

    // Close
    fclose($fr);
}

# Exercise 08
function searchWord($fileName, $word)
{
    // Here is the algorithm, I search for the occurrence of the first letter of the word
    // Then comparing the word with index of the letter found + length of the word
    $f = fopen($fileName, "r");

    $wordCounter = 0;
    while (!feof($f))
    {
        $line = fgets($f);

        for ($i=0; $i < strlen($line); $i++) 
        { 
            if (strcmp($word[0], $line[$i]) == 0)
            {
                if (strcmp($word, substr($line, $i, strlen($word))) == 0)
                {
                    $wordCounter++;

                    $i += strlen($word); 
                }
            }
        }
    }

    // Close the file
    fclose($f);
    // Return the result
    return $wordCounter;
}

# Exercise 09
function inverseFile($origin, $inversed)
{
    $fo = fopen($origin, "r");
    $fi = fopen(FILE_DIR . $inversed, "w");

    while (!feof($fo))
        fputs($fi, strrev(fgets($fo)));

    fclose($fo);
    fclose($fi);
}

# Exercise 10
function saveData($fileName, $data)
{
    // Create file or open file
    $file = !file_exists($fileName) ? fopen($fileName, "w") : fopen($fileName, "a");

    // Check size
    if (filesize($fileName) > 99)
        throw new Exception ("Maximum size reached!");

    for ($i=0; $i < count($data); $i++)
            fwrite($file, implode(";", $data[$i]) . "\r\n");

    // Close the file
    fclose($file);
}

# Exercise 11
function searchCode($fileName, $code)
{
    $file = fopen($fileName, "r");

    $target = [];
    while (!feof($file))
    {
        $line = fgets($file);

        if (strpos($line, "$code") !== false)
        {
            $strArray = explode(";", $line);
            $target["code"] = $strArray[0];
            $target["name"] = $strArray[1];
            $target["city"] = $strArray[2];
        }
    }

    // Close the file
    fclose($file);
    // Return the found record
    return $target;
}

# Exercise 12
function loadData($fileName)
{
    $file = fopen($fileName, "r");

    $data = [];
    while (!feof($file))
    {
        $line = explode(";", fgets($file));
        
        if (count($line) != 3)
            continue;

        $code = trim($line[0]);
        $nom = trim($line[1]);
        $city = trim($line[2]);

        $data[$code] = [$nom, $city];
    }
    // Close the file
    fclose($file);
    // Return the result
    return $data;
}

# Exercise 13
function filterCity($fileName, $city)
{
    $result = [];

    // Load data
    $data = loadData($fileName);
        foreach ($data as $key => $value)
            if (strcmp($value[1], $city) === 0)
                $result[$key] = $value;

    return $result;
}

# Exercice 14
function groupByCity($fileName)
{
    $data = [];

    foreach(loadData($fileName) as $code => $info)
    {
        // Save the grouping into an associative array
        $data[$info[1]][$code] = $info;
        // Create or open
        $openMode = file_exists($info[1] . ".txt") ? "a" : "w";
        // Open file
        $file = fopen(FILE_DIR . $info[1] . ".txt", $openMode);
        // Write in file
        fwrite($file, $code . ";" . $info[0] . ";" . $info[1] . "\r\n");
        // Close file
        fclose($file);
    }

    return $data;
}