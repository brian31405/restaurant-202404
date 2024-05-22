<?php
// 資料庫連接參數
$servername = "localhost";
$username = "root";
$password = "0916531078";
$dbname = "restaurant";

// 建立資料庫連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

// 查詢 table_A3 欄位值
$sql = "SELECT table_A3 FROM table_status";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 取出第一行資料
    $row = $result->fetch_assoc();
    $table_A3_status = $row['table_A3'];

    // 根據 table_A3 欄位值進行重定向
    if ($table_A3_status == '1') {
        header("Location: http://localhost/tables/order/order_a3.php");
        exit();
    } else if ($table_A3_status == '0') {
        header("Location: http://localhost/tables/forbidden/forbidden_a3.php");
        exit();
    } else {
        echo "未知的 table_A3 狀態值";
    }
} else {
    echo "未找到 table_A3 狀態值";
}

// 關閉資料庫連接
$conn->close();
?>
