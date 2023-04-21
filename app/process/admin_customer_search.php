<?php
require_once('../../config/database.php');

    $keyword = $_POST['keyword'];
    $sql_search = "SELECT users.*, roles.role_name
                    FROM `users` 
                    INNER JOIN `roles` ON `users`.`role_id` = `roles`.`role_id`
                    WHERE LOWER(`fullname`) LIKE CONCAT('%', ?, '%')
                    OR LOWER(`email`) LIKE CONCAT('%', ?, '%')
                    OR LOWER(`phone`) LIKE CONCAT('%', ?, '%')
                    OR LOWER(`address`) LIKE CONCAT('%', ?, '%')
                    OR LOWER(`roles`.`role_name`) LIKE CONCAT('%', ?, '%')";

    $stmt_search_customer = $connection->prepare($sql_search);
    if (!$stmt_search_customer) {
        $error = mysqli_error($connection);
        $response = array('success' => false, 'message' => 'Invalid query: '.$error);
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $stmt_search_customer->bind_param('sssss', $keyword , $keyword , $keyword , $keyword, $keyword);
        $stmt_search_customer->execute();
        $result = $stmt_search_customer->get_result();
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $response = array('success' => true, 'data' => $rows);
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $error = $stmt_search_customer->error;
            $response = array('success' =>false, 'message' => 'No have result to this keyword');
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        mysqli_stmt_close($stmt_search_customer);
    }
    mysqli_close($connection);
?>