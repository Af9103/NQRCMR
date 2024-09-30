<?php
require_once(__DIR__ . '/../koneksi.php');
require __DIR__ . '/../asset/library/autoload.php';
require __DIR__ . '/../asset/password-compat/lib/password.php';

session_start();

function input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = input($_POST['username']);
    $password = input($_POST['password']);

    // Validasi CAPTCHA
    if ($_SESSION["captcha_code"] != $_POST["captcha"]) {
        $error_msg = "Your CAPTCHA code is wrong!";
    } else {
        if (empty($username) || empty($password)) {
            $error_msg = "Username and password are required!";
        } else {
            $sql = "SELECT * FROM ct_users WHERE npk='$username'";
            $result = mysqli_query($koneksi2, $sql);

            if ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row['pwd'])) {
                    $_SESSION["username"] = $row["npk"];
                    $_SESSION["golongan"] = $row["golongan"];
                    $_SESSION["name"] = $row["full_name"];
                    $_SESSION["dept"] = $row["dept"];
                    $gol = $row['golongan'];
                    $act = $row['acting'];
                    $dept = $row['dept'];

                    // Check if the user is in the hrd_so table
                    $sql_hrd = "SELECT * FROM hrd_so WHERE npk='$username'";
                    $result_hrd = mysqli_query($koneksi2, $sql_hrd);

                    if ($hrd_row = mysqli_fetch_assoc($result_hrd)) {
                        $tipe = $hrd_row['tipe'];

                        if ($tipe == '7') {
                            $_SESSION['role'] = "BODTA";
                            $_SESSION['loggedin'] = true;
                        }
                    }

                    // Check other roles if not already assigned as "BODTA"
                    if (!isset($_SESSION['role'])) {
                        if ($gol >= 0 && $gol <= 2 && $act == 2 && $dept == 'PPC') {
                            $_SESSION['role'] = "OPPPC";
                        } elseif ($gol == 3 && $act == 2 && $dept == 'PPC') {
                            $_SESSION['role'] = "FMPPC";
                        } elseif ($gol == 4 && $act == 2 && $dept == 'PPC') {
                            $_SESSION['role'] = "SPVPPC";
                        } elseif ($gol == 4 && $act == 1 && $dept == 'PPC') {
                            $_SESSION['role'] = "MGRPPC";
                        } elseif ($gol >= 0 && $gol <= 2 && $act == 2 && $dept == 'QA') {
                            $_SESSION['role'] = "OPQA";
                        } elseif ($gol == 3 && $act == 2 && $dept == 'QA') {
                            $_SESSION['role'] = "FMQA";
                        } elseif ($gol == 4 && $act == 2 && $dept == 'QA') {
                            $_SESSION['role'] = "SPVQA";
                        } elseif ($gol == 4 && $act == 1 && $dept == 'QA') {
                            $_SESSION['role'] = "MGRQA";
                        } elseif ($gol >= 0 && $gol <= 2 && $act == 2 && $dept == 'VDD') {
                            $_SESSION['role'] = "OPVDD";
                        } elseif ($gol == 3 && $act == 2 && $dept == 'VDD') {
                            $_SESSION['role'] = "FMVDD";
                        } elseif ($gol == 4 && $act == 2 && $dept == 'VDD') {
                            $_SESSION['role'] = "SPVVDD";
                        } elseif ($gol == 4 && $act == 1 && $dept == 'VDD') {
                            $_SESSION['role'] = "MGRVDD";
                        } elseif ($gol == 5 && $act == 1 && $dept == 'admin') {
                            $_SESSION['role'] = "admin";
                        } else {
                            header("Location: forbidden.php");
                            exit;
                        }
                    }
                } else {
                    $error_msg = "Password Salah!";
                }
            } else {
                $error_msg = "NPK Tidak Ditemukan!";
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="../assets/img/k-logo.jpg" rel="icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-login">
                                    <div class="pt-4 pb-2">
                                        <div class="d-flex justify-content-center py-4">
                                            <a class="logo d-flex align-items-center w-auto">
                                                <img src="../assets/img/kayaba-logo.png" alt=""
                                                    style="width: 260px; margin-bottom: -60px;">
                                            </a>
                                        </div>
                                        <p style="font-weight: bold; margin-bottom: -20; font-size: large;"
                                            class="text-center large">Nonconforming Quality Report</p>
                                    </div>

                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <div class="col-12">
                                            <div class="input-group has-validation">
                                                <input type="text" class="form-control" name="username"
                                                    placeholder="NPK" maxlength="8" required>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="bi-person-fill"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="col-12">
                                            <div class="input-group has-validation ">
                                                <input type="password" class="form-control" name="password"
                                                    id="password-input" placeholder="password" maxlength="12" required>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="bi-eye-fill" id="password-toggle"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div style="margin-top: 10px;" class="captcha-container">
                                                <!-- Captcha image container -->
                                                <div id="captchaImageContainer">
                                                    <img src="../captcha.php" alt="Captcha Code" id="captchaImage">
                                                </div>
                                                <br>
                                                <input type="text" class="form-control" name="captcha"
                                                    placeholder="Enter captcha code" maxlength="8" required>
                                            </div>
                                            <div class="captcha-refresh-text" id="refreshCaptchaText"
                                                style="margin-top: 5px;">
                                                Captcha not read? Refresh<strong> <a href="javascript:void(0);"
                                                        onclick="refreshCaptcha()">here</a></strong>
                                            </div>

                                            <!-- Add this script to handle the captcha refresh button -->
                                            <script>
                                                // Function to refresh the captcha image
                                                function refreshCaptcha() {
                                                    // Get the captcha image element
                                                    const captchaImage = document.getElementById('captchaImage');
                                                    // Generate a new timestamp query parameter to force the browser to reload the image
                                                    const timestamp = new Date().getTime();
                                                    captchaImage.src = '../captcha.php?ts=' +
                                                        timestamp; // Tambahkan tanda kutip ganda di sekitar captcha.php
                                                }
                                            </script>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <button type="submit" id="login" name="login" value="login"
                                                class="btn btn-primary btn-block"
                                                style="width: 380px; margin: 0 auto;">Login</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/jQuery/jquery-3.6.0.min.js"></script>
    <script src="../asset/sweetalert2/package/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert script -->
    <script>
        <?php if (isset($error_msg) && !empty($error_msg)): ?>
            // Display SweetAlert if there is an error message
            Swal.fire({
                icon: "error",
                title: "Login Failed",
                text: "<?php echo $error_msg; ?>",
                showConfirmButton: true,
            });
        <?php endif; ?>
        <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
            // Display SweetAlert for successful login
            Swal.fire({
                icon: "success",
                title: "Login Successful",
                text: "Anda berhasil login!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "nqr/qa/dasbor.php"; // Redirect to the dashboard after the alert is closed
            });
        <?php endif; ?>

        <?php if (isset($_SESSION['username']) && $dept == 'QA'): ?>
            // Display SweetAlert for successful login
            Swal.fire({
                icon: "success",
                title: "Login Successful",
                text: "Anda berhasil login!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "nqr/qa/dasbor.php"; // Redirect to the dashboard after the alert is closed
            });
        <?php endif; ?>

        <?php if (isset($_SESSION['username']) && $dept == 'PPC'): ?>
            // Display SweetAlert for successful login
            Swal.fire({
                icon: "success",
                title: "Login Successful",
                text: "Anda berhasil login!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "nqr/ppc/dasborppc.php"; // Redirect to the dashboard after the alert is closed
            });
        <?php endif; ?>

        <?php if (isset($_SESSION['username']) && $dept == 'VDD'): ?>
            // Display SweetAlert for successful login
            Swal.fire({
                icon: "success",
                title: "Login Successful",
                text: "Anda berhasil login!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "nqr/vdd/dasbor-vdd.php"; // Redirect to the dashboard after the alert is closed
            });
        <?php endif; ?>

        <?php if (isset($_SESSION['username']) && $_SESSION['role'] == "BODTA"): ?>
            // Display SweetAlert for successful login
            Swal.fire({
                icon: "success",
                title: "Login Successful",
                text: "Anda berhasil login!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = "cmr/qa/dasborcmr.php"; // Redirect to the dashboard after the alert is closed
            });
        <?php endif; ?>
    </script>
    <script>
        $(document).ready(function () {
            // Ambil elemen input password dan ikon kunci
            const passwordInput = document.getElementById('password-input');
            const passwordToggle = document.getElementById('password-toggle');

            // Tambahkan event listener saat ikon kunci diklik
            passwordToggle.addEventListener('click', function () {
                // Periksa apakah input password dalam keadaan tersembunyi atau terlihat
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                // Ubah tipe input password
                passwordInput.setAttribute('type', type);
                // Ubah ikon kunci sesuai dengan tipe input password
                if (type === 'password') {
                    passwordToggle.classList.remove('bi-eye-slash-fill');
                    passwordToggle.classList.add('bi-eye-fill');
                } else {
                    passwordToggle.classList.remove('bi-eye-fill');
                    passwordToggle.classList.add('bi-eye-slash-fill');
                }
            });
        });
    </script>

</body>

</html>

<style>
    /* CSS untuk tata letak captcha */
    .captcha-container {
        display: flex;
        align-items: center;
    }

    .captcha-image {
        padding: 4px;
        /* Tambahkan padding agar ada ruang di sekitar gambar captcha */
    }

    .captcha-input-container {
        display: flex;
        align-items: center;
        height: 40px;
    }

    .captcha-input-container input {
        margin-right: 0px;
        height: 100%;
    }

    .captcha-input-container button {
        height: 100%;
    }

    @media screen and (max-width: 1000px) {
        .captcha-input-container {
            flex-direction: column;
            align-items: flex-start;
            height: auto;
        }

        .captcha-input-container input {
            margin-right: 0;
            margin-bottom: 5px;
        }
    }
</style>