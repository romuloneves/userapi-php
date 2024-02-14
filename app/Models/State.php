<?php

namespace App\Models;

use App\Libraries\MySQL;
use \DateTime;

class State
{
    public $name;
    public $uf;
    public $created_at;
    public $updated_at;

    public function save()
    {
        $mysql = new MySQL;
        $datetime = new DateTime;

        $this->created_at = $datetime->format('Y-m-d H:i:s');
        $this->updated_at = $datetime->format('Y-m-d H:i:s');

        $mysql->insert($this, 'states');
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

        return $mysql->select('states');
    }

    public static function all()
    {
        $mysql = new MySQL;

        return $mysql->select('states');
    }

    public static function getById($id)
    {
        $mysql = new MySQL;

        return $mysql->select('states WHERE id = '.$id)[0];
    }

    public static function update($state, $attributes)
    {
        $mysql = new MySQL;

        $where = 'id = '.$state->id;

        return $mysql->update('states', $where, $attributes);
    }

    public static function delete($state)
    {
        $mysql = new MySQL;

        $where = 'id = '.$state->id;

        return $mysql->delete('states', $where);
    }

    public function fill($attributes)
    {
        foreach($attributes as $key => $value)
        {
            $this->$key = $value;
        }
    }
}