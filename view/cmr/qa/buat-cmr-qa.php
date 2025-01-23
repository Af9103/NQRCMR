<?php
session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["dept"]) || $_SESSION["dept"] !== "QA") {
    echo "Anda harus login terlebih dahulu";
    header("Location: ../../forbidden.php");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}

include(__DIR__ . '/../../../koneksi.php');
include(__DIR__ . '/../../../function.php');

$process = isset($_GET['alert']) ? ($_GET['alert']) : false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Buat CMR - CMR</title>
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
    <header id="header" class="header fixed-top d-flex align-items-center">
        <?php include '../../../layout/header.php'; ?>
    </header>

    <aside id="sidebar" class="sidebar">
        <?php include '../../../layout/sidebar.php'; ?>
    </aside>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Buat Laporan CMR</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dasborcmr.php">Home</a></li>
                    <li class="breadcrumb-item active">Membuat CMR</li>
                </ol>
            </nav>
        </div>

        <!-- Tampilkan pesan -->
        <!-- <?php if (!empty($msg)): ?> -->
            <div id="successMessage" class="alert alert-success" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Buat Laporan CMR</h5>
                            <form id="myForm" method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="supp_name" class="col-sm-4 col-form-label">Supplier Name<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <select id="supp" name="supp_name" required>
                                            <option value="" disabled selected hidden>Select Supplier</option>
                                            <?php
                                            $query = mysqli_query($koneksi, "SELECT * FROM supplier");
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo "<option value='" . $row['nama'] . "'>" . $row['bpid'] . " - " . $row['nama'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="datepicker" class="col-sm-4 col-form-label">Issued Date<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="datepicker1" name="iss_dt"
                                            autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="datepicker" class="col-sm-4 col-form-label">Found Date<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="datepicker2" name="found_dt"
                                            autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="datepicker" class="col-sm-4 col-form-label">A/R Date<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="datepicker3" name="ar_dt"
                                            autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="datepicker" class="col-sm-4 col-form-label">KYB CMR No</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="kybNo" name="kybNo">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="datepicker" class="col-sm-4 col-form-label">B/L Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="datepicker4" name="bl_dt"
                                            autocomplete="off">
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0">Location Claim Occur<span
                                            class="wajib">*</span></legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco1" value="1"
                                                required>
                                            <label class="form-check-label" for="lco1">
                                                Receiving Insp
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco2" value="2"
                                                required>
                                            <label class="form-check-label" for="lco2">
                                                In-Process
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lco" id="lco3" value="3"
                                                required>
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
                                                value="1" required>
                                            <label class="form-check-label" for="doi11">
                                                Sorted by customer
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi1" id="doi12"
                                                value="2" required>
                                            <label class="form-check-label" for="doi12">
                                                Sorted by PT.KYB
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi1" id="doi13"
                                                value="3" required>
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
                                                value="1" required>
                                            <label class="form-check-label" for="doi21">
                                                Sorted bt PT KYBI
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi2" id="doi22"
                                                value="2" required>
                                            <label class="form-check-label" for="doi22">
                                                Keep to use
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi2" id="doi23"
                                                value="3" required>
                                            <label class="form-check-label" for="doi23">
                                                Return to KYB
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="doi2" id="doi24"
                                                value="4" required>
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
                                                required>
                                            <label class="form-check-label" for="cof1">
                                                First Time
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof2" value="2"
                                                required>
                                            <label class="form-check-label" for="cof2">
                                                Reoccurred
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof3" value="3"
                                                required>
                                            <label class="form-check-label" for="lco3">
                                                Intermittently
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof4" value="4"
                                                required>
                                            <label class="form-check-label" for="lco4">
                                                Continously
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cof" id="cof5" value="5"
                                                required>
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
                                                value="1" required>
                                            <label class="form-check-label" for="dispo1">
                                                Keep to use
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dispo" id="dispo2"
                                                value="2" required>
                                            <label class="form-check-label" for="dispo2">
                                                Retrun to KYB
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dispo" id="dispo3"
                                                value="3" required>
                                            <label class="form-check-label" for="lco3">
                                                Scrapped at PT KYB
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">No.Invoice<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="invoice" name="invoice">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Order<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="order_no" name="order_no">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">product<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="product" name="product">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Model<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="model" name="model">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Part Name<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="part_name" data-live-search="true">
                                            <option value="" disabled selected hidden>Select Part Name</option>
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
                                    <label for="inputText" class="col-sm-4 col-form-label">Part Number<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="part_num" data-live-search="true" class="selectpicker"
                                            data-live-search-placeholder="Search">
                                            <option value="" disabled selected hidden>Select Part Number</option>
                                            <?php
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
                                        <input type="text" class="form-control" id="qty_order" name="qty_order"
                                            oninput="formatNumber(this)">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Quantity delivered<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="qty_del" name="qty_del"
                                            oninput="formatNumber(this)">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Quantity defect<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="qty_def" name="qty_def"
                                            oninput="formatNumber(this)">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Crate Number<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="crate_num" name="crate_num">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-4 col-form-label">Problem<span
                                            class="wajib">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="problem" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="fileInput" class="col-sm-4 col-form-label">Attachment<span
                                            class="wajib">*</span>
                                        <small class="form-text text-muted">(PDF only, max 2MB)</small>
                                        <span id="fileError" class="text-danger d-block"></span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control mb-2" name="file" id="fileInput">
                                        <div id="filePreview"></div>
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
                                    </div>
                                </div>

                                <script>
                                    document.getElementById('fileInput').addEventListener('change', function () {
                                        const file = this.files[0];
                                        const fileError = document.getElementById('fileError');
                                        const filePreview = document.getElementById('filePreview');
                                        fileError.textContent = '';
                                        filePreview.innerHTML = '';

                                        if (file) {
                                            const fileType = file.type;
                                            const fileSize = file.size;

                                            // Check if file is a PDF
                                            if (fileType !== 'application/pdf') {
                                                fileError.textContent = 'Format file tidak sesuai(PDF Only)';
                                                return;
                                            }
                                            // Check if file size exceeds 2MB
                                            if (fileSize > 2 * 1024 * 1024) {
                                                fileError.textContent = 'Ukuran file terlalu besar*';
                                                return;
                                            }

                                            const reader = new FileReader();
                                            reader.onload = function (event) {
                                                const preview = document.createElement('embed');
                                                preview.setAttribute('src', event.target.result);
                                                preview.setAttribute('class',
                                                    'mb-12'); // Menyesuaikan kelas CSS
                                                preview.setAttribute('width', '100%'); // Lebar 100%
                                                preview.setAttribute('height',
                                                    '500px'); // Sesuaikan jika diperlukan
                                                filePreview.appendChild(preview);
                                            }

                                            reader.readAsDataURL(file);
                                        } else {
                                            filePreview.innerHTML = 'No file selected';
                                        }
                                    });
                                </script>
                                <!-- Tambahkan elemen form lainnya sesuai kebutuhan -->

                                <div class="col sm-6 text-end">
                                    <button class="btn btn-primary custom-button" type="submit"
                                        name="submit">Submit</button>
                                    <button type="reset" class="btn btn-danger custom-button"
                                        form="myForm">Reset</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
    </main>
    <footer id="footer" class="footer">
        <?php include '../../../layout/footer.php'; ?>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script src="../../../assets/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- Vendor JS Files -->
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../asset/jQuery/jquery-3.6.0.js"></script>
    <script src="../../../asset/jQuery/jquery-ui-1.13.2.custom/jquery-ui.js"></script>


    <!-- Template Main JS File -->
    <script src="../../../assets/js/main.js"></script>

    <?php
    require_once '../../../helper.php';

    $process = isset($_GET['alert']) ? ($_GET['alert']) : false;
    // Inisialisasi variabel-variabel yang digunakan dalam query SQL
    $cmr_no = '';
    $iss_dt = isset($_POST['iss_dt']) ? date('Y/m/d', strtotime($_POST['iss_dt'])) : '';
    $found_dt = isset($_POST['found_dt']) ? date('Y/m/d', strtotime($_POST['found_dt'])) : '';
    $ar_dt = isset($_POST['ar_dt']) ? date('Y/m/d', strtotime($_POST['ar_dt'])) : '';
    $kybNo = isset($_POST['kybNo']) ? input($_POST['kybNo']) : '';
    $bl_dt = isset($_POST['bl_dt']) ? date('Y/m/d', strtotime($_POST['bl_dt'])) : '';
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
    $sts_cmr = 1; // Atur status ke 1
    $nm_op_qa = isset($_SESSION['name']) ? $_SESSION['name'] : '';
    $status_op_qa = 1;
    date_default_timezone_set("Asia/Bangkok"); // Set zona waktu ke Asia/Bangkok
    $dt_op_qa = date("Y-m-d H:i:s"); // Menggunakan format "YYYY-MM-DD HH:MM:SS" untuk tanggal dan waktu saat ini
    
    $current_month = date('m');
    $query = "SELECT COUNT(Id) AS count FROM status_cmr WHERE MONTH(dt_op_qa) = $current_month";
    $result = mysqli_query($koneksi3, $query);
    $row = mysqli_fetch_assoc($result);

    // Membuat nomor berikutnya dengan dua digit
    $next_id_padded = str_pad($row['count'] + 1, 2, "0", STR_PAD_LEFT);

    // Format NQR
    function bulan_romawi($bulan)
    {
        $romawi = array(
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        );
        return $romawi[$bulan];
    }

    // Format nomor registrasi
    $cmr_no = $next_id_padded . "/CMR-4W/" . bulan_romawi(date("n")) . "/" . date("y");

    // Periksa apakah ada parameter Id yang dikirim melalui GET
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
        $target_dir = "../../../file cmr/";
        $original_file_name = basename($_FILES["file"]["name"]);
        $timestamp = time(); // Current timestamp
        $unique_filename = $timestamp . '_' . $original_file_name; // Combine timestamp with original file name
        $target_file = $target_dir . $unique_filename;
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is a PDF
        if ($fileType != "pdf") {
            echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'File harus berformat PDF',
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

        // If all conditions are met, attempt to upload the file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // If file upload is successful, proceed with SQL queries
                $query_transaksi = "INSERT INTO transaksi (att, cmr_no, iss_dt, found_dt, ar_dt, kybNo, bl_dt, lco, doi1, doi2, cof, dispo, supp_name, part_name, invoice, order_no, product, model, part_num, qty_order, qty_del, qty_def, crate_num, problem)
                                    VALUES ('$unique_filename', '$cmr_no', '$iss_dt', '$found_dt', '$ar_dt', '$kybNo', '$bl_dt', '$lco', '$doi1', '$doi2', '$cof', '$dispo', '$supp_name', '$part_name', '$invoice', '$order_no', '$product', '$model', '$part_num', '$qty_order', '$qty_del', '$qty_def', '$crate_num', '$problem')
                                    ON DUPLICATE KEY UPDATE att = VALUES(att), iss_dt = VALUES(iss_dt), found_dt = VALUES(found_dt), ar_dt = VALUES(ar_dt), kybNo = VALUES(kybNo), bl_dt = VALUES(bl_dt), lco =  VALUES(lco), doi1 = VALUES(doi1), doi2 = VALUES(doi2), cof = VALUES(cof), dispo = VALUES(dispo), supp_name = VALUES(supp_name), part_name = VALUES(part_name), invoice = VALUES(invoice), order_no = VALUES(order_no), product = VALUES(product), model = VALUES(model), part_num = VALUES(part_num), qty_order = VALUES(qty_order), qty_del = VALUES(qty_del), qty_def = VALUES(qty_def), crate_num = VALUES(crate_num), problem = VALUES(problem)";

                $query_status = "INSERT INTO status_cmr (Id, sts_cmr, nm_op_qa, status_op_qa, dt_op_qa)
                                 VALUES (LAST_INSERT_ID(), '$sts_cmr', '$nm_op_qa', '$status_op_qa', '$dt_op_qa')
                                 ON DUPLICATE KEY UPDATE sts_cmr = VALUES(sts_cmr), nm_op_qa = VALUES(nm_op_qa), status_op_qa = VALUES(status_op_qa), dt_op_qa = VALUES(dt_op_qa)";

                if (mysqli_query($koneksi3, $query_transaksi)) {
                    // Transaction query executed successfully
                    if (mysqli_query($koneksi3, $query_status)) {
                        // Status query executed successfully
    
                        // Add the new code for sending notifications
                        $message = "Pemberitahuan CMR! CMR dengan nomor $cmr_no telah dibuat oleh $nm_op_qa. Status menunggu approval foreman.";
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
                                    mysqli_query($koneksi3, $query_insert_notif);
                                }
                            }
                        }

                        // Display success message and handle the WhatsApp notifications
                        echo '<script>
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "CMR berhasil di-buat",
                                text: "CMR dengan nomor ' . $cmr_no . ' telah di-approve oleh ' . $nm_op_qa . ' pada ' . $dt_op_qa . ' ",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "dasborcmr.php";
                            });
                        </script>';
                    } else {
                        // Status query execution failed
                        echo "<script>
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Gagal menyimpan data status_cmr: ' . mysqli_error($koneksi3),
                                showConfirmButton: false,
                                timer: 2000
                            });
                          </script>";
                    }
                } else {
                    // Transaction query execution failed
                    echo "<script>
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Gagal menyimpan CMR: ' . mysqli_error($koneksi3),
                            showConfirmButton: false,
                            timer: 2000
                        });
                      </script>";
                }
            } else {
                echo "<script>
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Gagal mengunggah file',
                        showConfirmButton: false,
                        timer: 2000
                    });
                  </script>";
            }
        }
    }
    ?>
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
        // Atur pesan sukses untuk ditampilkan selama 5 detik
        setTimeout(function () {
            document.getElementById("successMessage").style.display = "none";
        }, 2000);
    </script>

    <script>
        $(function () {
            $("#datepicker1").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });

        $(function () {
            $("#datepicker2").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });

        $(function () {
            $("#datepicker3").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });

        $(function () {
            $("#datepicker4").datepicker({
                changeMonth: true,
                changeYear: true
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

    .btn-danger.custom-button {
        color: white;
    }

    .btn-danger.custom-button:hover {
        background-color: white;
        color: #dc3545;
        /* Bootstrap danger color */
    }
</style>