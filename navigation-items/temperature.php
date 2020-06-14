<?php

echo "<title>Temperature</title>";

$city = "Tanger";
$temperature = 23;
$colors = array("rgb(176, 0, 0)", 
	"rgb(176, 27, 0)", 
	"rgb(176, 76, 0)", 
	"rgb(238, 158, 0)", 
	"rgb(238, 228, 0)", 
	"rgb(178, 228, 0)", 
	"rgb(50, 255, 0)", 
	"rgb(0, 234, 182)", 
	"rgb(0, 70, 234)", 
	"rgb(18, 0, 234)", 
	"rgb(77, 2, 232)", 
	"rgb(134, 3, 231)");
$degrees = array(33, 28, 22, 17, 11, 5, 0, -6, -11, -17, -22, -50);

echo "<table width='100%' border=1 cellspacing=0 cellpadding=5 bordercolor=black>";
echo "<thead>";
echo "<tr>";
echo "<td>Couleur</td>";
echo "<td>Temperature</td>";
echo "<td>Ville</td>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
for ($i=0; $i < count($colors); $i++) 
{
	$x = $degrees[$i];
	$y = ($i == 0 ? 51 : $degrees[$i-1]) - 1;
	echo "<tr>";
	echo "<td style='background: ". $colors[$i] ."'></td>";
	echo "<td>Entre $y et $x</td>";
	
	if ($temperature > $x && $temperature < $y) 
		echo "<td style='color: ". $colors[$i] ."'>$city</td>";
	else 
		echo "<td></td>";
	
	echo "</tr>";
}
echo "</tbody>";
echo "</table>";

?>