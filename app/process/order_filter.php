<?php
require_once('../../config/database.php');

if (isset($_POST['value']) && isset($_POST['arrangement'])) {
    $value = $_POST['value'];
    $arrangement = $_POST['arrangement'];
    switch ($value) {
        case 'id':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT orders.*, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                    GROUP BY orders.order_id";
                    break;
                case 'Ascending':
                    $sql = "SELECT orders.*, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                    GROUP BY orders.order_id ORDER BY order_id ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT orders.*, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                    GROUP BY orders.order_id ORDER BY order_id DESC";
                    break;
            }
            break;
        case 'name':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT o.*, u.fullname, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders o
                    INNER JOIN order_detail ON o.order_id = order_detail.order_id
                    JOIN users u ON o.user_id = u.user_id
                    GROUP BY o.order_id;
                    ";
                    break;
                case 'Ascending':
                    $sql = "SELECT o.*, u.fullname, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders o
                    INNER JOIN order_detail ON o.order_id = order_detail.order_id
                    JOIN users u ON o.user_id = u.user_id
                    GROUP BY o.order_id
                            ORDER BY u.fullname ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT o.*, u.fullname, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders o
                    INNER JOIN order_detail ON o.order_id = order_detail.order_id
                    JOIN users u ON o.user_id = u.user_id
                    GROUP BY o.order_id
                            ORDER BY u.fullname DESC";
                    break;
            }
            break;
        case 'total':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT orders.*, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price, payment_methods.payment_method
                            FROM orders
                            INNER JOIN payment_methods ON orders.payment_method_id = payment_methods.method_id
                            INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id
                            ORDER BY total_price";
                    break;
                case 'Ascending':
                    $sql = "SELECT orders.*, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price, payment_methods.payment_method
                            FROM orders
                            INNER JOIN payment_methods ON orders.payment_method_id = payment_methods.method_id
                            INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id
                            ORDER BY total_price ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT orders.*, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price, payment_methods.payment_method
                            FROM orders
                            INNER JOIN payment_methods ON orders.payment_method_id = payment_methods.method_id
                            INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id
                            ORDER BY total_price DESC";
                    break;
            }
            break;
        case 'payment':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                            FROM orders
                            INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                            INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id
                            ";
                    break;
                case 'Ascending':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id
                    ORDER BY payment_method ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id
                    ORDER BY payment_method DESC";
                    break;
            }
            break;
        case 'pay_status':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                    GROUP BY orders.order_id;
                    ";
                    break;
                case 'Ascending':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                    GROUP BY orders.order_id
                     ORDER BY payment_status ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                    GROUP BY orders.order_id
                     ORDER BY order_id DESC";
                    break;
            }
            break;
        case 'ord_status':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                    GROUP BY orders.order_id";
                    break;
                case 'Ascending':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id ORDER BY order_status ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id ORDER BY order_status DESC";
                    break;
            }
            break;
        case 'address':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id";
                    break;
                case 'Ascending':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id ORDER BY ship_address ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id ORDER BY ship_address DESC";
                    break;
            }
            break;
        case 'phone':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id";
                    break;
                case 'Ascending':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id ORDER BY recipient_phone ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id ORDER BY recipient_phone DESC";
                    break;
            }
            break;
        case 'time':
            switch ($arrangement) {
                case 'Default':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id";
                    break;
                case 'Ascending':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id ORDER BY create_at ASC";
                    break;
                case 'Decrease':
                    $sql = "SELECT orders.*, payment_methods.payment_method, SUM(order_detail.product_price * order_detail.product_quantity) AS total_price
                    FROM orders
                    INNER JOIN `payment_methods` ON `orders`.`payment_method_id` = `payment_methods`.`method_id`
                    INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                            GROUP BY orders.order_id ORDER BY create_at DESC";
                    break;
            }
            break;
    }

    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $response = array('success' => true, 'data' => $rows);
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'message' => 'Order not found');
    }
    $connection->close();
} else {
    $response = array('success' => false, 'message' => 'You need to select objects and sorting to proceed with data filtering');
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>