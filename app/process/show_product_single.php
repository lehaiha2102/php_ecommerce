<?php 
require_once('../../process/show_category.php');
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'php_ecommerce';

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
	die('Connect error' . $connection->connect_error);
}

$sql = "SELECT * FROM products ORDER BY RAND() LIMIT 4;";
$result = $connection->query($sql);

$products_similar = array();
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$products_similar[] = $row;
	}
}

if (isset($_GET['product_id'])) {
	$product_id = $_GET['product_id'];
	$sql = 'SELECT * FROM products WHERE product_id = ?';
	$stmt = $connection->prepare($sql);
	$stmt->bind_param('i', $product_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$products_wid = array();
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$products_wid[] = $row;
		}
	}
}
?>