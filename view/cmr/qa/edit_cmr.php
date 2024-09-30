<?php
session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["dept"]) || $_SESSION["dept"] !== "QA") {
    echo "Anda harus login terlebih dahulu";
    header("Location: ../../forbidden.php");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}

include(__DIR__ . '/../../../koneksi.php');
include(__DIR__ . '/../../../function.php');

$Id = isset($_GET['Id']) ? $_GET['Id'] : '';
$query = mysqli_query($koneksi3, "SELECT t.*, s.sts_cmr, s.nm_op_qa, s.status_op_qa, s.dt_op_qa, s.feedback_qa
    FROM transaksi t
    INNER JOIN status_cmr s ON t.Id = s.Id
    WHERE t.Id LIKE '%$Id%'");

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
        $kybNo = $user_data['kybNo'];
        $kybNo = $user_data['kybNo'];
        $bl_dt = isset($user_data['bl_dt']) ? date('Y/m/d', strtotime($user_data['bl_dt'])) : '';
        $bl_dt = $bl_dt !== '1970/01/01' ? $bl_dt : ''; // Jika tanggal default dari strtotime adalah 1970/01/01, maka atur menjadi kosong            
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
    <link href="../../../asset/jQuery/jquery-ui-1.13.2.custom/jquery-ui.css" rel="stylesheet">
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
            <h1>Edit Laporan CMR</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dasborcmr.php">Home</a></li>
                    <li class="breadcrumb-item active">Edit CMR</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Laporan CMR</h5>

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
                                    <label for="inputText" class="col-sm-4 col-form-label">Supplier Name<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <select id="supp" name="supp_name">
                                            <option value="<?php echo $supp_name; ?>"><?php echo $supp_name; ?></option>
                                            <?php
                                            // Menambahkan klausa WHERE untuk memfilter status
                                            $query = mysqli_query($koneksi, "SELECT * FROM supplier");
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo "<option value='" . $row['nama'] . "'>" . $row['bpid'] . " - " . $row['nama'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Issued Date<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="datepicker_iss" name="iss_dt"
                                            value="<?php echo $iss_dt; ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Found Date<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="datepicker_found" name="found_dt"
                                            value="<?php echo $found_dt; ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">A/R Date<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="datepicker_ar" name="ar_dt"
                                            value="<?php echo $ar_dt; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">KYB CMR No</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="kybNo" class="form-control"
                                            value="<?php echo $kybNo ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">B/L Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="datepicker_bl" name="bl_dt"
                                            value="<?php echo $bl_dt; ?>">
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Location Claim Occur<span
                                            class="wajib">*</span></legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco1" value="1"
                                                <?php echo $RINChecked; ?>>
                                            <label class="form-check-label" for="lco1">
                                                Receiving Insp
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco2" value="2"
                                                <?php echo $INPChecked; ?>>
                                            <label class="form-check-label" for="lco2">
                                                In-Process
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco3" value="3"
                                                <?php echo $CUSChecked; ?>>
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
                                    <legend class="col-form-label col-sm-4 pt-0">At customer<span class="wajib">*</span>
                                    </legend>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi1" id="doi11"
                                                value="1" required <?php echo $AChecked; ?>>
                                            <label class="form-check-label" for="doi11">
                                                Sorted by customer
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi1" id="doi12"
                                                value="2" required <?php echo $BChecked; ?>>
                                            <label class="form-check-label" for="doi12">
                                                Sorted by PT.KYB
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi1" id="doi13"
                                                value="3" required <?php echo $CChecked; ?>>
                                            <label class="form-check-label" for="doi13">
                                                Keep to use
                                            </label>
                                        </div>
                                    </div>

                                    <legend class="col-form-label col-sm-2 pt-0">At PY KYBI<span class="wajib">*</span>
                                    </legend>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi2" id="doi21"
                                                value="1" required <?php echo $SPKChecked; ?>>
                                            <label class="form-check-label" for="doi21">
                                                Sorted bt PT KYBI
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi2" id="doi22"
                                                value="2" required <?php echo $KTUChecked; ?>>
                                            <label class="form-check-label" for="doi22">
                                                Keep to use
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi2" id="doi23"
                                                value="3" required <?php echo $RTKChecked; ?>>
                                            <label class="form-check-label" for="doi23">
                                                Return to KYB
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi2" id="doi24"
                                                value="4" required <?php echo $OChecked; ?>>
                                            <label class="form-check-label" for="doi24">
                                                Other
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Claim occurance frequency<span
                                            class="wajib">*</span></legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof1" value="1"
                                                required <?php echo $FTChecked; ?>>
                                            <label class="form-check-label" for="cof1">
                                                First Time
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof2" value="2"
                                                required <?php echo $RUChecked; ?>>
                                            <label class="form-check-label" for="cof2">
                                                Reoccurred
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof3" value="3"
                                                required <?php echo $INhecked; ?>>
                                            <label class="form-check-label" for="lco3">
                                                Intermittently
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof4" value="4"
                                                required <?php echo $COChecked; ?>>
                                            <label class="form-check-label" for="lco4">
                                                Continously
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof5" value="5"
                                                required <?php echo $OTChecked; ?>>
                                            <label class="form-check-label" for="lco5">
                                                Other
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Dispostion of Defect parts<span
                                            class="wajib">*</span></legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dispo" id="dispo1"
                                                value="1" required <?php echo $KChecked; ?>>
                                            <label class="form-check-label" for="dispo1">
                                                Keep to use
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dispo" id="dispo2"
                                                value="2" required <?php echo $RKYBChecked; ?>>
                                            <label class="form-check-label" for="dispo2">
                                                Retrun to KYB
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dispo" id="dispo3"
                                                value="3" required <?php echo $SAKChecked; ?>>
                                            <label class="form-check-label" for="lco3">
                                                Scrapped at PT KYB
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">No Invoice<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="invoice" class="form-control"
                                            value="<?php echo $invoice; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Order No<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="order_no" class="form-control"
                                            value="<?php echo $order_no; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Product<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="product" class="form-control"
                                            value="<?php echo $product; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Model<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="model" class="form-control"
                                            value="<?php echo $model; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Part Name<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="part_name" data-live-search="true" required>
                                            <option value="<?php echo $part_name; ?>"><?php echo $part_name; ?></option>
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
                                        <select name="part_num" data-live-search="true" class="selectpicker"
                                            data-live-search-placeholder="Search" required>
                                            <option value="<?php echo $part_num; ?>"><?php echo $part_num; ?></option>
                                            <?php

                                            // Menambahkan klausa WHERE untuk memfilter status
                                            $query = mysqli_query($koneksi, "SELECT * FROM item");
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo "<option value='" . $row['no'] . "'>" . $row['no'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Quantity Ordered<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="qty_order" class="form-control"
                                            value="<?php echo $qty_order; ?>" oninput="formatNumber(this)" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Quantity delivered<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="qty_del" class="form-control"
                                            value="<?php echo $qty_del; ?>" oninput="formatNumber(this)" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Quantity Defect<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="qty_def" class="form-control"
                                            value="<?php echo $qty_def; ?>" oninput="formatNumber(this)" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Crate Number<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="crate_num" class="form-control"
                                            value="<?php echo $crate_num; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Problem<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="problem" class="form-control"
                                            value="<?php echo $problem ?>" required>
                                    </div>
                                </div>

                                <!-- LINE KEEMPAT -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Attachment<span
                                            class="wajib">*</span>
                                        <small class="form-text text-muted">(PDF only, max 2MB)</small></label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" name="file" id="fileInput"
                                            value="<?php echo $att ?>" id="fileName" onchange="previewFile()">
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
                                        <input type="hidden" name="file" value="<?php echo $att ?>" id="fileName">
                                    </div>
                                    <p id="fileError"></p>

                                    <br>
                                    <br>
                                    <?php if ($att != null) { ?>
                                        <div class="form-group row mb-8">
                                            <div class="mb-12">
                                                <embed id="pdfembed" src="<?php echo "../../../file cmr/$att"; ?>"
                                                    width="1050" height="400" type="application/pdf">
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-group row mb-8">
                                            <p>File belum diupload.</p>
                                        </div>
                                    <?php } ?>
                                </div>

                                <!-- <script>
    function previewFile() {
        const fileInput = document.getElementById('fileInput');
        const fileNameInput = document.getElementById('fileName');

        // Mengatur nilai input teks dengan nama file yang dipilih
        fileNameInput.value = fileInput.files[0].name;
    }
</script> -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Feedback<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="feedback_qa" class="form-control"
                                            value="<?php echo $feedback_qa ?>" required>
                                    </div>
                                </div>
                                <br>
                                <div class="col sm-6 text-end">
                                    <button class="btn btn-primary custom-button" type="submit" name="proses"
                                        value="Ubah">Update</button>
                                </div>
                            </form>

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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById('fileInput');
            const embed = document.querySelector('embed');
            const fileError = document.getElementById('fileError');

            input.addEventListener('change', function () {
                const file = input.files[0];

                if (file) {
                    const fileType = file.type;
                    const fileSize = file.size;

                    // Check if file is a PDF
                    if (fileType !== 'application/pdf') {
                        fileError.textContent = 'Format file tidak sesuai(PDF Only)';
                        fileError.style.color = 'red'; // Set error message color to red
                        embed.style.display = 'none';
                        return;
                    }

                    // Check if file size exceeds 2MB
                    if (fileSize > 2 * 1024 * 1024) {
                        fileError.textContent = 'Ukuran file terlalu besar*';
                        fileError.style.color = 'red'; // Set error message color to red
                        embed.style.display = 'none';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        embed.setAttribute('src', e.target.result);
                        embed.style.display = 'block';
                        fileError.textContent = ''; // Clear any previous error messages
                    }

                    reader.readAsDataURL(file);
                } else {
                    embed.style.display = 'none';
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

    <?php
    require_once '../../../helper.php';

    $process = isset($_GET['alert']) ? $_GET['alert'] : false;

    // Inisialisasi variabel-variabel yang digunakan dalam query SQL
    $iss_dt = isset($_POST['iss_dt']) ? date('Y/m/d', strtotime($_POST['iss_dt'])) : '';
    $found_dt = isset($_POST['found_dt']) ? date('Y/m/d', strtotime($_POST['found_dt'])) : '';
    $ar_dt = isset($_POST['ar_dt']) ? date('Y/m/d', strtotime($_POST['ar_dt'])) : '';
    $supp_name = isset($_POST['supp_name']) ? $_POST['supp_name'] : '';
    $lco = isset($_POST['lco']) ? $_POST['lco'] : '';
    $doi1 = isset($_POST['doi1']) ? $_POST['doi1'] : '';
    $doi2 = isset($_POST['doi2']) ? $_POST['doi2'] : '';
    $cof = isset($_POST['cof']) ? $_POST['cof'] : '';
    $dispo = isset($_POST['dispo']) ? $_POST['dispo'] : '';
    $part_name = isset($_POST['part_name']) ? $_POST['part_name'] : '';
    $invoice = isset($_POST['invoice']) ? input($_POST['invoice']) : '';
    $order_no = isset($_POST['order_no']) ? input($_POST['order_no']) : '';
    $product = isset($_POST['product']) ? input($_POST['product']) : '';
    $model = isset($_POST['model']) ? input($_POST['model']) : '';
    $part_num = isset($_POST['part_num']) ? $_POST['part_num'] : '';
    $qty_order = isset($_POST['qty_order']) ? input($_POST['qty_order']) : '';
    $qty_del = isset($_POST['qty_del']) ? input($_POST['qty_del']) : '';
    $qty_def = isset($_POST['qty_def']) ? input($_POST['qty_def']) : '';
    $crate_num = isset($_POST['crate_num']) ? input($_POST['crate_num']) : '';
    $problem = isset($_POST['problem']) ? input($_POST['problem']) : '';
    $feedback_qa = isset($_POST['feedback_qa']) ? $_POST['feedback_qa'] : '';
    $feedback = isset($_POST['feedback_qa']) ? $_POST['feedback_qa'] : '';
    $sts_cmr = 1; // Atur status ke 1
    $nm_op_qa = isset($_SESSION['name']) ? $_SESSION['name'] : '';
    $status_op_qa = isset($_POST['status_op_qa']) ? $_POST['status_op_qa'] : '';
    $status_fm_qa = isset($_POST['status_fm_qa']) ? $_POST['status_fm_qa'] : '';
    date_default_timezone_set("Asia/Bangkok"); // Set zona waktu ke Asia/Bangkok
    $dt_op_qa = date("Y-m-d H:i:s"); // Menggunakan format "YYYY-MM-DD HH:MM:SS" untuk tanggal dan waktu saat ini
    $att = isset($_POST['att']) ? $_POST['att'] : '';

    // Ambil ID terbaru dari database
    $result = mysqli_query($koneksi3, "SELECT MAX(Id) AS max_id FROM transaksi");
    $row = mysqli_fetch_assoc($result);
    $max_id = $row['max_id'];
    $next_id = $max_id + 1; // ID berikutnya
    
    // Periksa apakah ada parameter Id yang dikirim melalui GET
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $target_dir = "../../../file cmr/";
        $unique_filename = "";
        $uploadOk = 1;

        // Check if a file was uploaded
        if (!empty($_FILES["file"]["name"])) {
            $original_file_name = basename($_FILES["file"]["name"]);
            $timestamp = time(); // Current timestamp
            $unique_filename = $timestamp . '_' . $original_file_name; // Combine timestamp with original filename
            $target_file = $target_dir . $unique_filename;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Allow certain file formats
            if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif', 'pdf'])) {
                echo "<script>
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                      </script>";
                $uploadOk = 0;
            }

            // Check file size (maximum 2MB)
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

            // Ensure only PDF files are allowed
            if ($imageFileType != "pdf") {
                echo "<script>
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Hanya file PDF yang diizinkan',
                            showConfirmButton: false,
                            timer: 2000
                        });
                      </script>";
                $uploadOk = 0;
            }

            // If all validations pass, attempt to upload the file
            if ($uploadOk) {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    // File uploaded successfully, set value for 'att' column
                    $att_value = ", att = '$unique_filename'";
                } else {
                    echo "<script>
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Sorry, there was an error uploading your file.',
                                showConfirmButton: false,
                                timer: 2000
                            });
                          </script>";
                    $uploadOk = 0;
                }
            }
        }

        // Execute the update query if the file upload was successful
        if ($uploadOk) {
            $query_transaksi = "UPDATE transaksi 
                        SET iss_dt = '$iss_dt', found_dt = '$found_dt', ar_dt = '$ar_dt', supp_name = '$supp_name', lco = '$lco', doi1 = '$doi1', doi2 = '$doi2', cof = '$cof', dispo = '$dispo', part_name = '$part_name', 
                            invoice = '$invoice', order_no = '$order_no', product = '$product', model = '$model', part_num = '$part_num', qty_order = '$qty_order', qty_del = '$qty_del', qty_def = '$qty_def', crate_num = '$crate_num', problem = '$problem', feedback = '$feedback'
                            $att_value
                        WHERE Id = '$Id'";

            // Execute the transaction query
            $result_transaksi = mysqli_query($koneksi3, $query_transaksi);

            // Query for status_cmr table
            $query_status_cmr = "UPDATE status_cmr 
                         SET sts_cmr = '1', 
                             nm_op_qa = '$nm_op_qa',
                             feedback_qa = '$feedback_qa', 
                             status_op_qa = '1', 
                             status_fm_qa = '' 
                         WHERE Id = '$Id'";

            // Execute the status_cmr query
            $result_status_cmr = mysqli_query($koneksi3, $query_status_cmr);

            // Check if both queries were successful
            if ($result_transaksi && $result_status_cmr) {
                // Notification message
                $message = "Pemberitahuan CMR! CMR dengan nomor $cmr_no telah diedit oleh $nm_op_qa. Status menunggu approval foreman.";
                $flags = "queue";

                // Query to get phone numbers
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

                // Send notifications
                if (!empty($phone_numbers)) {
                    foreach ($phone_numbers as $phone_number) {
                        $query_insert_notif = "INSERT INTO notif (phone_number, message, flags) VALUES ('$phone_number', '$message', '$flags')";
                        mysqli_query($koneksi3, $query_insert_notif);
                    }
                }

                // If successful, redirect to dashboard and display a success message
                echo '<script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            text: "CMR dengan nomor ' . $cmr_no . ' berhasil diupdate",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function(){window.location.href = "dasborcmr.php";}, 2000);
                      </script>';
            } else {
                // If either query fails, display an error message
                echo "Gagal mengupdate data: " . mysqli_error($koneksi3);
            }
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
        $(function () {
            $("#datepicker_iss").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });

        $(function () {
            $("#datepicker_ar").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });

        $(function () {
            $("#datepicker_found").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });

        $(function () {
            $("#datepicker_bl").datepicker({
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
</style>