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

		$user = Container::getModel('User');

		$user->__set('id', $_SESSION['id']);

		$this->view->info_user = $user->getInfoUser();
		$this->view->total_tweets = $user->getTotalTweets();
		$this->view->total_following = $user->getTotalFollowing();
		$this->view->total_followers = $user->getTotalFollowers();

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
			$user->__set('id' , $_SESSION['id']);
			$user->__set('username'  ,   $pesquisarPor);
			$users = $user->getAll();

	
		}

		$user = Container::getModel('User');

		$user->__set('id', $_SESSION['id']);

		$this->view->info_user = $user->getInfoUser();
		$this->view->total_tweets = $user->getTotalTweets();
		$this->view->total_following = $user->getTotalFollowing();
		$this->view->total_followers = $user->getTotalFollowers();

		$this->view->users = $users;

		$this->render('quemSeguir');

	}

	public function acao(){

		$this->validarLogin();


		$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
		$id_user_following= isset($_GET['id_user']) ? $_GET['id_user'] : '';


		$user = Container::getModel('User');
		$user->__set('id' , $_SESSION['id']);

		if($acao == 'seguir'){

					$user->followUser($id_user_following);

		}else if($acao == 'deixar_de_seguir'){

				$user->unfollowUser($id_user_following);
		}



		header('Location: /quem_seguir');

	}

	public function deleteTweet(){

		$this->validarLogin();


		$id_tweet_for_delete = isset($_GET['delete']) ? $_GET['delete'] : '';
		$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : '';



		$tweet = Container::getModel('Tweet');
		$tweet->__set('id', $id_tweet_for_delete);


		print_r($tweet);

		if($id_tweet_for_delete == $tweet->__get('id')){

					$tweet->deleteTweet($id_tweet_for_delete, $id_user);

		}



		header('Location: /timeline'); 

	}




}


?>