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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['table']) && isset($_POST['status'])) {
    $table = $_POST['table'];
    $new_status = (int)$_POST['status'];
    $sql = "UPDATE table_status SET $table = $new_status";
    
    if ($conn->query($sql) === TRUE) {
        echo "記錄更新成功";
    } else {
        echo "更新記錄錯誤: " . $conn->error;
    }
}

// 查詢各個位置的狀態
$sql = "SELECT table_A1, table_A2, table_A3, table_A4, table_A5 FROM table_status";
$result = $conn->query($sql);

// 檢查是否有結果返回
if ($result->num_rows > 0) {
    $status = $result->fetch_assoc();
} else {
    $status = ['table_A1' => 0, 'table_A2' => 0, 'table_A3' => 0, 'table_A4' => 0, 'table_A5' => 0];
}

// 關閉資料庫連接
$conn->close();
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>桌位狀態</title>
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
    <h1>桌位狀態</h1>
    <table>
        <tr>
            <th>桌位</th>
            <th>狀態</th>
            <th>操作</th>
        </tr>
        <?php foreach ($status as $table => $value): ?>
        <tr>
            <td><?php echo strtoupper($table); ?></td>
            <td><?php echo $value == 1 ? '開啟' : '關閉'; ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="table" value="<?php echo $table; ?>">
                    <input type="hidden" name="status" value="<?php echo $value == 1 ? 0 : 1; ?>">
                    <button type="submit"><?php echo $value == 1 ? '關閉' : '開啟'; ?></button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
