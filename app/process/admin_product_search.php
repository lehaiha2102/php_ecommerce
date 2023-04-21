<?php
require_once('../../config/database.php');

    $keyword = $_POST['keyword'];
    $sql_search = "SELECT `products`.`product_name`,
                        `products`.`product_image_1`, 
                        `categories`.`category_name`, 
                        `products`.`product_supplier`,
                        `products`.`product_price`,
                        `products`.`product_slug`
                    FROM `products` 
                    INNER JOIN `categories` ON `products`.`category_id` = `categories`.`category_id`
                    WHERE LOWER(`products`.`product_name`) LIKE CONCAT('%', ?, '%')
                    OR LOWER(`products`.`product_supplier`) LIKE CONCAT('%', ?, '%')
                    OR LOWER(`products`.`product_price`) LIKE CONCAT('%', ?, '%')
                    OR LOWER(`categories`.`category_name`) LIKE CONCAT('%', ?, '%')
                    ";

    $stmt_search_product = $connection->prepare($sql_search);
    if (!$stmt_search_product) {
        $error = mysqli_error($connection);
        $response = array('success' => false, 'message' => 'Invalid query: '.$error);
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $stmt_search_product->bind_param('ssss', $keyword, $keyword, $keyword, $keyword);
        $stmt_search_product->execute();
        $result = $stmt_search_product->get_result();
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $response = array('success' => true, 'data' => $rows);
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $error = $stmt_search_product->error;
            $response = array('success' =>false, 'message' => 'No have result to this keyword');
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        mysqli_stmt_close($stmt_search_product);
    }
    mysqli_close($connection);
?>