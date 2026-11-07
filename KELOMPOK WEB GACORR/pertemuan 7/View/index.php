<?php

require_once __DIR__ . '/../Controller/GacorContrroller.php';

$controller = new GacorController();
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->process();
    exit;
}

switch ($action) {
    case 'show':
        $controller->show($id);
        break;
    case 'process':
        $controller->process();
        break;
    case 'index':
    default:
        $controller->index();
        break;
}
