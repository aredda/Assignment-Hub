<?php

include "tools/date.php";

$pageUrl = null;

if (isset($_GET['p']))
    $pageUrl = $_GET['p'];

// Get current date
$currentDate = new Date(date("d-m-Y"));

// Prepare days of week
$weekDays = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

// Check for changes
if (isset($_GET['day']))
    $currentDate->day = $_GET['day'];

if (isset($_GET['month']))
    $currentDate->month = $_GET['month'];

if (isset($_GET['year']))
    $currentDate->year = $_GET['year'];

?>

<div class="row text-center">
    <div class="col-lg-3 py-3">
        <?php
            if ($currentDate->month != 1)
            {
                $prevMonth = $currentDate->month - 1;

                echo "<a class='text-orange' href='index.php?p=$pageUrl&month=$prevMonth'>Previous Month</a>";
            }
        ?>
    </div>
    <div class="col-lg-6 p-1">
        <h6 class="m-0 p-0">
            <?php echo $currentDate->year; ?>
        </h6>
        <h5 class="text-orange m-0 p-0">
            <?php echo date ("F", $currentDate->toTime()); ?>
        </h5>
    </div>
    <div class="col-lg-3 py-3">
        <?php
            if ($currentDate->month != 12)
            {
                $nextMonth = $currentDate->month + 1;

                echo "<a class='text-orange' href='index.php?p=$pageUrl&month=$nextMonth'>Next Month</a>";
            }
        ?>
    </div>
</div>

<?php

echo "<table class='table table-bordered calendar text-center'>";
echo "<thead class='bg-orange text-white text-center font-weight-bold'>";
foreach ($weekDays as $wday)
    echo "<td>$wday</td>";
echo "<thead>";
echo "<tbody>";
for ($i=0; $i < 6; $i++) 
{ 
    echo "<tr>";
    for ($j=1; $j <= count($weekDays); $j++) 
        echo "<td class='bg-white text-orange' id='$i-$j'></td>";
    echo "</tr>";
}
echo "<tbody>";
echo "</table>";

function renderMonth(Date $date)
{
    // Clone date
    $virtualDate = new Date($date->displayDate());

    // Retrieve the number of days in that month
    $monthDays = cal_days_in_month(CAL_GREGORIAN, $virtualDate->month, $virtualDate->year);

    $currentDay = $virtualDate->day;
    $prevWeekDay = -1;

    for ($i=1, $j=0; $i <= $monthDays; $i++) 
    { 
        // Change date's day
        $virtualDate->day = $i;   

        // Get the week day
        $weekDay = date("N", $virtualDate->toTime());

        // Move to the next row
        if ( $prevWeekDay > $weekDay )
            $j++;

        // Change the cell's text
        echo "<script>document.getElementById('$j-$weekDay').innerHTML = '$virtualDate->day';</script>";

        // Change the cell's color
        if ($i == $currentDay)
        {
            echo "<script>document.getElementById('$j-$weekDay').classList.add('bg-orange');</script>";
            echo "<script>document.getElementById('$j-$weekDay').classList.add('text-white');</script>";
        }

        $prevWeekDay = $weekDay;
    }
}

renderMonth($currentDate);

?>

<div class="row text-center">
    <?php 
        $direction = ["prev", "next"];
        $step = ["week", "day"];

        foreach ($direction as $d)
        {
            foreach ($step as $s)
            {
                echo '<div class="col-lg-3 py-1">';
                try
                {
                    $predicted = $currentDate->move($d, $s);

                    $date = "day=$predicted->day&month=$currentDate->month&year=$currentDate->year";

                    echo "<a class='text-orange' href='index.php?p=$pageUrl&$date'>". ucfirst($d) . " " . ucfirst($s) . "</a>";
                }
                catch (Exception $x) {}
                echo '</div>';
            }

            $step = array_reverse($step);
        }
    ?>
</div>

