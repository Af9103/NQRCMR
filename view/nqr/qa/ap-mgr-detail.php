<?php
session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["dept"]) || $_SESSION["dept"] !== "QA" || $_SESSION["role"] !== "MGRQA") {
    echo "Anda harus login terlebih dahulu";
    header("Location: ../../forbidden.php");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}

include(__DIR__ . '/../../../koneksi.php');
include(__DIR__ . '/../../../function.php');


$currentYear = date("Y");

$Id = isset($_GET['Id']) ? $_GET['Id'] : '';
$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE Id = '$Id'");

if (!$query) {
    die('Query error: ' . mysqli_error($koneksi3));
}

$num_rows = mysqli_num_rows($query);

if ($num_rows > 0) {
    while ($user_data = mysqli_fetch_array($query)) {
        // Proses data di sini
        $status = $user_data['status'];
        $reg_no = $user_data['reg_no'];
        $iss_dt = $user_data['iss_dt'];
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
        $note = $user_data['note'];
        $feedback = $user_data['feedback'];
        $routin = $user_data['routin'];
        $att = $user_data['att'];
        $nm_op_qa = $user_data['nm_op_qa'];
        date_default_timezone_set("Asia/Bangkok"); // Set zona waktu ke Asia/Bangkok
        $dt_fm_qa = date("Y-m-d H:i:s"); // Menggunakan format "YYYY-MM-DD HH:MM:SS" untuk tanggal dan waktu saat ini

        // Lakukan apa pun yang perlu dilakukan dengan data
    }
} else {
    echo "Tidak ada data yang sesuai dengan ID yang diberikan.";
}
?>

<?php

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
?>

<?php

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
// $doi1 = 0;
// Tetapkan atribut checked sesuai dengan nilai dari database
$RChecked = ($lco === "1") ? "checked" : "";
$IChecked = ($lco === "2") ? "checked" : "";
$CChecked = ($lco === "3") ? "checked" : "";
?>

<?php

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
?>

<?php

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
$RChecked = ($cof === "2") ? "checked" : "";
?>

<?php

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
$RChecked = ($dodp === "2") ? "checked" : "";
$SChecked = ($dodp === "3") ? "checked" : "";
?>

<?php

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
                    <li class="breadcrumb-item"><a href="dasbor.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="ap-mgr.php">List NQR</a></li>
                    <li class="breadcrumb-item active">Approval by Manager</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Detail NQR</h5>

                            <!-- General Form Elements -->
                            <form action="" method="post" id="myForm">

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Reg No</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?php echo $reg_no; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Issued Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" readonly value="<?php echo $iss_dt; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Receive No</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                            value="<?php echo $rece_no; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Supplier Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                            value="<?php echo $supp_name; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Part Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                            value="<?php echo $part_name; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Part No</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                            value="<?php echo $part_no; ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Po No</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?php echo $po_no; ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Invoice</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                            value="<?php echo $invoice; ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Order No</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                            value="<?php echo $order_no; ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Total Del</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                            value="<?php echo $total_del; ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Total Claim</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                            value="<?php echo $total_claim; ?>">
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Info</legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info" id="info1"
                                                value="1" <?php echo $claimChecked; ?> disabled>
                                            <label class="form-check-label" for="info1">
                                                Claim
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info" id="info2"
                                                value="2" <?php echo $complaintChecked; ?> disabled>
                                            <label class="form-check-label" for="info2">
                                                Complaint (Information)
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Delivery Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?php echo $dev_dt; ?>">
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Location Claim Occur</legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco1" value="1"
                                                <?php echo $RChecked; ?> disabled>
                                            <label class="form-check-label" for="lco1">
                                                Receiving Insp
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco2" value="2"
                                                <?php echo $IChecked; ?> disabled>
                                            <label class="form-check-label" for="lco2">
                                                In-Process
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco3" value="3"
                                                <?php echo $CChecked; ?> disabled>
                                            <label class="form-check-label" for="lco3">
                                                Customer
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Disposition of
                                        invnetory</label>
                                </div>

                                <?php if ($doi1 !== "0"): ?>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">At Customer</legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi1" id="doi11"
                                                value="1" <?php echo $SCChecked; ?> disabled>
                                            <label class="form-check-label" for="doi11">
                                                Sorted by Customer
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi1" id="doi12"
                                                value="2" <?php echo $SSChecked; ?> disabled>
                                            <label class="form-check-label" for="doi12">
                                                Sorted by Supplier
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi1" id="doi13"
                                                value="3" <?php echo $SPChecked; ?> disabled>
                                            <label class="form-check-label" for="doi13">
                                                Sorted by PT KYBI
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi1" id="doi14"
                                                value="4" <?php echo $SKChecked; ?> disabled>
                                            <label class="form-check-label" for="doi14">
                                                Keep to use
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <?php endif; ?>

                                <?php if ($doi2 !== "0"): ?>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">At PT KYBI</legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi2" id="doi22"
                                                value="2" <?php echo $SKChecked; ?> disabled>
                                            <label class="form-check-label" for="doi22">
                                                Sorted by Supplier
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi2" id="doi23"
                                                value="3" <?php echo $PKChecked; ?> disabled>
                                            <label class="form-check-label" for="doi23">
                                                Sorted by PT KYBI
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi2" id="doi24"
                                                value="4" <?php echo $KKChecked; ?> disabled>
                                            <label class="form-check-label" for="doi24">
                                                Keep to use
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <?php endif; ?>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Claim of Occurance</legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof1" value="1"
                                                <?php echo $FChecked; ?> disabled>
                                            <label class="form-check-label" for="cof1">
                                                First Time
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof2" value="2"
                                                <?php echo $RUChecked; ?> disabled>
                                            <label class="form-check-label" for="cof2">
                                                Reoccured occurance freq
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <?php if ($cof !== "1"): ?>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Routin</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?php echo $routin; ?>">
                                    </div>
                                </div>
                                <?php endif; ?>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Dispostion of defect part</legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dodp" id="dodp1"
                                                value="1" <?php echo $KChecked; ?> disabled>
                                            <label class="form-check-label" for="cof1">
                                                Keep to use
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dodp" id="dodp2"
                                                value="2" <?php echo $RChecked; ?> disabled>
                                            <label class="form-check-label" for="info2">
                                                Return to supplier
                                            </label>
                                        </div>
                                        <label for="inputText"
                                            class="col-sm-8 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $supp_name; ?></label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dodp" id="dodp3"
                                                value="3" <?php echo $SChecked; ?> disabled>
                                            <label class="form-check-label" for="info2">
                                                Scrapped at PT KYBI
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Problem</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="<?php echo $problem ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">QTY Problem</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                            value="<?php echo $qty_problem ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Catatan</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" readonly><?php echo $note; ?></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Feedback</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                            value="<?php echo $feedback ?>">
                                    </div>
                                </div>

                                <!-- Pratinjau File yang Diunggah -->
                                <div class="preview-container">
                                    <div class="row">
                                        <div class="form-group col-sm-12 mb-8">
                                            <label for="fileInput" class="form-label">Dokumen Pendukung (Only
                                                .pdf)</label>
                                        </div>
                                    </div>

                                    <?php if ($att != null) { ?>
                                    <div class="row">
                                        <div class="form-group col-sm-12 mb-8">
                                            <embed id="pdfembed" src="<?php echo "../../../file/$att"; ?>" width="1050"
                                                height="400" type="application/pdf">
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

                                <div class="row mb-3" style="display: none;">
                                    <label for="inputText" class="col-sm-4 col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nm_mgr_qa" name="nm_mgr_qa" readonly
                                            value="<?php echo $_SESSION['name']; ?>">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-12 text-end">
                                        <form method="post">
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
                    <div class="modal-dialog modal-dialog-centered" role="document">
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
                                        <textarea class="form-control" style="height: 150px" id="remark_mgr_qa"
                                            name="remark_mgr_qa"></textarea>
                                        <label for="floatingName">Remark</label>
                                    </div>
                                </div>
                                <div class="row mb-3" style="display: none;">
                                    <label for="inputText" class="col-sm-4 col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nm_mgr_qa" name="nm_mgr_qa" readonly
                                            value="<?php echo $_SESSION['name']; ?>">
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

    <!-- Template Main JS File -->
    <script src="../../../assets/js/main.js"></script>

    <?php
    // Proses form jika tombol tolak diklik
    if (isset($_POST['proses'])) {

        $nm_mgr_qa = $_POST['nm_mgr_qa'];
        date_default_timezone_set("Asia/Bangkok"); // Set zona waktu ke Asia/Bangkok
        $dt_mgr_qa = date("Y-m-d H:i:s"); // Menggunakan format "YYYY-MM-DD HH:MM:SS" untuk tanggal dan waktu saat ini
    
        // Eksekusi query update
        $result_approvemgr = mysqli_query($koneksi, "UPDATE transaksi SET dt_mgr_qa='$dt_mgr_qa', nm_mgr_qa='$nm_mgr_qa', status='4',sts_mgr_qa='1' WHERE Id='$Id'");
        if ($result_approvemgr) {
            // Kirim notifikasi jika query update berhasil
            $message = "Pemberitahuan NQR! NQR dengan nomor $reg_no telah di approve oleh Manager QA $nm_mgr_qa. Selanjutnya akan dilanjutkan oleh departemen PPC.";
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
    var message = "NQR dengan nomor ' . $reg_no . ' telah di approve oleh foreman(' . $nm_spv_qa . '). Klik link ini untuk memeriksa NQR: http://e-learning.stmi.ac.id/mhs/login";

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
        title: "NQR Approved",
        text: "NQR dengan nomor ' . $reg_no . ' telah di-approve oleh ' . $nm_mgr_qa . ' pada ' . $dt_mgr_qa . ' ",
        showConfirmButton: false,
        timer: 2000
    }).then(() => {
        window.location.href = "ap-mgr.php";
    });
</script>';
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($koneksi); // Tampilkan pesan kesalahan jika query gagal
        }
        exit(); // Pastikan tidak ada output setelah ini
    }
    ?>

    <?php
    // Proses form jika tombol tolak diklik
    if (isset($_POST['tolak'])) {

        $nm_mgr_qa = $_POST['nm_mgr_qa'];
        $remark_mgr_qa = input($_POST['remark_mgr_qa']); // Ambil nilai remark dari formulir modal
        date_default_timezone_set("Asia/Bangkok"); // Set zona waktu ke Asia/Bangkok
        $dt_mgr_qa = date("Y-m-d H:i:s"); // Menggunakan format "YYYY-MM-DD HH:MM:SS" untuk tanggal dan waktu saat ini
    
        // Eksekusi query update
        $result_rejectmgr = mysqli_query($koneksi, "UPDATE transaksi SET dt_mgr_qa='$dt_mgr_qa', nm_mgr_qa='$nm_mgr_qa', remark_mgr_qa='$remark_mgr_qa', remark='$remark_mgr_qa', status='11',sts_mgr_qa='2' WHERE Id='$Id'");
        if ($result_rejectmgr) {
            // Kirim notifikasi jika query update berhasil
            $message = "Pemberitahuan NQR! NQR dengan nomor $reg_no telah di reject oleh Manager QA $nm_mgr_qa dengan remark $remark_mgr_qa";
            $flags = "queue";
            $query_phone = "SELECT no_hp FROM isd 
                            LEFT JOIN ct_users ON ct_users.npk = isd.npk 
                            WHERE ct_users.golongan = 2 AND ct_users.acting = 2 AND dept = 'QA'";
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
    var message = "NQR dengan nomor ' . $reg_no . ' telah di reject oleh foreman(' . $nm_mgr_qa . ').dengan alasan ' . $remark_mgr_qa . ' Klik link ini untuk memeriksa NQR: http://e-learning.stmi.ac.id/mhs/login";

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
        text: "NQR dengan nomor ' . $reg_no . ' telah di-reject oleh ' . $nm_mgr_qa . ' pada ' . $dt_mgr_qa . ' dengan remark ' . $remark_mgr_qa . '",
        showConfirmButton: false,
        timer: 2000
    }).then(() => {
        window.location.href = "ap-mgr.php";
    });
</script>';
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($koneksi); // Tampilkan pesan kesalahan jika query gagal
        }
        exit(); // Pastikan tidak ada output setelah ini
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

</body>

<script src="../../../assets/cdnjs/jquery.slim.min.js"></script>
<script src="../../../assets/package/dist/umd/popper.min.js"></script>
<script src="../../../assets/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>

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