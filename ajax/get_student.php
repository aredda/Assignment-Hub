<?php

include $_SERVER["DOCUMENT_ROOT"] . "/PHPCA/libraries/config.php";
include $_SERVER["DOCUMENT_ROOT"] . "/PHPCA/libraries/mapping/c_context.php";

// Instantiate a new data context
$context = new DataContext(getConfigArray());

// Retrieve the desired table
$entity = $context->GetEntity("etudiant");

// Expected Parameters
$criteria = [];
foreach($_POST as $key => $value)
    if ($entity->HasColumn($key))
        array_push($criteria, Pair::Create($key, $value));

// Get result
echo json_encode($entity->Select($criteria));