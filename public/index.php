<?php
require_once '../app/core/Database.php';
require_once '../app/Controllers/Products_Controller.php';

use App\Controllers\Products_Controller;
header('Content-Type: application/json');

$controller = new Products_Controller();
$controller->handleRequest();
