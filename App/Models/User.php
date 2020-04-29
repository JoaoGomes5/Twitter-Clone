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

    public function autenticar(){

             $query = "SELECT id , username, email from users where email= :email and password = :password";
             $stmt = $this->db->prepare($query);
             $stmt->bindValue(':email' , $this->__get('email'));
             $stmt->bindValue(':password' , $this->__get('password'));
             $stmt->execute();        

             $user = $stmt->fetch(\PDO::FETCH_ASSOC);


            if($user['id'] != '' && $user['username'] != ''){

            $this->__set('id' , $user['id']);
            $this->__set('username' , $user['username']);
            

             }

             return $this;



    }
            //buscar a db o pesquisado
    public function getAll(){

        $query = "
        SELECT 
            u.id, u.username , u.email,
            (
                SELECT
                    count(*)
                FROM
                    user_followers as us

                WHERE
                    us.id_user = :id_user and us.id_user_following = u.id

            ) as follow_sn

         FROM 
            users as u 
        where 
            u.username  LIKE  :username and u.id != :id_user";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':username' , '%'.$this->__get('username').'%');
        $stmt->bindValue(':id_user' , $this->__get('id'));
        $stmt->execute();  


        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function followUser($id_user_following){

            $query ="INSERT INTO 
                        user_followers(id_user, id_user_following )
                    VALUES (:id_user, :id_user_following)";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id_user" , $this->__get('id'));
            $stmt->bindValue(":id_user_following" , $id_user_following);
            $stmt->execute();


            return true;

    }

    public function unfollowUser($id_user_following){

            $query ="DELETE FROM user_followers WHERE id_user = :id_user and id_user_following = :id_user_following";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id_user" , $this->__get('id'));
            $stmt->bindValue(":id_user_following" , $id_user_following);
            $stmt->execute();


            return true;

    }
        //INFORMACOES DO USER
    public function getInfoUser(){

        $query = "SELECT username FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id' , $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

        //TWEETS
      public function getTotalTweets(){

        $query = "SELECT count(*) as  total_tweet FROM tweets WHERE id_user = :id_user";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_user' , $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

        //seguindo
    public function getTotalFollowing(){

        $query = "SELECT count(*) as  total_following FROM user_followers WHERE id_user = :id_user";
        
        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_user' , $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }


        //SEGUIDORES
    public function getTotalFollowers(){

        $query = "SELECT count(*) as  total_followers FROM user_followers WHERE id_user_following = :id_user";
        
        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_user' , $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

}

?>