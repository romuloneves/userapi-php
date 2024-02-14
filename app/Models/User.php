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


    /**
     * Método save(): Armazena valores inicializados neste objeto ao banco da classe.
     */

    public function save()
    {
        $mysql = new MySQL;
        $datetime = new DateTime;

        $this->created_at = $datetime->format('Y-m-d H:i:s');
        $this->updated_at = $datetime->format('Y-m-d H:i:s');

        $mysql->insert($this, 'users');
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

        return $mysql->select('users');
    }


    /**
     * Método getById(): Retorna objeto específico de acordo com o $id especificado.
     *
     * @return object<mixed>
     */

    public static function getById($id)
    {
        $mysql = new MySQL;

        $attributes = $mysql->select('users WHERE id = '.$id)[0];

        $self = new self;
        $self->fill($attributes);
        $self->addresses = $self->getAddresses();
        return $self;
    }


    /**
     * Método getAddresses(): Retorna o endereço relacionado de acordo com a chave $user_id e seu relacionamento.
     *
     * @return object<mixed>
     */

    public function getAddresses()
    {
        $mysql = new MySQL;

        return $mysql->select('addresses WHERE user_id = '.$this->id);
    }


    /**
     * Método all(): Retorna um objeto com todos os registros cadastrados.
     *
     * @return object<mixed>
     */

    public static function all()
    {
        $mysql = new MySQL;

        return $mysql->select('users');
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

        return $mysql->update('users', $where, $attributes);
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

        return $mysql->delete('users', $where);
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