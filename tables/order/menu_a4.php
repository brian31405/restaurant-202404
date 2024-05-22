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

// 查詢菜單資料
$sql = "SELECT CHN, ENG, QTY, IMG, MEMO FROM menu_content";
$result = $conn->query($sql);

// 檢查是否有結果返回
if ($result->num_rows > 0) {
    $menu_items = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $menu_items = [];
}

// 關閉資料庫連接
$conn->close();
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>點餐系統</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .menu-item {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px;
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
        }
        .menu-item img {
            width: 256px;
            height: 256px;
        }
        .menu-item input[type="number"] {
            width: 60px;
        }
        .menu-item textarea {
            width: 100%;
            height: 50px;
        }
        .submit-btn {
            background-color: #48B8D9;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #3a9cb3;
        }
    </style>
</head>
<body>
    <h1>點餐系統</h1>
    <form action="submit_order_a4.php" method="post">
        <?php foreach ($menu_items as $item): ?>
            <div class="menu-item">
                <h2><?php echo $item['CHN']; ?> (<?php echo $item['ENG']; ?>)</h2>
                <img src="<?php echo $item['IMG']; ?>" alt="<?php echo $item['CHN']; ?>">
                <p>價格: $<?php echo $item['QTY']; ?></p>
                <p>備註: <?php echo $item['MEMO']; ?></p>
                <label>數量: <input type="number" name="qty[<?php echo $item['CHN']; ?>]" min="0" value="0"></label>
                <label>客製化資訊: <textarea name="customize[<?php echo $item['CHN']; ?>]"></textarea></label>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="submit-btn">提交訂單</button>
    </form>
</body>
</html>
