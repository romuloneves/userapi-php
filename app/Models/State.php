<?php

namespace App\Models;

use App\Libraries\MySQL;
use \DateTime;


/**
 * Classe State (Estado): Armazena nomes dos estados brasileiros e suas unidades federativas.
 */

class State
{
    protected $id;
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


    /**
     * Método create(): Armazena valores do parâmetro de objetos $attributes ao banco da classe.
     *
     * @return object<mixed>
     */

    public static function create($attributes)
    {
        $self = new self;
        $self->fill($attributes);
        return $self->save();
    }


    /**
     * Método get(): Retorna collection de objetos da classe.
     *
     * @return object<mixed>
     */

    public function get()
    {
        $mysql = new MySQL;

        return $mysql->select('states');
    }


    /**
     * Método all(): Retorna um objeto com todos os registros cadastrados.
     *
     * @return object<mixed>
     */

    public static function all()
    {
        $mysql = new MySQL;

        return $mysql->select('states');
    }


    /**
     * Método getById(): Retorna objeto específico de acordo com o $id especificado.
     *
     * @return object<mixed>
     */

    public static function getById($id)
    {
        $mysql = new MySQL;

        $attributes = $mysql->select('states WHERE id = '.$id)[0];

        $self = new self;
        $self->fill($attributes);
        return $self;
    }


    /**
     * Método update(): Atualiza valores armazenados a partir do parâmetro de objetos $attributes.
     *
     * @return object<mixed>
     */

    public function update($attributes)
    {
        $mysql = new MySQL;
        $datetime = new DateTime;

        $attributes['updated_at'] = $datetime->format('Y-m-d H:i:s');

        $where = 'id = '.$this->id;

        return $mysql->update('states', $where, $attributes);
    }


    /**
     * Método delete(): Remove registros armazenados de acordo com os valores inicializados neste objeto.
     *
     * @return object<mixed>
     */

    public function delete()
    {
        $mysql = new MySQL;

        $where = 'id = '.$this->id;

        return $mysql->delete('states', $where);
    }


    /**
     * Método fill(): Preenche este objeto utilizando valores no argumento $attributes.
     */

    public function fill($attributes)
    {
        foreach($attributes as $key => $value)
        {
            $this->$key = $value;
        }
    }
}