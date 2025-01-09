<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error <?= $status_code; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .error-container {
            text-align: center;
            background: #fff;
            padding: 30px 50px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .error-container h1 {
            font-size: 100px;
            margin: 0;
            color: #ff6b6b;
        }
        .error-container h2 {
            font-size: 24px;
            margin: 10px 0;
            color: #333;
        }
        .error-container p {
            font-size: 16px;
            color: #666;
            margin: 15px 0;
        }
        .error-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .error-container a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1><?= $status_code; ?></h1>
        <h2>Access Denied</h2>
        <p><?= $message; ?></p>
        <a href="<?= base_url('Dashboard'); ?>">Go to Dashboard</a>
    </div>
</body>
</html>
