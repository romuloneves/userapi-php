<?php

namespace App\Controllers;

use App\Models\Street;

class StreetController
{
    public static function index($id = null)
    {
        if($id)
        {
            $street = Street::getById($id);

            $response = (array) $street;
        }
        else
        {
            $streets = Street::all();

            $response = ['data' => (array) $streets];
        }

        die(json_encode($response));
    }

    public static function store()
    {
        # Workaround para interpretar dados enviados via POST JSON
        $data = json_decode(file_get_contents("php://input"), true);

        $street = Street::create($data);

        die(json_encode(['201 Created']));
    }

    public static function update($id)
    {
        if($id)
        {
            # Workaround para interpretar dados enviados via PUT JSON
            $data = json_decode(file_get_contents("php://input"), true);

            $street = Street::getById($id);
            Street::update($street, $data);

            die(json_encode(['200 OK']));
        }
    }

    public static function destroy($id)
    {
        if($id)
        {
            # Workaround para interpretar dados enviados via DELETE JSON
            $data = json_decode(file_get_contents("php://input"), true);

            $street = Street::getById($id);
            Street::delete($street);

            die(json_encode(['200 OK']));
        }
    }
}