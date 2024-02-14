<?php

namespace App\Models;

use App\Libraries\MySQL;
use \DateTime;

class User
{
    public $first_name;
    public $last_name;
    public $phone_number;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;

    public function save()
    {
        $mysql = new MySQL;
        $datetime = new DateTime;

        $this->created_at = $datetime->format('Y-m-d H:i:s');
        $this->updated_at = $datetime->format('Y-m-d H:i:s');

        $mysql->insert($this, 'users');
    }

    public static function create($attributes)
    {
        $self = new self;
        $self->fill($attributes);
        return $self->save();
    }

    public function get()
    {
        $mysql = new MySQL;

        return $mysql->select('users');
    }

    public static function all()
    {
        $mysql = new MySQL;

        return $mysql->select('users');
    }

    public static function getById($id)
    {
        $mysql = new MySQL;

        return $mysql->select('users WHERE id = '.$id)[0];
    }

    public static function update($user, $attributes)
    {
        $mysql = new MySQL;

        $where = 'id = '.$user->id;

        return $mysql->update('users', $where, $attributes);
    }

    public static function delete($user)
    {
        $mysql = new MySQL;

        $where = 'id = '.$user->id;

        return $mysql->delete('users', $where);
    }

    public function fill($attributes)
    {
        foreach($attributes as $key => $value)
        {
            $this->$key = $value;
        }
    }
}