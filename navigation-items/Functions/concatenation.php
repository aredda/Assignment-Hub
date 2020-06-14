<?php

function NomComplet($nom, $prenom)
{
    return $nom . " " . $prenom;
}

// echo "<h1 class='text-orange mb-3'>Concatenation</h1>";
echo "<form method='post' class='form-group'>";
echo "<label class='form-label'>Nom</label><input class='form-control' name='nom'/></br>";
echo "<label class='form-label'>Prenom</label><input class='form-control' name='prenom'/>";
echo "<input type='submit' value='Afficher Le Nom Complet' />";
echo "</form>";

if (isset($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['prenom']))
{
    echo "<div class='form-group'>";
    echo "<label class='form-label'>Result</label><input class='form-control' value='". NomComplet($_POST['nom'], $_POST['prenom']) ."' />";
}

?>