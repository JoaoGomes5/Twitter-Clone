<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
		
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('index');
	}

	public function inscreverse() {

		$this->view->user = array(
				'username' => '',
				'email' => '',
				'password' => '',
			);

		$this->view->erroRegisto = false;

		$this->render('inscreverse');
	}

	public function registar() {

		$user = Container::getModel('User');

		$user->__set('username', $_POST['username']);
		$user->__set('email', $_POST['email']);
		$user->__set('password', $_POST['password']);

		
		if($user->validarRegisto() && count($user->getUserFromEmail()) == 0) {
		
				$user->saveUser();

				$this->render('registo');

		} else {

			$this->view->user = array(
				'username' => $_POST['username'],
				'email' => $_POST['email'],
				'password' => $_POST['password'],
			);

			$this->view->erroRegisto = true;

			$this->render('inscreverse');
		}

	}

}


?>