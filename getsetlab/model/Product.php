<?php

class Product{

	private $id;
    private $name;
    private $price;
    private $description;
    private $picture;

    private $rosters; //listas en la que esta el producto

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @return mixed
     */
    public function getLists()
    {
        return $this->lists;
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
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @param mixed $lists
     */
    public function setLists($lists)
    {
        $this->lists = $lists;
    }

    function insertProduct(){

        $insert = $this->con->prepare("INSERT INTO PRODUCTS(name,price,description,picture) VALUES(:name,:price,:description,:picture)");

        $insert->execute(array(
            "name" => $this->name,
            "price" => $this->price,
            "description" => $this->description,
            "picture" => $this->picture
        ));

        $this->con = null;
    }

    function getAllProducts(){

    	$select = $this->con->prepare("SELECT * FROM PRODUCTS");
        $select->execute();
        $resul = $select->fetchAll(PDO::FETCH_ASSOC);

        $this->con = null;
        
        if (count($resul) != 0) {
            return $resul;
        }
        else {
            return false;
        }
    }

    function getProductById(){

        $select = $this->con->prepare("SELECT * FROM PRODUCTS WHERE id=:id");      
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

    function getProductsByRosterId($idRoster){

        $select = $this->con->prepare("SELECT p.*, rp.lot as lot FROM PRODUCTS p, ROSTERS r, ROSTERSPRODUCTS rp WHERE p.id=rp.fkProduct AND rp.fkRoster=:idRoster");      
        $select->execute(array(
            "idRoster" => $idRoster
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