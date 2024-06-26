<?php

namespace App\controllers;

use App\http\Auth;

use App\models\CompanyModel;

class Company
{
    public static function register($request, $response)
    {
        $data = $request->getFormData();
        if ($data->image) {
            $imagename = $request->uplaodImages($data->image['image']);
            $fields = $data->request;
            if ($request->validate($fields, ["name", "about", "address", "city", "phone", "email", "password"])) {
                $sanitized = $request->ValueValidate($fields);
                if ($sanitized) {
                    if (!is_array($imagename)) {
                        $fields = $data->request;
                        $id = CompanyModel::register($fields, $imagename);
                        if ($id) {
                            $user = (object)["id" => $id, "company_name" => $fields->name, "about" => $fields->about, "address" => $fields->address, "city" => $fields->city, "phone" => $fields->phone, "email" => $fields->email, "password" => $fields->password, "image" => $imagename];
                            $token = Auth::authorization($user->id);
                            $response->json(array(
                                "token" => $token,
                                "user" => $user
                            ));
                        } else {
                            $response->json(array(
                                "error" => "can't create this account"
                            ));
                        }
                    } else {
                        $response->json($imagename);
                    }
                } else {
                    $response->json(array(
                        "error" => "can't create this account"
                    ));
                }
            } else {
                $response->json(array(
                    "error" => "can't create this account"
                ));
            }
        } else {
            $response->json(array(
                "error" => "can't create this account"
            ));
        }
    }
    //===========company login=====================
    public static function login($request, $response)
    {
        $fields = $request->getJson();
        $row = CompanyModel::login($fields);
        if ($row) {
            $token = Auth::authorization($row->company_id);
            $response->json(array(
                "token" => $token,
                "user" => $row,
            ));
        } else {
            $response->json(array(
                "user" => $row
            ));
        }
    }
    //=========company profile info ======================
    public static function info($request, $response)
    {
        if (Auth::gettoken()) {
            try {
                $id = Auth::verification(Auth::gettoken());
                $user = CompanyModel::info($id->id);
                if ($user) {
                    $response->json(
                        $user
                    );
                } else {
                    $response->json(array(
                        "error" => "can't get user information"
                    ));
                }
            } catch (\Throwable $th) {
                $response->json("unauthorizedtoken");
            }
        } else {
            $response->json("unauthorized");
        }
    }
}
