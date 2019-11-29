<?php

class RosterController {
	
	private $connect;
    private $connection;
	
	public function __construct(){
		require_once __DIR__ . '\..\model\Connection.php';
		require_once __DIR__ . '\..\model\Roster.php';
        $this->connect = new Connection();
        $this->connection = $this->connect->connect();
    }

    public function getRostersByUserId(){

		$roster = new Roster($this->connection);
		$rosters = $roster->getRostersByUserId($_SESSION['idUser']);

		return $rosters;
	}

	public function getRosterById(){

		$roster = new Roster($this->connection);
		$roster->setId($_POST['idRoster']);

		return $roster->getRosterById();
	}

}

?>