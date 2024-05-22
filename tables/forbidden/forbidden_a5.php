<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>尚未開桌</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: '微軟正黑體', sans-serif;
            background-color: #f8f9fa;
        }
        .message {
            text-align: center;
            font-size: 36pt;
            color: #000000;
            margin-top: 20px;
        }
        .refresh-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 256px;
            height: 80px;
            background-color: #48B8D9;
            color: #FFFFFF;
            font-size: 30pt;
            font-family: '微軟正黑體', sans-serif;
            text-decoration: none;
            text-align: center;
            margin-top: 20px;
            border-radius: 8px;
        }
        .refresh-button:hover {
            background-color: #3a9cb3;
        }
    </style>
</head>
<body>
    <img src="https://uxwing.com/wp-content/themes/uxwing/download/signs-and-symbols/forbidden-prohibited-icon.png" alt="Forbidden" width="512" height="512">
    <div class="message">很抱歉本桌尚未開桌,請通知服務人員</div>
    <a class="refresh-button" href="https://localhost/tables/default_state/table_a5.php">重新整理</a>
</body>
</html>
