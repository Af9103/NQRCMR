<?php
session_start();

// Periksa apakah pengguna sudah login, jika belum, redirect ke halaman login
if (!isset($_SESSION["username"]) || !isset($_SESSION["dept"])) {
  echo "Anda harus login terlebih dahulu";
  header("Location: ../../login.php");
  exit; // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}
include(__DIR__ . '/../../../koneksi.php');

// Fungsi untuk mengubah format delay
function formatDelay($delay)
{
  if ($delay >= 720) { // 720 jam dalam satu bulan
    $months = floor($delay / 720); // Menggunakan 4.348 minggu per bulan
    $days = floor(($delay % 720) / 24);
    $hours = $delay % 24;
    $result = $months . " bulan";
    if ($days > 0) {
      $result .= " " . $days . " hari";
    }
    if ($hours > 0) {
      $result .= " " . $hours . " jam";
    }
    return $result;
  } elseif ($delay >= 168) { // 168 jam dalam satu minggu
    $weeks = floor($delay / 168);
    $days = floor(($delay % 168) / 24);
    $hours = $delay % 24;
    $result = $weeks . " minggu";
    if ($days > 0) {
      $result .= " " . $days . " hari";
    }
    if ($hours > 0) {
      $result .= " " . $hours . " jam";
    }
    return $result;
  } elseif ($delay >= 24) {
    $days = floor($delay / 24);
    $hours = $delay % 24;
    $result = $days . " hari";
    if ($hours > 0) {
      $result .= " " . $hours . " jam";
    }
    return $result;
  } else {
    return $delay . " jam";
  }
}

if (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPQA' || $_SESSION['role'] == 'admin')) {
  // Query untuk menghitung jumlah data
  $queryKasir = mysqli_query($koneksi, "SELECT reg_no, dt_op_qa,
    CASE
        WHEN status = 1 THEN TIMESTAMPDIFF(HOUR, dt_op_qa, NOW())
        WHEN status = 2 THEN TIMESTAMPDIFF(HOUR, dt_fm_qa, NOW())
        WHEN status = 3 THEN TIMESTAMPDIFF(HOUR, dt_spv_qa, NOW())
        ELSE 0
    END AS delay,
    CASE
        WHEN status = 1 THEN 'Foreman'
        WHEN status = 2 THEN 'Supervisor'
        WHEN status = 3 THEN 'Manager'
        ELSE ''
    END AS approval_role
    FROM transaksi
    HAVING delay != 0
    ORDER BY delay DESC;
    ");

  if (!$queryKasir) {
    // Tangani kesalahan eksekusi query
    die("Query error: " . mysqli_error($koneksi));
  }
} elseif (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPPPC')) {
  // Query untuk menghitung jumlah data
  $queryKasir = mysqli_query($koneksi, "SELECT reg_no, dt_op_qa,
    CASE
        WHEN status_ppc = 2 THEN TIMESTAMPDIFF(HOUR, dt_op_ppc, NOW())
        WHEN status_ppc = 3 THEN TIMESTAMPDIFF(HOUR, dt_fm_ppc, NOW())
        WHEN status_ppc = 4 THEN TIMESTAMPDIFF(HOUR, dt_spv_ppc, NOW())
        ELSE 0
    END AS delay,
    CASE
        WHEN status_ppc = 2 THEN 'Foreman'
        WHEN status_ppc = 3 THEN 'Supervisor'
        WHEN status_ppc = 4 THEN 'Manager'
        ELSE ''
    END AS approval_role
    FROM transaksi
    HAVING delay != 0
    ORDER BY delay DESC;
    ");
  if (!$queryKasir) {
    // Tangani kesalahan eksekusi query
    die("Query error: " . mysqli_error($koneksi));
  }
} elseif (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPVDD')) {
  // Query untuk menghitung jumlah data
  $queryKasir = mysqli_query($koneksi, "SELECT reg_no, dt_op_qa,
    CASE
        WHEN status_vdd = 2 THEN TIMESTAMPDIFF(HOUR, dt_op_vdd, NOW())
        WHEN status_vdd = 3 THEN TIMESTAMPDIFF(HOUR, dt_fm_vdd, NOW())
        WHEN status_vdd = 4 THEN TIMESTAMPDIFF(HOUR, dt_spv_vdd, NOW())
        ELSE 0
    END AS delay,
    CASE
        WHEN status_vdd = 2 THEN 'Foreman'
        WHEN status_vdd = 3 THEN 'Supervisor'
        WHEN status_vdd = 4 THEN 'Manager'
        ELSE ''
    END AS approval_role
    FROM transaksi
    HAVING delay != 0
    ORDER BY delay DESC;
    ");
  if (!$queryKasir) {
    // Tangani kesalahan eksekusi query
    die("Query error: " . mysqli_error($koneksi));
  }
}

// Proses POST request untuk pengiriman notifikasi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Ambil data dari POST
  $reg_no = $_POST['reg_no'];
  $message = $_POST['message'];
  $flags = $_POST['flags'];
  $query_npk = $_POST['query_npk'];

  // Execute the query to get NPKs
  $result_npk = mysqli_query($koneksi2, $query_npk);
  $npk_list = array();

  if ($result_npk) {
    while ($row = mysqli_fetch_assoc($result_npk)) {
      $npk_list[] = "'" . $row['npk'] . "'";
    }
  }

  if (!empty($npk_list)) {
    // Convert NPK array to string for the phone query
    $npk_list_str = implode(',', $npk_list);

    // Query to get phone numbers based on NPK list
    $query_phone = "SELECT no_hp FROM hp WHERE npk IN ($npk_list_str)";
    $result_phone = mysqli_query($koneksi4, $query_phone);

    if ($result_phone && mysqli_num_rows($result_phone) > 0) {
      while ($phone_row = mysqli_fetch_assoc($result_phone)) {
        $phone_number = $phone_row['no_hp'];

        // Insert into the notif table for each phone number
        $query_insert_notif = "INSERT INTO notif (phone_number, message, flags) VALUES ('$phone_number', '$message', '$flags')";
        if (!mysqli_query($koneksi, $query_insert_notif)) {
          die("Error inserting notification for phone number $phone_number: " . mysqli_error($koneksi));
        }
      }
      echo "Notifications sent successfully.";
    } else {
      echo "No phone numbers found.";
    }
  } else {
    echo "No NPKs found for the specified role.";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Reminder - NQR</title>
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
      <h1>List NQR</h1>
      <nav>
        <ol class="breadcrumb">
          <!-- <li class="breadcrumb-item"><a href="index.php">Home</a></li> -->
          <!-- <li class="breadcrumb-item"><a href="#">#</a></li> -->
          <li class="breadcrumb-item active">List NQR </li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="notif.php">
          NQR<span style="font-size: smaller; opacity: 0.7;"> </span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="../../cmr/qa/notifcmr.php">CMR<span
            style="font-size: smaller; opacity: 0.7;"></span></a>
      </li>
    </ul>

    <section class="section dashboard">

      </div>

      </div>
      </div><!-- End Reports -->

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data NQR</h5>

          <!-- konten -->
          <table class="table table-hover text-center" id="ppcTable">
            <thead>
              <tr>
                <th scope="col">Reg No</th>
                <th scope="col">delay</th>
                <th scope="col">Pending Approval</th>
                <th scope="col" data-orderable="false">Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              while ($user_data = mysqli_fetch_array($queryKasir)) {
                echo "<tr>";
                echo "<td>" . $user_data['reg_no'] . "</td>";
                echo "<td>" . formatDelay($user_data['delay']) . "</td>";
                echo "<td>" . $user_data['approval_role'] . "</td>";
                echo '<td><button type="button" class="btn btn-warning btn-sm" onclick="sendWhatsAppMessage(\'' . $user_data['reg_no'] . '\', \'' . $user_data['approval_role'] . '\', \'' . formatDelay($user_data['delay']) . '\')">Send Notif</button></td>';
                echo "</tr>";
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
  <script src="../../../asset/sweetalert2/sweet.js"></script>
  <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Load jQuery and DataTables -->
  <script src="../../../asset/jQuery/jquery-3.6.0.min.js"></script>
  <script src="../../../asset/DataTables/js/datatables.min.js"></script>
  <script src="../../../assets/sweetalert2/package/dist/sweetalert2.all.min.js"></script>
  <script src="../../../assets/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
  <script src="../../../assets/DataTables-2.0.1/js/dataTables.bootstrap4.min.js"></script>

  <script>
    function sendWhatsAppMessage(reg_no, approval_role, delay) {
      // Create the message based on the approval role
      let message = `NQR dengan nomor ${reg_no} belum diperiksa oleh ${approval_role} selama ${delay}.`;
      let flags = "queue";

      // Define the appropriate query based on the approval role
      let query_npk = "";

      // Check the session role and adjust the query accordingly
      if (<?php echo json_encode($_SESSION['role'] == 'OPQA'); ?>) {
        if (approval_role === 'Foreman') {
          query_npk = "SELECT npk FROM ct_users WHERE golongan = 3 AND acting = 2 AND dept = 'QA'";
        } else if (approval_role === 'Supervisor') {
          query_npk = "SELECT npk FROM ct_users WHERE golongan = 4 AND acting = 2 AND dept = 'QA'";
        } else if (approval_role === 'Manager') {
          query_npk = "SELECT npk FROM ct_users WHERE golongan = 4 AND acting = 1 AND dept = 'QA'";
        }
      } else if (<?php echo json_encode($_SESSION['role'] == 'OPPPC'); ?>) {
        if (approval_role === 'Foreman') {
          query_npk = "SELECT npk FROM ct_users WHERE golongan = 3 AND acting = 2 AND dept = 'PPC'";
        } else if (approval_role === 'Supervisor') {
          query_npk = "SELECT npk FROM ct_users WHERE golongan = 4 AND acting = 2 AND dept = 'PPC'";
        } else if (approval_role === 'Manager') {
          query_npk = "SELECT npk FROM ct_users WHERE golongan = 4 AND acting = 1 AND dept = 'PPC'";
        }
      } else if (<?php echo json_encode($_SESSION['role'] == 'OPVDD'); ?>) {
        if (approval_role === 'Foreman') {
          query_npk = "SELECT npk FROM ct_users WHERE golongan = 3 AND acting = 2 AND dept = 'VDD'";
        } else if (approval_role === 'Supervisor') {
          query_npk = "SELECT npk FROM ct_users WHERE golongan = 4 AND acting = 2 AND dept = 'VDD'";
        } else if (approval_role === 'Manager') {
          query_npk = "SELECT npk FROM ct_users WHERE golongan = 4 AND acting = 1 AND dept = 'VDD'";
        }
      }

      // Send the AJAX request with the message and flags
      $.ajax({
        type: "POST",
        url: "notif.php",
        data: {
          reg_no: reg_no,
          message: message,
          flags: flags,
          query_npk: query_npk
        },
        success: function (response) {
          Swal.fire({
            icon: 'success',
            title: 'Notification Sent',
            text: 'The notification has been successfully sent.',
          });
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
          });
        }
      });
    }
  </script>


  <script>
    $(document).ready(function () {
      $('#ppcTable').DataTable({
        autoWidth: false,
        "language": {
          "emptyTable": "there is no NQR data in this record"
        },
        "lengthMenu": [5, 10, 15, 20, 25], // Menentukan opsi tampilan jumlah entri per halaman
        "order": [
          [1]
        ] // Mengurutkan berdasarkan kolom pertama secara menaik
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
</style>