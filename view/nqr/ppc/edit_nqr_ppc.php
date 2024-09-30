<?php
session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["dept"]) || $_SESSION["dept"] !== "PPC") {
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
    $reg_no = $user_data['reg_no'];
    $status_ppc = $user_data['status_ppc']; // Definisikan variabel $status_ppc
}
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
    <link href="../../../asset/jQuery/jquery-ui-1.13.2.custom/jquery-ui.css" rel="stylesheet">

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
                    <li class="breadcrumb-item"><a href="dasborppc.php">Home</a></li>
                    <li class="breadcrumb-item active">Membuat NQR</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <form action="" method="post" id="myForm">
            <div class="row mb-3">
                <label for="inputText" class="col-sm-4 col-form-label">Reg No</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" readonly value="<?php echo $reg_no; ?>">
                </div>
            </div>

            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-4 pt-0">Disposition of This Claim<span class="wajib">*</span>
                </legend>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridRadios2" name="p" value="1"
                            onchange="showAdditionalOptions()" required>
                        <label class="form-check-label" for="gridRadios2">
                            Pay compensation
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridRadios3" name="p" value="2"
                            onchange="showAdditionalOptions()" required>
                        <label class="form-check-label" for="gridRadios3">
                            Send the replacement
                        </label>
                    </div>
                </div>
            </fieldset>

            <div id="additionalOptions">
                <!-- At pt kybi options -->
                <div id="additionalOptionsPtKybi" style="display: none;">
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-4 pt-0">Send the Replacement</legend>
                        <div class="col-sm-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stc" id="stcByAir" value="1"
                                    onclick="toggleDateInput()">
                                <label class="form-check-label" for="stcByAir">By Air</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stc" id="stcBySea" value="2"
                                    onclick="toggleDateInput()">
                                <label class="form-check-label" for="stcBySea">By Sea</label>
                            </div>
                        </div>
                    </fieldset>
                    <!-- Date input -->
                    <div id="replacementDateInput" style="display: none;">
                        <div class="form-group row">
                            <label for="replacementDate" class="col-sm-4 col-form-label">Replacement Date</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="datepicker1" name="dt_stc"
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row mb-3" id="feedbackDiv">
                <label for="inputText" class="col-sm-4 col-form-label">Feedback<span class="wajib">*</span></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="feedback_ppc">
                </div>
            </div>
            </div>

            <br>
            <div class="col sm-6 text-end">
                <button class="btn btn-primary custom-button" type="submit" name="proses" value="Ubah">Submit</button>
                <button type="reset" class="btn btn-danger custom-button" form="myForm">Reset</button>
            </div>
        </form>

    </main><!-- End #main -->

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
    <script src="../../../asset/jQuery/jquery-3.6.0.js"></script>
    <script src="../../../asset/jQuery/jquery-ui-1.13.2.custom/jquery-ui.js"></script>

    <!-- Template Main JS File -->
    <script src="../../../assets/js/main.js"></script>
    <script>
        function showAdditionalOptions() {
            var customerRadio = document.getElementById("gridRadios2");
            var ptKybiRadio = document.getElementById("gridRadios3");
            var additionalOptionsPtKybiDiv = document.getElementById("additionalOptionsPtKybi");
            var additionalOptionsCustomerDiv = document.getElementById("additionalOptionsCustomer");

            if (ptKybiRadio.checked) {
                additionalOptionsPtKybiDiv.style.display = "block";
                additionalOptionsCustomerDiv.style.display = "none";
            } else if (customerRadio.checked) {
                additionalOptionsPtKybiDiv.style.display = "none";
                additionalOptionsCustomerDiv.style.display = "block";
            } else {
                additionalOptionsPtKybiDiv.style.display = "none";
                additionalOptionsCustomerDiv.style.display = "none";
            }
        }
    </script>


    <?php
    // Proses form jika tombol proses diklik
    if (isset($_POST['proses'])) {
        $pay = isset($_POST['pay']) ? $_POST['pay'] : '';
        $stc = isset($_POST['stc']) ? $_POST['stc'] : '';
        $dt_stc = !empty($_POST['dt_stc']) ? date('Y/m/d', strtotime($_POST['dt_stc'])) : '0000-00-00'; // Correct date format
        date_default_timezone_set("Asia/Bangkok"); // Set zona waktu ke Asia/Bangkok
        $dt_op_ppc = date("Y-m-d H:i:s"); // Menggunakan format "YYYY-MM-DD HH:MM:SS" untuk tanggal dan waktu saat ini
        $nm_op_ppc = isset($_SESSION['name']) ? $_SESSION['name'] : '';
        $p = isset($_POST['p']) ? $_POST['p'] : '';
        $feedback_ppc = isset($_POST['feedback_ppc']) ? input($_POST['feedback_ppc']) : '';

        // Eksekusi query update
        $query = "UPDATE transaksi SET p='$p', pay='$pay', stc='$stc', dt_stc='$dt_stc', nm_op_ppc='$nm_op_ppc', dt_op_ppc='$dt_op_ppc', status_ppc='2', sts_op_ppc='1', sts_fm_ppc='', sts_spv_ppc='', sts_mgr_ppc='', feedback_ppc='$feedback_ppc' WHERE Id='$Id'";

        if (mysqli_query($koneksi, $query)) {
            $message = "Pemberitahuan NQR! Judgement NQR dengan nomor $reg_no telah diisi oleh $nm_op_ppc. Status menunggu approval foreman.";
            $flags = "queue";
            $query_phone = "SELECT no_hp FROM isd 
                            LEFT JOIN ct_users ON ct_users.npk = isd.npk 
                            WHERE ct_users.golongan = 3 AND ct_users.acting = 2 AND dept = 'PPC'";
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

            // Menampilkan SweetAlert dan mengirim pesan
            echo '<script>
                var no_reg_sanitized = "' . preg_replace("/[^a-zA-Z0-9]+/", "", $reg_no) . '";
                var message = "NQR dengan nomor ' . $reg_no . ' telah di-update oleh operator PPC (' . $nm_op_ppc . '). Klik link ini untuk memeriksa NQR: http://e-learning.stmi.ac.id/mhs/login";

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
                    title: "NQR berhasil di-update",
                    text: "NQR dengan nomor ' . $reg_no . ' telah di-update oleh ' . $nm_op_ppc . ' pada ' . $dt_op_ppc . ' ",
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = "dasborppc.php";
                });
            </script>';
            exit(); // Pastikan tidak ada output lagi setelah ini
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($koneksi);
        }
    }
    ?>

    <script>
        // Function to show/hide date input based on selection
        function toggleDateInput() {
            var selectedOption = document.querySelector('input[name="stc"]:checked').value;
            var dateInput = document.getElementById('replacementDateInput');

            if (selectedOption === '1' || selectedOption === '2') {
                dateInput.style.display = 'block';
            } else {
                dateInput.style.display = 'none';
            }
        }
    </script>

    <script>
        $(function () {
            $("#datepicker1").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });
    </script>

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
        function resetForm() {
            // Mendapatkan referensi form
            var form = document.getElementById('form-control'); // Ganti 'form_id' dengan ID form Anda

            // Mereset form
            form.reset();
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Assuming status_ppc is set somewhere in your PHP or you can retrieve it from your backend
            var status_ppc =
                <?php echo $status_ppc; ?>; // Assuming $status_ppc is the variable containing the status_ppc value

            // Get the feedback input element
            var feedbackDiv = document.getElementById('feedbackDiv');

            // Check the value of status_ppc and hide the feedback input accordingly
            if (status_ppc === 1 || status_ppc === 2) {
                feedbackDiv.style.display = 'none'; // Hide the feedbackDiv
            }
        });
    </script>

</body>

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