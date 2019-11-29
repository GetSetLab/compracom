<?php

class ProductController {
	
	private $connect;
    private $connection;
	
	public function __construct(){
		require_once __DIR__ . '\..\model\Connection.php';
		require_once __DIR__ . '\..\model\Product.php';
		require_once __DIR__ . '\..\model\Roster.php';
        $this->connect = new Connection();
        $this->connection = $this->connect->connect();
    }

	public function getAllProducts(){
		$product = new Product($this->connection);
		$products = $product->getAllProducts();
		return $products;
	}

	public function getProductById($idProduct){
		$product = new Product($this->connection);
		$product->setId($idProduct);
		$product = $product->getProductById();
		return $product;
	}

	public function getProductsByRosterId($idRoster){
		$product = new Product($this->connection);
		$roster = new Roster($this->connection);
		$roster->setId($idRoster);
		$product = $product->getProductsByRosterId($roster->getId());
		return $product;
	}
}

?>