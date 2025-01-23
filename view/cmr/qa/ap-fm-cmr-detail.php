<?php
session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["dept"]) || $_SESSION["dept"] !== "QA" || !in_array($_SESSION["role"], ["FMQA", "SPVQA", "MGRQA"])) {
    echo "Anda harus login terlebih dahulu";
    header("Location: ../../forbidden.php");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}

include(__DIR__ . '/../../../koneksi.php');
include(__DIR__ . '/../../../function.php');

$Id = isset($_GET['Id']) ? $_GET['Id'] : '';
$query = mysqli_query($koneksi3, "SELECT t.*, s.*
    FROM transaksi t
    INNER JOIN status_cmr s ON t.Id = s.Id
    WHERE t.Id = '$Id'");

if (!$query) {
    die('Query error: ' . mysqli_error($koneksi3));
}

$num_rows = mysqli_num_rows($query);

if ($num_rows > 0) {
    while ($user_data = mysqli_fetch_array($query)) {
        // Proses data di sini
        $sts_cmr = $user_data['sts_cmr'];
        $cmr_no = isset($user_data['cmr_no']) ? $user_data['cmr_no'] : ''; // Perbaikan disini
        $iss_dt = isset($user_data['iss_dt']) ? date('Y/m/d', strtotime($user_data['iss_dt'])) : '';
        $found_dt = isset($user_data['found_dt']) ? date('Y/m/d', strtotime($user_data['found_dt'])) : '';
        $ar_dt = isset($user_data['ar_dt']) ? date('Y/m/d', strtotime($user_data['ar_dt'])) : '';
        $supp_name = $user_data['supp_name'];
        $part_name = $user_data['part_name'];
        $part_num = $user_data['part_num'];
        $product = $user_data['product'];
        $model = $user_data['model'];
        $invoice = $user_data['invoice'];
        $order_no = $user_data['order_no'];
        $qty_order = $user_data['qty_order'];
        $qty_del = $user_data['qty_del'];
        $qty_def = $user_data['qty_def'];
        $crate_num = $user_data['crate_num'];
        $problem = $user_data['problem'];
        $feedback_qa = $user_data['feedback_qa'];
        $att = $user_data['att'];

        // Lakukan apa pun yang perlu dilakukan dengan data
    }
} else {
    echo "Tidak ada data yang sesuai dengan ID yang diberikan.";
}

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi3, "SELECT lco FROM transaksi WHERE Id = '$Id'");
if ($queryInfo) {
    // Jika query berhasil, ambil nilai dari hasil query
    $row = mysqli_fetch_assoc($queryInfo);
    // Tetapkan nilai ke variabel $infoValue
    $lco = $row['lco'];
} else {
    // Jika query gagal, atur nilai default
    $lco = "1"; // Nilai default
}

// Tetapkan atribut checked sesuai dengan nilai dari database
$RINChecked = ($lco === "1") ? "checked" : "";
$INPChecked = ($lco === "2") ? "checked" : "";
$CUSChecked = ($lco === "3") ? "checked" : "";
?>

<?php
// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi3, "SELECT doi1 FROM transaksi WHERE Id = '$Id'");
if ($queryInfo) {
    // Jika query berhasil, ambil nilai dari hasil query
    $row = mysqli_fetch_assoc($queryInfo);
    // Tetapkan nilai ke variabel $infoValue
    $doi1 = $row['doi1'];
} else {
    // Jika query gagal, atur nilai default
    $doi1 = "1"; // Nilai default
}

// Tetapkan atribut checked sesuai dengan nilai dari database
$AChecked = ($doi1 === "1") ? "checked" : "";
$BChecked = ($doi1 === "2") ? "checked" : "";
$CChecked = ($doi1 === "3") ? "checked" : "";

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';


// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi3, "SELECT doi2 FROM transaksi WHERE Id = '$Id'");
if ($queryInfo) {
    // Jika query berhasil, ambil nilai dari hasil query
    $row = mysqli_fetch_assoc($queryInfo);
    // Tetapkan nilai ke variabel $infoValue
    $doi2 = $row['doi2'];
} else {
    // Jika query gagal, atur nilai default
    $doi2 = "1"; // Nilai default
}

// Tetapkan atribut checked sesuai dengan nilai dari database

$SPKChecked = ($doi2 === "1") ? "checked" : "";
$KTUChecked = ($doi2 === "2") ? "checked" : "";
$RTKChecked = ($doi2 === "3") ? "checked" : "";
$OChecked = ($doi2 === "4") ? "checked" : "";

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi3, "SELECT cof FROM transaksi WHERE Id = '$Id'");
if ($queryInfo) {
    // Jika query berhasil, ambil nilai dari hasil query
    $row = mysqli_fetch_assoc($queryInfo);
    // Tetapkan nilai ke variabel $infoValue
    $cof = $row['cof'];
} else {
    // Jika query gagal, atur nilai default
    $cof = "1"; // Nilai default
}
// $doi1 = 0;
// Tetapkan atribut checked sesuai dengan nilai dari database
$FTChecked = ($cof === "1") ? "checked" : "";
$RUChecked = ($cof === "2") ? "checked" : "";
$INhecked = ($cof === "3") ? "checked" : "";
$COChecked = ($cof === "4") ? "checked" : "";
$OTChecked = ($cof === "5") ? "checked" : "";

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi3, "SELECT dispo FROM transaksi WHERE Id = '$Id'");
if ($queryInfo) {
    // Jika query berhasil, ambil nilai dari hasil query
    $row = mysqli_fetch_assoc($queryInfo);
    // Tetapkan nilai ke variabel $infoValue
    $dispo = $row['dispo'];
} else {
    // Jika query gagal, atur nilai default
    $dispo = "1"; // Nilai default
}
// $doi1 = 0;
// Tetapkan atribut checked sesuai dengan nilai dari database
$KChecked = ($dispo === "1") ? "checked" : "";
$RKYBChecked = ($dispo === "2") ? "checked" : "";
$SAKChecked = ($dispo === "3") ? "checked" : "";


$process = isset($_GET['alert']) ? $_GET['alert'] : false;

// Fungsi untuk dekripsi token

$currentYear = date("Y");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit NQR - NQR</title>
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
    <link href="asset/jQuery/jquery-ui-1.13.2.custom/jquery-ui.css" rel="stylesheet">
    <!-- <link href="../../../assets/slim-select/slimselect.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.8.0/slimselect.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.3.1/css/tom-select.min.css"> -->
    <link href="../../../assets/slim-select/selectize.bootstrap5.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.bootstrap5.min.css"> -->

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
            <h1>Approval by Foreman</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dasborcmr.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="ap-fm-cmr.php">List NQR</a></li>
                    <li class="breadcrumb-item active">Approval CMR</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data CMR</h5>

                            <!-- General Form Elements -->
                            <form method="post" enctype="multipart/form-data">

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">CMR No</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="cmr_no" class="form-control" readonly
                                            value="<?php echo $cmr_no; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">CMR No</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="cmr_no" class="form-control" readonly
                                            value="<?php echo $supp_name; ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Issued Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="datepicker1" readonly name="iss_dt"
                                            value="<?php echo $iss_dt; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Found Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="datepicker2" readonly
                                            name="found_dt" value="<?php echo $found_dt; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">A/R Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="datepicker3" readonly name="ar_dt"
                                            value="<?php echo $ar_dt; ?>">
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Location Claim Occur</legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco1" value="1"
                                                <?php echo $RINChecked; ?> disabled>
                                            <label class="form-check-label" for="lco1">
                                                Receiving Insp
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco2" value="2"
                                                <?php echo $INPChecked; ?> disabled>
                                            <label class="form-check-label" for="lco2">
                                                In-Process
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco3" value="3"
                                                <?php echo $CUSChecked; ?> disabled>
                                            <label class="form-check-label" for="lco3">
                                                Customer
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="row mb-3">
                                    <label for="rece_no" class="col-sm-12 col-form-label">Disposition of
                                        Inventory</label>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">At customer</legend>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi1" id="doi11"
                                                value="1" required <?php echo $AChecked; ?> disabled>
                                            <label class="form-check-label" for="doi11">
                                                Sorted by customer
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi1" id="doi12"
                                                value="2" required <?php echo $BChecked; ?> disabled>
                                            <label class="form-check-label" for="doi12">
                                                Sorted by PT.KYB
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi1" id="doi13"
                                                value="3" required <?php echo $CChecked; ?> disabled>
                                            <label class="form-check-label" for="doi13">
                                                Keep to use
                                            </label>
                                        </div>
                                    </div>

                                    <legend class="col-form-label col-sm-2 pt-0">At PY KYBI</legend>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi2" id="doi21"
                                                value="1" required <?php echo $SPKChecked; ?> disabled>
                                            <label class="form-check-label" for="doi21">
                                                Sorted bt PT KYBI
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi2" id="doi22"
                                                value="2" required <?php echo $KTUChecked; ?> disabled>
                                            <label class="form-check-label" for="doi22">
                                                Keep to use
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi2" id="doi23"
                                                value="3" required <?php echo $RTKChecked; ?> disabled>
                                            <label class="form-check-label" for="doi23">
                                                Return to KYB
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi2" id="doi24"
                                                value="4" required <?php echo $OChecked; ?> disabled>
                                            <label class="form-check-label" for="doi24">
                                                Other
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Claim occurance frequency</legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof1" value="1"
                                                required <?php echo $FTChecked; ?> disabled>
                                            <label class="form-check-label" for="cof1">
                                                First Time
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof2" value="2"
                                                required <?php echo $RUChecked; ?> disabled>
                                            <label class="form-check-label" for="cof2">
                                                Reoccurred
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof3" value="3"
                                                required <?php echo $INhecked; ?> disabled>
                                            <label class="form-check-label" for="lco3">
                                                Intermittently
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof4" value="4"
                                                required <?php echo $COChecked; ?> disabled>
                                            <label class="form-check-label" for="lco4">
                                                Continously
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof5" value="5"
                                                required <?php echo $OTChecked; ?> disabled>
                                            <label class="form-check-label" for="lco5">
                                                Other
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Dispostion of Defect parts</legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dispo" id="dispo1"
                                                value="1" required <?php echo $KChecked; ?> disabled>
                                            <label class="form-check-label" for="dispo1">
                                                Keep to use
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dispo" id="dispo2"
                                                value="2" required <?php echo $RKYBChecked; ?> disabled>
                                            <label class="form-check-label" for="dispo2">
                                                Retrun to KYB
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dispo" id="dispo3"
                                                value="3" required <?php echo $SAKChecked; ?> disabled>
                                            <label class="form-check-label" for="lco3">
                                                Scrapped at PT KYB
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">No Invoice</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="invoice" class="form-control"
                                            value="<?php echo $invoice; ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Order No</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="order_no" class="form-control"
                                            value="<?php echo $order_no; ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Product</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="product" class="form-control"
                                            value="<?php echo $product; ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Model</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="model" class="form-control"
                                            value="<?php echo $model; ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Part Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="model" class="form-control"
                                            value="<?php echo $part_name; ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Part No</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="model" class="form-control"
                                            value="<?php echo $part_num; ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Quantity Ordered</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="qty_order" class="form-control"
                                            value="<?php echo $qty_order; ?>" oninput="formatNumber(this)" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Quantity delivered</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="qty_del" class="form-control"
                                            value="<?php echo $qty_del; ?>" oninput="formatNumber(this)" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Quantity Defect</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="qty_def" class="form-control"
                                            value="<?php echo $qty_def; ?>" oninput="formatNumber(this)" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Crate Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="crate_num" class="form-control"
                                            value="<?php echo $crate_num; ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Problem</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="problem" class="form-control"
                                            value="<?php echo $problem ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">File yang Diunggah</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                            value="<?php echo isset($file_name) ? $file_name : '' ?>">
                                    </div>
                                </div>

                                <!-- <div class="row mb-3">
    <label for="inputText" class="col-sm-4 col-form-label">Feedback</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" readonly value="<?php echo $feedback ?>">
    </div>
</div> -->

                                <!-- Pratinjau File yang Diunggah -->
                                <div class="preview-container">
                                    <div class="row">
                                        <div class="form-group col-sm-12 mb-8">
                                            <label for="fileInput" class="form-label">Dokumen Pendukung (Only
                                                .pdf)</label>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <?php if ($att != null) { ?>
                                            <div class="row">
                                                <div class="form-group col-sm-12 mb-8">
                                                    <embed id="pdfembed" src="<?php echo "../../../file cmr/$att"; ?>"
                                                        width="100%" height="400" type="application/pdf">
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="row">
                                                <div class="form-group col-sm-12 mb-8">
                                                    <p>File belum diupload.</p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <script>
                                        function previewFile() {
                                            const fileInput = document.getElementById('fileInput');
                                            const fileNameInput = document.getElementById('fileName');

                                            // Mengatur nilai input teks dengan nama file yang dipilih
                                            fileNameInput.value = fileInput.files[0].name;
                                        }
                                    </script>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-4 col-form-label">Feedback</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="feedback" class="form-control"
                                                value="<?php echo $feedback_qa ?>">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row mb-3" style="display: none;">
                                        <label for="inputText" class="col-sm-4 col-form-label">Nama</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="nm_fm_qa" name="nm_fm_qa"
                                                readonly value="<?php echo $_SESSION['name']; ?>">
                                        </div>
                                    </div>


                                    <div class="row mt-3">
                                        <div class="col-sm-12 text-end">
                                            <form method="post">
                                                <button type="submit" class="btn btn-primary custom-button"
                                                    name="proses" value="Ubah">Approve</button>
                                                <button type="button" class="btn btn-danger custom-button"
                                                    data-toggle="modal" data-target="#tolakModal">Tolak</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>

                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="tolakModal" tabindex="-1" role="dialog"
                        aria-labelledby="tolakModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Revisi NQR</h5>
                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true"
                                        style="position: absolute; top: 10px; right: 10px;">
                                        &times;
                                    </a>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Jelaskan detail revisi dari NQR tersebut
                                </div>
                                <form class="row g-3" action="" method="post" class="modal-dialog" role="document">
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" style="height: 150px" id="remark_fm_qa"
                                                name="remark_fm_qa"></textarea>
                                            <label for="floatingName">Remark</label>
                                        </div>
                                    </div>
                                    <div class="row mb-3" style="display: none;">
                                        <label for="inputText" class="col-sm-4 col-form-label">Nama</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="nm_fm_qa" name="nm_fm_qa"
                                                readonly value="<?php echo $_SESSION['name']; ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary custom-button" name="tolak"
                                            value="Ubah">Konfirmasi</button> <!-- Ubah type menjadi submit -->
                                        <button type="button" class="btn btn-danger custom-button" aria-label="Close"
                                            onclick="document.getElementById('remark_fm_qa').value='';">Reset</button>

                                    </div>
                            </div>
                        </div>
                    </div>

    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <?php include '../../../layout/footer.php'; ?>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../../../asset/sweetalert2/sweet.js"></script>
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Load jQuery and DataTables -->
    <script src="../../../asset/jQuery/jquery-3.6.0.min.js"></script>
    <script src="../../../asset/DataTables/js/datatables.min.js"></script>
    <script src="../../../assets/sweetalert2/package/dist/sweetalert2.all.min.js"></script>
    <script src="../../../assets/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <script src="../../../assets/DataTables-2.0.1/js/dataTables.bootstrap4.min.js"></script>

    <?php
    // Proses form jika tombol tolak diklik
    if (isset($_POST['proses'])) {
        include 'koneksi.php';
        $nm_fm_qa = $_POST['nm_fm_qa'];
        date_default_timezone_set("Asia/Bangkok"); // Set zona waktu ke Asia/Bangkok
        $dt_fm_qa = date("Y-m-d H:i:s"); // Menggunakan format "YYYY-MM-DD HH:MM:SS" untuk tanggal dan waktu saat ini
    
        // Decrypt $Id before using it in the query
    

        // Eksekusi query update
        $result_approvefm = mysqli_query($koneksi3, "UPDATE status_cmr SET dt_fm_qa='$dt_fm_qa', nm_fm_qa='$nm_fm_qa', sts_cmr='2',status_fm_qa='1' WHERE Id='$Id'");

        if ($result_approvefm) {

            $message = "Pemberitahuan CMR! CMR dengan nomor $cmr_no telah di-approve oleh Foreman QA $nm_fm_qa. Status menunggu approval supervisor.";
            $flags = "queue";
            $query_npk = "SELECT npk FROM ct_users WHERE golongan = 4 AND acting = 2 AND dept = 'QA'";
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
                        mysqli_query($koneksi3, $query_insert_notif);
                    }
                }
            }
            echo '<script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "CMR approved",
            text: "CMR dengan nomor ' . $cmr_no . ' telah di-approve oleh ' . $nm_fm_qa . ' pada ' . $dt_fm_qa . ' ",
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            window.location.href = "ap-fm-cmr.php";
        });
        </script>';
            exit(); // Pastikan tidak ada output setelah ini
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($koneksi3); // Tampilkan pesan kesalahan jika query gagal
        }
    }
    ?>


    <?php
    // Proses form jika tombol tolak diklik
    if (isset($_POST['tolak'])) {
        include 'koneksi.php';
        $nm_fm_qa = $_POST['nm_fm_qa'];
        $remark_fm_qa = input($_POST['remark_fm_qa']); // Ambil nilai remark dari formulir modal
        date_default_timezone_set("Asia/Bangkok"); // Set zona waktu ke Asia/Bangkok
        $dt_fm_qa = date("Y-m-d H:i:s"); // Menggunakan format "YYYY-MM-DD HH:MM:SS" untuk tanggal dan waktu saat ini
    
        // Eksekusi query update
        $result_rejectfm = "UPDATE status_cmr SET dt_fm_qa='$dt_fm_qa', nm_fm_qa='$nm_fm_qa', sts_cmr='9',status_fm_qa='2', remark_fm_qa='$remark_fm_qa', remark='$remark_fm_qa' WHERE Id='$Id'";

        if ($result_rejectfm) {
            // Kirim notifikasi jika query update berhasil
            $message = "Pemberitahuan CMR! CMR dengan nomor $cmr_no telah di reject oleh foreman QA $nm_fm_qa dengan remark $remark_fm_qa";
            $flags = "queue";
            $query_npk = "SELECT npk FROM ct_users WHERE golongan = 2 AND acting = 2 AND dept = 'QA'";
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
                        mysqli_query($koneksi3, $query_insert_notif);
                    }
                }
            }
            echo '<script>
    Swal.fire({
        position: "center",
        icon: "error",
        title: "NQR Rejected",
        text: "NQR dengan nomor ' . $cmr_no . ' telah di-reject oleh ' . $nm_fm_qa . ' pada ' . $dt_fm_qa . ' dengan remark ' . $remark_fm_qa . '",
        showConfirmButton: false,
        timer: 2000
    }).then(() => {
        window.location.href = "ap-fm-cmr.php";
    });
</script>';
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($koneksi3); // Tampilkan pesan kesalahan jika query gagal
        }
        exit(); // Pastikan tidak ada output setelah ini
    }
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById('fileInput');
            const embed = document.querySelector('embed');

            input.addEventListener('change', function () {
                $("#pdfembed").attr("hidden", false);

                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        embed.setAttribute('src', e.target.result);
                    }

                    reader.readAsDataURL(file);
                    embed.style.display = 'block'; // Menampilkan elemen embed

                } else {
                    embed.style.display = 'none'; // Menyembunyikan elemen embed
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
        function showAdditionalOptions() {
            var customerRadio = document.getElementById("gridRadios2");
            var ptKybiRadio = document.getElementById("gridRadios3");
            var additionalOptionsPtKybiDiv = document.getElementById("additionalOptionsPtKybi");
            var additionalOptionsCustomerDiv = document.getElementById("additionalOptionsCustomer");

            if (ptKybiRadio.checked) {
                additionalOptionsPtKybiDiv.style.display = "block";
                additionalOptionsCustomerDiv.style.display = "none";
                clearRadioSelections('additionalOptionsPtKybi');
            } else if (customerRadio.checked) {
                additionalOptionsPtKybiDiv.style.display = "none";
                additionalOptionsCustomerDiv.style.display = "block";
                clearRadioSelections('additionalOptionsCustomer');
            } else {
                additionalOptionsPtKybiDiv.style.display = "none";
                additionalOptionsCustomerDiv.style.display = "none";
            }
        }

        function clearRadioSelections(containerId) {
            var container = document.getElementById(containerId);
            var radios = container.querySelectorAll('input[type="radio"]');
            radios.forEach(function (radio) {
                radio.checked = false;
            });
        }
    </script>

    <script>
        document.querySelectorAll('input[type="radio"][name="cof"]').forEach(function (radio) {
            radio.addEventListener('change', function () {
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
        $(function () {
            $("#datepicker_iss").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });
    </script>

    <script>
        $(function () {
            $("#datepicker_dt").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });
    </script>
    <script src="../../../assets/slim-select/selectize.min.js"></script>
    <script>
        $(function () {
            $("#supp").selectize();
            $("select[name='part_name']").selectize();
            $("select[name='part_num']").selectize();
        });
    </script>

</body>

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