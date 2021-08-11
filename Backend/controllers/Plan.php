<?php

namespace App\controllers;

use App\http\Auth;
use App\models\PlanModel;
use DateTime;

class Plan
{
    public static function create($request,  $response)
    {

        if (Auth::gettoken()) {
            try {
                $id = Auth::verification(Auth::gettoken());
                $fields = $request->getJson();
                if ($request->validate($fields, ["title", "description", "duration", "price", "balance"])) {
                    $sanitized = $request->ValueValidate($fields);
                    if ($sanitized) {
                        $fields->buiss_id = $id->id;
                        $created = PlanModel::create($fields);
                        $response->json($created);
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
            } catch (\Throwable $th) {
                $response->json("unauthorizedtoken");
            }
        } else {
            $response->json("unauthorized");
        }
    }
    public static function reserve($request, $response)
    {
        if (Auth::gettoken()) {
            try {
                $id = Auth::verification(Auth::gettoken());
                $fields = $request->getJson();
                if ($request->validate($fields, ["plan_id", "balance"])) {
                    $sanitized = $request->ValueValidate($fields);
                    if ($sanitized) {
                        $fields->user_id = $id->id;
                        $created = PlanModel::reserve($fields);
                        $response->json($created);
                    } else {
                        $response->json(array(
                            "error" => "can't create this reservation"
                        ));
                    }
                } else {
                    $response->json(array(
                        "error" => "can't create this reservation"
                    ));
                }
            } catch (\Throwable $th) {
                $response->json("unauthorizedtoken");
            }
        } else {
            $response->json("unauthorized");
        }
    }
    public static function stats($request, $response)
    {

        if (Auth::gettoken()) {
            try {
                $id = Auth::verification(Auth::gettoken());
                $row = PlanModel::stats($id->id);
                $response->json($row);
            } catch (\Throwable $th) {
                $response->json("unauthorizedtoken");
            }
        } else {
            $response->json("unauthorized");
        }
    }
}
