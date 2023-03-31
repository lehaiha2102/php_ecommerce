<?php
    require_once('../../config/database.php');

    $keyword = trim(strtolower($_GET['keyword']));

    $sql = "SELECT products.*, categories.category_name as category_name
    FROM products
    INNER JOIN categories ON products.category_id = categories.category_id
    WHERE (LOWER(products.product_name) LIKE CONCAT('%', ?, '%')
                                        OR LOWER(products.product_description) LIKE CONCAT('%', ?, '%') 
                                        OR LOWER(categories.category_name) LIKE CONCAT('%', ?, '%'))";

    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        die('Câu truy vấn không hợp lệ.');
    }
    $stmt->bind_param('sss', $keyword, $keyword, $keyword);
    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo $row['product_name'] . ' - ' . $row['category_name'] . '<br>';
    }
    echo 'No product';

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

?>