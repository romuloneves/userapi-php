<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public static function index($id = null)
    {
        if($id)
        {
            $user = User::getById($id);

            $response = (array) $user;
        }
        else
        {
            $users = User::all();

            $response = ['data' => (array) $users];
        }

        die(json_encode($response));
    }

    public static function store()
    {
        # Workaround para interpretar dados enviados via POST JSON
        $data = json_decode(file_get_contents("php://input"), true);

        $user = User::create($data);

        die(json_encode(['201 Created']));
    }

    public static function update($id)
    {
        if($id)
        {
            # Workaround para interpretar dados enviados via POST JSON
            $data = json_decode(file_get_contents("php://input"), true);

            $user = User::getById($id);
            $user->update($data);

            die(json_encode(['200 OK']));
        }
    }

    public static function destroy($id)
    {
        if($id)
        {
            # Workaround para interpretar dados enviados via POST JSON
            $data = json_decode(file_get_contents("php://input"), true);

            $user = User::getById($id);
            $user->delete();

            die(json_encode(['200 OK']));
        }
    }
}