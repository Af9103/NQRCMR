<?php
session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["dept"]) || $_SESSION["dept"] !== "PPC") {
  echo "Anda harus login terlebih dahulu";
  header("Location: ../../forbidden.php");
  exit; // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}

include(__DIR__ . '/../../../koneksi.php');

$currentYear = date("Y");

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
// Inisialisasi variabel untuk filter tanggal
$dateFilter = '';

// Tentukan filter berdasarkan pilihan pengguna
switch ($filter) {
  case 'week':
    // Filter untuk minggu ini
    $dateFilter = "AND YEARWEEK(dt_op_qa) = YEARWEEK(NOW())";
    break;
  case 'month':
    // Filter untuk bulan ini
    $dateFilter = "AND YEAR(dt_op_qa) = YEAR(NOW()) AND MONTH(dt_op_qa) = MONTH(NOW())";
    break;
  case 'year':
    // Filter untuk tahun ini
    $dateFilter = "AND YEAR(dt_op_qa) = YEAR(NOW())";
    break;
  default:
    // Tidak ada filter tambahan yang diterapkan, hanya data tahun ini
    $dateFilter = "AND YEAR(dt_op_qa) = $currentYear";
    break;
}

// Daftar status yang diizinkan
$allowedStatus = [1, 2, 6, 7, 8, 3, 4, 5];

// Konversi daftar status menjadi string untuk digunakan dalam kueri SQL
$statusString = implode(",", $allowedStatus);

// Buat kueri dengan menambahkan filter tanggal dan status jika ada
$query = "SELECT * FROM transaksi t
JOIN status_cmr s ON t.Id = s.Id
WHERE 1=1 $dateFilter AND s.sts_cmr_ppc IN ($statusString)
ORDER BY FIELD(s.sts_cmr_ppc, 1, 2, 6, 7, 8, 3, 4, 5)";


// Eksekusi kueri
$query1 = mysqli_query($koneksi3, $query);

// Periksa apakah kueri berhasil dieksekusi
if (!$query1) {
  die("Query error: " . mysqli_error($koneksi3));
}

?>

<!-- <?php

// Periksa apakah ada parameter Id yang dikirim melalui GET
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Query ke database untuk mengambil nilai infoValue
$queryInfo = mysqli_query($koneksi, "SELECT stc FROM transaksi WHERE Id = '$Id'");
if ($queryInfo) {
  // Jika query berhasil, ambil nilai dari hasil query
  $row = mysqli_fetch_assoc($queryInfo);
  // Tetapkan nilai ke variabel $infoValue
  $info = $row['stc'];
} else {
  // Jika query gagal, atur nilai default
  $info = "1"; // Nilai default
}

// Tetapkan atribut checked sesuai dengan nilai dari database
$AirChecked = ($info === "1") ? "checked" : "";
$SeaChecked = ($info === "2") ? "checked" : "";
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
  $info = $row['p'];
} else {
  // Jika query gagal, atur nilai default
  $info = "1"; // Nilai default
}

// Tetapkan atribut checked sesuai dengan nilai dari database
$pChecked = ($info === "1") ? "checked" : "";
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NQR</title>
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <!-- <li class="breadcrumb-item"><a href="index.php">Home</a></li> -->
          <li class="breadcrumb-item active">Home</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card" onclick="window.location.href='requestppc-cmr.php';"
                style="cursor: pointer;">

                <div class="card-body">
                  <h5 class="card-title">Requested <span>| This Year</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi-dash-circle-fill text-warning"></i>
                    </div>
                    <div class="ps-3">
                      <?php
                      // Melakukan query untuk menghitung jumlah status dengan nilai 2, 3, dan 4
                      $queryJumlahData = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = $currentYear AND sts_cmr_ppc IN (1,2)");

                      // Mengambil nilai jumlah dari hasil query
                      $row = mysqli_fetch_assoc($queryJumlahData);
                      $jumlahStatus = $row['jumlah'];
                      ?>
                      <h6><?php echo $jumlahStatus; ?></h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card" onclick="window.location.href='rejectppc-cmr.php';"
                style="cursor: pointer;">

                <div class="card-body">
                  <h5 class="card-title">Rejected <span>| This Year</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi-x-circle-fill text-danger"></i></a>
                    </div>
                    <div class="ps-3">
                      <?php
                      // Melakukan query untuk menghitung jumlah status dengan nilai 2, 3, dan 4
                      $queryJumlahData = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = $currentYear AND sts_cmr_ppc IN (6, 7, 8)");

                      // Mengambil nilai jumlah dari hasil query
                      $row = mysqli_fetch_assoc($queryJumlahData);
                      $jumlahStatus = $row['jumlah'];
                      ?>
                      <h6><?php echo $jumlahStatus; ?></h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card" onclick="window.location.href='approveppc-cmr.php';"
                style="cursor: pointer;">

                <div class="card-body">
                  <h5 class="card-title">Approved <span>| This Year</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-check-circle-fill text-success"></i></a>
                    </div>
                    <div class="ps-3">
                      <?php
                      // Melakukan query untuk menghitung jumlah status dengan nilai 2, 3, dan 4
                      $queryJumlahData = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = $currentYear AND sts_cmr_ppc IN (3, 4, 5)");

                      // Mengambil nilai jumlah dari hasil query
                      $row = mysqli_fetch_assoc($queryJumlahData);
                      $jumlahStatus = $row['jumlah'];
                      ?>
                      <h6><?php echo $jumlahStatus; ?></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
            <div class="card">
              <div class="card-body">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a id="thisWeek" class="dropdown-item" href="#">This Week</a></li>
                    <li><a id="thisMonth" class="dropdown-item" href="#">This Month</a></li>
                    <li><a id="thisYear" class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <script>
                  // Fungsi untuk mengubah teks di dalam elemen <span> berdasarkan pilihan filter
                  function updateFilterText(text) {
                    document.getElementById('filterText').innerText = text;
                  }

                  // Event listener untuk pilihan "This Week"
                  document.getElementById('thisWeek').addEventListener('click', function () {
                    updateFilterText("| This Week"); // Memperbarui teks filter
                    window.location.href =
                      'dasborcmr_ppc.php?filter=week'; // Redirect dengan filter "week"
                  });

                  // Event listener untuk pilihan "This Month"
                  document.getElementById('thisMonth').addEventListener('click', function () {
                    updateFilterText("| This Month"); // Memperbarui teks filter
                    window.location.href =
                      'dasborcmr_ppc.php?filter=month'; // Redirect dengan filter "month"
                  });

                  // Event listener untuk pilihan "This Year"
                  document.getElementById('thisYear').addEventListener('click', function () {
                    updateFilterText("| This Year"); // Memperbarui teks filter
                    window.location.href =
                      'dasborcmr_ppc.php?filter=year'; // Redirect dengan filter "year"
                  });

                  // Memeriksa apakah ada filter saat halaman dimuat
                  window.onload = function () {
                    var currentFilter =
                      "<?php echo isset($_GET['filter']) ? $_GET['filter'] : ''; ?>";
                    if (currentFilter) {
                      // Jika ada filter, update teks filter dengan filter saat ini
                      updateFilterText("| This " + currentFilter.charAt(0).toUpperCase() +
                        currentFilter.slice(1));
                    } else {
                      // Jika tidak ada filter, biarkan teks filter seperti itu
                      updateFilterText("");
                    }
                  };
                </script>

                <!-- Teks judul dengan elemen <span> untuk menampilkan teks filter -->
                <h5 class="card-title">Claim Report History <span id="filterText"></span></h5>
                <!-- Table with hoverable rows -->
                <table class="table table-hover text-center" id="ppcTable">
                  <thead>
                    <tr>
                      <th scope="col">Cmr No</th>
                      <th scope="col">Pay compensation</th>
                      <th scope="col">Send The replacement</th>
                      <!-- <th scope="col">Detail</th> -->
                      <th scope="col">Status</th>
                      <th scope="col" data-orderable="false">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($user_data = mysqli_fetch_array($query1)) {
                      echo "<tr>";
                      echo "<td>" . $user_data['cmr_no'] . "</td>";
                      echo "<td>" . ($user_data['dotc'] == 1 ? "yes" : "") . "</td>";
                      echo "<td>";

                      // Tampilkan label sesuai dengan nilai 'stc' dan tambahkan nilai 'dt_stc' jika bukan '0000-00-00'
                      if ($user_data['stc'] == 0) {
                        echo "";
                      } elseif ($user_data['stc'] == 1) {
                        echo "By Air";
                      } elseif ($user_data['stc'] == 2) {
                        echo "By Sea";
                      } else {
                        echo $user_data['stc'];
                      }

                      // Tampilkan nilai 'dt_stc' jika bukan '0000-00-00'
                      if ($user_data['stc'] != 0 && $user_data['dt_stc'] != '0000-00-00') {
                        $dt_stc_formatted = date("Y / m / d", strtotime($user_data['dt_stc']));
                        echo " (" . $dt_stc_formatted . ")";
                      }

                      echo "</td>";
                      // echo "<td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#detailModal-" . $user_data['Id'] . "'>Detail</button></td>";
                    
                      // echo "<td>" . substr($user_data['remark'], 0, 10) . "...</td>";
                      echo "</td>";
                      // Mengubah nilai status menjadi "requested" jika status adalah 1
                      $status_label = "";
                      $status_badge = "";

                      switch ($user_data['sts_cmr_ppc']) {
                        case 1:
                          $status_label = "QA Finish";
                          $status_badge = "bg-primary";
                          break;
                        case 2:
                          $status_label = "Requested";
                          $status_badge = "bg-warning text-dark";
                          break;
                        case 3:
                          $status_label = "Approved by Foreman";
                          $status_badge = "bg-success";
                          break;
                        case 4:
                          $status_label = "Approved by Supervisor";
                          $status_badge = "bg-success";
                          break;
                        case 5:
                          $status_label = "Approved by Manager";
                          $status_badge = "bg-success";
                          break;
                        case 6:
                          $status_label = "Rejected by Foreman";
                          $status_badge = "bg-danger";
                          break;
                        case 7:
                          $status_label = "Rejected by Supervisor";
                          $status_badge = "bg-danger";
                          break;
                        case 8:
                          $status_label = "Rejected by Manager";
                          $status_badge = "bg-danger";
                          break;
                        default:
                          $status_label = $user_data['status'];
                      }

                      switch ($user_data['sts_op_ppc']) {
                        case 1:
                          $status_op = "Requested";
                          break;
                        default:
                          $status_op = "";
                      }

                      switch ($user_data['sts_fm_ppc']) {
                        case 1:
                          $status_fm = "Approved by Foreman";
                          break;
                        case 2:
                          $status_fm = "Rejected by Foreman";
                          break;
                        default:
                          $status_fm = "";
                      }

                      switch ($user_data['sts_spv_ppc']) {
                        case 1:
                          $status_spv = "Approved by Supervisor";
                          break;
                        case 2:
                          $status_spv = "Rejected by Supervisor";
                          break;
                        default:
                          $status_spv = "";
                      }

                      switch ($user_data['sts_mgr_ppc']) {
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
                    
                      if (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPPPC' || $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'FMPPC')) {
                        $sts_cmr_ppc = $user_data['sts_cmr_ppc']; // asumsikan status tersedia dalam $user_data
                    
                        // Periksa apakah status adalah 1, 9, 10, atau 11
                        if ($sts_cmr_ppc == 1 || $sts_cmr_ppc == 2 || $sts_cmr_ppc == 6 || $sts_cmr_ppc == 7 || $sts_cmr_ppc == 8) {
                          echo "<a href='edit_cmr_ppc.php?Id={$user_data['Id']}' class='btn btn-success btn-sm' style='padding: 0.25rem 0.5rem;'>
  <i class='ri-edit-2-line' style='color: white;'></i></a>";
                          echo " "; // Menambahkan spasi antara tombol
                        }
                      }
                      // echo "<a href='?hapus={$user_data['Id']}' onclick=\"return confirm('Yakin ingin menghapus data?');\" class='btn btn-danger btn-sm'>
//   <i class='bi bi-trash' style='color: white;'></i></a>";
//   echo " "; // Menambahkan spasi antara tombol
                      echo "<a href='CMR1.php?Id={$user_data['Id']}' target='_blank'><i class='btn btn-warning btn-sm' style='padding: 0.25rem 0.5rem;'>
<i class='bi bi-file-earmark-pdf' style='color: white;'></i></a>";
                      echo "</tr>";


                      // Modal Detail 
                      echo '<div id="detailModal-' . $user_data['Id'] . '" class="modal fade" tabindex="-1" role="dialog">';
                      echo '<div class="modal-dialog modal-dialog-centered" role="document">';
                      echo '<div class="modal-content">';
                      echo '<div class="modal-header">';
                      echo '<h5 style="color: black;" class="modal-title">Detail Data - ' . $user_data['cmr_no'] . '</h5>';
                      echo '<a href="#" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</a>';
                      echo '</div>';
                      echo '<div class="modal-body">';

                      $csSql = "SELECT * FROM transaksi WHERE Id = '{$user_data['Id']}'";

                      $csResult = mysqli_query($koneksi3, $csSql);

                      while ($userData = mysqli_fetch_assoc($csResult)) {
                        //   $status = $userData['status'];
                        $cmr_no = $userData['cmr_no'];
                        $dotc = $userData['dotc'];
                        $stc = $userData['stc'];
                        $dt_stc = isset($userData['dt_stc']) ? $userData['dt_stc'] : "";
                        $dt_stc_formatted = !empty($dt_stc) && $dt_stc != '0000-00-00' ? date("Y / m / d", strtotime($dt_stc)) : "";
                        // $feedback_ppc = $userData['feedback_ppc'];
                        // $remark_ppc = $userData['remark_ppc'];
                      }
                      mysqli_free_result($csResult);

                      // Isi modal dengan data yang sesuai
                    

                      echo '<div class="row mb-3">';
                      echo '<label for="inputText" class="col-sm-4 col-form-label">Disposition of this claim</label>';
                      echo '<div class="col-sm-8">';
                      if ($dotc == 1) {
                        $pText = "Pay compensation";
                        echo '<input type="text" class="form-control mb-2" readonly value="' . $pText . '">';
                      } elseif ($dotc == 2) {
                        $pText = "Send the replacement";
                        echo '<input type="text" class="form-control mb-2" readonly value="' . $pText . '">';
                        // Tampilkan nilai $stc setelah tulisan "Send the replacement"
                        echo '<input type="text" class="form-control mb-2" readonly value="By ';
                        if ($stc == 1) {
                          echo 'Air">';
                        } elseif ($stc == 2) {
                          echo 'Sea">';
                        } else {
                          echo 'Unknown">';
                        }
                        // Tampilkan nilai dt_stc setelah nilai $stc
                        if (!empty($dt_stc_formatted)) {
                          echo '<input type="text" class="form-control" readonly value="' . $dt_stc_formatted . '">';
                        }
                      } else {
                        $pText = ""; // Handle other cases if needed
                        echo '<input type="text" class="form-control" readonly value="' . $pText . '">';
                      }


                      echo '</div>';
                      echo '</div>';

                      // echo '<div class="row mb-3">';
// echo '<label for="inputText" class="col-sm-4 col-form-label">Feedback</label>';
// echo '<div class="col-sm-8">';
// echo '<input type="text" class="form-control" readonly value="' . $feedback_ppc . '">';
// echo '</div>';
// echo '</div>';
                    

                      // echo '<div class="row mb-3">';
// echo '<label for="inputText" class="col-sm-4 col-form-label">Remark</label>';
// echo '<div class="col-sm-8">';
// echo '<input type="text" class="form-control" readonly value="' . $remark_ppc . '">';
// echo '</div>';
// echo '</div>';
                    
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
                      echo '<h5 style="color: black;" class="modal-title">History Data - ' . $user_data['cmr_no'] . '</h5>';
                      echo '<a href="#" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</a>';
                      echo '</div>';
                      echo '<div class="modal-body">';

                      // Ambil data nama dan tanggal dari tabel CS
                      $csSql = "SELECT * FROM transaksi t JOIN status_cmr s ON t.Id = s.Id WHERE t.Id = '{$user_data['Id']}'";

                      $csResult = mysqli_query($koneksi3, $csSql);

                      while ($userData = mysqli_fetch_assoc($csResult)) {
                        $nm_op_ppc = $userData['nm_op_ppc'];
                        $nm_fm_ppc = $userData['nm_fm_ppc'];
                        $nm_spv_ppc = $userData['nm_spv_ppc'];
                        $nm_mgr_ppc = $userData['nm_mgr_ppc'];
                        $dt_op_ppc = $userData['dt_op_ppc'];
                        $dt_fm_ppc = $userData['dt_fm_ppc'];
                        $dt_spv_ppc = $userData['dt_spv_ppc'];
                        $dt_mgr_ppc = $userData['dt_mgr_ppc'];
                        $remark_fm_ppc = $userData['remark_fm_ppc'];
                        $remark_spv_ppc = $userData['remark_spv_ppc'];
                        $remark_mgr_ppc = $userData['remark_mgr_ppc'];
                        $sts_cmr = $userData['sts_cmr'];
                      }
                      mysqli_free_result($csResult);

                      echo '<strong>■. ppc</strong>';
                      echo '<br>';
                      echo '<div class="col-md-12">';
                      echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;status:' . $status_op . '</strong>';
                      echo '<br>';
                      echo '<div class="col-md-12">';
                      if ($dt_op_ppc == '0000-00-00 00:00:00') {
                        $date_formatted = "";
                      } else {
                        $date_formatted = date("Y / m / d H:i:s", strtotime($dt_op_ppc));
                        echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp; {$nm_op_ppc} ({$date_formatted}) <br></span>";
                        echo '<br>';
                      }

                      echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;status:' . $status_fm . '</strong>';
                      echo '<br>';
                      echo '<div class="col-md-12">';
                      if ($dt_fm_ppc == '0000-00-00 00:00:00') {
                        $date_formatted = "";
                      } else {
                        $date_formatted = date("Y / m / d H:i:s", strtotime($dt_fm_ppc));

                        echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp; {$nm_fm_ppc} ($date_formatted) <br></span>";
                      }
                      echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;■ Remark</strong>';
                      echo '<br>';
                      echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $remark_fm_ppc <br></span>";


                      echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;status:' . $status_spv . '</strong>';
                      echo '<br>';
                      echo '<div class="col-md-12">';
                      if ($dt_spv_ppc == '0000-00-00 00:00:00') {
                        $date_formatted = "";
                      } else {
                        $date_formatted = date("Y / m / d H:i:s", strtotime($dt_spv_ppc));
                        echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp; {$nm_spv_ppc} ($date_formatted) <br></span>";
                      }
                      echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;■ Remark</strong>';
                      echo '<br>';
                      echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $remark_spv_ppc <br></span>";


                      echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;status:' . $status_mgr . '</strong>';
                      echo '<br>';
                      echo '<div class="col-md-12">';
                      if ($dt_mgr_ppc == '0000-00-00 00:00:00') {
                        $date_formatted = "";
                      } else {
                        $date_formatted = date("Y / m / d H:i:s", strtotime($dt_mgr_ppc));
                        echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp; {$nm_mgr_ppc} ($date_formatted) <br></span>";
                      }
                      echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;■ Remark</strong>';
                      echo '<br>';
                      echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $remark_mgr_ppc <br></span>";
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

                    }
                    ?>
                  </tbody>

                </table>
              </div>
    </section>

  </main><!-- End #main -->

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

  <!-- Load jQuery and DataTables -->
  <script src="../../../asset/jQuery/jquery-3.6.0.min.js"></script>
  <script src="../../../asset/DataTables/js/datatables.min.js"></script>
  <script src="../../../assets/sweetalert2/package/dist/sweetalert2.all.min.js"></script>

  <script src="../../../assets/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
  <script src="../../../assets/DataTables-2.0.1/js/dataTables.bootstrap4.min.js"></script>

  <script>
    $(document).ready(function () {
      // Define custom sorting function for sts_cmr_ppc column
      $.fn.dataTable.ext.type.order['sts-cmr-ppc-pre'] = function (data) {
        switch (data) {
          case '1':
            return 0;
          case '2':
            return 1;
          case '6':
            return 2;
          case '7':
            return 3;
          case '8':
            return 4;
          case '3':
            return 5;
          case '4':
            return 6;
          case '5':
            return 7;
          default:
            return 8; // Default to a high number for unknown values
        }
      };

      // Initialize DataTable with custom sorting
      $('#ppcTable').DataTable({
        autoWidth: false,
        language: {
          emptyTable: "There is no NQR data in this record"
        },
        lengthMenu: [5, 10, 15, 20, 25], // Menentukan opsi tampilan jumlah entri per halaman
        order: [
          [3, 'asc']
        ], // Sort ascending based on sts_cmr_ppc
        columnDefs: [{
          type: 'sts-cmr-ppc',
          targets: 3
        } // Apply custom sorting to sts_cmr_ppc column
        ]
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


</body>

</html>

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