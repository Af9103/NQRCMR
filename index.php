<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <title>NQR & CMR</title>
    <link href="assets/img/k-logo.jpg" rel="icon">
    <style>
        .header {
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
        }

        .header img {
            width: 150px;
            margin-right: 20px;
            margin-left: 140px;
        }

        .header h1 {
            font-size: 1.9rem;
            font-weight: bold;
        }

        .home-illustration {
            padding: 100px 150px;
            /* Add padding to move content down and to the right */
        }

        .home-illustration .content {
            margin-top: 20px;
        }

        .smaller-image {
            width: 40%;
            margin-left: 100px;
        }

        .red-line::after {
            content: "";
            display: block;
            width: 40%;
            height: 5px;
            background-color: red;
            margin-top: 5px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
                padding: 10px;
            }

            .header img {
                width: 100px;
                margin-left: 0;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .home-illustration {
                padding: 50px 20px;
                text-align: center;
            }

            .home-illustration .content {
                margin-top: 10px;
            }

            .smaller-image {
                width: 80%;
                margin-left: 0;
            }

            .nav-link {
                width: 100%;
                text-align: center;
                padding: 10px;
            }
        }

        .footer {
            color: black;
            text-align: center;
            padding: 10px 0;
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 3;
        }

        .footer p {
            margin: 0;
        }

        .content .btn-login {
            font-size: 1.7rem;
            border-radius: 50px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .content .btn-login:hover {
            background-color: white;
            color: red;
            outline: 1px solid red;
            transform: scale(1.05);
            /* Slightly increase the button size */
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="assets/img/kayaba-logo.png" alt="Logo"> <!-- Adjust the src to your logo image path -->
        <h1>PT KAYABA INDONESIA</h1>
    </div>

    <!-- Main Content -->
    <div class="d-flex align-items-center home-illustration">
        <div class="w-50 content">
            <div class="d-flex align-items-center">
                <h1>
                    <span class="fw-bold red-line" style="font-size: 3rem">Welcome to</span>
                    <hr class="w-25 main-hr mb-2 mt-3" />
                    <span class="fw-normal fs-3">PT. Kayaba Indonesia NONCONFORMING QUALITY REPORT & CLAIM REPORT
                        SYSTEM</span>
                </h1>
            </div>
            <div class="mt-2 w-25 d-flex align-items-center">
                <a href="view/login.php" class="btn btn-danger btn-login" style="width: 210px;">Login</a>
            </div>
        </div>
        <img src="assets/img/ketidaksesuaian-produk.jpg" alt="Gambarr" class="smaller-image">
    </div>

    <div class="footer">
        <p>&copy; Copyright 2024 <strong><a href="https://www.kyb-astra.com/">PT KAYABA INDONESIA</a></strong>. All
            Rights
            Reserved</p>
    </div>

</body>

</html>