<?php
require_once('../../config/database.php');

    $keyword = $_POST['keyword'];
    $sql_search = "SELECT `category_name`, `category_slug`
                    FROM `categories` 
                    WHERE LOWER(`category_name`) LIKE CONCAT('%', ?, '%')";

    $stmt_search_category = $connection->prepare($sql_search);
    if (!$stmt_search_category) {
        $error = mysqli_error($connection);
        $response = array('success' => false, 'message' => 'Invalid query: '.$error);
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $stmt_search_category->bind_param('s', $keyword);
        $stmt_search_category->execute();
        $result = $stmt_search_category->get_result();
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $response = array('success' => true, 'data' => $rows);
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $error = $stmt_search_category->error;
            $response = array('success' =>false, 'message' => 'No have result to this keyword');
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        mysqli_stmt_close($stmt_search_category);
    }
    mysqli_close($connection);
?>