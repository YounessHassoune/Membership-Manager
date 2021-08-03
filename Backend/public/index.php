<?php

use App\core\App;
use App\Api;
use App\core\Core;
use App\core\Database;
use App\route\Route;

require_once '../vendor/autoload.php';
require_once '../Api/Api.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();
$app = new App();
