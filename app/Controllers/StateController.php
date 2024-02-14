<?php

namespace App\Controllers;

use App\Models\State;

class StateController
{
    public static function index($id = null)
    {
        if($id)
        {
            $state = State::getById($id);

            $response = (array) $state;
        }
        else
        {
            $states = State::all();

            $response = ['data' => (array) $states];
        }

        die(json_encode($response));
    }

    public static function store()
    {
        # Workaround para interpretar dados enviados via POST JSON
        $data = json_decode(file_get_contents("php://input"), true);

        $state = State::create($data);

        die(json_encode(['201 Created']));
    }

    public static function update($id)
    {
        if($id)
        {
            # Workaround para interpretar dados enviados via PUT JSON
            $data = json_decode(file_get_contents("php://input"), true);

            $state = State::getById($id);
            State::update($state, $data);

            die(json_encode(['200 OK']));
        }
    }

    public static function destroy($id)
    {
        if($id)
        {
            # Workaround para interpretar dados enviados via DELETE JSON
            $data = json_decode(file_get_contents("php://input"), true);

            $state = State::getById($id);
            State::delete($state);

            die(json_encode(['200 OK']));
        }
    }
}