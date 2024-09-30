<?php
session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["dept"]) || $_SESSION["dept"] !== "QA") {
  echo "Anda harus login terlebih dahulu";
  header("Location: ../../forbidden.php");
  exit; // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}

include(__DIR__ . '/../../../koneksi.php');

$currentYear = date("Y");

// Query untuk mengambil data kota sesuai halaman aktif
$query1 = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE YEAR(dt_op_qa) = $currentYear AND status IN (1)");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Requested - NQR</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../../assets/img/kayaba-logo.png" rel="icon">
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
      <h1>Requested NQR List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dasbor.php">Home</a></li>
          <!-- <li class="breadcrumb-item"><a href="#">#</a></li> -->
          <li class="breadcrumb-item active">NQR Request</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <!-- konten -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Request <span>| NQR</span></h5>

        <!-- Table with hoverable rows -->
        <table class="table table-hover text-center" id="apTable">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Reg No</th>
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
            $no = 1; // Definisikan variabel $no di sini
            while ($user_data = mysqli_fetch_array($query1)) {
              // Modal Detail 
              echo '<div id="detailModal-' . $user_data['Id'] . '" class="modal fade" tabindex="-1" role="dialog">';
              echo '<div class="modal-dialog modal-dialog-centered" role="document">';
              echo '<div class="modal-content">';
              echo '<div class="modal-header">';
              echo '<h5 style="color: black;" class="modal-title">Detail Data - ' . $user_data['reg_no'] . '</h5>';
              echo '<a href="#" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</a>';
              echo '</div>';
              echo '<div class="modal-body">';

              $csSql = "SELECT * FROM transaksi WHERE Id = '{$user_data['Id']}'";

              $csResult = mysqli_query($koneksi, $csSql);

              while ($userData = mysqli_fetch_assoc($csResult)) {
                $status = $userData['status'];
                $reg_no = $userData['reg_no'];
                $iss_dt = isset($userData['iss_dt']) ? $userData['iss_dt'] : ""; // Periksa dan tetapkan nilai ke $iss_dt
                $iss_dt_formatted = !empty($iss_dt) ? date("Y / m / d", strtotime($iss_dt)) : ""; // Gunakan format tanggal jika $iss_dt tidak kosong, atau beri nilai default
                $rece_no = $userData['rece_no'];
                $supp_name = $userData['supp_name'];
                $part_name = $userData['part_name'];
                $part_no = $userData['part_no'];
                $po_no = $userData['po_no'];
                $invoice = $userData['invoice'];
                $order_no = $userData['order_no'];
                $total_del = $userData['total_del'];
                $total_claim = $userData['total_claim'];
                $dev_dt = isset($userData['dev_dt']) ? $userData['dev_dt'] : ""; // Periksa dan tetapkan nilai ke $iss_dt
                $dev_dt_formatted = !empty($iss_dt) ? date("Y / m / d", strtotime($dev_dt)) : ""; // Gunakan format tanggal jika $iss_dt tidak kosong, atau beri nilai default
                $problem = $userData['problem'];
                $qty_problem = $userData['qty_problem'];
                $feedback = $userData['feedback'];
                $routin = $userData['routin'];
                $info = $userData['info'];
                $lco = $userData['lco'];
                $doi1 = $userData['doi1'];
                $doi2 = $userData['doi2'];
                $cof = $userData['cof'];
                $routin = $userData['routin'];
                $dodp = $userData['dodp'];
                $remark = $userData['remark'];
                $att = $user_data['att'];
                $note = $user_data['note'];
              }
              mysqli_free_result($csResult);

              // Isi modal dengan data yang sesuai
              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Issued Date</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $iss_dt_formatted . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Receive No</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $rece_no . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Supplier Name</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $supp_name . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Part Name</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $part_name . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Part No</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $part_no . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Po No</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $po_no . '">';
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
              echo '<label for="inputText" class="col-sm-4 col-form-label">Total Del</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $total_del . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Total Claim</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $total_claim . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Type NQR</label>';
              echo '<div class="col-sm-8">';
              if ($info == 1) {
                $info = "Claim";
              } elseif ($info == 2) {
                $info = "Complaint (Information)";
              } else {
                $info = ""; // Handle other cases if needed
              }
              echo '<input type="text" class="form-control" readonly value="' . $info . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Delivery Date</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $dev_dt_formatted . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Type NQR</label>';
              echo '<div class="col-sm-8">';
              if ($lco == 1) {
                $lco = "Receiving Insp";
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
              echo '<label for="inputText" class="col-sm-4 col-form-label">Dispostion of Inventory</label>';
              echo '<div class="col-sm-8">';
              if ($doi1 == 1) {
                $doi1_text = "Sorted by Customer (At Customer)";
              } elseif ($doi1 == 2) {
                $doi1_text = "Sorted by Supplier (At Customer)";
              } elseif ($doi1 == 3) {
                $doi1_text = "Sorted by PT KYBI (At Customer)";
              } elseif ($doi1 == 4) {
                $doi1_text = "Customer (At Customer)";
              } else {
                $doi1_text = ""; // Set default value if $doi1 is not matched
              }

              if ($doi2 == 1) {
                $doi2_text = "Sorted by Customer (At PT KYBI)";
              } elseif ($doi2 == 2) {
                $doi2_text = "Sorted by Supplier (At PT KYBI)";
              } elseif ($doi2 == 3) {
                $doi2_text = "Sorted by PT KYBI (At PT KYBI)";
              } elseif ($doi2 == 4) {
                $doi2_text = "Customer (At Customer AT PT KYBI)";
              } else {
                $doi2_text = ""; // Set default value if $doi2 is not matched
              }
              // Gabungkan nilai $doi1_text dan $doi2_text
              $combined_text = $doi1_text . " " . $doi2_text;

              // Output input field dengan nilai yang digabungkan
              echo '<input type="text" class="form-control" readonly value="' . $combined_text . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Claim occurance frequency</label>';
              echo '<div class="col-sm-8">';
              if ($cof == 1) {
                $cof = "First Time";
              } elseif ($cof == 2) {
                $cof = "Reoccured/routin:";
              } else {
                $cof = ""; // Handle other cases if needed
              }
              if ($routin == 0) {
                $routin_text = ""; // Set sebagai string kosong jika nilai routin adalah 0
              } else {
                $routin_text = "(" . $routin . " times)";

              }
              // Output input field dengan nilai yang digabungkan
              echo '<input type="text" class="form-control" readonly value="' . $cof . $routin_text . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Type NQR</label>';
              echo '<div class="col-sm-8">';
              if ($dodp == 1) {
                $dodp = "Keep to use";
              } elseif ($dodp == 2) {
                $dodp = "Return to supplier $supp_name";
              } elseif ($dodp == 3) {
                $dodp = "Scrapped to PT KYBI";
              } else {
                $dodp = ""; // Handle other cases if needed
              }
              echo '<input type="text" class="form-control" readonly value="' . $dodp . '">';
              echo '</div>';
              echo '</div>';


              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Problem</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $problem . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">QTY Problem</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $qty_problem . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Catatan</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $note . '">';
              echo '</div>';
              echo '</div>';

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">File yang Diunggah</label>';
              echo '<div class="col-sm-8">';
              echo '<div class="modal-body">';
              // Tambahkan logika PHP untuk menentukan URL PDF
              $pdf_file_url = isset($att) ? "../../../file/$att" : ""; // Tentukan URL PDF berdasarkan variabel $att
            
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
              echo '<input type="text" class="form-control" readonly value="' . $feedback . '">';
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


              // Modal History
              echo '<div id="historyModal-' . $user_data['Id'] . '" class="modal fade" tabindex="-1" role="dialog">';
              echo '<div class="modal-dialog modal-dialog-centered" role="document">';
              echo '<div class="modal-content">';
              echo '<div class="modal-header">';
              echo '<h5 style="color: black;" class="modal-title">History Data - ' . $user_data['reg_no'] . '</h5>';
              echo '<a href="#" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</a>';
              echo '</div>';
              echo '<div class="modal-body">';

              // Ambil data nama dan tanggal dari tabel CS
              $csSql = "SELECT * FROM transaksi WHERE Id = '{$user_data['Id']}'";

              $csResult = mysqli_query($koneksi, $csSql);

              while ($userData = mysqli_fetch_assoc($csResult)) {
                $reg_no = $userData['reg_no'];
                $nm_op_qa = $userData['nm_op_qa'];
                $nm_fm_qa = $userData['nm_fm_qa'];
                $nm_spv_qa = $userData['nm_spv_qa'];
                $nm_mgr_qa = $userData['nm_mgr_qa'];
                $dt_op_qa = $userData['dt_op_qa'];
                $dt_fm_qa = $userData['dt_fm_qa'];
                $dt_spv_qa = $userData['dt_spv_qa'];
                $dt_mgr_qa = $userData['dt_mgr_qa'];
                $remark_fm_qa = $userData['remark_fm_qa'];
                $remark_spv_qa = $userData['remark_spv_qa'];
                $remark_mgr_qa = $userData['remark_mgr_qa'];
                $status = $userData['status'];
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
              echo "<tr>";
              echo "<td style='text-align:center;'>" . $no++ . "</td>"; // Menggunakan $no di sini dan atur rata tengah
              echo "<td style='text-align:center;'>" . $user_data['reg_no'] . "</td>";
              echo "<td>" . $user_data['supp_name'] . "</td>";
              echo "<td>" . $user_data['part_name'] . "</td>";
              echo "<td>" . $user_data['part_no'] . "</td>";
              $status_label = "";
              $status_badge = "";

              switch ($user_data['status']) {
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
                default:
                  $status_label = $user_data['status'];
              }

              switch ($user_data['sts_op_qa']) {
                case 1:
                  $status_op = "Requested";
                  break;
                default:
                  $status_op = "";
              }

              switch ($user_data['sts_fm_qa']) {
                case 1:
                  $status_fm = "Approved by Foreman";
                  break;
                case 2:
                  $status_fm = "Rejected by Foreman";
                  break;
                default:
                  $status_fm = "";
              }

              switch ($user_data['sts_spv_qa']) {
                case 1:
                  $status_spv = "Approved by Supervisor";
                  break;
                case 2:
                  $status_spv = "Rejected by Supervisor";
                  break;
                default:
                  $status_spv = "";
              }

              switch ($user_data['sts_mgr_qa']) {
                case 1:
                  $status_mgr = "Approved by Manager";
                  break;
                case 2:
                  $status_mgr = "Rejected by Manager";
                  break;
                default:
                  $status_mgr = "";
              }
              echo "<td><a href='#' class='badge $status_badge' data-toggle='modal' data-target='#historyModal-" . $user_data['Id'] . "'>" . $status_label . "</a></td>";
              echo "<td>";
              echo "<a href='#' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#detailModal-" . $user_data['Id'] . "'>
            <i class='ri-file-search-line' style='color: white;'></i>
          </a>";
              echo " "; // Menambahkan spasi antara tombol
              if (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPQA' || $_SESSION['role'] == 'admin')) {
                $status = $user_data['status']; // asumsikan status tersedia dalam $user_data
            
                // Periksa apakah status adalah 1, 9, 10, atau 11
                if ($status == 1 || $status == 9 || $status == 10 || $status == 11) {
                  // Periksa apakah fungsi encryptIdToToken sudah ada sebelumnya
                  if (!function_exists('encryptIdToToken')) {
                    // Deklarasikan fungsi hanya jika belum ada
                    function encryptIdToToken($Id, $key)
                    {
                      $ivSize = openssl_cipher_iv_length('aes-256-cbc');
                      $iv = openssl_random_pseudo_bytes($ivSize);
                      $encrypted = openssl_encrypt($Id, 'aes-256-cbc', $key, 0, $iv);
                      $token = base64_encode($iv . $encrypted);
                      return $token;
                    }

                  }
                  // Lanjutkan menggunakan fungsi seperti biasa
                  $Id = $user_data['Id']; // Menggunakan ID dari $user_data
                  $key = 'secret_key'; // Ganti dengan kunci enkripsi yang sesuai
                  $encrypted_token = encryptIdToToken($Id, $key);

                  // Hasil enkripsi
                  echo "<a href='edit_nqr.php' class='btn btn-success btn-sm' style='padding: 0.25rem 0.5rem;'>
        <i class='ri-edit-2-line' style='color: white;'></i>
      </a>";

                  echo " "; // Menambahkan spasi antara tombol
                }
              }


              echo "<a href='NQR2.php?Id={$user_data['Id']}' target='_blank' class='btn btn-warning btn-sm' style='padding: 0.25rem 0.5rem;'>
    <i class='bi bi-file-earmark-pdf' style='color: white;'></i></a>";

              $status = $user_data['status']; // assuming status is available in $user_data
              $nm_fm_qa = $user_data['nm_fm_qa']; // assuming nm_fm_qa is available in $user_data
              echo " "; // Menambahkan spasi antara tombol
            
              // Check if status is 1 and nm_fm_qa is not empty
              if ($status == 1 && $nm_fm_qa == "") {
                echo "<button onclick=\"confirmDelete('$user_data[Id]', '$user_data[reg_no]')\"class='btn btn-danger btn-sm'>
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
          mysqli_query($koneksi, "DELETE FROM transaksi WHERE Id = '$_GET[hapus]'")
            or die(mysqli_error($koneksi));

          echo ("<p><b> Data berhasil dihapus </b></p>");
          echo "<script>document.location='dasbor.php';</script>";
        }
        ?>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <?php include '../../../layout/footer.php'; ?>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->

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

  <!-- Load jQuery and DataTables -->
  <script src="../../../asset/jQuery/jquery-3.6.0.min.js"></script>
  <script src="../../../asset/DataTables/js/datatables.min.js"></script>
  <script src="../../../assets/sweetalert2/package/dist/sweetalert2.all.min.js"></script>

  <script src="../../../assets/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
  <script src="../../../assets/DataTables-2.0.1/js/dataTables.bootstrap4.min.js"></script>

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
    $(document).ready(function () {
      $('#apTable').DataTable({
        autoWidth: false,
        "language": {
          "emptyTable": "there is no NQR data in this record"
        },
        "lengthMenu": [5, 10, 15, 20, 25] // Menentukan opsi tampilan jumlah entri per halaman
      });
    });
  </script>

</body>

</html>
<style>
  .dataTables_wrapper .dataTables_filter {
    float: right;
    margin-right: 10px;
  }

  #apTable th {
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