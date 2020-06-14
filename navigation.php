<?php

$directory_name = "navigation-items/";

function is_valid($name)
{
    if (strcmp($name, ".") == 0 || strcmp($name, "..") == 0)
        return false;

    return true;
}

function check_extension($name, $extension)
{
    if (strpos($name, $extension) !== false)
        return true;

    return false;
}

function count_files($directory_name)
{
    $directory = opendir($directory_name);

    $c = 0;
    while (($i = readdir($directory)) !== false)
        if (is_valid($i) && check_extension($i, "php"))
            $c++;

    closedir($directory);

    return $c;
}

function correct_string($string)
{
    // Remove the extension
    $pure_string = str_replace(".php", "", $string);
    // Replace underscore with a space
    $pure_string = str_replace("_", " ", $pure_string);
    // Convert the first character to uppercase
    return ucfirst($pure_string);
}

function get_nav_items($directory_name)
{
    // Open the navigation items directory
    $directory = opendir($directory_name);

    $nav_items = [];
    while (($item = readdir($directory)) !== false)
    {
        if (!is_valid($item))
            continue;

        if (strpos($item, '.') === FALSE)
        {
            // Check if this directory has sub items
            $sub_directory_name = $directory_name . "$item/";
            $sub_directory = opendir($sub_directory_name);
            
            // Initiate the navigation main item
            $nav_items[$item] = [];

            if (count_files($sub_directory_name) != 0)
            {
                while (($sub_item = readdir($sub_directory)) !== false)
                    if (is_valid($sub_item) && check_extension($sub_item, "php"))
                        array_push($nav_items[$item], $sub_item);   
            }
            closedir($sub_directory);
        }
    }

    // Close the directory
    closedir($directory);

    return $nav_items;
}