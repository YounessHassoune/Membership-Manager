<?php

namespace App\http;



class Request
{

    public static function RequestInfo()
    {
        return (object) [
            'path' => $_GET['url'] ?? null,
            'method' =>  $_SERVER['REQUEST_METHOD'] ?? null,
            'contentType' => $_SERVER["CONTENT_TYPE"] ?? null,
            'authorization' => $_SERVER['HTTP_AUTHORIZATION'] ?? null
        ];
    }
    public static function getJson()
    {
        if ($_SERVER['REQUEST_METHOD'] !== "POST" || $_SERVER["CONTENT_TYPE"] !== "application/json") {
            return null;
        }
        $data =   json_decode(file_get_contents("php://input"));
        return json_last_error() === JSON_ERROR_NONE ? $data : [];
    }

    public static function getJsonFormData($body)
    {
        $data = json_decode($body);
        return json_last_error() === JSON_ERROR_NONE ? $data : [];
    }

    public static function getFormData()
    {
        if ($_SERVER['REQUEST_METHOD'] !== "POST") {
            return null;
        }
        $request = self::getJsonFormData($_POST['request'] ?? '');
        return (object)[
            "image" => $_FILES,
            "request" => $request
        ];
    }
    public static function uplaodImages($imagefile)
    {
        $valid_extensions = array('jpeg', 'jpg');

        if ($imagefile == []) {
            return null;
        }
        $fileName  =  $imagefile['name'];
        $tempPath  = $imagefile['tmp_name'];
        $fileSize  =  $imagefile['size'];
        $path = dirname(__DIR__) . "/public/storage/images/";
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $name = md5(time() . mt_rand(1, 1000000));
        if (in_array($fileExt, $valid_extensions)) {
            if ($fileSize < 5000000) {
                if (move_uploaded_file($tempPath, $path . $name . '.' . $fileExt)) {
                } else {
                    return array("message" => "Sorry, cant move the file", "status" => false);
                }
            } else {
                return array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false);
            }
        } else {
            return array("message" => "Sorry, only JPG, JPEG files are allowed", "status" => false);
        }
        return  $name;
    }

    public static function isArrayMatching($requestarray, $definearray): bool
    {
        return array_diff($requestarray, $definearray) == array_diff($definearray, $requestarray);
    }
    public static function ValueValidate($request)
    {

        $sanitizedValues = [];
        foreach ($request as $key => $value) {
            if (trim($value) !== "") {
                $sanitizedValues[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            } else {
                return false;
            }
        }
        return $sanitizedValues;
    }
    public static function validate($request, $fields): bool
    {
        $convertedJson = (array)$request;
        return self::isArrayMatching(array_keys($convertedJson), $fields);
    }
}
