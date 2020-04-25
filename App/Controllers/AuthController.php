<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {


	public function autenticar(){

 
		$user = Container::getModel('user');
		$user->__set('email' , $_POST['email']);
		$user->__set('password' , md5($_POST['password']));
	
	

		$user->autenticar();


		if($user->__get('id') != '' && $user->__get('username')){
			
			session_start();
			$_SESSION['id'] = $user->__get('id');
			$_SESSION['username'] = $user->__get('username');


			header('Location: /timeline');




		}else{

			header('Location: /?login=erro');
		}



	}

	public function sair(){

		session_start();

		session_destroy();

		header('Location: /');


	}




}