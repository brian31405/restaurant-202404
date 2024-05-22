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

$order_table = "A4";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $qtys = $_POST['qty'];
    $customizes = $_POST['customize'];

    foreach ($qtys as $item => $qty) {
        $customize = $customizes[$item];

        // 查詢菜品價格
        $sql = "SELECT QTY FROM menu_content WHERE CHN = '$item'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $price = $row['QTY'];
            $total_price = $qty * $price;

            // 插入訂單資料
            $sql = "INSERT INTO orders (order_table, item, qty, count, customize) VALUES ('$order_table', '$item', '$qty', '$total_price', '$customize')";

            if ($conn->query($sql) === TRUE) {
                echo "訂單提交成功: $item 數量: $qty 總價: $total_price<br>";
            } else {
                echo "訂單提交失敗: " . $conn->error . "<br>";
            }
        } else {
            echo "查無此菜品: $item<br>";
        }
    }
}

// 關閉資料庫連接
$conn->close();
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>訂單提交結果</title>
</head>
<body>
    <a href="menu_a4.php">返回菜單</a>
</body>
</html>
