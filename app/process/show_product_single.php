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

	$sql_similar = "SELECT * FROM products WHERE product_id != $product_id ORDER BY RAND() LIMIT 4;";
	$result_similar = $connection->query($sql_similar);

$products_similar = array();
if ($result_similar->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$products_similar[] = $row;
	}
}
}
?>