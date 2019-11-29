<?php

class UserController {
	
	private $connect;
    private $connection;
	
	public function __construct(){
		require_once __DIR__ . '\..\model\Connection.php';
		require_once __DIR__ . '\..\model\User.php';
        $this->connect = new Connection();
        $this->connection = $this->connect->connect();
    }

	public function registerUser(){

		if (!empty($_POST['username']) and !empty($_POST['password']) and !empty($_POST['name'])) {

        	$user = new User($this->connection);
			$user->setUsername($_POST['username']);
			$hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 15]);
			$user->setPassword($hash);
			$user->setName($_POST['name']);

			$user->registerUser();
    	}	
	}

	public function loginUser(){
		if (!empty($_POST['username']) and !empty($_POST['password'])) {

			$user = new User($this->connection);
			$user->setUsername($_POST['username']);
			$user->setPassword($_POST['password']);

			$datos = $user->loginUser();

			if(password_verify($user->getPassword(), $datos[0]['password'])){
				
				session_regenerate_id(true);
				$_SESSION['idUser'] = $datos[0]['id'];
				$_SESSION['login'] = true;
			}
			else{

				$_SESSION['idUser'] = "";
				$_SESSION['login'] = false;
			}
		}
		else {

			$_SESSION['idUser'] = "";
			$_SESSION['login'] = false;
		}
		echo(json_encode(array("login" => $_SESSION['login'])));
	}

	public function logout(){

		$_SESSION['idUser'] = "";
		$_SESSION['login'] = false;
		session_destroy();
	}
}

?>