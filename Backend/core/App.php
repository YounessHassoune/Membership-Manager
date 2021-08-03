<?php

namespace App\core;

use App\http\Request;
use App\route\Route;

class App
{
    public function __construct()
    {
        (new Route(Request::RequestInfo()))->resolver();
        $this->cors();
    }

    public function cors()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    }
}
