

<?php
session_start();
$_SESSION['login'] = false;

require_once __DIR__ . '\controller\UserController.php';
require_once __DIR__ . '\controller\RosterController.php';
//require_once __DIR__ . '\controller\ProductController.php';

//$path = __DIR__ . '\a.jpg';
//$type = pathinfo($path, PATHINFO_EXTENSION);
//$data = file_get_contents($path);
//$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

//echo($base64);
if (isset($_POST["username"])) {
	$user = new UserController();
	$user->loginUser();
}


//$resul = $class->getAllCol();

//echo json_encode($resul);

//$class = new ProductController();
//$resul = $class->getAllProducts();
//$resul = $class->getProductById(1);
//$resul = $class->getProductsByRosterId(1);

//echo json_encode($resul);
?>

