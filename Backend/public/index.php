<?php



use App\core\App;


require_once '../vendor/autoload.php';
require_once '../Api/Api.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();
$app = new App();
