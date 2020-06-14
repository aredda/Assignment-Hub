<?php

include "././libraries/config.php";
include "././libraries/mapping/c_context.php";
include "models/product.php";
include "models/client.php";
include "models/facture.php";
include "models/container.php";

$configArray = getConfigArray();
$configArray["data"] = "factures";

$container = new Container($configArray);

$keys = ["nom", "prix", "quantite"];
$data = [];

// Retrieve the data to insert
foreach ($keys as $key)
    if (isset($_POST[$key]))
        array_push($data, Pair::Create($key, $_POST[$key]));

// If all info is provided, insert
if (count($keys) == count($data))
{
    // Insert
    $container->context->RunQuery($container->context->GetEntity("produit")->Insert($data));
    $container->refresh();
}

// If the target to delete is provided, just delete
if (isset($_GET['toDelete']))
{
    $container->context->RunQuery($container->context->GetEntity("produit")->Delete(
        Pair::Create("id", $_GET['toDelete'])
    ));
    $container->refresh();
}

?>

<h3 class="text-orange mb-4">List of products</h3>
<table class="table bg-white table-bordered">
    <thead class="bg-orange text-white">
        <td>Id</td>
        <td>Nom</td>
        <td>Prix</td>
        <td>Quantite</td>
        <td></td>
    </thead>
    <tbody>
        <?php
        foreach ($container->produits as $produit)
        {
            echo "<tr>";
            echo "<td>" . $produit->id . "</td>";
            echo "<td>" . $produit->nom . "</td>";
            echo "<td>" . $produit->prix . "</td>";
            echo "<td>" . $produit->quantite . "</td>"; 
            echo "<td><a href='index.php?p=".$_GET['p']."&toDelete=".$produit->id."'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<h3 class="text-orange mb-4">Add a new Product</h3>
<form method='post' class="form-group">
    <label class="form-label">Product Name</label>
    <input class="form-control" placeholder="Enter the name" name='nom' /><br>
    <label class="form-label">Product Price</label>
    <input class="form-control" type="number" placeholder="Enter the price" name='prix' /><br>
    <label class="form-label">Product Quantity in Stock</label>
    <input class="form-control" type="number" placeholder="Enter the quantity" name='quantite' />
    <input type='submit' value='Add Product' />
</form>