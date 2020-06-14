<form method="post" class="form-group">
    <label class="form-label">Filename</label>
    <input type="text" class="form-control" name="filename" placeholder="Nom du fichier"/>
    <input type="submit" value="Group cities"/>
</form>

<?php

include "././libraries/file_library.php";

try 
{
    if (!isset($_POST["filename"]))
        throw new Exception("Provide the data source!");

    if (!file_exists($_POST["filename"]))
        throw new Exception("<b>" . $_POST["filename"] . "</b> doesn't exist!");

    // Retrieve data
    $data = loadData($_POST["filename"]);
    $grouped_data = groupByCity($_POST["filename"]);

    // Styling
    $colors = ["dark", "primary", "danger", "success", "info", "warning", "secondary"];
    $used_colors = [];
    $associations = [];

    foreach ($grouped_data as $city => $record)
    {
        // Choose a random color and affect it
        $associations[$city] = null; 
        do 
        {
            $associations[$city] = $colors[array_rand($colors)];
        }
        while (in_array($associations[$city], $used_colors));
        // Mark the color as picked
        array_push($used_colors, $associations[$city]);
    }

    // Display the original file
    echo "<div class='row mb-3'>";
    echo "<div class='col-lg-12'>";
    ?>
    <h5>Original file: <b><?php echo $_POST["filename"]; ?></b></h5>
    <table class="table table-bordered">
        <thead class="thead bg-orange text-white">
            <tr>
                <td>Code</td>
                <td>Name</td>
                <td>City</td>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($data as $code => $info)
            {
                echo "<tr>";
                echo "<td>$code</td>";
                echo "<td>$info[0]</td>";
                echo "<td>$info[1]</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
    <?php
    echo "</div>";
    echo "</div>";

    // Display the grouped data
    echo "<div class='row'>";
    foreach ( $grouped_data as $city => $rows )
    {
        ?>
        <div class="col-lg-6">
            <h6 class="text-<?php echo $associations[$city]; ?>"><?php echo "$city.txt"; ?></h6>
            <table class="table table-striped table-bordered">
                <thead class="thead table-<?php echo $associations[$city]; ?>">
                    <tr>
                        <td>Code</td>
                        <td>Name</td>
                        <td>City</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rows as $code => $info)
                    {
                        echo "<tr>";
                        echo "<td>$code</td>";
                        echo "<td>$info[0]</td>";
                        echo "<td>$info[1]</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    }
    echo "</div>";
} 
catch (Exception $e) 
{
    echo "<div class='alert alert-danger'><b>". $e->getMessage() ."</b></div>";
}