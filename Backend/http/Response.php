<?php

namespace App\http;

class Response
{
    public static function json($body)
    {
        exit(json_encode($body));
    }
}
