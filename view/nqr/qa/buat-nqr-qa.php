<?php
session_start();

// Periksa apakah pengguna sudah login, jika belum, redirect ke halaman login
if (!isset($_SESSION["username"]) || !isset($_SESSION["dept"]) || $_SESSION["dept"] !== "QA") {
    echo "Anda harus login terlebih dahulu";
    header("Location: ../../forbidden.php");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}

include(__DIR__ . '/../../../koneksi.php');
include(__DIR__ . '/../../../function.php');

$process = isset($_GET['alert']) ? ($_GET['alert']) : false;
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
    <link href="../../../assets/slim-select/selectize.bootstrap5.min.css" rel="stylesheet">


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
    <header id="header" class="header fixed-top d-flex align-items-center">
        <?php include '../../../layout/header.php'; ?>
    </header>

    <aside id="sidebar" class="sidebar">
        <?php include '../../../layout/sidebar.php'; ?>
    </aside>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Buat Laporan NQR</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dasbor.php">Home</a></li>
                    <li class="breadcrumb-item active">Membuat NQR</li>
                </ol>
            </nav>
        </div>

        <!-- Tampilkan pesan -->
        <!-- <?php if (!empty($msg)): ?> -->
        <div id="successMessage" class="alert alert-success" role="alert">
            <?php echo $msg; ?>
        </div>
        <?php endif; ?>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Buat Laporan NQR</h5>
                            <form id="myForm" method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="datepicker" class="col-sm-4 col-form-label">Issued Date<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="datepicker" name="iss_dt"
                                            autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="rece_no" class="col-sm-4 col-form-label">Receiv No</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="rece_no" name="rece_no">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="supp_name" class="col-sm-4 col-form-label">Supplier Name<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <select id="supp" name="supp_name" required>
                                            <option value="" disabled selected hidden>Select Supplier</option>
                                            <?php
                                            $query = mysqli_query($koneksi, "SELECT * FROM supplier");
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo "<option value='" . $row['nama'] . "'>" . $row['bpid'] . " - " . $row['nama'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Part Name<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="part_name" data-live-search="true" required>
                                            <option value="" disabled selected hidden>Select Part Name</option>
                                            <?php
                                            // Menambahkan klausa WHERE untuk memfilter status
                                            $query = mysqli_query($koneksi, "SELECT * FROM item");
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo "<option value='" . $row['desk'] . "'>" . $row['desk'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Part No<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="part_no" data-live-search="true" class="selectpicker"
                                            data-live-search-placeholder="Search" required>
                                            <option value="" disabled selected hidden>Select Part Number</option>
                                            <?php
                                            $query = mysqli_query($koneksi, "SELECT * FROM item");
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo "<option value='" . $row['no'] . "'>" . $row['no'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">PO No<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="po_no" name="po_no" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">No.Invoice<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="invoice" name="invoice" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Order<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="order_no" name="order_no" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Total Delivery<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="total_del" name="total_del"
                                            oninput="formatNumber(this)" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Total Claim<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="total_claim" name="total_claim"
                                            oninput="formatNumber(this)" required>
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Type of NQR<span class="wajib">*</span>
                                    </legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info" id="info1"
                                                value="1" required>
                                            <label class="form-check-label" for="info1">
                                                Claim
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info" id="info2"
                                                value="2" required>
                                            <label class="form-check-label" for="info2">
                                                Complaint(Information)
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Delivery Date<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="datepicker_dev" name="dev_dt"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Location Claim Occur<span
                                            class="wajib">*</span></legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco1" value="1"
                                                required>
                                            <label class="form-check-label" for="lco1">
                                                Receiving Insp
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco2" value="2"
                                                required>
                                            <label class="form-check-label" for="lco2">
                                                In-Process
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco3" value="3"
                                                required>
                                            <label class="form-check-label" for="lco3">
                                                Customer
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>


                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Disposition of inventory<span
                                            class="wajib">*</span>
                                    </legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios"
                                                id="gridRadios2" value="option2" onchange="showAdditionalOptions()">
                                            <label class="form-check-label" for="gridRadios2">
                                                At customer
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios"
                                                id="gridRadios3" value="option3" onchange="showAdditionalOptions()"
                                                required>
                                            <label class="form-check-label" for="gridRadios3">
                                                At PT KYBI
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div id="additionalOptions">
                                    <!-- At pt kybi options -->
                                    <div id="additionalOptionsPtKybi" style="display: none;">
                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-4 pt-0">At PT KYBI</legend>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="doi2" id="doi2"
                                                        value="2">
                                                    <label class="form-check-label" for="sortedBySupplier">Sorted by
                                                        Supplier</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="doi2" id="doi2"
                                                        value="3">
                                                    <label class="form-check-label" for="sortedByPTKYBI">Sorted by PT
                                                        KYBI</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="doi2" id="doi2"
                                                        value="4">
                                                    <label class="form-check-label" for="keepToUse">Keep to use</label>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <!-- At customer options -->
                                    <div id="additionalOptionsCustomer" style="display: none;">
                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-4 pt-0">Additional Options for At
                                                Customer</legend>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="doi1" id="doi1"
                                                        value="1">
                                                    <label class="form-check-label" for="sortedByCustomer">Sorted by
                                                        Customer</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="doi1" id="doi1"
                                                        value="2">
                                                    <label class="form-check-label" for="sortedBySupplier">Sorted by
                                                        Supplier</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="doi1" id="doi1"
                                                        value="3">
                                                    <label class="form-check-label" for="sortedByPTKYBI">Sorted by PT
                                                        KYBI</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="doi1" id="doi1"
                                                        value="4">
                                                    <label class="form-check-label" for="keepToUse">Keep to use</label>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <script>
                                function showAdditionalOptions() {
                                    var gridRadios2 = document.getElementById('gridRadios2');
                                    var additionalOptionsCustomer = document.getElementById(
                                        'additionalOptionsCustomer');
                                    var additionalOptionsPtKybi = document.getElementById('additionalOptionsPtKybi');

                                    if (gridRadios2.checked) {
                                        additionalOptionsCustomer.style.display = 'block';
                                        additionalOptionsPtKybi.style.display = 'none';
                                        clearRadioSelections('additionalOptionsCustomer');
                                    } else {
                                        additionalOptionsCustomer.style.display = 'none';
                                        additionalOptionsPtKybi.style.display = 'block';
                                        clearRadioSelections('additionalOptionsPtKybi');
                                    }
                                }

                                function clearRadioSelections(containerId) {
                                    var container = document.getElementById(containerId);
                                    var radios = container.querySelectorAll('input[type="radio"]');
                                    radios.forEach(function(radio) {
                                        radio.checked = false;
                                    });
                                }
                                </script>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Claim occurance freq<span
                                            class="wajib">*</span></legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof1" value="1"
                                                required onclick="toggleRoutinInput()">
                                            <label class="form-check-label" for="cof1">
                                                First Time
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof2" value="2"
                                                required onclick="toggleRoutinInput()">
                                            <label class="form-check-label" for="cof2">
                                                Reoccurred/routin
                                            </label>
                                        </div>
                                        <div id="reoccurredInput" style="display: none;">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="routin" name="routin"
                                                        oninput="formatNumber(this)">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="inputText" class="col-sm-4 col-form-label">Times</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <script>
                                function toggleRoutinInput() {
                                    var cof1 = document.getElementById('cof1');
                                    var routinInput = document.getElementById('reoccurredInput');

                                    if (cof1.checked) {
                                        routinInput.style.display = 'none';
                                        document.getElementById('routin').value = ''; // Reset the value
                                    } else {
                                        routinInput.style.display = 'block';
                                    }
                                }
                                </script>

                                </fieldset>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Disposition of defect part<span
                                            class="wajib">*</span>
                                    </legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dodp" id="dodp1"
                                                value="1" required>
                                            <label class="form-check-label" for="dodp1">
                                                Keep to use
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dodp" id="dodp2"
                                                value="2" required>
                                            <label class="form-check-label" for="dodp2">
                                                Return to supplier
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dodp" id="dodp3"
                                                value="3" required>
                                            <label class="form-check-label" for="dodp3">
                                                Scrapped at PT.KYBI
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Problem<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="problem" name="problem" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">QTY Problem<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="qty_problem" name="qty_problem"
                                            oninput="formatNumber(this)" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="note" class="col-sm-4 col-form-label">Catatan<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" style="height: 100px" id="note" name="note"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="fileInput" class="col-sm-4 col-form-label">Attachment<span
                                            class="wajib">*</span>
                                        <small class="form-text text-muted">(PDF only, max 2MB)</small>
                                        <span id="fileError" class="text-danger d-block"></span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control mb-2" name="file" id="fileInput">
                                        <div id="filePreview"></div>
                                        <?php if ($process == 'gagal_ekstensi'): ?>
                                        <div class="alert alert-danger mt-2">
                                            Jenis file tidak diizinkan
                                        </div>
                                        <?php elseif ($process == 'gagal_ukuran'): ?>
                                        <div class="alert alert-danger mt-2">
                                            Ukuran file terlalu besar
                                        </div>
                                        <?php elseif ($process == 'berhasil'): ?>
                                        <div class="alert alert-success mt-2">
                                            Upload berhasil
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- Tambahkan elemen form lainnya sesuai kebutuhan -->

                                <div class="col sm-6 text-end">
                                    <button class="btn btn-primary custom-button" type="submit"
                                        name="submit">Submit</button>
                                    <button type="reset" class="btn btn-danger custom-button"
                                        form="myForm">Reset</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
    </main>
    <footer id="footer" class="footer">
        <?php include '../../../layout/footer.php'; ?>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script src="../../../assets/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- Vendor JS Files -->
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

    <?php

    $process = isset($_GET['alert']) ? ($_GET['alert']) : false;
    // Inisialisasi variabel-variabel yang digunakan dalam query SQL
    $reg_no = '';
    $iss_dt = isset($_POST['iss_dt']) ? date('Y/m/d', strtotime($_POST['iss_dt'])) : '';
    $rece_no = isset($_POST['rece_no']) ? input($_POST['rece_no']) : '';
    $supp_name = isset($_POST['supp_name']) ? $_POST['supp_name'] : '';
    $part_name = isset($_POST['part_name']) ? $_POST['part_name'] : '';
    $part_no = isset($_POST['part_no']) ? $_POST['part_no'] : '';
    $po_no = isset($_POST['po_no']) ? input($_POST['po_no']) : '';
    $invoice = isset($_POST['invoice']) ? input($_POST['invoice']) : '';
    $order_no = isset($_POST['order_no']) ? input($_POST['order_no']) : '';
    $total_del = isset($_POST['total_del']) ? input($_POST['total_del']) : '';
    $total_claim = isset($_POST['total_claim']) ? input($_POST['total_claim']) : '';
    $info = isset($_POST['info']) ? $_POST['info'] : '';
    $dev_dt = isset($_POST['dev_dt']) ? date('Y/m/d', strtotime($_POST['dev_dt'])) : '';
    $lco = isset($_POST['lco']) ? $_POST['lco'] : '';
    $doi1 = isset($_POST['doi1']) ? $_POST['doi1'] : '';
    $doi2 = isset($_POST['doi2']) ? $_POST['doi2'] : '';
    $cof = isset($_POST['cof']) ? $_POST['cof'] : '';
    $routin = isset($_POST['routin']) ? $_POST['routin'] : '';
    $dodp = isset($_POST['dodp']) ? $_POST['dodp'] : '';
    $problem = isset($_POST['problem']) ? input($_POST['problem']) : '';
    $qty_problem = isset($_POST['qty_problem']) ? input($_POST['qty_problem']) : '';
    $status = 1; // Atur status ke 1
    $nm_op_qa = isset($_SESSION['name']) ? $_SESSION['name'] : '';
    $note = isset($_POST['note']) ? input($_POST['note']) : '';
    $sts_op_qa = 1;
    date_default_timezone_set("Asia/Bangkok"); // Set zona waktu ke Asia/Bangkok
    $dt_op_qa = date("Y-m-d H:i:s"); // Menggunakan format "YYYY-MM-DD HH:MM:SS" untuk tanggal dan waktu saat ini
    
    // Ambil ID terbaru dari database
    $result = mysqli_query($koneksi, "SELECT MAX(Id) AS max_id FROM transaksi");
    $row = mysqli_fetch_assoc($result);
    $max_id = $row['max_id'];
    $next_id = $max_id + 1; // ID berikutnya
    
    // Format NQR
    function bulan_romawi($bulan)
    {
        $romawi = array(
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        );
        return $romawi[$bulan];
    }

    // Format nomor registrasi
    $reg_no = $next_id . "/NQR/" . bulan_romawi(date("n")) . "/" . date("Y");

    // Periksa apakah ada parameter Id yang dikirim melalui GET
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
        $target_dir = "../../../file/";
        $original_file_name = basename($_FILES["file"]["name"]);
        $timestamp = time(); // Timestamp saat ini
        $unique_filename = $timestamp . '_' . $original_file_name; // Gabungkan timestamp dengan nama file asli
        $target_file = $target_dir . $unique_filename;
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Periksa apakah file adalah PDF
        if ($fileType != "pdf") {
            echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'File harus berformat PDF',
                    showConfirmButton: false,
                    timer: 2000
                });
              </script>";
            $uploadOk = 0;
        }

        // Periksa ukuran file (maksimum 2MB)
        if ($_FILES["file"]["size"] > 2 * 1024 * 1024) {
            echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Ukuran file terlalu besar. Maksimum 2MB.',
                    showConfirmButton: false,
                    timer: 2000
                });
              </script>";
            $uploadOk = 0;
        }

        // Jika semua kondisi terpenuhi, coba upload file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // Jika file berhasil diupload, lanjutkan dengan query SQL
                $query = "INSERT INTO transaksi (att, reg_no, iss_dt, rece_no, supp_name, part_name, part_no, po_no, invoice, order_no, total_del, total_claim, info, dev_dt, lco, doi1, doi2, cof, routin, dodp, problem, qty_problem, status, nm_op_qa, note, sts_op_qa, dt_op_qa) 
                VALUES ('$unique_filename', '$reg_no', '$iss_dt', '$rece_no', '$supp_name', '$part_name', '$part_no', '$po_no', '$invoice', '$order_no', '$total_del', '$total_claim', '$info', '$dev_dt', '$lco', '$doi1', '$doi2', '$cof', '$routin', '$dodp', '$problem', '$qty_problem', '$status', '$nm_op_qa','$note','$sts_op_qa','$dt_op_qa') 
                ON DUPLICATE KEY UPDATE att = VALUES(att), reg_no = VALUES(reg_no), iss_dt = VALUES(iss_dt), rece_no = VALUES(rece_no), supp_name = VALUES(supp_name), part_name = VALUES(part_name), part_no = VALUES(part_no), po_no = VALUES(po_no), invoice = VALUES(invoice), order_no = VALUES(order_no), total_del = VALUES(total_del), total_claim = VALUES(total_claim), info = VALUES(info), dev_dt = VALUES(dev_dt), lco = VALUES(lco), doi1 = VALUES(doi1), doi2 = VALUES(doi2), cof = VALUES(cof), routin = VALUES(routin), dodp = VALUES(dodp), problem = VALUES(problem), qty_problem = VALUES(qty_problem), status = VALUES(status), nm_op_qa = VALUES(nm_op_qa), note = VALUES(note), sts_op_qa = VALUES(sts_op_qa), dt_op_qa = VALUES(dt_op_qa)";

                if (mysqli_query($koneksi, $query)) {
                    $message = "Pemberitahuan NQR! NQR dengan nomor $reg_no telah dibuat oleh $nm_op_qa. Status menunggu approval foreman.";
                    $flags = "queue";
                    $query_phone = "SELECT no_hp FROM isd 
                                    LEFT JOIN ct_users ON ct_users.npk = isd.npk 
                                    WHERE ct_users.golongan = 3 AND ct_users.acting = 2 AND dept = 'QA'";
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
                        var message = "NQR dengan nomor ' . $reg_no . ' telah dibuat oleh ' . $nm_op_qa . '. Klik link ini untuk memeriksa NQR: http://e-learning.stmi.ac.id/mhs/login";
                        
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
                            title: "NQR berhasil disimpan",
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = "dasbor.php";
                        });
                    </script>';
                } else {
                    echo "<script>
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Gagal menyimpan data NQR',
                            showConfirmButton: false,
                            timer: 2000
                        });
                      </script>";
                }
            } else {
                echo "<script>
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Gagal mengunggah file',
                        showConfirmButton: false,
                        timer: 2000
                    });
                  </script>";
            }
        }
    }

    ?>

    <script>
    document.getElementById('fileInput').addEventListener('change', function() {
        const file = this.files[0];
        const fileError = document.getElementById('fileError');
        const filePreview = document.getElementById('filePreview');
        fileError.textContent = '';
        filePreview.innerHTML = '';

        if (file) {
            const fileType = file.type;
            const fileSize = file.size;

            // Check if file is a PDF
            if (fileType !== 'application/pdf') {
                fileError.textContent = 'Format file tidak sesuai(PDF Only)';
                return;
            }
            // Check if file size exceeds 2MB
            if (fileSize > 2 * 1024 * 1024) {
                fileError.textContent = 'Ukuran file terlalu besar*';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.createElement('embed');
                preview.setAttribute('src', event.target.result);
                preview.setAttribute('class', 'mb-12'); // Menyesuaikan kelas CSS
                preview.setAttribute('width', '100%'); // Lebar 100%
                preview.setAttribute('height', '500px'); // Sesuaikan jika diperlukan
                filePreview.appendChild(preview);
            }

            reader.readAsDataURL(file);
        } else {
            filePreview.innerHTML = 'No file selected';
        }
    });
    </script>

    <script>
    document.querySelectorAll('input[type="radio"][name="cof"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            var reoccurredInput = document.getElementById('reoccurredInput');
            if (this.value === '2') {
                reoccurredInput.style.display = 'block';
            } else {
                reoccurredInput.style.display = 'none';
            }
        });
    });
    </script>

    <script>
    function formatNumber(input) {
        // Menghapus semua karakter selain angka
        var value = input.value.replace(/\D/g, '');

        // Menambahkan titik setiap 3 digit dari belakang
        var formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        // Memasukkan kembali nilai yang sudah diformat ke dalam input
        input.value = formattedValue;
    }
    </script>

    <script>
    // Atur pesan sukses untuk ditampilkan selama 5 detik
    setTimeout(function() {
        document.getElementById("successMessage").style.display = "none";
    }, 2000);
    </script>

    <script>
    $(function() {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true
        });
    });
    </script>

    <script>
    $(function() {
        $("#datepicker_dev").datepicker({
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
    <script src="../../../assets/slim-select/selectize.min.js"></script>
    <script>
    $(function() {
        $("#supp").selectize();
        $("select[name='part_name']").selectize();
        $("select[name='part_no']").selectize();
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