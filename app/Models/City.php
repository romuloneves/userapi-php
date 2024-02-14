<?php

namespace App\Models;

use App\Libraries\MySQL;
use \DateTime;

class City
{
    public $state_id;
    public $name;
    public $created_at;
    public $updated_at;

    public function save()
    {
        $mysql = new MySQL;
        $datetime = new DateTime;

        $this->created_at = $datetime->format('Y-m-d H:i:s');
        $this->updated_at = $datetime->format('Y-m-d H:i:s');

        $mysql->insert($this, 'cities');
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

        return $mysql->select('cities');
    }

    public static function all()
    {
        $mysql = new MySQL;

        return $mysql->select('cities');
    }

    public static function getById($id)
    {
        $mysql = new MySQL;

        return $mysql->select('cities WHERE id = '.$id)[0];
    }

    public static function update($city, $attributes)
    {
        $mysql = new MySQL;

        $where = 'id = '.$city->id;

        return $mysql->update('cities', $where, $attributes);
    }

    public static function delete($city)
    {
        $mysql = new MySQL;

        $where = 'id = '.$city->id;

        return $mysql->delete('cities', $where);
    }

    public function fill($attributes)
    {
        foreach($attributes as $key => $value)
        {
            $this->$key = $value;
        }
    }
}