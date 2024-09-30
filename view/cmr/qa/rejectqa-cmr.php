<?php
session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["dept"]) || $_SESSION["dept"] !== "QA") {
  echo "Anda harus login terlebih dahulu";
  header("Location: ../../forbidden.php");
  exit; // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}

include(__DIR__ . '/../../../koneksi.php');
include(__DIR__ . '/../../../function.php');


// Konfigurasi jumlah data per halaman
$currentYear = date("Y");
// Query untuk mengambil data kota sesuai halaman aktif
$status = isset($_GET['sts_cmr']) ? $_GET['sts_cmr'] : "9";

// Query untuk mengambil data kota sesuai status yang dipilih
$query1 = mysqli_query($koneksi3, "SELECT * FROM transaksi t INNER JOIN status_cmr s ON t.Id = s.Id WHERE YEAR(s.dt_op_qa) = $currentYear AND s.sts_cmr IN ($status)");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Rejected List - CMR</title>
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
  <link href="../../../assets/DataTables-2.0.1/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <!-- <link href="https://cdn.datatables.net/v/bs4/dt-2.0.1/.css" rel="stylesheet"> -->

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
      <h1>Rejected NQR List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dasborcmr.php">Home</a></li>
          <!-- <li class="breadcrumb-item"><a href="#">#</a></li> -->
          <li class="breadcrumb-item active">CMR Rejected</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <ul class="nav nav-tabs">
      <li class="nav-item">
        <?php
        // Melakukan query untuk menghitung jumlah status dengan nilai 2
        $queryJumlahData = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = $currentYear AND sts_cmr = 9");
        $row = mysqli_fetch_assoc($queryJumlahData);
        $jumlahStatus = $row['jumlah'];
        ?>
        <a class="nav-link <?php echo $status == 9 ? 'active' : ''; ?>" aria-current="page"
          href="rejectqa-cmr.php?sts_cmr=9">Rejected by Foreman<span style="font-size: smaller; opacity: 0.7;">
            (<?php echo $jumlahStatus; ?>)</span></a>
      </li>
      <li class="nav-item">
        <?php
        // Melakukan query untuk menghitung jumlah status dengan nilai 2
        $queryJumlahData = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = $currentYear AND sts_cmr = 10");
        $row = mysqli_fetch_assoc($queryJumlahData);
        $jumlahStatus = $row['jumlah'];
        ?>
        <a class="nav-link <?php echo $status == 10 ? 'active' : ''; ?>" href="rejectqa-cmr.php?sts_cmr=10">Rejected by
          Supervisor<span style="font-size: smaller; opacity: 0.7;"> (<?php echo $jumlahStatus; ?>)</span></a>
      </li>
      <li class="nav-item">
        <?php
        // Melakukan query untuk menghitung jumlah status dengan nilai 2
        $queryJumlahData = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = $currentYear AND sts_cmr = 11");
        $row = mysqli_fetch_assoc($queryJumlahData);
        $jumlahStatus = $row['jumlah'];
        ?>
        <a class="nav-link <?php echo $status == 11 ? 'active' : ''; ?>" href="rejectqa-cmr.php?sts_cmr=11">Rejected by
          Manager<span style="font-size: smaller; opacity: 0.7;"> (<?php echo $jumlahStatus; ?>)</span></a>
      </li>
    </ul>
    <!-- konten -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Rejected <span>| NQR</span></h5>

        <!-- Table with hoverable rows -->
        <table class="table table-hover text-center" id="ppcTable">
          <thead>
            <tr>
              <th scope="col">CMR No</th>
              <th scope="col">Supplier Name</th>
              <th scope="col">Part Name</th>
              <th scope="col">Part No</th>
              <!-- <th scope="col">Remark</th> -->
              <th scope="col">Status</th>
              <th scope="col" data-orderable="false">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($user_data = mysqli_fetch_array($query1)) {
              // Modal Detail 
              echo '<div id="detailModal-' . $user_data['Id'] . '" class="modal fade" tabindex="-1" role="dialog">';
              echo '<div class="modal-dialog modal-dialog-centered" role="document">';
              echo '<div class="modal-content">';
              echo '<div class="modal-header">';
              echo '<h5 style="color: black;" class="modal-title">Detail Data - ' . $user_data['cmr_no'] . '</h5>';
              echo '<a href="#" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</a>';
              echo '</div>';
              echo '<div class="modal-body">';

              $cmrSql = "SELECT t.*, s.feedback_qa, s.remark
           FROM transaksi t 
           INNER JOIN status_cmr s ON t.Id = s.Id 
           WHERE t.Id = '{$user_data['Id']}'";


              $cmrResult = mysqli_query($koneksi3, $cmrSql);

              while ($userData = mysqli_fetch_assoc($cmrResult)) {
                // $status_qa = $userData['status_qa'];
                $cmr_no = $userData['cmr_no'];
                $iss_dt = isset($userData['iss_dt']) ? $userData['iss_dt'] : ""; // Periksa dan tetapkan nilai ke $iss_dt
                $iss_dt_formatted = !empty($iss_dt) ? date("Y / m / d", strtotime($iss_dt)) : ""; // Gunakan format tanggal jika $iss_dt tidak kosong, atau beri nilai default
                $found_dt = isset($userData['found_dt']) ? $userData['found_dt'] : ""; // Periksa dan tetapkan nilai ke $found_dt
                $found_dt_formatted = !empty($found_dt) ? date("Y / m / d", strtotime($found_dt)) : ""; // Gunakan format tanggal jika $found_dt tidak kosong, atau beri nilai default
                $supp_name = $userData['supp_name'];
                $part_name = $userData['part_name'];
                $part_num = $userData['part_num'];
                $ar_dt = isset($userData['ar_dt']) ? $userData['ar_dt'] : ""; // Periksa dan tetapkan nilai ke $ar_dt
                $ar_dt_formatted = !empty($ar_dt) ? date("Y / m / d", strtotime($ar_dt)) : ""; // Gunakan format tanggal jika $ar_dt tidak kosong, atau beri nilai default
                $invoice = $userData['invoice'];
                $order_no = $userData['order_no'];
                $product = $userData['product'];
                $model = $userData['model'];
                $qty_order = $userData['qty_order'];
                $qty_del = $userData['qty_del'];
                $qty_def = $userData['qty_def'];
                $crate_num = $userData['crate_num'];
                $hand_dt = isset($userData['hand_dt']) ? $userData['hand_dt'] : ""; // Periksa dan tetapkan nilai ke $hand_dt
                $hand_dt_formatted = !empty($hand_dt) ? date("Y / m / d", strtotime($hand_dt)) : ""; // Gunakan format tanggal jika $hand_dt tidak kosong, atau beri nilai default
                $problem = $userData['problem'];
                $lco = $userData['lco'];
                $doi1 = $userData['doi1'];
                $doi2 = $userData['doi2'];
                $cof = $userData['cof'];
                $dispatch = $userData['dispatch'];
                $dispo = $userData['dispo'];
                $feedback_qa = $userData['feedback_qa'];
                $remark = $userData['remark'];
                $att = $user_data['att'];
              }
              mysqli_free_result($cmrResult);


              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Supplier Name</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $supp_name . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Issued Date</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $iss_dt_formatted . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Found Date</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $found_dt_formatted . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">A/R Date</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $ar_dt_formatted . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Location Time Occur</label>';
              echo '<div class="col-sm-8">';
              if ($lco == 1) {
                $lco = "Receiving Inspect";
              } elseif ($lco == 2) {
                $lco = "In-Process";
              } elseif ($lco == 3) {
                $lco = "Customer";
              } else {
                $lco = ""; // Handle other cases if needed
              }

              echo '<input type="text" class="form-control" readonly value="' . $lco . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-12 col-form-label">Disposition of Inventory</label>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">At customer</label>';
              echo '<div class="col-sm-8">';
              if ($doi1 == 1) {
                $doi1 = "Sorted by Customer";
              } elseif ($doi1 == 2) {
                $doi1 = "Sorted by PT.KYB";
              } elseif ($doi1 == 3) {
                $doi1 = "Keep to use";
              } else {
                $doi1 = ""; // Handle other cases if needed
              }

              echo '<input type="text" class="form-control" readonly value="' . $doi1 . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">At PT KYB</label>';
              echo '<div class="col-sm-8">';
              if ($doi2 == 1) {
                $doi2 = "Sorted by PT.KYB";
              } elseif ($doi2 == 2) {
                $doi2 = "Keep to use";
              } elseif ($doi2 == 3) {
                $doi2 = "Return to KYB";
              } elseif ($doi2 == 4) {
                $doi2 = "other";
              } else {
                $doi2 = ""; // Handle other cases if needed
              }
              echo '<input type="text" class="form-control" readonly value="' . $doi2 . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Claim Occurence Frequency</label>';
              echo '<div class="col-sm-8">';
              if ($cof == 1) {
                $cof = "First Time";
              } elseif ($cof == 2) {
                $cof = "Reoccured";
              } elseif ($cof == 3) {
                $cof = "Intermittently";
              } elseif ($cof == 4) {
                $cof = "Continiusly";
              } elseif ($cof == 5) {
                $cof = "Other";
              } else {
                $cof = ""; // Handle other cases if needed
              }
              echo '<input type="text" class="form-control" readonly value="' . $cof . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Dispostionj of Defect Parts</label>';
              echo '<div class="col-sm-8">';
              if ($dispo == 1) {
                $dispo = "Keep to use";
              } elseif ($dispo == 2) {
                $dispo = "Return to KYB";
              } elseif ($dispo == 3) {
                $dispo = "Scrapped at PT KYB";
              } else {
                $dispo = ""; // Handle other cases if needed
              }
              echo '<input type="text" class="form-control" readonly value="' . $dispo . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Invoice</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $invoice . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Order No</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $order_no . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Product</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $product . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Model</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $model . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Part Name</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $part_name . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Part Number</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $part_num . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Quantity Ordered</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $qty_order . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Quantity Delivered</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $qty_del . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Quantity Defect</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $qty_def . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Crate Number</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $crate_num . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Hnadling Date</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $hand_dt_formatted . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Problem</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $problem . '">';
              echo '</div>';
              echo '</div>';


              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">File yang Diunggah</label>';
              echo '<div class="col-sm-8">';
              echo '<div class="modal-body">';
              // Tambahkan logika PHP untuk menentukan URL PDF
              $pdf_file_url = isset($att) ? "./file cmr/$att" : ""; // Tentukan URL PDF berdasarkan variabel $att
            
              if ($pdf_file_url) {
                // Jika URL PDF tersedia, tampilkan pratinjau PDF
                echo '<embed src="' . $pdf_file_url . '" type="application/pdf" width="100%" height="200px" zoom="true">';
              } else {
                // Jika tidak ada URL PDF tersedia, tampilkan pesan "File belum diunggah"
                echo '<p>File belum diunggah.</p>';
              }

              echo '</div>';
              echo '</div>';
              echo '</div>';


              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Feedback</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $feedback_qa . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Remark</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $remark . '">';
              echo '</div>';
              echo '</div>';

              echo '</div>';
              echo '<div class="modal-footer">';
              // echo '<input type="button" id="req" class="btn btn-primary" value="Request">';
              echo '<button type="button" class="btn btn-secondary custom-button" data-dismiss="modal">Tutup</button>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';

              echo "<tr>";
              echo "<td style='text-align:center;'>" . $user_data['cmr_no'] . "</td>";
              echo "<td>" . $user_data['supp_name'] . "</td>";
              echo "<td>" . $user_data['part_name'] . "</td>";
              echo "<td>" . $user_data['part_num'] . "</td>";
              $status_label = "";
              $status_badge = "";

              switch ($user_data['sts_cmr']) {
                case 1:
                  $status_label = "Requested";
                  $status_badge = "bg-warning text-dark";
                  break;
                case 2:
                  $status_label = "Approved by Foreman";
                  $status_badge = "bg-success";
                  break;
                case 3:
                  $status_label = "Approved by Supervisor";
                  $status_badge = "bg-success";
                  break;
                case 4:
                  $status_label = "Approved by Manager";
                  $status_badge = "bg-success";
                  break;
                case 5:
                  $status_label = "Checked by TA";
                  $status_badge = "bg-success";
                  break;
                case 9:
                  $status_label = "Rejected by Foreman";
                  $status_badge = "bg-danger";
                  break;
                case 10:
                  $status_label = "Rejected by Supervisor";
                  $status_badge = "bg-danger";
                  break;
                case 11:
                  $status_label = "Rejected by Manager";
                  $status_badge = "bg-danger";
                  break;
                case 12:
                  $status_label = "Rejected by TA";
                  $status_badge = "bg-danger";
                  break;
                default:
                  $status_label = $user_data['status'];
              }

              echo "<td><a href='#' class='badge $status_badge' data-toggle='modal' data-target='#historyModal-" . $user_data['Id'] . "'>" . $status_label . "</a></td>";
              // Modal History
              echo '<div id="historyModal-' . $user_data['Id'] . '" class="modal fade" tabindex="-1" role="dialog">';
              echo '<div class="modal-dialog modal-dialog-centered" role="document">';
              echo '<div class="modal-content">';
              echo '<div class="modal-header">';
              echo '<h5 style="color: black;" class="modal-title">History Data - ' . $user_data['cmr_no'] . '</h5>';
              echo '<a href="#" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</a>';
              echo '</div>';
              echo '<div class="modal-body">';

              // Ambil data nama dan tanggal dari tabel CS
              $csSql = "SELECT * FROM transaksi t JOIN status_cmr s ON t.Id = s.Id WHERE t.Id = '{$user_data['Id']}'";

              $csResult = mysqli_query($koneksi3, $csSql);

              while ($userData = mysqli_fetch_assoc($csResult)) {
                $nm_op_qa = $userData['nm_op_qa'];
                $nm_fm_qa = $userData['nm_fm_qa'];
                $nm_spv_qa = $userData['nm_spv_qa'];
                $nm_mgr_qa = $userData['nm_mgr_qa'];
                $nm_ta = $userData['nm_ta'];
                $dt_op_qa = $userData['dt_op_qa'];
                $dt_fm_qa = $userData['dt_fm_qa'];
                $dt_spv_qa = $userData['dt_spv_qa'];
                $dt_mgr_qa = $userData['dt_mgr_qa'];
                $dt_ta = $userData['dt_ta'];
                $sts_cmr = $userData['sts_cmr'];
                $remark_fm_qa = $userData['remark_fm_qa'];
                $remark_spv_qa = $userData['remark_spv_qa'];
                $remark_mgr_qa = $userData['remark_mgr_qa'];
                $remark_ta = $userData['remark_ta'];
                switch ($user_data['status_op_qa']) {
                  case 1:
                    $status_op = "Requested";
                    break;
                  default:
                    $status_op = "";
                }

                switch ($user_data['status_fm_qa']) {
                  case 1:
                    $status_fm = "Approved by Foreman";
                    break;
                  case 2:
                    $status_fm = "Rejected by Foreman";
                    break;
                  default:
                    $status_fm = "";
                }

                switch ($user_data['status_spv_qa']) {
                  case 1:
                    $status_spv = "Approved by Supervisor";
                    break;
                  case 2:
                    $status_spv = "Rejected by Supervisor";
                    break;
                  default:
                    $status_spv = "";
                }

                switch ($user_data['status_mgr_qa']) {
                  case 1:
                    $status_mgr = "Approved by Manager";
                    break;
                  case 2:
                    $status_mgr = "Rejected by Manager";
                    break;
                  default:
                    $status_mgr = "";
                }
                switch ($user_data['status_ta']) {
                  case 1:
                    $status_ta = "Checked by TA";
                    break;
                  case 2:
                    $status_ta = "Rejected by Manager";
                    break;
                  default:
                    $status_ta = "";
                }

              }
              mysqli_free_result($csResult);

              echo '<strong>■. QA</strong>';
              echo '<br>';
              echo '<div class="col-md-12">';
              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;status:' . $status_op . '</strong>';
              echo '<br>';
              echo '<div class="col-md-12">';
              if (!empty($dt_op_qa)) {
                $date_formatted = date("Y / m / d H:i:s", strtotime($dt_op_qa));
                echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp; {$nm_op_qa} ({$date_formatted}) <br></span>";
                echo '<br>';
              }

              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;status:' . $status_fm . '</strong>';
              echo '<br>';
              echo '<div class="col-md-12">';
              if ($dt_fm_qa == '0000-00-00 00:00:00') {
                $date_formatted = "";
              } else {
                $date_formatted = date("Y / m / d H:i:s", strtotime($dt_fm_qa));

                echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp; {$nm_fm_qa} ($date_formatted) <br></span>";
              }
              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;■ Remark</strong>';
              echo '<br>';
              echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $remark_fm_qa <br></span>";


              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;status:' . $status_spv . '</strong>';
              echo '<br>';
              echo '<div class="col-md-12">';
              if ($dt_spv_qa == '0000-00-00 00:00:00') {
                $date_formatted = "";
              } else {
                $date_formatted = date("Y / m / d H:i:s", strtotime($dt_spv_qa));
                echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp; {$nm_spv_qa} ($date_formatted) <br></span>";
              }
              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;■ Remark</strong>';
              echo '<br>';
              echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $remark_spv_qa <br></span>";


              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;status:' . $status_mgr . '</strong>';
              echo '<br>';
              echo '<div class="col-md-12">';
              if ($dt_mgr_qa == '0000-00-00 00:00:00') {
                $date_formatted = "";
              } else {
                $date_formatted = date("Y / m / d H:i:s", strtotime($dt_mgr_qa));
                echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp; {$nm_mgr_qa} ($date_formatted) <br></span>";
              }
              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;■ Remark</strong>';
              echo '<br>';
              echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $remark_mgr_qa <br></span>";

              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;status:' . $status_ta . '</strong>';
              echo '<br>';
              echo '<div class="col-md-12">';
              if ($dt_ta == '0000-00-00 00:00:00') {
                $date_formatted = "";
              } else {
                $date_formatted = date("Y / m / d H:i:s", strtotime($dt_ta));
                echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp; {$nm_ta} ($date_formatted) <br></span>";
              }
              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;■ Remark</strong>';
              echo '<br>';
              echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $remark_ta <br></span>";

              echo '<br>';
              echo '</div>';
              // Tambahkan detail lainnya di sini jika diperlukan
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '<div class="modal-footer">';
              echo '<button type="button" class="btn btn-secondary custom-button" data-dismiss="modal">Tutup</button>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo "<td>";
              echo "<a href='#' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#detailModal-" . $user_data['Id'] . "'>
            <i class='ri-file-search-line' style='color: white;'></i>
          </a>";
              echo " "; // Menambahkan spasi antara tombol
              if (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPQA' || $_SESSION['role'] == 'admin')) {
                $status = $user_data['sts_cmr']; // asumsikan status tersedia dalam $user_data
            
                // Periksa apakah status adalah 1, 9, 10, atau 11
                if ($status == 1 || $status == 9 || $status == 10 || $status == 11) {

                  echo "<a href='edit_cmr.php?Id={$user_data['Id']}' class='btn btn-success btn-sm' style='padding: 0.25rem 0.5rem;'>
        <i class='ri-edit-2-line' style='color: white;'></i>
      </a>";

                  echo " "; // Menambahkan spasi antara tombol
                }
              }

              echo "<a href='../../../output/CMR1.php?Id={$user_data['Id']}' target='_blank' class='btn btn-warning btn-sm' style='padding: 0.25rem 0.5rem;'>
    <i class='bi bi-file-earmark-pdf' style='color: white;'></i></a>";

              $status = $user_data['sts_cmr']; // assuming status is available in $user_data
              $nm_fm_qa = $user_data['nm_fm_qa']; // assuming nm_fm_qa is available in $user_data
              echo " "; // Menambahkan spasi antara tombol
            
              // Check if status is 1 and nm_fm_qa is not empty
              if ($status == 1 && $nm_fm_qa == "") {
                echo "<button onclick=\"confirmDelete('$user_data[Id]', '$user_data[cmr_no]')\"class='btn btn-danger btn-sm'>
        <i class='bi bi-trash-fill' style='color: white;'></i>
      </a>";
              }
              echo "</td>";

              // Script JavaScript untuk menampilkan SweetAlert dan melakukan penghapusan jika dikonfirmasi
              echo "<script>";
              echo "function confirmDelete(id, reg_no) {"; // Menambahkan parameter reg_no
              echo "  Swal.fire({";
              echo "    title: 'Yakin ingin menghapus NQR ' + reg_no + '?',";
              echo "    icon: 'warning',";
              echo "    showCancelButton: true,";
              echo "    confirmButtonColor: '#d33',";
              echo "    cancelButtonColor: '#3085d6',";
              echo "    confirmButtonText: 'Ya, hapus!',";
              echo "    cancelButtonText: 'Batal'";
              echo "  }).then((result) => {";
              echo "    if (result.isConfirmed) {";
              echo "      Swal.fire({";
              echo "        position: 'center',";
              echo "        icon: 'success',";
              echo "        title: 'Data berhasil dihapus',";
              echo "        showConfirmButton: false,";
              echo "        timer: 2000";
              echo "      });";
              echo "      setTimeout(function(){ window.location.href = '?hapus=' + id; }, 2000);"; // Redirect ke halaman index.php setelah menutup SweetAlert
              echo "    }";
              echo "  });";
              echo "}";
              echo "</script>";

            }

            ?>
          </tbody>
        </table>
        <?php
        if (isset($_GET['hapus'])) {
          mysqli_query($koneksi3, "DELETE FROM status_cmr WHERE Id = '$_GET[hapus]'")
            or die(mysqli_error($koneksi3));
          mysqli_query($koneksi3, "DELETE FROM transaksi WHERE Id = '$_GET[hapus]'")
            or die(mysqli_error($koneksi3));

          echo ("<p><b> Data berhasil dihapus </b></p>");
          echo "<script>document.location='dasborcmr.php';</script>";
        }
        ?>
        <!-- End Table with hoverable rows -->
      </div>
      </section>

  </main><!-- End #main -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <?php include '../../../layout/footer.php'; ?>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
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

  <!-- Load jQuery and DataTables -->
  <script src="../../../asset/jQuery/jquery-3.6.0.min.js"></script>
  <script src="../../../asset/DataTables/js/datatables.min.js"></script>
  <script src="../../../assets/sweetalert3/package/dist/sweetalert2.all.min.js"></script>

  <script src="../../../assets/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
  <script src="../../../assets/DataTables-2.0.1/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#ppcTable').DataTable({
        autoWidth: false,
        "language": {
          "emptyTable": "there is no NQR data in this record"
        },
        "lengthMenu": [5, 10, 15, 20, 25] // Menentukan opsi tampilan jumlah entri per halaman
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

  <style>
    .dataTables_wrapper .dataTables_filter {
      float: right;
      margin-right: 10px;
    }

    #ppcTable th {
      text-align: center;
    }

    .custom-button {
      background-color: white;
      border-color: green;
      color: green;
    }

    .custom-button:hover {
      background-color: green;
      color: white;
    }
  </style>

</body>

</html>