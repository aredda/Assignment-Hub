<?php
    $langs = [
        "English" => ["CNE", "Name", "Branch", "Display Notes", "Subject", "Note", "Result", "Passed", "Failed", "Retaking Exam", "Final Note"],
        "Arabic" => ["رقم البطاقة الوطني", "الاسم الكامل", "الشعبة", "اظهار النقاط", "المادة", "النقطة", "النتيجة", "ناجح", "راسب", "استدراكي", "المعدل"]
    ];

    $url = $_GET["p"];
    $lang = "English";

    if (isset($_GET["lang"]))
        $lang = $_GET["lang"];

    include_once "././libraries/config.php";
    include_once "././libraries/mapping/c_context.php";

    // Instantiate a context
    $dataContext = new DataContext(getConfigArray());
    
    // Get tables
    $students = $dataContext->GetEntity("etudiant");
    $subjects = $dataContext->GetEntity("matiere");
    $notes = $dataContext->GetEntity("note");
?>

<div class="row">
    <div class="col-lg-12 text-center mb-3">
        <?php 
            foreach ($langs as $key => $value)
                echo "<a style='padding:0 5px;' href='index.php?p=$url&lang=$key'>$key</a>";
        ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 <?php if (strcmp($lang, "English") != 0) echo "text-right"; ?>">
        <form id="frm_search_input" method="post" class="form-row">
            <div class="col-lg-12 mb-3">
                <label class="form-label"><?php echo $langs[$lang][2] ?></label>
                <select name="in_branch" class="form-control">
                    <option value="-1">Select Branch</option>
                    <?php 
                        foreach ($dataContext->GetEntity("classe")->rows as $row)
                            echo "<option value='". $row["code"] ."'>".$row["filiere"]."</option>";
                    ?>
                </select>
            </div>
            <div class="col-lg-8">
                <label class="form-label"><?php echo $langs[$lang][0] ?></label>
                <select name="in_cne" class="form-control">
                    <option value="-1">Select CNE</option>
                </select>
            </div>
            <div class="col-lg-4">
                <label class="form-label"><?php echo $langs[$lang][1] ?></label>
                <input disabled id="out_name" class="form-control">
            </div>
            <div class="col-lg-12">
                <input name="btn_search" type="submit" value="<?php echo $langs[$lang][3] ?>"/>
            </div>
        </form>
    </div>
</div>
<?php
try
{
    if (!isset($_POST["btn_search"]) || !isset($_POST["in_cne"]))
        throw new Exception("Select a student to display his bulletin!");

    // Get all marks of the targeted student
    $result = $notes->Select(Pair::Create("etudiant", $_POST["in_cne"]));
    $student = $students->Find(Pair::Create("cne", $_POST["in_cne"]));

    if (count($result) == 0)
        throw new Exception("Couldn't find any results for <b>" . $student["cne"] . " - " . $student["nom"]. "</b>!");
?>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-striped text-center">
                <thead class="thead bg-orange text-white">
                    <tr>
                        <td><?php echo $langs[$lang][4]; ?></td>
                        <td><?php echo $langs[$lang][5]; ?></td>
                        <td><?php echo $langs[$lang][6]; ?></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sum = 0;
                    $avg = 0;
                    
                    foreach($result as $row)
                    {
                        echo "<tr>";
                        echo "<td>". $subjects->Find(Pair::Create("code", $row["matiere"]))["designation"] ."</td>";
                        echo "<td>". $row["note"] ."</td>";
                        echo "<td>". (($row["note"] >= 10) ? $langs[$lang][7] : ($row["note"] < 5 ? $langs[$lang][8] : $langs[$lang][9])) ."</td>";
                        echo "</tr>";
                        
                        $sum += $row["note"];
                    }

                    // Calculate the average
                    $avg = $sum / count($result);

                    echo "<tr class='table-". ($avg < 10 ? "danger" : "success") ." font-weight-bold'>";
                    echo "<td>". $langs[$lang][10] ."</td>";
                    echo "<td>". $avg ."</td>";
                    echo "<td>". ($avg < 10 ? $langs[$lang][8] : $langs[$lang][7]) ."</td>";
                    echo "</tr>";
                    ?>
                </tbody>
            </table>
        </div>
</div>
<?php
}
catch(Exception $e)
{
    echo "<div class='alert alert-danger'>". $e->getMessage() ."</div>";
}