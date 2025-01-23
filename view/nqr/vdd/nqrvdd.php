<?php
session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["dept"]) || $_SESSION["dept"] !== "VDD") {
    echo "Anda harus login terlebih dahulu";
    header("Location: ../../forbidden.php");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}

include(__DIR__ . '/../../../koneksi.php');
include(__DIR__ . '/../../../function.php');

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE Id = '$Id'");
while ($user_data = mysqli_fetch_array($query)) {
    $status = $user_data['status'];
    $status_vdd = $user_data['status_vdd'];
    $reg_no = $user_data['reg_no'];
    $dt_stc = $user_data['dt_stc'];
    $p = $user_data['p'];
    $pay = $user_data['pay'];
}
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
// $doi1 = 0;
// Tetapkan atribut checked sesuai dengan nilai dari database
$PayChecked = ($p === "1") ? "checked" : "";
$SendChecked = ($p === "2") ? "checked" : "";
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Buat NQR - NQR</title>
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
            <h1>Buat Laporan NQR</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dasbor-vdd.php">Home</a></li>
                    <li class="breadcrumb-item active">Membuat NQR</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Buat Laporan NQR</h5>

                            <!-- General Form Elements -->

                            <form method="POST" action="">

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Reg No</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?php echo $reg_no; ?>">
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Disposition of this claim</legend>
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
                                            <label class="form-check-label" for="cof2">
                                                Send The Replacement
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <?php if ($p !== "2"): ?>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Pay Compensation<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <textarea name="pay" class="form-control" rows="5"
                                            cols="40"><?php echo $pay; ?></textarea>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($p !== "1"): ?>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Send The Replacement</label>
                                    <div class="col-sm-8">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="stc" id="stcByAir"
                                                value="1" <?php echo $AirChecked; ?> disabled>
                                            <label class="form-check-label" for="stcByAir">By Air</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="stc" id="stcBySea"
                                                value="2" <?php echo $SeaChecked; ?> disabled>
                                            <label class="form-check-label" for="stcBySea">By Sea</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="replacementDate" class="col-sm-4 col-form-label">Replacement
                                        Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="datepicker1" name="dt_stc"
                                            value="<?php echo $dt_stc; ?>" disabled>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <br>

                                <?php if ($status_vdd !== "1"): ?>
                                <div class="row mb-3" id="feedbackDiv">
                                    <label for="inputText" class="col-sm-4 col-form-label">Feedback<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="feedback_vdd">
                                    </div>
                                </div>
                                <?php endif; ?>



                                <script>
                                // Ambil nilai status_vdd dari sumber data Anda atau tentukan nilainya
                                var status_vdd = /* nilai status_vdd dari sumber data Anda */ ;

                                // Periksa apakah status_vdd tidak sama dengan 1 dan tidak sama dengan 2
                                if (status_vdd !== 1 && status_vdd !== 2) {
                                    // Jika tidak sama dengan 1 atau 2, tampilkan elemen dengan ID feedbackDiv
                                    document.getElementById("feedbackDiv").style.display = "block";
                                }
                                </script>

                                <br>
                                <div class="col sm-6 text-end">
                                    <button class="btn btn-primary custom-button" type="submit" name="proses"
                                        value="Ubah">Submit</button>
                                    <button type="reset" class="btn btn-danger custom-button">Reset</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <?php include '../../../layout/footer.php'; ?>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../../../assets/sweetalert2/sweetalert2.all.min.js"></script>
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

    <?php
    // Proses form jika tombol proses diklik
    if (isset($_POST['proses'])) {

        $pay = isset($_POST['pay']) ? input($_POST['pay']) : '';
        $p = isset($_POST['p']) ? input($_POST['p']) : '';
        $feedback_vdd = isset($_POST['feedback_vdd']) ? input($_POST['feedback_vdd']) : '';
        date_default_timezone_set("Asia/Bangkok"); // Set zona waktu ke Asia/Bangkok
        $dt_op_vdd = date("Y-m-d H:i:s"); // Menggunakan format "YYYY-MM-DD HH:MM:SS" untuk tanggal dan waktu saat ini
        $nm_op_vdd = isset($_SESSION['name']) ? $_SESSION['name'] : '';

        // Eksekusi query update
        $query = "UPDATE transaksi SET pay='$pay', nm_op_vdd='$nm_op_vdd', dt_op_vdd='$dt_op_vdd', status_vdd='2', sts_op_vdd='1', sts_fm_vdd='', sts_spv_vdd='', sts_mgr_vdd='', feedback_vdd='$feedback_vdd' WHERE Id='$Id'";

        if (mysqli_query($koneksi, $query)) {
            $message = "Pemberitahuan NQR! NQR dengan nomor $reg_no telah dilanjutkan oleh $nm_op_vdd. Status menunggu approval foreman.";
            $flags = "queue";
            $query_npk = "SELECT npk FROM ct_users WHERE golongan = 3 AND acting = 2 AND dept = 'VDD'";
            $result_npk = mysqli_query($koneksi2, $query_npk);

            // Collect NPKs
            $npk_list = array();
            if ($result_npk) {
                while ($row = mysqli_fetch_assoc($result_npk)) {
                    $npk_list[] = "'" . $row['npk'] . "'";
                }
            }

            if (!empty($npk_list)) {
                // Convert NPK array to string for query
                $npk_list_str = implode(',', $npk_list);

                // Query to get phone numbers based on NPK list
                $query_phone = "SELECT no_hp FROM hp WHERE npk IN ($npk_list_str)";
                $result_phone = mysqli_query($koneksi4, $query_phone);

                $phone_numbers = array();
                if ($result_phone) {
                    while ($phone_row = mysqli_fetch_assoc($result_phone)) {
                        $phone_numbers[] = $phone_row['no_hp'];
                    }
                }

                if (!empty($phone_numbers)) {
                    // Insert notification for each phone number
                    foreach ($phone_numbers as $phone_number) {
                        $query_insert_notif = "INSERT INTO notif (phone_number, message, flags) VALUES ('$phone_number', '$message', '$flags')";
                        mysqli_query($koneksi, $query_insert_notif);
                    }
                }
            }

            // Menampilkan SweetAlert dan mengirim pesan
            echo '<script>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "NQR berhasil di-update",
                    text: "NQR dengan nomor ' . $reg_no . ' telah di-update oleh ' . $nm_op_vdd . ' pada ' . $dt_op_vdd . ' ",
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = "dasbor-vdd.php";
                });
            </script>';
            exit(); // Pastikan tidak ada output lagi setelah ini
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($koneksi);
        }
    }
    ?>


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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Assuming status_ppc is set somewhere in your PHP or you can retrieve it from your backend
        var status_vdd =
            <?php echo $status_vdd; ?>; // Assuming $status_ppc is the variable containing the status_ppc value

        // Get the feedback input element
        var feedbackDiv = document.getElementById('feedbackDiv');

        // Check the value of status_ppc and hide the feedback input accordingly
        if (status_vdd === 1 || status_vdd === 2) {
            feedbackDiv.style.display = 'none'; // Hide the feedbackDiv
        }
    });
    </script>
</body>
<script src="../../../assets/cdnjs/jquery.slim.min.js"></script>
<script src="../../../assets/package/dist/umd/popper.min.js"></script>
<script src="../../../assets/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>

</html>
<style>
.wajib {
    color: red;
}

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