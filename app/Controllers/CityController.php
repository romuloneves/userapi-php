<?php

namespace App\Controllers;

use App\Models\City;

class CityController
{
    public static function index($id = null)
    {
        if($id)
        {
            $city = City::getById($id);

            $response = (array) $city;
        }
        else
        {
            $cities = City::all();

            $response = ['data' => (array) $cities];
        }

        die(json_encode($response));
    }

    public static function store()
    {
        # Workaround para interpretar dados enviados via POST JSON
        $data = json_decode(file_get_contents("php://input"), true);

        $city = City::create($data);

        die(json_encode(['201 Created']));
    }

    public static function update($id)
    {
        if($id)
        {
            # Workaround para interpretar dados enviados via POST JSON
            $data = json_decode(file_get_contents("php://input"), true);

            $city = City::getById($id);
            City::update($city, $data);

            die(json_encode(['200 OK']));
        }
    }

    public static function destroy($id)
    {
        if($id)
        {
            # Workaround para interpretar dados enviados via POST JSON
            $data = json_decode(file_get_contents("php://input"), true);

            $city = City::getById($id);
            City::delete($city);

            die(json_encode(['200 OK']));
        }
    }
}