<?php

class User{

	private $id;
    private $username;
    private $password;
    private $name;

    private $rosters; //listas en la que esta el usuario

    public function __construct($connection){
        $this->con = $connection;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getRosters()
    {
        return $this->rosters;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $rosters
     */
    public function setRosters($rosters)
    {
        $this->rosters = $rosters;
    }

    function registerUser(){

        $insert = $this->con->prepare("INSERT INTO USERS(username,password,name) VALUES(:username,:password,:name)");

        $insert->execute(array(
            "username" => $this->username,
            "password" => $this->password,
            "name" => $this->name
        ));

        $this->con = null;
    }

    function loginUser(){
        
    	$select = $this->con->prepare("SELECT id, password FROM USERS WHERE username = :username");
        $select->execute(array(
            "username" => $this->username
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