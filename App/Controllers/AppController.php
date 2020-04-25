<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

	public function timeline(){




		$this->validarLogin();

		//recuperação dos tweets

		$tweet = Container::getModel('Tweet');

		$tweet->__set('id_user' , $_SESSION['id']);

		$tweets = $tweet->getAll();

	

		$this->view->tweets = $tweets;
		$this->render('timeline');

	

		
	}

	public function tweet(){

	

		$this->validarLogin();

	
			$tweet = Container::getModel('Tweet');

			$tweet->__set('tweet' , $_POST['tweet']);
			$tweet->__set('id_user' , $_SESSION['id']);


			$tweet->saveTweet();


			header('Location: /timeline');

	} 

	public function validarLogin(){

		session_start();

			if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['username']) || $_SESSION['username'] == '') {
			header('Location: /?login=erro');
		}	
		
	}

	public function quemSeguir(){

		$this->validarLogin();
	
	
		$pesquisarPor = isset($_GET['pesquisarPor']) ? 	($_GET['pesquisarPor']) : '';

	


		$users = array();
		if($pesquisarPor != '' ){

			$user = Container::getModel('User');

			$user->__set('username'  ,   $pesquisarPor);
			$users = $user->getAll();

	
		}

		$this->view->users = $users;

		$this->render('quemSeguir');

	}



}


?>