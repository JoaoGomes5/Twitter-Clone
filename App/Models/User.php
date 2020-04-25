<?php

namespace App\Models;

use MF\Model\Model;

class User extends  Model{

	private $id;
	private $username;
	private $email;
	private $password;


    public function __get($attr){
        return $this->$attr;
    }

   public function __set($attr, $value){
        $this->$attr = $value;
   }


    //guardar o user
    public function saveUser(){

        $query = "INSERT INTO users(username, email, password)VALUE(:username, :email, :password)";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':username' , $this->__get('username'));
        $stmt->bindValue(':email' , $this->__get('email'));
        $stmt->bindValue(':password' , $this->__get('password'));//md5 ->hash de 32 caracteres
        $stmt->execute();

        return $this;

    }

	//validar se o registo pode ser feito
    public function validarRegisto( ){
    	$valido = true;

        if(strlen($this->__get('username')) < 3){
            $valido = false;

        }
        if(strlen($this->__get('email')) < 3){
            $valido = false;

        }
        if(strlen($this->__get('password')) < 3){
            $valido = false;

        }

        
        return $valido;
    }
    
    //recuperar um user por e-mail
    public function getUserFromEmail(){
        
        $query = "SELECT username, email, password from users where email= :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email' , $this->__get('email'));
        $stmt->execute();;
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }


}

?>