<?php
session_start();

// Periksa apakah pengguna sudah login, jika belum, redirect ke halaman login
if (!isset($_SESSION["username"]) || !isset($_SESSION["dept"])) {
  echo "Anda harus login terlebih dahulu";
  header("Location: ../login.php");
  exit; // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}

include '../../koneksi.php';

$currentYear = date("Y");

// Query untuk mengambil data kota sesuai halaman aktif
$queryKasir = mysqli_query($koneksi3, "SELECT * FROM transaksi t INNER JOIN status_cmr s ON t.Id = s.Id WHERE YEAR(s.dt_op_qa) = $currentYear AND sts_cmr_vdd IN (5)");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Download CMR - CMR</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../assets/img/k-logo.jpg" rel="icon">
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="../../assets/DataTables-2.0.1/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <!-- <link href="https://cdn.datatables.net/v/bs4/dt-2.0.1/.css" rel="stylesheet"> -->

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">

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
    <?php include '../../layout/header.php'; ?>
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <?php include '../../layout/sidebar.php'; ?>
  </aside><!-- End Sidebar-->
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Download CMR</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dasborcmr_vdd.php">Home</a></li>
          <!-- <li class="breadcrumb-item"><a href="#">#</a></li> -->
          <li class="breadcrumb-item active">Download NQR</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <ul class="nav nav-tabs">
      <li class="nav-item active">
        <a class="nav-link" aria-current="page" href="../nqr/donlodnqr.php">
          NQR<span style="font-size: smaller; opacity: 0.7;"> </span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link active" href="donlodcmr.php">CMR<span style="font-size: smaller; opacity: 0.7;"></span></a>
      </li>
    </ul>

    <!-- konten -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Download <span>| CMR</span></h5>

        <!-- Table with hoverable rows -->
        <table class="table table-hover text-center" id="dasborTable">
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
            while ($user_data = mysqli_fetch_array($queryKasir)) {
              echo "<tr>";
              echo "<td>" . $user_data['cmr_no'] . "</td>";
              echo "<td>" . $user_data['supp_name'] . "</td>";
              echo "<td>" . $user_data['part_name'] . "</td>";
              echo "<td>" . $user_data['part_num'] . "</td>";

              // echo "<td>" . substr($user_data['remark'], 0, 10) . "...</td>";
              echo "</td>";
              // Mengubah nilai status menjadi "requested" jika status adalah 1
              $status_label = "";
              $status_badge = "";

              switch ($user_data['sts_cmr_vdd']) {
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

              switch ($user_data['status_op_vdd']) {
                case 1:
                  $status_op = "Requested";
                  break;
                default:
                  $status_op = "";
              }

              switch ($user_data['status_fm_vdd']) {
                case 1:
                  $status_fm = "Approved by Foreman";
                  break;
                case 2:
                  $status_fm = "Rejected by Foreman";
                  break;
                default:
                  $status_fm = "";
              }

              switch ($user_data['status_spv_vdd']) {
                case 1:
                  $status_spv = "Approved by Supervisor";
                  break;
                case 2:
                  $status_spv = "Rejected by Supervisor";
                  break;
                default:
                  $status_spv = "";
              }

              switch ($user_data['status_mgr_vdd']) {
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
              echo "<a href='../../output/CMR1.php?Id={$user_data['Id']}' target='_blank' class='btn btn-danger btn-sm' style='padding: 0.25rem 0.5rem;'>
<i class='bi bi-file-earmark-pdf' style='color: white;'></i></a>";
              echo " "; // Menambahkan spasi antara tombol
              echo "<a href='../../output/CMR1.php?Id={$user_data['Id']}' download='{$user_data['cmr_no']}.pdf' class='btn btn-primary btn-sm download-link' style='padding: 0.25rem 0.5rem;' target='_blank'>
<i class='ri-file-download-line'></i>
</a>";

              echo "</td>";


              if (isset($_POST['Id'])) {
                include 'koneksi.php';
                $Id = $_POST['Id']; // tambahkan ini untuk mendapatkan nilai $_POST['Id']
                $status = $_POST['status'];
                $dt_op_qa = date("Y-m-d");

                // Eksekusi query update
                $result = mysqli_query($koneksi, "UPDATE transaksi SET dt_op_qa='$dt_op_qa', status='1' WHERE Id='$Id'");
                if ($result) {
                  echo "Data berhasil diupdate";
                } else {
                  echo "Gagal mengupdate data: " . mysqli_error($koneksi);
                }
              }
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
              echo '<button type="button" class="btn btn-secondary custom-button" data-dismiss="modal">Tutup</button>';
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
        <script src="asset/sweetalert2/package/dist/sweetalert2.all.min.js"></script>
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            const downloadLink = document.querySelector('.download-link');
            downloadLink.addEventListener('click', function (event) {
              event.preventDefault();

              // Memulai Sweet Alert saat tombol unduh diklik
              let timerInterval;
              Swal.fire({
                title: "Mohon Tunggu...",
                timer: 1500,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading();
                  const timer = Swal.getPopup().querySelector("b");
                  timerInterval = setInterval(() => {
                    timer.textContent = `${Math.ceil(Swal.getTimerLeft() / 1000)}`;
                  }, 100);
                },
                willClose: () => {
                  clearInterval(timerInterval);
                }
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  console.log("I was closed by the timer");
                }
              });

              // Mengarahkan pengguna ke URL unduhan setelah beberapa waktu (2 detik)
              setTimeout(() => {
                window.location.href = downloadLink.getAttribute('href');
              }, 1500);
            });
          });
        </script>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <?php include '../../layout/footer.php'; ?>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/vendor/quill/quill.min.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>


  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>

  <!-- Load jQuery and DataTables -->
  <script src="../../asset/jQuery/jquery-3.6.0.min.js"></script>
  <script src="../../asset/DataTables/js/datatables.min.js"></script>
  <script src="../../assets/sweetalert3/package/dist/sweetalert2.all.min.js"></script>

  <script src="../../assets/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
  <script src="../../assets/DataTables-2.0.1/js/dataTables.bootstrap4.min.js"></script>

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
      $('#dasborTable').DataTable({
        autoWidth: false,
        "language": {
          "emptyTable": "there is no NQR data in this record"
        },
        "lengthMenu": [5, 10, 15, 20, 25] // Menentukan opsi tampilan jumlah entri per halaman
      });
    });
  </script>

  <style>
    .dataTables_wrapper .dataTables_filter {
      float: right;
      margin-right: 10px;
    }

    #dasborTable th {
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