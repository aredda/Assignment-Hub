<?php 

include 'layout.php';

$included_page = null;
if (isset($_GET['p']))
    $included_page = base64_decode($_GET['p']);

$layout_instance = new Layout($included_page);
$layout_instance->generate();