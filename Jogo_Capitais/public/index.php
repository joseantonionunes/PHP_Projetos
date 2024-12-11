<?php

// create session
session_start();

// get route
$route = $_GET['route'] ?? 'start';

// execute routes
$script = null;
switch ($route) {
    case 'start':
        $script = 'start';
        break;
    case 'game':
        $script = 'game';
        break;
    case 'gameover':
        $script = 'gameover';
        break;
    default:
        $script = '404';
        break;
}

// load data
$capitals = require __DIR__ . '/../data/capitals.php';

// load scripts/views
require_once __DIR__ . "/../scripts/header.php";
require_once __DIR__ . "/../scripts/$script.php";
require_once __DIR__ . "/../scripts/footer.php";