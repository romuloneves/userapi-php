<?php

namespace App\Models;

use App\Libraries\MySQL;
use \DateTime;


/**
 * Classe Address (Endereço): Armazena endereços de usuários.
 */

class Address
{
    protected $id;
    public $name;
    public $user_id;
    public $state_id;
    public $city_id;
    public $street_id;
    public $created_at;
    public $updated_at;

    /*
     * Relation variables (Variáveis de relacionamentos)
     */

    public $user; 
    public $state; 
    public $city; 
    public $street; 


    /**
     * Método save(): Armazena valores inicializados neste objeto ao banco da classe.
     */

    public function save()
    {
        $mysql = new MySQL;
        $datetime = new DateTime;

        $this->created_at = $datetime->format('Y-m-d H:i:s');
        $this->updated_at = $datetime->format('Y-m-d H:i:s');

        return $mysql->insert($this, 'addresses');
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

        return $mysql->select('addresses');
    }


    /**
     * Método getById(): Retorna objeto específico de acordo com o $id especificado.
     *
     * @return object<mixed>
     */

    public static function getById($id)
    {
        $mysql = new MySQL;

        $attributes = $mysql->select('addresses WHERE id = '.$id)[0];

        $self = new self;
        $self->fill($attributes);

        $self->user = $self->getUser();
        $self->state = $self->getState();
        $self->city = $self->getCity();
        $self->street = $self->getStreet();

        return $self;
    }


    /**
     * Método getUser(): Retorna o usuário relacionado de acordo com a chave $user_id e seu relacionamento.
     *
     * @return object<mixed>
     */

    public function getUser()
    {
        $mysql = new MySQL;

        return $mysql->select('users WHERE id = '.$this->user_id);
    }


    /**
     * Método getState(): Retorna o estado relacionado de acordo com a chave $state_id e seu relacionamento.
     *
     * @return object<mixed>
     */

    public function getState()
    {
        $mysql = new MySQL;

        return $mysql->select('states WHERE id = '.$this->state_id);
    }


    /**
     * Método getCity(): Retorna a cidade relacionada de acordo com a chave $city_id e seu relacionamento.
     *
     * @return object<mixed>
     */

    public function getCity()
    {
        $mysql = new MySQL;

        return $mysql->select('cities WHERE id = '.$this->city_id);
    }


    /**
     * Método getStreet(): Retorna a rua com bairro relacionada de acordo com a chave $street_id e seu relacionamento.
     *
     * @return object<mixed>
     */

    public function getStreet()
    {
        $mysql = new MySQL;

        return $mysql->select('streets WHERE id = '.$this->street_id);
    }


    /**
     * Método all(): Retorna um objeto com todos os registros cadastrados.
     *
     * @return object<mixed>
     */

    public static function all()
    {
        $mysql = new MySQL;

        return $mysql->select('addresses');
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

        return $mysql->update('addresses', $where, $attributes);
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

        return $mysql->delete('addresses', $where);
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