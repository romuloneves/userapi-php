<?php

namespace App\Models;

use App\Libraries\MySQL;
use \DateTime;

class User
{
    protected $id;
    public $first_name;
    public $last_name;
    public $phone_number;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;

    /*
     * Relation variables (Variáveis de relacionamentos)
     */

    public $addresses = []; // one-to-many relationship

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

    public static function getById($id)
    {
        $mysql = new MySQL;

        $attributes = $mysql->select('users WHERE id = '.$id)[0];

        $self = new self;
        $self->fill($attributes);
        $self->addresses = $self->getAddresses();
        return $self;
    }

    public function getAddresses()
    {
        $mysql = new MySQL;

        return $mysql->select('addresses WHERE user_id = '.$this->id);
    }

    public static function all()
    {
        $mysql = new MySQL;

        return $mysql->select('users');
    }

    public function update($attributes)
    {
        $mysql = new MySQL;
        $datetime = new DateTime;

        $attributes['updated_at'] = $datetime->format('Y-m-d H:i:s');

        $where = 'id = '.$this->id;

        return $mysql->update('users', $where, $attributes);
    }

    public function delete()
    {
        $mysql = new MySQL;

        $where = 'id = '.$this->id;

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