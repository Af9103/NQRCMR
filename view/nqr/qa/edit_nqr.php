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

$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE Id = '$Id'");
if (!$query) {
    die('Query error: ' . mysqli_error($koneksi));
}

$num_rows = mysqli_num_rows($query);

if ($num_rows > 0) {
    while ($user_data = mysqli_fetch_array($query)) {
        // Proses data di sini
        $status = $user_data['status'];
        $reg_no = isset($user_data['reg_no']) ? $user_data['reg_no'] : ''; // Perbaikan disini
        $iss_dt = isset($user_data['iss_dt']) ? date('Y/m/d', strtotime($user_data['iss_dt'])) : '';
        $rece_no = $user_data['rece_no'];
        $supp_name = $user_data['supp_name'];
        $part_name = $user_data['part_name'];
        $part_no = $user_data['part_no'];
        $po_no = $user_data['po_no'];
        $invoice = $user_data['invoice'];
        $order_no = $user_data['order_no'];
        $total_del = $user_data['total_del'];
        $total_claim = $user_data['total_claim'];
        $dev_dt = isset($user_data['iss_dt']) ? date('Y/m/d', strtotime($user_data['dev_dt'])) : '';
        $problem = $user_data['problem'];
        $qty_problem = $user_data['qty_problem'];
        $feedback = $user_data['feedback'];
        $att = $user_data['att'];
        $routin = $user_data['routin'];
        $note = $user_data['note'];

        // Lakukan apa pun yang perlu dilakukan dengan data
    }
} else {
    echo "Tidak ada data yang sesuai dengan ID yang diberikan.";
}

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi, "SELECT info FROM transaksi WHERE Id = '$Id'");
if ($queryInfo) {
    // Jika query berhasil, ambil nilai dari hasil query
    $row = mysqli_fetch_assoc($queryInfo);
    // Tetapkan nilai ke variabel $infoValue
    $info = $row['info'];
} else {
    // Jika query gagal, atur nilai default
    $info = "1"; // Nilai default
}

// Tetapkan atribut checked sesuai dengan nilai dari database
$claimChecked = ($info === "1") ? "checked" : "";
$complaintChecked = ($info === "2") ? "checked" : "";
?>

<?php

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi, "SELECT doi1 FROM transaksi WHERE Id = '$Id'");
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
$SCChecked = ($doi1 === "1") ? "checked" : "";
$SSChecked = ($doi1 === "2") ? "checked" : "";
$SPChecked = ($doi1 === "3") ? "checked" : "";
$SKChecked = ($doi1 === "4") ? "checked" : "";

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi, "SELECT lco FROM transaksi WHERE Id = '$Id'");
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
$RIChecked = ($lco === "1") ? "checked" : "";
$IChecked = ($lco === "2") ? "checked" : "";
$CChecked = ($lco === "3") ? "checked" : "";

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi, "SELECT doi2 FROM transaksi WHERE Id = '$Id'");
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

$SChecked = ($doi2 === "2") ? "checked" : "";
$PChecked = ($doi2 === "3") ? "checked" : "";
$KChecked = ($doi2 === "4") ? "checked" : "";

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi, "SELECT cof FROM transaksi WHERE Id = '$Id'");
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
$FChecked = ($cof === "1") ? "checked" : "";
$RUChecked = ($cof === "2") ? "checked" : "";

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi, "SELECT dodp FROM transaksi WHERE Id = '$Id'");
if ($queryInfo) {
    // Jika query berhasil, ambil nilai dari hasil query
    $row = mysqli_fetch_assoc($queryInfo);
    // Tetapkan nilai ke variabel $infoValue
    $dodp = $row['dodp'];
} else {
    // Jika query gagal, atur nilai default
    $dodp = "1"; // Nilai default
}
// $doi1 = 0;
// Tetapkan atribut checked sesuai dengan nilai dari database
$KChecked = ($dodp === "1") ? "checked" : "";
$RSChecked = ($dodp === "2") ? "checked" : "";
$SChecked = ($dodp === "3") ? "checked" : "";

$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi, "SELECT doi1 FROM transaksi WHERE Id = '$Id'");
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
$SCChecked = ($doi1 === "1") ? "checked" : "";
$SSChecked = ($doi1 === "2") ? "checked" : "";
$SPChecked = ($doi1 === "3") ? "checked" : "";
$SKChecked = ($doi1 === "4") ? "checked" : "";
$ACChecked = ($doi1 !== "0") ? "checked" : "";

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi, "SELECT doi2 FROM transaksi WHERE Id = '$Id'");
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

$SKChecked = ($doi2 === "2") ? "checked" : "";
$PKChecked = ($doi2 === "3") ? "checked" : "";
$KKChecked = ($doi2 === "4") ? "checked" : "";
$AKChecked = ($doi2 !== "0") ? "checked" : "";

$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi, "SELECT cof FROM transaksi WHERE Id = '$Id'");
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
$FChecked = ($cof === "1") ? "checked" : "";
$RChecked = ($cof === "2") ? "checked" : "";

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
            <h1>Edit Laporan NQR</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dasbor.php">Home</a></li>
                    <li class="breadcrumb-item active">Edit NQR</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Laporan NQR</h5>

                            <!-- General Form Elements -->
                            <form method="post" enctype="multipart/form-data">

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Reg No<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="reg_no" class="form-control" readonly
                                            value="<?php echo $reg_no; ?>" required>
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
                                    <label for="inputText" class="col-sm-4 col-form-label">Receive No</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="rece_no" class="form-control"
                                            value="<?php echo $rece_no; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Supplier Name<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <select id="supp" name="supp_name" required>
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
                                        <select name="part_no" data-live-search="true" class="selectpicker"
                                            data-live-search-placeholder="Search" required>
                                            <option value="<?php echo $part_no; ?>"><?php echo $part_no; ?></option>
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
                                    <label for="inputText" class="col-sm-4 col-form-label">Po No<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="po_no" class="form-control"
                                            value="<?php echo $po_no; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Invoice<span
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
                                    <label for="inputText" class="col-sm-4 col-form-label">Total Delivery<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="total_del" class="form-control"
                                            value="<?php echo $total_del; ?>" oninput="formatNumber(this)" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Total Claim<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="total_claim" class="form-control"
                                            value="<?php echo $total_claim; ?>" oninput="formatNumber(this)" required>
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Type of NQR<span class="wajib">*</span>
                                    </legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info" id="info1"
                                                value="1" <?php echo $claimChecked; ?>>
                                            <label class="form-check-label" for="info1">
                                                Claim
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info" id="info2"
                                                value="2" <?php echo $complaintChecked; ?>>
                                            <label class="form-check-label" for="info2">
                                                Complaint (Information)
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Delivery Date<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" id="datepicker_dt" name="dev_dt"
                                            value="<?php echo $dev_dt; ?>">
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Location Claim Occur<span
                                            class="wajib">*</span></legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco1" value="1"
                                                <?php echo $RIChecked; ?>>
                                            <label class="form-check-label" for="lco1">
                                                Receiving Insp
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco2" value="2"
                                                <?php echo $IChecked; ?>>
                                            <label class="form-check-label" for="lco2">
                                                In-Process
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco3" value="3"
                                                <?php echo $CChecked; ?>>
                                            <label class="form-check-label" for="lco3">
                                                Customer
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Disposition of inventory<span
                                            class="wajib">*</span></legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios"
                                                id="gridRadios2" value="option2" onchange="showAdditionalOptions()"
                                                required <?php echo $ACChecked; ?>>
                                            <label class="form-check-label" for="gridRadios2">
                                                At customer
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios"
                                                id="gridRadios3" value="option3" onchange="showAdditionalOptions()"
                                                required <?php echo $AKChecked; ?>>
                                            <label class="form-check-label" for="gridRadios3">
                                                At PT KYBI
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div id="additionalOptions">
                                    <!-- At pt kybi options -->
                                    <div id="additionalOptionsPtKybi"
                                        <?php echo ($AKChecked == "checked") ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-4 pt-0">At PT KYBI</legend>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="doi2" id="doi2"
                                                        value="2" <?php echo $SKChecked; ?>>
                                                    <label class="form-check-label" for="sortedBySupplier">Sorted by
                                                        Supplier</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="doi2" id="doi2"
                                                        value="3" <?php echo $PKChecked; ?>>
                                                    <label class="form-check-label" for="sortedByPTKYBI">Sorted by PT
                                                        KYBI</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="doi2" id="doi2"
                                                        value="4" <?php echo $KKChecked; ?>>
                                                    <label class="form-check-label" for="keepToUse">Keep to use</label>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <!-- At customer options -->
                                <div id="additionalOptionsCustomer"
                                    <?php echo ($ACChecked == "checked") ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-4 pt-0">Additional Options for At Customer
                                        </legend>
                                        <div class="col-sm-8">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="doi1" id="doi1"
                                                    value="1" <?php echo $SCChecked; ?>>
                                                <label class="form-check-label" for="sortedByCustomer">Sorted by
                                                    Customer</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="doi1" id="doi1"
                                                    value="2" <?php echo $SSChecked; ?>>
                                                <label class="form-check-label" for="sortedBySupplier">Sorted by
                                                    Supplier</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="doi1" id="doi1"
                                                    value="3" <?php echo $SPChecked; ?>>
                                                <label class="form-check-label" for="sortedByPTKYBI">Sorted by PT
                                                    KYBI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="doi1" id="doi1"
                                                    value="4" <?php echo $SKChecked; ?>>
                                                <label class="form-check-label" for="keepToUse">Keep to use</label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Claim occurrence freq<span
                                            class="wajib">*</span></legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof1" value="1"
                                                <?php echo $FChecked; ?> onchange="toggleRoutinInput()">
                                            <label class="form-check-label" for="cof1">
                                                First Time
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof2" value="2"
                                                <?php echo $RUChecked; ?> onchange="toggleRoutinInput()">
                                            <label class="form-check-label" for="cof2">
                                                Reoccurred/routin
                                            </label>
                                        </div>
                                        <div id="reoccurredInput"
                                            <?php echo ($RUChecked == "checked") ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="routin" name="routin"
                                                        value="<?php echo $routin; ?>" oninput="formatNumber(this)">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Times</label>
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

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Dispostion of defect part<span
                                            class="wajib">*</span></legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dodp" id="dodp1"
                                                value="1" <?php echo $KChecked; ?>>
                                            <label class="form-check-label" for="cof1">
                                                Keep to use
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dodp" id="dodp2"
                                                value="2" <?php echo $RSChecked; ?>>
                                            <label class="form-check-label" for="info2">
                                                Return to supplier
                                            </label>
                                        </div>
                                        <label for="inputText"
                                            class="col-sm-8 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $supp_name; ?></label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dodp" id="dodp3"
                                                value="3" <?php echo $SChecked; ?>>
                                            <label class="form-check-label" for="info2">
                                                Scrapped at PT KYBI
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Problem<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="problem" class="form-control"
                                            value="<?php echo $problem ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">QTY Problem<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="qty_problem" class="form-control"
                                            value="<?php echo $qty_problem ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="note" class="col-sm-4 col-form-label">Catatan<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" style="height: 100px" id="note" name="note"
                                            required><?php echo isset($note) ? $note : ''; ?></textarea>
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
                                    <br>
                                    <br>
                                    <?php if ($att != null) { ?>
                                    <div class="form-group row mb-8">
                                        <div class="mb-12">
                                            <embed id="pdfembed" src="<?php echo "../../../file/$att"; ?>" width="1050"
                                                height="400" type="application/pdf">
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="form-group row mb-8">
                                        <p>File belum diupload.</p>
                                    </div>
                                    <?php } ?>
                                </div>
                                <p id="fileError"></p>

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
                                        <input type="text" name="feedback" class="form-control"
                                            value="<?php echo $feedback ?>">
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

    <script src="../../../asset/sweetalert2/sweet.js"></script>
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Load jQuery and DataTables -->
    <script src="../../../asset/jQuery/jquery-3.6.0.min.js"></script>
    <script src="../../../asset/DataTables/js/datatables.min.js"></script>
    <script src="../../../assets/sweetalert2/package/dist/sweetalert2.all.min.js"></script>
    <script src="../../../assets/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <script src="../../../assets/DataTables-2.0.1/js/dataTables.bootstrap4.min.js"></script>

    <!-- Template Main JS File -->
    <script src="../../../assets/js/main.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.getElementById('fileInput');
        const embed = document.querySelector('embed');
        const fileError = document.getElementById('fileError');

        input.addEventListener('change', function() {
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
                reader.onload = function(e) {
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
        radios.forEach(function(radio) {
            radio.checked = false;
        });
    }
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

    <?php

    $process = isset($_GET['alert']) ? $_GET['alert'] : false;

    // Inisialisasi variabel-variabel yang digunakan dalam query SQL
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
    $note = isset($_POST['note']) ? input($_POST['note']) : '';
    $att = isset($_POST['att']) ? $_POST['att'] : '';
    $sts_op_qa = isset($_POST['sts_op_qa']) ? $_POST['sts_op_qa'] : '';
    $sts_fm_qa = isset($_POST['sts_fm_qa']) ? $_POST['sts_fm_qa'] : '';
    $sts_spv_qa = isset($_POST['sts_spv_qa']) ? $_POST['sts_spv_qa'] : '';
    $sts_mgr_qa = isset($_POST['sts_mgr_qa']) ? $_POST['sts_mgr_qa'] : '';
    $feedback = isset($_POST['feedback']) ? input($_POST['feedback']) : '';
    date_default_timezone_set("Asia/Bangkok"); // Set zona waktu ke Asia/Bangkok
    $dt_op_qa = date("Y-m-d H:i:s"); // Menggunakan format "YYYY-MM-DD HH:MM:SS" untuk tanggal dan waktu saat ini
    $nm_op_qa = isset($_SESSION['name']) ? $_SESSION['name'] : '';

    // Ambil ID terbaru dari database
    $result = mysqli_query($koneksi, "SELECT MAX(Id) AS max_id FROM transaksi");
    $row = mysqli_fetch_assoc($result);
    $max_id = $row['max_id'];
    $next_id = $max_id + 1; // ID berikutnya
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $target_dir = "../../../file/";
        $unique_filename = "";
        $uploadOk = 1;
        $att_value = "";

        // Periksa apakah ada file yang diunggah
        if (!empty($_FILES["file"]["name"])) {
            $original_file_name = basename($_FILES["file"]["name"]);
            $timestamp = time(); // Timestamp saat ini
            $unique_filename = $timestamp . '_' . $original_file_name; // Gabungkan timestamp dengan nama file asli
            $target_file = $target_dir . $unique_filename;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Allow certain file formats
            if (
                $imageFileType != "pdf"
            ) {
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

            // Jika semua validasi file lolos, lakukan upload
            if ($uploadOk) {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    // File berhasil diunggah, tetapkan nilai untuk kolom 'att'
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

        if ($uploadOk) {
            // Eksekusi query update tanpa mengunggah file jika tidak ada file yang diunggah
            $query = "UPDATE transaksi SET iss_dt = '$iss_dt', rece_no = '$rece_no', supp_name = '$supp_name', part_name = '$part_name', part_no = '$part_no', po_no = '$po_no', invoice = '$invoice', order_no = '$order_no', total_del = '$total_del', total_claim = '$total_claim', info = '$info', dev_dt = '$dev_dt', lco = '$lco', doi1 = '$doi1', doi2 = '$doi2', cof = '$cof', routin = '$routin', dodp = '$dodp', problem = '$problem', qty_problem = '$qty_problem', note = '$note', status = '1', sts_op_qa='1', sts_fm_qa='', sts_spv_qa='', sts_mgr_qa='', dt_op_qa='$dt_op_qa', feedback='$feedback', nm_op_qa='$nm_op_qa' $att_value WHERE Id = '$Id'";
            $result = mysqli_query($koneksi, $query);
        
            if ($result) {
                // Kirim notifikasi
                $message = "Pemberitahuan NQR! NQR dengan nomor $reg_no telah diedit oleh $nm_op_qa. Status menunggu approval foreman.";
                $flags = "queue";
                if ($result_rejectspv) {
                    // Kirim notifikasi jika query update berhasil
                    $message = "Pemberitahuan NQR! NQR dengan nomor $reg_no telah di reject oleh Supervisor QA $nm_spv_vdd dengan remark $remark_spv_vdd";
                    $flags = "queue";
                    $query_npk = "SELECT npk FROM ct_users WHERE golongan = 3 AND acting = 2 AND dept = 'QA'";
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
                }
        
                // Jika berhasil, arahkan ke halaman dasbor.php dan tampilkan pesan
                echo '<script>';
                echo 'Swal.fire({';
                echo '  position: "center",';
                echo '  icon: "success",';
                echo '  text: "NQR dengan nomor ' . $reg_no . ' berhasil diupdate",'; // Menambahkan koma setelah string
                echo '  showConfirmButton: false,';
                echo '  timer: 1500';
                echo '});';
                echo 'setTimeout(function(){window.location.href = "dasbor.php";}, 2000);'; // Redirect ke halaman dasbor.php setelah menutup SweetAlert
                echo '</script>';
            } else {
                echo "Gagal mengupdate data: " . mysqli_error($koneksi);
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
    $(function() {
        $("#datepicker_iss").datepicker({
            changeMonth: true,
            changeYear: true
        });
    });
    </script>

    <script>
    $(function() {
        $("#datepicker_dt").datepicker({
            changeMonth: true,
            changeYear: true
        });
    });
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
</style>