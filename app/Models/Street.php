<?php

namespace App\Models;

use App\Libraries\MySQL;
use \DateTime;

class Street
{
    protected $id;
    public $city_id;
    public $name;
    public $created_at;
    public $updated_at;

    public function save()
    {
        $mysql = new MySQL;
        $datetime = new DateTime;

        $this->created_at = $datetime->format('Y-m-d H:i:s');
        $this->updated_at = $datetime->format('Y-m-d H:i:s');

        $mysql->insert($this, 'streets');
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

        return $mysql->select('streets');
    }

    public static function all()
    {
        $mysql = new MySQL;

        return $mysql->select('streets');
    }

    public static function getById($id)
    {
        $mysql = new MySQL;

        $attributes = $mysql->select('streets WHERE id = '.$id)[0];

        $self = new self;
        $self->fill($attributes);
        return $self;
    }

    public function update($attributes)
    {
        $mysql = new MySQL;
        $datetime = new DateTime;

        $attributes['updated_at'] = $datetime->format('Y-m-d H:i:s');

        $where = 'id = '.$this->id;

        return $mysql->update('streets', $where, $attributes);
    }

    public function delete()
    {
        $mysql = new MySQL;

        $where = 'id = '.$this->id;

        return $mysql->delete('streets', $where);
    }

    public function fill($attributes)
    {
        foreach($attributes as $key => $value)
        {
            $this->$key = $value;
        }
    }
}