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

$keys = ["nom", "adresse"];
$data = [];

// Retrieve the data to insert
foreach ($keys as $key)
    if (isset($_POST[$key]))
        array_push($data, Pair::Create($key, $_POST[$key]));

// If all info is provided, insert
if (count($keys) == count($data))
{
    // Insert
    $container->context->RunQuery($container->context->GetEntity("client")->Insert($data));
    $container->refresh();
}

// If the target to delete is provided, just delete
if (isset($_GET['toDelete']))
{
    $container->context->RunQuery($container->context->GetEntity("client")->Delete(
        Pair::Create("id", $_GET['toDelete'])
    ));
    $container->refresh();
}

?>

<h3 class="text-orange mb-4">List of Clients</h3>
<table class="table bg-white table-bordered">
    <thead class="bg-orange text-white">
        <td>Id</td>
        <td>Nom</td>
        <td>Adresse</td>
        <td></td>
    </thead>
    <tbody>
        <?php
        foreach ($container->clients as $client)
        {
            echo "<tr>";
            echo "<td>" . $client->id . "</td>";
            echo "<td>" . $client->nom . "</td>";
            echo "<td>" . $client->adresse . "</td>"; 
            echo "<td><a href='index.php?p=".$_GET['p']."&toDelete=" . $client->id . "'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<h3 class="text-orange mb-4">Add a new Client</h3>
<form method='post' class="form-group">
    <label class="form-label">Client Name</label>
    <input class="form-control" placeholder="Enter the name" name='nom' /><br>
    <label class="form-label">Client Address</label>
    <input class="form-control" placeholder="Enter the address" name='adresse' />
    <input type='submit' value='Add Client' />
</form>