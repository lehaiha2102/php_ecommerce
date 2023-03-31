<?php 
    require_once('../../../config/database.php');

    if(isset($_POST['filter']) && isset($_POST['category_id']) && isset($_POST['ascending_price'])){
        $category_id = $_POST['category_id'];
        $ascending_price = $_POST['ascending_price'];
        $sql = "SELECT * FROM products WHERE category_id = ? ORDER BY product_price " . ($ascending_price == 1 ? "ASC" : "DESC");
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
            
        $products_filter = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products_filter[] = $row;
            }
        }
    }
?>