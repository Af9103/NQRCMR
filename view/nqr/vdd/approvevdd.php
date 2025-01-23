<?php
session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["dept"]) || $_SESSION["dept"] !== "VDD") {
  echo "Anda harus login terlebih dahulu";
  header("Location: ../../forbidden.php");
  exit; // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}

include(__DIR__ . '/../../../koneksi.php');

// Konfigurasi jumlah data per halaman
$currentYear = date("Y");
// Query untuk mengambil data kota sesuai halaman aktif
$status_vdd = isset($_GET['status_vdd']) ? $_GET['status_vdd'] : "3";

// Query untuk mengambil data kota sesuai status yang dipilih
$queryKasir = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE YEAR(dt_op_qa) = $currentYear AND status_vdd IN ($status_vdd)");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Approved List - NQR</title>
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
      <h1>Approved NQR List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dasbor-vdd.php">Home</a></li>
          <!-- <li class="breadcrumb-item"><a href="#">#</a></li> -->
          <li class="breadcrumb-item active">NQR Approved</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <ul class="nav nav-tabs">
      <li class="nav-item">
        <?php
        // Melakukan query untuk menghitung jumlah status dengan nilai 2
        $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = $currentYear AND status_vdd = 3");
        $row = mysqli_fetch_assoc($queryJumlahData);
        $jumlahStatus = $row['jumlah'];
        ?>
        <a class="nav-link <?php echo $status_vdd == 3 ? 'active' : ''; ?>" aria-current="page"
          href="approvevdd.php">Approved by Foreman<span style="font-size: smaller; opacity: 0.7;">
            (<?php echo $jumlahStatus; ?>)</span></a>
      </li>
      <li class="nav-item">
        <?php
        // Melakukan query untuk menghitung jumlah status dengan nilai 2
        $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = $currentYear AND status_vdd = 4");
        $row = mysqli_fetch_assoc($queryJumlahData);
        $jumlahStatus = $row['jumlah'];
        ?>
        <a class="nav-link <?php echo $status_vdd == 4 ? 'active' : ''; ?>" href="approvevdd.php?status_vdd=4">Approved
          by
          SPV<span style="font-size: smaller; opacity: 0.7;"> (<?php echo $jumlahStatus; ?>)</span></a>
      </li>
      <li class="nav-item">
        <?php
        // Melakukan query untuk menghitung jumlah status dengan nilai 2
        $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = $currentYear AND status_vdd = 5");
        $row = mysqli_fetch_assoc($queryJumlahData);
        $jumlahStatus = $row['jumlah'];
        ?>
        <a class="nav-link <?php echo $status_vdd == 5 ? 'active' : ''; ?>" aria-current="page"
          href="approvevdd.php?status_vdd=5">Approved by Manager<span style="font-size: smaller; opacity: 0.7;">
            (<?php echo $jumlahStatus; ?>)</span></a>
      </li>
    </ul>
    <!-- konten -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Approved <span>| NQR</span></h5>

        <!-- Table with hoverable rows -->
        <table class="table table-hover text-center" id="ppcTable">
          <thead>
            <tr>
              <th scope="col">Reg No</th>
              <th scope="col">Pay compensation</th>
              <th scope="col">Send The replacement</th>
              <!-- <th scope="col">Detail</th> -->
              <th scope="col">Status</th>
              <th scope="col" data-orderable="false">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($user_data = mysqli_fetch_array($queryKasir)) {
              echo "<tr>";
              echo "<td>" . $user_data['reg_no'] . "</td>";
              echo "<td>" . ($user_data['p'] == 1 ? ($user_data['pay'] != "" ? "yes (" . $user_data['pay'] . ")" : "yes ") : "") . "</td>";
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
              //  echo "<td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#detailModal-" . $user_data['Id'] . "'>Detail</button></td>"; 
            
              $remark_vdd = $user_data['remark_vdd'];

              echo "</td>";
              // Mengubah nilai status menjadi "requested" jika status adalah 1
              $status_label = "";
              $status_badge = "";

              switch ($user_data['status_vdd']) {
                case 1:
                  $status_label = "PPC Finish";
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

              switch ($user_data['sts_op_vdd']) {
                case 1:
                  $status_op = "Requested";
                  break;
                default:
                  $status_op = "";
              }

              switch ($user_data['sts_fm_vdd']) {
                case 1:
                  $status_fm = "Approved by Foreman";
                  break;
                case 2:
                  $status_fm = "Rejected by Foreman";
                  break;
                default:
                  $status_fm = "";
              }

              switch ($user_data['sts_spv_vdd']) {
                case 1:
                  $status_spv = "Approved by SPV";
                  break;
                case 2:
                  $status_spv = "Rejected by SPV";
                  break;
                default:
                  $status_spv = "";
              }

              switch ($user_data['sts_mgr_vdd']) {
                case 1:
                  $status_mgr = "Approved by MGR";
                  break;
                case 2:
                  $status_mgr = "Rejected by MGR";
                  break;
                default:
                  $status_mgr = "";
              }

              echo "<td><a href='#' class='badge $status_badge' data-toggle='modal' data-target='#historyModal-" . $user_data['Id'] . "'>" . $status_label . "</a></td>";
              // Tambahkan pengecekan role di sini
              echo "<td>";
              echo "<a href='#' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#detailModal-" . $user_data['Id'] . "'>
        <i class='ri-file-search-line' style='color: white;'></i>
      </a>";
              echo " "; // Menambahkan spasi antara tombol
              if (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPVDD' || $_SESSION['role'] == 'admin')) {
                $status_vdd = $user_data['status_vdd']; // asumsikan status tersedia dalam $user_data
            
                // Periksa apakah status adalah 1, 9, 10, atau 11
                if ($status_vdd == 1 || $status_vdd == 2 || $status_vdd == 6 || $status_vdd == 7 || $status_vdd == 8) {
                  echo "<a href='nqrvdd.php?Id={$user_data['Id']}' class='btn btn-success btn-sm' style='padding: 0.25rem 0.5rem;'>
  <i class='ri-edit-2-line' style='color: white;'></i></a>";
                  echo " "; // Menambahkan spasi antara tombol
                }
              }
              echo "<a href='../../../output/NQR2.php?Id={$user_data['Id']}' target='_blank'><i class='btn btn-warning btn-sm' style='padding: 0.25rem 0.5rem;'>
<i class='bi bi-file-earmark-pdf' style='color: white;'></i></a>";
              echo "</tr>";


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
                $p = $userData['p'];
                $stc = $userData['stc'];
                $dt_stc = isset($userData['dt_stc']) ? $userData['dt_stc'] : "";
                $dt_stc_formatted = !empty($dt_stc) && $dt_stc != '0000-00-00' ? date("Y / m / d", strtotime($dt_stc)) : "";
                $remark_vdd = $userData['remark_vdd'];
                $pay = $userData['pay'];
              }
              mysqli_free_result($csResult);

              // Isi modal dengan data yang sesuai
              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Disposition of this claim</label>';
              echo '<div class="col-sm-8">';
              if ($p == 1) {
                $pText = "Pay compensation";
                echo '<input type="text" class="form-control mb-2" readonly value="' . $pText . '">';
                echo '<input type="text" class="form-control mb-2" readonly value="' . $pay . '">';
              } elseif ($p == 2) {
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

              echo '<div class="row mb-3">';
              echo '<label for="inputText" class="col-sm-4 col-form-label">Remark</label>';
              echo '<div class="col-sm-8">';
              echo '<input type="text" class="form-control" readonly value="' . $remark_vdd . '">';
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
                $nm_op_vdd = $userData['nm_op_vdd'];
                $nm_fm_vdd = $userData['nm_fm_vdd'];
                $nm_spv_vdd = $userData['nm_spv_vdd'];
                $nm_mgr_vdd = $userData['nm_mgr_vdd'];
                $dt_op_vdd = $userData['dt_op_vdd'];
                $dt_fm_vdd = $userData['dt_fm_vdd'];
                $dt_spv_vdd = $userData['dt_spv_vdd'];
                $dt_mgr_vdd = $userData['dt_mgr_vdd'];
                $remark_fm_vdd = $userData['remark_fm_vdd'];
                $remark_spv_vdd = $userData['remark_spv_vdd'];
                $remark_mgr_vdd = $userData['remark_mgr_vdd'];
                $status = $userData['status'];
              }
              mysqli_free_result($csResult);

              echo '<strong>■. vdd</strong>';
              echo '<br>';
              echo '<div class="col-md-12">';
              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;status:' . $status_op . '</strong>';
              echo '<br>';
              echo '<div class="col-md-12">';
              if ($dt_op_vdd == '0000-00-00 00:00:00') {
                $date_formatted = "";
              } else {
                $date_formatted = date("Y / m / d H:i:s", strtotime($dt_op_vdd));
                echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp; {$nm_op_vdd} ({$date_formatted}) <br></span>";
                echo '<br>';
              }

              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;status:' . $status_fm . '</strong>';
              echo '<br>';
              echo '<div class="col-md-12">';
              if ($dt_fm_vdd == '0000-00-00 00:00:00') {
                $date_formatted = "";
              } else {
                $date_formatted = date("Y / m / d H:i:s", strtotime($dt_fm_vdd));

                echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp; {$nm_fm_vdd} ($date_formatted) <br></span>";
              }
              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;■ Remark</strong>';
              echo '<br>';
              echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $remark_fm_vdd <br></span>";


              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;status:' . $status_spv . '</strong>';
              echo '<br>';
              echo '<div class="col-md-12">';
              if ($dt_spv_vdd == '0000-00-00 00:00:00') {
                $date_formatted = "";
              } else {
                $date_formatted = date("Y / m / d H:i:s", strtotime($dt_spv_vdd));
                echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp; {$nm_spv_vdd} ($date_formatted) <br></span>";
              }
              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;■ Remark</strong>';
              echo '<br>';
              echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $remark_spv_vdd <br></span>";


              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;status:' . $status_mgr . '</strong>';
              echo '<br>';
              echo '<div class="col-md-12">';
              if ($dt_mgr_vdd == '0000-00-00 00:00:00') {
                $date_formatted = "";
              } else {
                $date_formatted = date("Y / m / d H:i:s", strtotime($dt_mgr_vdd));
                echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp; {$nm_mgr_vdd} ($date_formatted) <br></span>";
              }
              echo '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;■ Remark</strong>';
              echo '<br>';
              echo "<span style='color: black;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $remark_mgr_vdd <br></span>";
              echo '<br>';
              echo '</div>';
              // Tambahkan detail lainnya di sini jika diperlukan
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '<div class="modal-footer">';
              echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';

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
      </div>
      </section>

  </main><!-- End #main -->

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