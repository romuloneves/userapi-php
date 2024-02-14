<?php

namespace App\Controllers;

use App\Models\Address;

class AddressController
{
    public static function index($id = null)
    {
        if($id)
        {
            $address = Address::getById($id);

            $response = (array) $address;
        }
        else
        {
            $addresses = Address::all();

            $response = ['data' => (array) $addresses];
        }

        die(json_encode($response));
    }

    public static function store()
    {
        # Workaround para interpretar dados enviados via POST JSON
        $data = json_decode(file_get_contents("php://input"), true);

        $address = Address::create($data);

        die(json_encode(['201 Created']));
    }

    public static function update($id)
    {
        if($id)
        {
            # Workaround para interpretar dados enviados via POST JSON
            $data = json_decode(file_get_contents("php://input"), true);

            $address = Address::getById($id);
            Address::update($address, $data);

            die(json_encode(['200 OK']));
        }
    }

    public static function destroy($id)
    {
        if($id)
        {
            # Workaround para interpretar dados enviados via POST JSON
            $data = json_decode(file_get_contents("php://input"), true);

            $address = Address::getById($id);
            Address::delete($address);

            die(json_encode(['200 OK']));
        }
    }
}