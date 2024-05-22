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

// 處理更新狀態請求
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_table']) && isset($_POST['time']) && isset($_POST['item'])) {
    $order_table = $_POST['order_table'];
    $time = $_POST['time'];
    $item = $_POST['item'];
    $new_status = (int)$_POST['status'];
    $sql = "UPDATE orders SET kitchen_status = $new_status WHERE order_table = '$order_table' AND time = '$time' AND item = '$item'";
    
    if ($conn->query($sql) === TRUE) {
        echo "記錄更新成功";
    } else {
        echo "更新記錄錯誤: " . $conn->error;
    }
}

// 查詢訂單資訊，並根據完成狀態、成立時間和訂單分類排序
$sql = "SELECT order_table, time, item, qty, kitchen_status FROM orders ORDER BY kitchen_status ASC, time ASC, order_table ASC";
$result = $conn->query($sql);

// 關閉資料庫連接
$conn->close();
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
	<meta http-equiv="refresh" content="5">
    <title>訂單狀態</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        button {
            background-color: #48B8D9;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #3a9cb3;
        }
    </style>
</head>
<body>
    <h1>訂單狀態</h1>
    <table>
        <tr>
            <th>桌號</th>
            <th>訂單成立時間</th>
            <th>品項</th>
            <th>數量</th>
            <th>完成狀態</th>
            <th>操作</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['order_table']); ?></td>
                    <td><?php echo htmlspecialchars($row['time']); ?></td>
                    <td><?php echo htmlspecialchars($row['item']); ?></td>
                    <td><?php echo htmlspecialchars($row['qty']); ?></td>
                    <td><?php echo $row['kitchen_status'] == 1 ? '完成' : '未完成'; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="order_table" value="<?php echo htmlspecialchars($row['order_table']); ?>">
                            <input type="hidden" name="time" value="<?php echo htmlspecialchars($row['time']); ?>">
                            <input type="hidden" name="item" value="<?php echo htmlspecialchars($row['item']); ?>">
                            <input type="hidden" name="status" value="<?php echo $row['kitchen_status'] == 1 ? 0 : 1; ?>">
                            <button type="submit"><?php echo $row['kitchen_status'] == 1 ? '標記為未完成' : '標記為完成'; ?></button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">沒有訂單</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
