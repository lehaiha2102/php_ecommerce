<?php
// Kết nối tới cơ sở dữ liệu
$connection = mysqli_connect('localhost', 'username', 'password', 'database');

// Truy vấn để lấy dữ liệu về đơn hàng và chi tiết đơn hàng
$query = "SELECT `order_id`, `product_price`, `product_quantity`, `create_at`
          FROM `order_detail`";

// Tính toán tổng doanh thu của từng tháng dựa trên dữ liệu lấy được từ truy vấn
$query .= " GROUP BY MONTH(`create_at`), YEAR(`create_at`)";
$query .= " ORDER BY YEAR(`create_at`) ASC, MONTH(`create_at`) ASC";

$results = mysqli_query($connection, $query);

$data = array();
foreach ($results as $row) {
    $data[] = $row;
}

// Trả về kết quả của truy vấn dưới dạng JSON để sử dụng trong JavaScript
echo json_encode($data);
?>