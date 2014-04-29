<?php
namespace Application\Model;

class Member
{

    public $id = '';

    public $username = '';

    public $password = '';

    public $name = '';

    public $email = '';

    public $create_time = '';

    public function exchangeArray($data)
    {
        $this->id = (! empty($data['id'])) ? $data['id'] : null;
        $this->username = (! empty($data['username'])) ? $data['username'] : null;
        $this->password = (! empty($data['password'])) ? $data['password'] : null;
        $this->name = (! empty($data['name'])) ? $data['name'] : null;
        $this->email = (! empty($data['email'])) ? $data['email'] : null;
        $this->create_time = (! empty($data['create_time'])) ? $data['create_time'] : null;
    }

    public function toArray($data)
    {
        $data = array();
        (! empty($this->id)) ? $data['id'] = $this->id : null;
        (! empty($this->username)) ? $data['username'] = $this->username : null;
        (! empty($this->password)) ? $data['password'] = $this->password : null;
        (! empty($this->name)) ? $data['name'] = $this->name : null;
        (! empty($this->email)) ? $data['email'] = $this->email : null;
        (! empty($this->create_time)) ? $data['create_time'] = $this->create_time : null;
        return $data;
    }
}

