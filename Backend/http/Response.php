<?php

namespace App\http;

class Response
{
    public static function json($body)
    {
        header('Content-Type: application/json');
        exit(json_encode($body));
    }
    
}
