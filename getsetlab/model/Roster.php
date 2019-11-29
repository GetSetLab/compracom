<?php

class Roster{

	private $id;
	private $name;
	private $day;
	private $password;

	private $products; //Lista de productos dentro de la lista

	public function __construct($connection){
        $this->con = $connection;
    }

	/**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    function getRostersByUserId($idUser){

        $select = $this->con->prepare("SELECT r.* FROM ROSTERS r, USERSROSTERS ur, USERS u WHERE r.id = ur.fkRoster AND u.id = ur.fkUser AND u.id = :idUser");
        $select->execute(array(
            "idUser" => $idUser
        ));
        $resul = $select->fetchAll(PDO::FETCH_ASSOC);

        $this->con = null;
        
        if (count($resul) != 0) {
            return $resul;
        }
        else {
            return false;
        }
    }

    function getRosterById(){

        $select = $this->con->prepare("SELECT * FROM ROSTERS WHERE id = :id");
        $select->execute(array(
            "id" => $this->id
        ));
        $resul = $select->fetchAll(PDO::FETCH_ASSOC);

        $this->con = null;
        
        if (count($resul) != 0) {
            return $resul;
        }
        else {
            return false;
        }
    }

}

?>