<?php

namespace App\Models;

use MF\Model\Model;

class Tweet extends  Model{

		private $id;
		private $id_user;
		private $tweet;
		private $date;


		 public function __get($attr){
            return $this->$attr;
    	 }

		 public function __set($attr, $value){
		    $this->$attr = $value;
		 }


		 //guardar tweet
		 public function saveTweet(){

		 	$query="INSERT INTO tweets(id_user, tweet)VALUES(:id_user , :tweet)";
		 	$stmt = $this->db->prepare($query);
		 	$stmt->bindValue(':id_user' , $this->__get('id_user'));
		 	$stmt->bindValue(':tweet' , $this->__get('tweet'));

		 	$stmt->execute();


		 	return $this;



		 }



		 //mostar tweet
		 public function getAll(){

		 	$query="

		 	SELECT 
		 		t.id, 
		 		t.id_user, 
		 		u.username , 
		 		t.tweet, 
		 		DATE_FORMAT(t.date, '%d/%m/%Y %H:%i') as date
		 	FROM 
		 		tweets as t
		 		LEFT JOIN users = u on(t.id_user = u.id)
		 	WHERE 
		 		t.id_user = :id_user
		 		or t.id_user in (SELECT id_user_following FROM user_followers WHERE id_user  = :id_user)
		 	ORDER BY
		 		t.date desc
		 	
		 	";
		 	$stmt = $this->db->prepare($query);
		 	$stmt->bindValue(':id_user' , $this->__get('id_user'));
		 	$stmt->execute();


		 	return $stmt->fetchAll(\PDO::FETCH_ASSOC);


		 }

		 public function deleteTweet($id_tweet_for_delete, $id_user){

		 $query ="DELETE FROM tweets WHERE  id = :id and id_user = :id_user ";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id" , $id_tweet_for_delete);
            $stmt->bindValue(":id_user" , $id_user);
            $stmt->execute();


            return true;

		 }



}