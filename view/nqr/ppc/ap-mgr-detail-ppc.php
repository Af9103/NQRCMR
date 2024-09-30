<?php
session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["dept"]) || $_SESSION["dept"] !== "PPC" || $_SESSION["role"] !== "MGRPPC") {
    echo "Anda harus login terlebih dahulu";
    header("Location: ../../forbidden.php");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}

include(__DIR__ . '/../../../koneksi.php');
include(__DIR__ . '/../../../function.php');


// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

$currentYear = date("Y");

// Query ke database untuk mengambil data transaksi berdasarkan Id
$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE Id = '$Id'");
if ($query) {
    // Jika query berhasil, ambil data dari hasil query
    $user_data = mysqli_fetch_array($query);
    if ($user_data) {
        $status_ppc = $user_data['status_ppc'];
        $reg_no = $user_data['reg_no'];
        $feedback = $user_data['feedback'];
        $dt_stc = $user_data['dt_stc'];
        date_default_timezone_set("Asia/Bangkok"); // Set zona waktu ke Asia/Bangkok
        $dt_fm_qa = date("Y-m-d H:i:s"); // Menggunakan format "YYYY-MM-DD HH:MM:SS" untuk tanggal dan waktu saat ini
    }
} else {
    echo "Terjadi kesalahan dalam mengambil data transaksi.";
}
?>

<?php

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi, "SELECT stc FROM transaksi WHERE Id = '$Id'");
if ($queryInfo) {
    // Jika query berhasil, ambil nilai dari hasil query
    $row = mysqli_fetch_assoc($queryInfo);
    // Tetapkan nilai ke variabel $infoValue
    $stc = $row['stc'];
} else {
    // Jika query gagal, atur nilai default
    $stc = "1"; // Nilai default
}

// Tetapkan atribut checked sesuai dengan nilai dari database
$AirChecked = ($stc === "1") ? "checked" : "";
$SeaChecked = ($stc === "2") ? "checked" : "";
?>

<?php

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi, "SELECT p FROM transaksi WHERE Id = '$Id'");
if ($queryInfo) {
    // Jika query berhasil, ambil nilai dari hasil query
    $row = mysqli_fetch_assoc($queryInfo);
    // Tetapkan nilai ke variabel $infoValue
    $p = $row['p'];
} else {
    // Jika query gagal, atur nilai default
    $p = "1"; // Nilai default
}

// Tetapkan atribut checked sesuai dengan nilai dari database
$PayChecked = ($p === "1") ? "checked" : "";
$SendChecked = ($p === "2") ? "checked" : "";
?>

<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Approval Manager - NQR</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../../../assets/img/k-logo.jpg" rel="icon">
    <link href="../../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../../assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <?php include '../../../layout/header.php'; ?>
    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <?php include '../../../layout/sidebar.php'; ?>
    </aside><!-- End Sidebar-->
    <main id="main" class="main">


        <div class="pagetitle">
            <h1>Approval by Manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dasborppc.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="ap-mgr-ppc.php">List NQR</a></li>
                    <li class="breadcrumb-item active">Approval by Manager</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data NQR</h5>

                            <!-- General Form Elements -->
                            <form method="post" id="myForm">

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Reg No</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?php echo $reg_no; ?>">
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Dispostion of this claim</legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="p" id="p1" value="1"
                                                <?php echo $PayChecked; ?> disabled>
                                            <label class="form-check-label" for="p1">
                                                Pay Compensation
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="p" id="p2" value="2"
                                                <?php echo $SendChecked; ?> disabled>
                                            <label class="form-check-label" for="info2">
                                                Send the Replacement
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <?php if ($p == "2"): ?>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-4 pt-0">Send The Replacement</legend>
                                        <div class="col-sm-8">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="stc" id="stc1" value="1"
                                                    <?php echo $AirChecked; ?> disabled>
                                                <label class="form-check-label" for="stc1">
                                                    By Air
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="stc" id="stc2" value="2"
                                                    <?php echo $SendChecked; ?> disabled>
                                                <label class="form-check-label" for="stc2">
                                                    By Sea
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                <?php endif; ?>

                                <?php if ($stc != "0"): ?>
                                    <div id="replacementDateInput">
                                        <div class="form-group row">
                                            <label for="replacementDate" class="col-sm-4 col-form-label">Replacement
                                                Date</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="dt_stc"
                                                    value="<?php echo $dt_stc; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="row mb-3" style="display: none;">
                                    <label for="inputText" class="col-sm-4 col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nm_mgr_ppc" name="nm_mgr_ppc"
                                            readonly value="<?php echo $_SESSION['name']; ?>">
                                    </div>
                                </div>


                                <div class="row mt-3">
                                    <div class="col-sm-12 text-end">
                                        <form method="post" id="myForm">
                                            <button type="submit" class="btn btn-primary custom-button" name="proses"
                                                value="Ubah">Approve</button>
                                            <button type="button" class="btn btn-danger custom-button"
                                                data-toggle="modal" data-target="#tolakModal">Tolak</button>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>

                </div>


                <!-- Modal -->
                <div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered"" role=" document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Revisi NQR</h5>
                                <a href="#" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true"
                                    style="position: absolute; top: 10px; right: 10px;">
                                    &times;
                                </a>
                            </div>
                            <div class="modal-body">
                                Jelaskan detail revisi dari NQR tersebut
                            </div>
                            <form class="row g-3" action="" method="post" class="modal-dialog" role="document">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" style="height: 150px" id="remark_mgr_ppc"
                                            name="remark_mgr_ppc"></textarea>
                                        <label for="floatingName">Remark</label>
                                    </div>
                                </div>

                                <div class="row mb-3" style="display: none;">
                                    <label for="inputText" class="col-sm-4 col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nm_mgr_ppc" name="nm_mgr_ppc"
                                            readonly value="<?php echo $_SESSION['name']; ?>">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary custom-button" name="tolak"
                                        value="Ubah">Konfirmasi</button> <!-- Ubah type menjadi submit -->
                                    <button type="button" class="btn btn-danger custom-button" aria-label="Close"
                                        onclick="document.getElementById('myForm').reset()">Reset</button>
                                </div>
                        </div>
                    </div>
                </div>
    </main>

    <script>
        function resetForm() {
            // Dapatkan semua elemen input dalam formulir
            var inputs = document.querySelectorAll('form input[type=text], form input[type=date], form textarea');

            // Setel nilai setiap elemen input menjadi string kosong
            inputs.forEach(function (input) {
                input.value = '';
            });

            // Reset juga untuk file input jika ada
            var fileInputs = document.querySelectorAll('form input[type=file]');
            fileInputs.forEach(function (fileInput) {
                fileInput.value = null;
            });
        }
    </script>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <?php include '../../../layout/footer.php'; ?>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../../../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../../assets/vendor/quill/quill.min.js"></script>
    <script src="../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../../../assets/js/main.js"></script>
    <script src="../../../asset/sweetalert2/package/dist/sweetalert2.all.min.js"></script>

    <?php
    // Proses form jika tombol proses diklik
    if (isset($_POST['proses'])) {

        date_default_timezone_set("Asia/Bangkok"); // Set zona waktu ke Asia/Bangkok
        $dt_mgr_ppc = date("Y-m-d H:i:s"); // Menggunakan format "YYYY-MM-DD HH:MM:SS" untuk tanggal dan waktu saat ini
        $nm_mgr_ppc = $_POST['nm_mgr_ppc'];

        // Eksekusi query update
        $result_approvemgr = mysqli_query($koneksi, "UPDATE transaksi SET dt_mgr_ppc='$dt_mgr_ppc', nm_mgr_ppc='$nm_mgr_ppc', status_ppc='5', sts_mgr_ppc='1',status_vdd='1' WHERE Id='$Id'");
        if ($result_approvemgr) {
            // Kirim notifikasi jika query update berhasil
            $message = "Pemberitahuan NQR! NQR dengan nomor $reg_no telah di approve oleh Manager QA $nm_mgr_ppc. Selanjutnya akan dilanjutkan oleh departemen VDD.";
            $flags = "queue";
            $query_phone = "SELECT no_hp FROM isd 
                            LEFT JOIN ct_users ON ct_users.npk = isd.npk 
                            WHERE ct_users.golongan = 2 AND ct_users.acting = 2 AND dept = 'VDD'";
            $result_phone = mysqli_query($koneksi2, $query_phone);

            $phone_numbers = array();

            if ($result_phone) {
                while ($phone_row = mysqli_fetch_assoc($result_phone)) {
                    $phone_numbers[] = $phone_row['no_hp'];
                }
            }

            if (!empty($phone_numbers)) {
                foreach ($phone_numbers as $phone_number) {
                    $query_insert_notif = "INSERT INTO notif (phone_number, message, flags) VALUES ('$phone_number', '$message', '$flags')";
                    mysqli_query($koneksi, $query_insert_notif);
                }
            }
            echo '<script>
    var no_reg_sanitized = "' . preg_replace("/[^a-zA-Z0-9]+/", "", $reg_no) . '";
    var message = "NQR dengan nomor ' . $reg_no . ' telah di approve oleh Manager PPC(' . $nm_mgr_ppc . '). Klik link ini untuk memeriksa NQR: http://e-learning.stmi.ac.id/mhs/login";

    var numbers = ["081283265843", "089502233425"]; // Tambahkan nomor baru di sini

    numbers.forEach(function(number) {
        var formData = new FormData();
        formData.append("message", message);
        formData.append("number", number);

        fetch("https://3rxjp5-8000.csb.app/send-message", {
            method: "POST",
            body: formData
        })
        .then(() => {
            console.log("Pesan berhasil dikirim ke " + number);
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });

    // Menampilkan SweetAlert tanpa menunggu pesan WhatsApp terkirim
    Swal.fire({
        position: "center",
        icon: "success",
        title: "NQR berhasil di-approve",
        text: "NQR dengan nomor ' . $reg_no . ' telah di-approve oleh ' . $nm_mgr_ppc . ' pada ' . $dt_mgr_ppc . ' ",
        showConfirmButton: false,
        timer: 2000
    }).then(() => {
        window.location.href = "ap-mgr-ppc.php";
    });
</script>';
            exit(); // Make sure there is no output after this
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($koneksi);
        }

    }
    ?>

    <?php
    // Proses form jika tombol tolak diklik
    if (isset($_POST['tolak'])) {

        $nm_mgr_ppc = $_POST['nm_mgr_ppc'];
        $remark_mgr_ppc = input($_POST['remark_mgr_ppc']); // Ambil nilai remark dari formulir modal
        date_default_timezone_set("Asia/Bangkok"); // Set zona waktu ke Asia/Bangkok
        $dt_mgr_ppc = date("Y-m-d H:i:s"); // Menggunakan format "YYYY-MM-DD HH:MM:SS" untuk tanggal dan waktu saat ini
    
        // Eksekusi query update
        $result_rejectmgr = mysqli_query($koneksi, "UPDATE transaksi SET dt_mgr_ppc='$dt_mgr_ppc', nm_mgr_ppc='$nm_mgr_ppc', remark_mgr_ppc='$remark_mgr_ppc', remark_ppc='$remark_mgr_ppc', status_ppc='8',sts_mgr_ppc='2' WHERE Id='$Id'");
        if ($result_rejectmgr) {
            // Kirim notifikasi jika query update berhasil
            $message = "Pemberitahuan NQR! NQR dengan nomor $reg_no telah di reject oleh Manager PPC $nm_mgr_ppc dengan remark $remark_mgr_ppc";
            $flags = "queue";
            $query_phone = "SELECT no_hp FROM isd 
                            LEFT JOIN ct_users ON ct_users.npk = isd.npk 
                            WHERE ct_users.golongan = 2 AND ct_users.acting = 2 AND dept = 'PPC'";
            $result_phone = mysqli_query($koneksi2, $query_phone);

            $phone_numbers = array();

            if ($result_phone) {
                while ($phone_row = mysqli_fetch_assoc($result_phone)) {
                    $phone_numbers[] = $phone_row['no_hp'];
                }
            }

            if (!empty($phone_numbers)) {
                foreach ($phone_numbers as $phone_number) {
                    $query_insert_notif = "INSERT INTO notif (phone_number, message, flags) VALUES ('$phone_number', '$message', '$flags')";
                    mysqli_query($koneksi, $query_insert_notif);
                }
            }
            echo '<script>
    var no_reg_sanitized = "' . preg_replace("/[^a-zA-Z0-9]+/", "", $reg_no) . '";
    var message = "NQR dengan nomor ' . $reg_no . ' telah di reject oleh Supervisor PPC(' . $nm_mgr_ppc . '). Klik link ini untuk memeriksa NQR: http://e-learning.stmi.ac.id/mhs/login";

    var numbers = ["081283265843", "089502233425"]; // Tambahkan nomor baru di sini

    numbers.forEach(function(number) {
        var formData = new FormData();
        formData.append("message", message);
        formData.append("number", number);

        fetch("https://3rxjp5-8000.csb.app/send-message", {
            method: "POST",
            body: formData
        })
        .then(() => {
            console.log("Pesan berhasil dikirim ke " + number);
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });

    // Menampilkan SweetAlert tanpa menunggu pesan WhatsApp terkirim
    Swal.fire({
        position: "center",
        icon: "error",
        title: "NQR Rejected",
        text: "NQR dengan nomor ' . $reg_no . ' telah di-reject oleh ' . $nm_mgr_ppc . ' pada ' . $dt_mgr_ppc . ' ",
        showConfirmButton: false,
        timer: 2000
    }).then(() => {
        window.location.href = "ap-mgr-ppc.php";
    });
</script>';
            exit(); // Make sure there is no output after this
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($koneksi);
        }

    }
    ?>

    <script>
        function showSuccessMessage() {
            // Menambahkan SweetAlert2
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Berhasil Approve",
                showConfirmButton: true,
            }).then(() => {
                // Menunda navigasi dengan 1 detik
                setTimeout(() => {
                    window.location.href = 'ap-fm.php';
                }, 1000);
            });
        }
    </script>
</body>

<script src="../../../assets/cdnjs/jquery.slim.min.js"></script>
<script src="../../../assets/package/dist/umd/popper.min.js"></script>
<script src="../../../assets/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>

<script>
    function updateTime() {
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();

        // Menambahkan leading zero jika angka kurang dari 10
        hours = (hours < 10 ? "0" : "") + hours;
        minutes = (minutes < 10 ? "0" : "") + minutes;
        seconds = (seconds < 10 ? "0" : "") + seconds;

        var formattedTime = hours + ":" + minutes + ":" + seconds;

        document.getElementById("current-time").innerText = formattedTime;
    }

    // Memanggil updateTime setiap detik
    setInterval(updateTime, 1000);

    // Panggil updateTime setelah halaman dimuat
    updateTime();
</script>

</html>
<style>
    .btn-primary.custom-button {
        color: white;
    }

    .btn-primary.custom-button:hover {
        background-color: white;
        color: #007bff;
        /* Bootstrap primary color */
    }

    .btn-danger.custom-button {
        color: white;
    }

    .btn-danger.custom-button:hover {
        background-color: white;
        color: #dc3545;
        /* Bootstrap danger color */
    }
</style>