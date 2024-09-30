<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/img/k-logo.jpg" rel="icon">
    <title>Access Forbidden</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .forbidden-container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .forbidden-container .lock-icon {
            font-size: 80px;
            color: #dc3545;
            margin-bottom: 20px;
        }

        .forbidden-container p {
            font-size: 18px;
            color: #6c757d;
        }

        .forbidden-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .forbidden-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="forbidden-container">
        <div class="lock-icon">&#128274;</div> <!-- Icon Gembok -->
        <p>Access Forbidden. You do not have permission to access this page.</p>
        <a href="../index.php">Go to Homepage</a>
    </div>
</body>

</html>