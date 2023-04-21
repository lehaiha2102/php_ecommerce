<?php
require_once('../../config/database.php');

    $keyword = $_POST['keyword'];
    $sql_search = "SELECT `orders`.`order_id`, `users`.`fullname`,
                          `payment_methods`.`payment_method`, `orders`.`order_status`, `orders`.
                          `ship_address`, `orders`.`recipient_phone`, 
                          `orders`.`payment_status`, `orders`.`consignee`, `orders`.`create_at`  
                    FROM `orders`
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN `users` ON `orders`.`user_id` = `users`.`user_id`
                    WHERE LOWER(`orders`.`order_id`) LIKE CONCAT('%', ?, '%')
                    OR LOWER(`users`.`fullname`) LIKE CONCAT('%', ?, '%')
                    OR LOWER(`payment_methods`.`payment_method`) LIKE CONCAT('%', ?, '%')
                    OR LOWER(`orders`.`order_status`) LIKE CONCAT('%', ?, '%')
                    OR LOWER(`orders`.`ship_address`) LIKE CONCAT('%', ?, '%')
                    OR LOWER(`orders`.`recipient_phone`) LIKE CONCAT('%', ?, '%')
                    OR LOWER(`orders`.`payment_status`) LIKE CONCAT('%', ?, '%')
                    OR LOWER(`orders`.`consignee`) LIKE CONCAT('%', ?, '%')
                    ";

    $stmt_search_product = $connection->prepare($sql_search);
    if (!$stmt_search_product) {
        $error = mysqli_error($connection);
        $response = array('success' => false, 'message' => 'Invalid query: '.$error);
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $stmt_search_product->bind_param('ssssssss', $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword);
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