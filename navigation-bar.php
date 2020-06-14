<?php

include "navigation.php";

echo "<div class='row'>";
foreach (get_nav_items($directory_name) as $item => $sub_items)
{
    $sub_directory = $directory_name . $item;

    echo "<div class='col-lg-12 menu'>";
    echo "<a class='nav-item' href='#'>";
    echo "<img class='mr-3' src='$sub_directory"."/__icon.png'/>";
    echo $item;
    echo "<span>". count_files($sub_directory) ." items</span>";
    echo "</a>";
    
    if (count($sub_items) != 0)
    {
        echo "<div class='row sub-menu'>";
        foreach($sub_items as $sub_item)
        {
            if (is_valid($sub_item) && check_extension($sub_item, "php"))
            {
                // Encode the link
                $encoded = base64_encode($sub_directory . "/" . $sub_item);
                
                echo "<div class='col-lg-12'><a href='index.php?p=$encoded' class='nav-item'>".correct_string($sub_item)."</a></div>";
            }   
        }
        echo "</div>";
    }

    echo "</div>";
}
echo "</div>";