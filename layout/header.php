<div class="d-flex align-items-center justify-content-between">
    <a href="#" class="logo d-flex align-items-center">
        <img src="../../../assets/img/kayaba-logo.png" alt="" style="width: 130px; height: 90px;">
        <!-- <span class="d-none d-lg-block">NQR</span> -->
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
    <!-- <span style="margin-left: 300px; font-weight: bold; font-style: italic; font-size: 1.4em; text-align: center;" class="d-none d-lg-block text-danger">Nonconforming Quality Report</span> -->
    <span style="margin-left: 400px; font-weight: bold; font-style: italic; font-size: 1.4em; text-align: center;"
        class="d-none d-lg-block text-danger">SI NQR - CMR</span>

</div><!-- End Logo -->

<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">

            </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                <span class="badge bg-danger badge-number" style="font-size: x-small;">
                    <?php
                    $currentYear = date("Y");
                    if (isset($_SESSION['role'])) {
                        $currentYear = date("Y");
                        if ($_SESSION['role'] == 'OPQA') {
                            $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = '$currentYear' AND status IN (9,10,11)");
                            $row = mysqli_fetch_assoc($queryJumlahData);
                            $jumlahTransaksi = $row['jumlah'];

                            // Query untuk status_cmr menggunakan koneksi kedua ($koneksi3)
                            $queryJumlahData2 = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = '$currentYear' AND sts_cmr IN (9,10,11)");
                            $row2 = mysqli_fetch_assoc($queryJumlahData2);
                            $jumlahStatusCMR = $row2['jumlah'];

                        } elseif ($_SESSION['role'] == 'FMQA' || $_SESSION['role'] == 'admin') {
                            // Query untuk transaksi menggunakan koneksi pertama ($koneksi)
                            $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = '$currentYear' AND status IN (1)");
                            $row = mysqli_fetch_assoc($queryJumlahData);
                            $jumlahTransaksi = $row['jumlah'];

                            // Query untuk status_cmr menggunakan koneksi kedua ($koneksi3)
                            $queryJumlahData2 = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = '$currentYear' AND sts_cmr IN (1)");
                            $row2 = mysqli_fetch_assoc($queryJumlahData2);
                            $jumlahStatusCMR = $row2['jumlah'];


                        } elseif ($_SESSION['role'] == 'SPVQA') {
                            $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = '$currentYear' AND status IN (2)");
                            $row = mysqli_fetch_assoc($queryJumlahData);
                            $jumlahTransaksi = $row['jumlah'];

                            // Query untuk status_cmr menggunakan koneksi kedua ($koneksi3)
                            $queryJumlahData2 = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = '$currentYear' AND sts_cmr IN (2)");
                            $row2 = mysqli_fetch_assoc($queryJumlahData2);
                            $jumlahStatusCMR = $row2['jumlah'];

                        } elseif ($_SESSION['role'] == 'MGRQA') {
                            $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = '$currentYear' AND status IN (3)");
                            $row = mysqli_fetch_assoc($queryJumlahData);
                            $jumlahTransaksi = $row['jumlah'];

                            // Query untuk status_cmr menggunakan koneksi kedua ($koneksi3)
                            $queryJumlahData2 = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = '$currentYear' AND sts_cmr IN (3)");
                            $row2 = mysqli_fetch_assoc($queryJumlahData2);
                            $jumlahStatusCMR = $row2['jumlah'];

                        } elseif ($_SESSION['role'] == 'OPPPC') {
                            $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = '$currentYear' AND status_ppc IN (1,6,7,8)");
                            $row = mysqli_fetch_assoc($queryJumlahData);
                            $jumlahTransaksi = $row['jumlah'];

                            // Query untuk status_cmr menggunakan koneksi kedua ($koneksi3)
                            $queryJumlahData2 = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = '$currentYear' AND sts_cmr_ppc IN (6,7,8)");
                            $row2 = mysqli_fetch_assoc($queryJumlahData2);
                            $jumlahStatusCMR = $row2['jumlah'];

                        } elseif ($_SESSION['role'] == 'FMPPC') {
                            $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = '$currentYear' AND status_ppc IN (2)");
                            $row = mysqli_fetch_assoc($queryJumlahData);
                            $jumlahTransaksi = $row['jumlah'];

                            // Query untuk status_cmr menggunakan koneksi kedua ($koneksi3)
                            $queryJumlahData2 = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = '$currentYear' AND sts_cmr_ppc IN (2)");
                            $row2 = mysqli_fetch_assoc($queryJumlahData2);
                            $jumlahStatusCMR = $row2['jumlah'];

                        } elseif ($_SESSION['role'] == 'SPVPPC') {
                            $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = '$currentYear' AND status_ppc IN (3)");
                            $row = mysqli_fetch_assoc($queryJumlahData);
                            $jumlahTransaksi = $row['jumlah'];

                            // Query untuk status_cmr menggunakan koneksi kedua ($koneksi3)
                            $queryJumlahData2 = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = '$currentYear' AND sts_cmr_ppc IN (3)");
                            $row2 = mysqli_fetch_assoc($queryJumlahData2);
                            $jumlahStatusCMR = $row2['jumlah'];

                        } elseif ($_SESSION['role'] == 'MGRPPC') {
                            $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = '$currentYear' AND status_ppc IN (4)");
                            $row = mysqli_fetch_assoc($queryJumlahData);
                            $jumlahTransaksi = $row['jumlah'];

                            // Query untuk status_cmr menggunakan koneksi kedua ($koneksi3)
                            $queryJumlahData2 = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = '$currentYear' AND sts_cmr_ppc IN (4)");
                            $row2 = mysqli_fetch_assoc($queryJumlahData2);
                            $jumlahStatusCMR = $row2['jumlah'];

                        } elseif ($_SESSION['role'] == 'OPVDD') {
                            $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = '$currentYear' AND status_vdd IN (1,6,7,8)");
                            $row = mysqli_fetch_assoc($queryJumlahData);
                            $jumlahTransaksi = $row['jumlah'];

                            // Query untuk status_cmr menggunakan koneksi kedua ($koneksi3)
                            $queryJumlahData2 = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = '$currentYear' AND sts_cmr_vdd IN (1,6,7,8)");
                            $row2 = mysqli_fetch_assoc($queryJumlahData2);
                            $jumlahStatusCMR = $row2['jumlah'];

                        } elseif ($_SESSION['role'] == 'FMVDD') {
                            $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = '$currentYear' AND status_vdd IN (2)");
                            $row = mysqli_fetch_assoc($queryJumlahData);
                            $jumlahTransaksi = $row['jumlah'];

                            // Query untuk status_cmr menggunakan koneksi kedua ($koneksi3)
                            $queryJumlahData2 = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = '$currentYear' AND sts_cmr_vdd IN (2)");
                            $row2 = mysqli_fetch_assoc($queryJumlahData2);
                            $jumlahStatusCMR = $row2['jumlah'];

                        } elseif ($_SESSION['role'] == 'SPVVDD' || $_SESSION['role'] == 'admin') {
                            $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = '$currentYear' AND status_vdd IN (3)");
                            $row = mysqli_fetch_assoc($queryJumlahData);
                            $jumlahTransaksi = $row['jumlah'];

                            // Query untuk status_cmr menggunakan koneksi kedua ($koneksi3)
                            $queryJumlahData2 = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = '$currentYear' AND sts_cmr_vdd IN (3)");
                            $row2 = mysqli_fetch_assoc($queryJumlahData2);
                            $jumlahStatusCMR = $row2['jumlah'];

                        } elseif ($_SESSION['role'] == 'MGRVDD') {
                            $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = '$currentYear' AND status_vdd IN (4)");
                            $row = mysqli_fetch_assoc($queryJumlahData);
                            $jumlahTransaksi = $row['jumlah'];

                            $queryJumlahData2 = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = '$currentYear' AND sts_cmr_vdd IN (4)");
                            $row2 = mysqli_fetch_assoc($queryJumlahData2);
                            $jumlahStatusCMR = $row2['jumlah'];

                        } elseif ($_SESSION['role'] == 'BODTA') {
                            $queryJumlahData = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE YEAR(dt_op_qa) = '$currentYear' AND status_vdd IN (5)");
                            $row = mysqli_fetch_assoc($queryJumlahData);
                            $jumlahTransaksi = $row['jumlah'];

                            $queryJumlahData2 = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = '$currentYear' AND sts_cmr_vdd IN (5)");
                            $row2 = mysqli_fetch_assoc($queryJumlahData2);
                            $jumlahStatusCMR = $row2['jumlah'];


                            // Query untuk status_cmr menggunakan koneksi kedua ($koneksi3)
                            $queryJumlahData2 = mysqli_query($koneksi3, "SELECT COUNT(*) AS jumlah FROM status_cmr WHERE YEAR(dt_op_qa) = '$currentYear' AND sts_cmr_vdd IN (4)");
                            $row2 = mysqli_fetch_assoc($queryJumlahData2);
                            $jumlahStatusCMR = $row2['jumlah'];
                        }
                    }

                    $totalJumlah = $jumlahTransaksi + $jumlahStatusCMR;

                    // Output total jumlah
                    echo $totalJumlah;

                    ?>
                </span>


            </a><!-- End Notification Icon -->


            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                <li class="dropdown-header">
                    You have <?php echo $totalJumlah; ?> new notifications
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'OPQA'): ?>
                        <a href="../../nqr/qarejectqa.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                all</span></a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'FMQA'): ?>
                        <a href="../../nqr/qa/ap-fm.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                all</span></a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'SPVQA' || $_SESSION['role'] == 'admin'): ?>
                        <a href="../../nqr/qa/ap-spv.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                all</span></a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'MGRQA'): ?>
                        <a href="../../nqr/qa/ap-mgr.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                all</span></a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'OPPPC'): ?>
                        <a href="../../nqr/ppc/dasborppc.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                all</span></a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'FMPPC'): ?>
                        <a href="../../nqr/ppc/ap-fm-ppc.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                all</span></a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'SPVPPC'): ?>
                        <a href="../../nqr/ppc/ap-spv-ppc.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                all</span></a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'MGRPPC'): ?>
                        <a href="../../nqr/ppc/ap-mgr-ppc.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                all</span></a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'OPVDD'): ?>
                        <a href="../../nqr/ppc/dasbor-vdd.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                all</span></a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'FMVDD'): ?>
                        <a href="../../nqr/ppc/ap-fm-vdd.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                all</span></a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'SPVVDD'): ?>
                        <a href="../../nqr/ppc/ap-spv-vdd.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View
                                all</span></a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'BODTA'): ?>
                        <a href="ta.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    <?php endif; ?>

                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <?php
                // Mendapatkan tahun ini
                
                $currentYear = date("Y");

                if (isset($_SESSION['role'])) {
                    if ($_SESSION['role'] == 'OPQA') {

                        // Melakukan query untuk mendapatkan semua data dengan status 9, 10, atau 11 pada tahun ini
                        $queryStatus1 = mysqli_query($koneksi, "SELECT reg_no, status, remark, Id,
        CASE
            WHEN status = 9 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_fm_qa, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_fm_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_fm_qa, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_fm_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_fm_qa, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_fm_qa, NOW()) > TIMESTAMPDIFF(WEEK, dt_fm_qa, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_fm_qa, NOW()) - TIMESTAMPDIFF(WEEK, dt_fm_qa, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_fm_qa, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_fm_qa, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
            WHEN status = 10 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_spv_qa, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_spv_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_spv_qa, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_spv_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_spv_qa, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_spv_qa, NOW()) > TIMESTAMPDIFF(WEEK, dt_spv_qa, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_spv_qa, NOW()) - TIMESTAMPDIFF(WEEK, dt_spv_qa, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_spv_qa, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_spv_qa, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
            WHEN status = 11 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_mgr_qa, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_mgr_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_mgr_qa, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_mgr_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_mgr_qa, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_mgr_qa, NOW()) > TIMESTAMPDIFF(WEEK, dt_mgr_qa, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_mgr_qa, NOW()) - TIMESTAMPDIFF(WEEK, dt_mgr_qa, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_mgr_qa, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_mgr_qa, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
            ELSE ''
        END AS hours_ago
    FROM 
        transaksi 
    WHERE 
        status IN (9, 10, 11) AND YEAR(dt_op_qa) = $currentYear
    ORDER BY 
        CASE 
            WHEN status IN (9, 10, 11) THEN dt_op_qa 
            ELSE NOW() 
        END ASC");

                        $queryStatus2 = mysqli_query($koneksi3, "SELECT transaksi.Id, transaksi.cmr_no, status_cmr.sts_cmr, status_cmr.remark,
CASE
    WHEN status_cmr.sts_cmr = 9 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_fm_qa, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_fm_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_fm_qa, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_qa, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_fm_qa, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_qa, NOW()) * 7 THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_fm_qa, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_qa, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_fm_qa, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_fm_qa, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    WHEN status_cmr.sts_cmr = 10 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, dt_spv_qa, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_spv_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_spv_qa, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_qa, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_spv_qa, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_qa, NOW()) * 7 THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_spv_qa, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_qa, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_spv_qa, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_spv_qa, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    WHEN status_cmr.sts_cmr = 11 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_mgr_qa, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_mgr_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_mgr_qa, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_qa, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_mgr_qa, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_qa, NOW()) * 7 THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_mgr_qa, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_qa, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_mgr_qa, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_mgr_qa, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    ELSE ''
END AS hours_ago
FROM 
transaksi
INNER JOIN
status_cmr ON transaksi.id = status_cmr.id
WHERE 
status_cmr.sts_cmr IN (9,10,11) AND YEAR(status_cmr.dt_op_qa) = '$currentYear'
ORDER BY 
CASE 
    WHEN status_cmr.sts_cmr IN (9,10,11) THEN status_cmr.dt_op_qa 
    ELSE NOW() 
END ASC");


                        $allData = array();
                        while ($row = mysqli_fetch_assoc($queryStatus1)) {
                            $allData[] = $row;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData = $allData;

                        // Simpan semua data dalam sebuah array
                        $allData2 = array();

                        // Reset kursor untuk kueri kedua
                        mysqli_data_seek($queryStatus2, 0);

                        while ($row2 = mysqli_fetch_assoc($queryStatus2)) {
                            $allData2[] = $row2;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData2 = $allData2;

                        // Memeriksa apakah ada data dengan status 1 atau status 2
                        if (count($recentData) > 0 || count($recentData2) > 0) {
                            echo '<ul class="notification-list">';
                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData
                            foreach ($recentData as $rowStatus1) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus1['status'] == 9) {
                                    $statusText = 'rejected by Foreman';
                                } elseif ($rowStatus1['status'] == 10) {
                                    $statusText = 'rejected by SPV';
                                } elseif ($rowStatus1['status'] == 11) {
                                    $statusText = 'rejected by Manager';
                                }


                                echo '<li class="notification-item" data-reg-no="' . $rowStatus1['reg_no'] . '">
                  <a href="../../nqr/qa/edit_nqr.php?Id=' . $rowStatus1['reg_no'] . '">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <div>
                            <h4>' . $rowStatus1['reg_no'] . '</h4>
                            <p>' . $rowStatus1['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . $statusText . '</p>';
                                }
                                if (isset($rowStatus1['remark'])) {
                                    echo '<p>Remark:' . $rowStatus1['remark'] . '</p>';
                                }
                                echo '</div>
                </a>
            </li>';
                            }

                            foreach ($recentData2 as $rowStatus2) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus2['sts_cmr'] == 9) {
                                    $statusText = 'rejected by Foreman';
                                } elseif ($rowStatus2['sts_cmr'] == 10) {
                                    $statusText = 'rejected by SPV';
                                } elseif ($rowStatus2['sts_cmr'] == 11) {
                                    $statusText = 'rejected by Manager';
                                }

                                echo '<li class="notification-item" data-reg-no="' . $rowStatus2['cmr_no'] . '">
                  <a href="../../cmr/qa/edit_cmr.php?Id=' . $rowStatus2['Id'] . '">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <div>
                            <h4>' . $rowStatus2['cmr_no'] . '</h4>
                            <p>' . $rowStatus2['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . $statusText . '</p>';
                                }
                                if (isset($rowStatus2['remark'])) {
                                    echo '<p>Remark:' . $rowStatus2['remark'] . '</p>';
                                }
                                echo '</div>
                </a>
            </li>';
                            }
                            echo '</ul>';
                        } else {
                            // Menampilkan pesan jika tidak ada data dengan status 1 pada tahun ini
                            echo '<ul class="notification-list">
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>No data waiting for reject this year</h4>
                    </div>
                </li>
            </ul>';
                        }


                    } elseif ($_SESSION['role'] == 'FMQA' || $_SESSION['role'] == 'admin') {

                        $queryStatus1 = mysqli_query($koneksi, "SELECT reg_no, status, Id,
        CASE
            WHEN status = 1 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_op_qa, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_op_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_op_qa, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_op_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_op_qa, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_op_qa, NOW()) > TIMESTAMPDIFF(WEEK, dt_op_qa, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_op_qa, NOW()) - TIMESTAMPDIFF(WEEK, dt_op_qa, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_op_qa, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_op_qa, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
            ELSE ''
        END AS hours_ago
    FROM 
        transaksi 
    WHERE 
        status = 1 AND YEAR(dt_op_qa) = $currentYear
    ORDER BY 
        CASE 
            WHEN status = 1 THEN dt_op_qa 
            ELSE NOW() 
        END ASC");

                        $queryStatus2 = mysqli_query($koneksi3, "SELECT transaksi.Id, transaksi.cmr_no, status_cmr.sts_cmr,
CASE
    WHEN status_cmr.sts_cmr = 1 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_op_qa, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_op_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_op_qa, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_op_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_op_qa, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_op_qa, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_op_qa, NOW()) * 7
                    THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_op_qa, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_op_qa, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_op_qa, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_op_qa, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    ELSE ''
END AS hours_ago
FROM 
transaksi
INNER JOIN
status_cmr ON transaksi.id = status_cmr.id
WHERE 
status_cmr.sts_cmr = 1 AND YEAR(status_cmr.dt_op_qa) = $currentYear
ORDER BY 
CASE 
    WHEN status_cmr.sts_cmr = 1 THEN status_cmr.dt_op_qa 
    ELSE NOW() 
END ASC");

                        // Simpan semua data dalam sebuah array
                        $allData = array();
                        while ($row = mysqli_fetch_assoc($queryStatus1)) {
                            $allData[] = $row;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData = $allData;

                        // Simpan semua data dalam sebuah array
                        $allData2 = array();

                        // Reset kursor untuk kueri kedua
                        mysqli_data_seek($queryStatus2, 0);

                        while ($row2 = mysqli_fetch_assoc($queryStatus2)) {
                            $allData2[] = $row2;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData2 = $allData2;

                        // Memeriksa apakah ada data dengan status 1 atau status 2
                        if (count($recentData) > 0 || count($recentData2) > 0) {
                            // Mengambil data dan menampilkannya dalam elemen HTML
                            echo '<ul class="notification-list">';

                            // Menampilkan data dari $recentData
                            foreach ($recentData as $rowStatus1) {
                                echo '<li class="notification-item" data-reg-no="' . htmlspecialchars($rowStatus1['reg_no']) . '">
                  <a href="../../nqr/qa/ap-fm-detail.php?Id=' . $rowStatus1['reg_no'] . '">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>' . htmlspecialchars($rowStatus1['reg_no']) . '</h4>
                        <p>' . htmlspecialchars($rowStatus1['hours_ago']) . '</p>
                        <p>Status: Requested</p>
                    </div>
                </a>
            </li>';
                            }

                            // Menampilkan data dari $recentData2
// Menampilkan data dari $recentData2 (queryStatus2)
                            foreach ($recentData2 as $rowStatus2) {
                                echo '<li class="notification-item" data-reg-no="' . htmlspecialchars($rowStatus2['cmr_no']) . '">
            <a href="../../cmr/qa/ap-fm-cmr-detail.php?Id=' . $rowStatus2['Id'] . '">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>' . htmlspecialchars($rowStatus2['cmr_no']) . '</h4>
                    <p>' . htmlspecialchars($rowStatus2['hours_ago']) . '</p>
                    <p>Status: Requested</p>
                </div>
            </a>
        </li>';
                            }

                            echo '</ul>'; // Tutup list notifikasi
                        } else {
                            // Menampilkan pesan jika tidak ada data dengan status 1 atau status 2
                            echo '<ul class="notification-list">
            <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>No data waiting this year</h4>
                </div>
            </li>
        </ul>';
                        }

                    } elseif ($_SESSION['role'] == 'SPVQA') {
                        // Melakukan query untuk mendapatkan semua data dengan status 1 pada tahun ini
                
                        $queryStatus1 = mysqli_query($koneksi, "SELECT reg_no, status, Id,
        CASE
            WHEN status = 2 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_fm_qa, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_fm_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_fm_qa, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_fm_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_fm_qa, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_fm_qa, NOW()) > TIMESTAMPDIFF(WEEK, dt_fm_qa, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_fm_qa, NOW()) - TIMESTAMPDIFF(WEEK, dt_fm_qa, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_fm_qa, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_fm_qa, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
            ELSE ''
        END AS hours_ago
    FROM 
        transaksi 
    WHERE 
        status = 2 AND YEAR(dt_op_qa) = $currentYear
    ORDER BY 
        CASE 
            WHEN status = 2 THEN dt_op_qa 
            ELSE NOW() 
        END ASC");

                        $queryStatus2 = mysqli_query($koneksi3, "SELECT transaksi.Id, transaksi.cmr_no, status_cmr.sts_cmr,
CASE
    WHEN status_cmr.sts_cmr = 2 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_fm_qa, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_fm_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_fm_qa, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_qa, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_fm_qa, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_qa, NOW()) * 7
                    THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_fm_qa, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_qa, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_fm_qa, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_fm_qa, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    ELSE ''
END AS hours_ago
FROM 
transaksi
INNER JOIN
status_cmr ON transaksi.id = status_cmr.id
WHERE 
status_cmr.sts_cmr = 2 AND YEAR(status_cmr.dt_op_qa) = $currentYear
ORDER BY 
CASE 
    WHEN status_cmr.sts_cmr = 2 THEN status_cmr.dt_op_qa 
    ELSE NOW() 
END ASC");

                        // Simpan semua data dalam sebuah array
                        $allData = array();
                        while ($row = mysqli_fetch_assoc($queryStatus1)) {
                            $allData[] = $row;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData = $allData;

                        // Simpan semua data dalam sebuah array
                        $allData2 = array();

                        // Reset kursor untuk kueri kedua
                        mysqli_data_seek($queryStatus2, 0);

                        while ($row2 = mysqli_fetch_assoc($queryStatus2)) {
                            $allData2[] = $row2;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData2 = $allData2;


                        // Memeriksa apakah ada data dengan status 1
                        if (count($recentData) > 0 || count($recentData2) > 0) {
                            echo '<ul class="notification-list">';
                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData
                            foreach ($recentData as $rowStatus1) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus1['status'] == 2) {
                                    $statusText = 'Approved by Foreman';
                                } elseif ($rowStatus2['sts_cmr'] == 2) {
                                    $statusText = 'Approved by Foreman';
                                }

                                echo '<li class="notification-item" data-reg-no="' . htmlspecialchars($rowStatus1['reg_no']) . '">
                <a href="../../nqr/qa/ap-spv-detail.php?Id=' . $rowStatus1['reg_no'] . '">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>' . htmlspecialchars($rowStatus1['reg_no']) . '</h4>
                        <p>' . htmlspecialchars($rowStatus1['hours_ago']) . '</p>
                        <p>Status: ' . htmlspecialchars($statusText) . '</p> 
                    </div>
                </a>
            </li>';
                            }

                            // Menampilkan data dari $recentData2
                            foreach ($recentData2 as $rowStatus2) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus1['status'] == 2) {
                                    $statusText = 'Approved by Foreman';
                                } elseif ($rowStatus2['sts_cmr'] == 2) {
                                    $statusText = 'Approved by Foreman';
                                }


                                echo '<li class="notification-item" data-reg-no="' . htmlspecialchars($rowStatus2['cmr_no']) . '">
                <a href="../../cmr/qa/ap-spv-cmr-detail.php?Id=' . $rowStatus2['Id'] . '">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>' . htmlspecialchars($rowStatus2['cmr_no']) . '</h4>
                        <p>' . htmlspecialchars($rowStatus2['hours_ago']) . '</p>
                        <p>Status: ' . htmlspecialchars($statusText) . '</p> <!-- Perbaikan -->
                    </div>
                </a>
            </li>';
                            }

                            echo '</ul>'; // Tutup list notifikasi
                        } else {
                            // Menampilkan pesan jika tidak ada data dengan status 1 atau status 2
                            echo '<ul class="notification-list">
            <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>No data waiting this year</h4>
                </div>
            </li>
        </ul>';
                        }
                    } elseif ($_SESSION['role'] == 'MGRQA') {
                        // Melakukan query untuk mendapatkan semua data dengan status 1 pada tahun ini
                        $queryStatus1 = mysqli_query($koneksi, "SELECT reg_no, status, Id,
      CASE
          WHEN status = 3 THEN 
              CASE
                  WHEN TIMESTAMPDIFF(SECOND, dt_spv_qa, NOW()) < 3600 THEN 'baru saja'
                  ELSE CONCAT(
                      CASE
                          WHEN TIMESTAMPDIFF(MONTH, dt_spv_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_spv_qa, NOW()), ' bulan ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(WEEK, dt_spv_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_spv_qa, NOW()), ' minggu ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(DAY, dt_spv_qa, NOW()) > TIMESTAMPDIFF(WEEK, dt_spv_qa, NOW()) * 7
                          THEN CONCAT(TIMESTAMPDIFF(DAY, dt_spv_qa, NOW()) - TIMESTAMPDIFF(WEEK, dt_spv_qa, NOW()) * 7, ' hari ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(HOUR, dt_spv_qa, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_spv_qa, NOW()) % 24, ' jam ')
                          ELSE ''
                      END,
                      'lalu'
                  )
              END
          ELSE ''
      END AS hours_ago
  FROM 
      transaksi 
  WHERE 
      status = 3 AND YEAR(dt_op_qa) = $currentYear
  ORDER BY 
      CASE 
          WHEN status = 3 THEN dt_op_qa 
          ELSE NOW() 
      END ASC");


                        $queryStatus2 = mysqli_query($koneksi3, "SELECT transaksi.Id, transaksi.cmr_no, status_cmr.sts_cmr,
CASE
    WHEN status_cmr.sts_cmr = 3 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_spv_qa, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_spv_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_spv_qa, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_qa, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_spv_qa, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_qa, NOW()) * 7
                    THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_spv_qa, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_qa, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_spv_qa, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_spv_qa, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    ELSE ''
END AS hours_ago
FROM 
transaksi
INNER JOIN
status_cmr ON transaksi.id = status_cmr.id
WHERE 
status_cmr.sts_cmr = 3 AND YEAR(status_cmr.dt_op_qa) = $currentYear
ORDER BY 
CASE 
    WHEN status_cmr.sts_cmr = 3 THEN status_cmr.dt_op_qa 
    ELSE NOW() 
END ASC");

                        // Simpan semua data dalam sebuah array
                        $allData = array();
                        while ($row = mysqli_fetch_assoc($queryStatus1)) {
                            $allData[] = $row;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData = $allData;

                        // Simpan semua data dalam sebuah array
                        $allData2 = array();

                        // Reset kursor untuk kueri kedua
                        mysqli_data_seek($queryStatus2, 0);

                        while ($row2 = mysqli_fetch_assoc($queryStatus2)) {
                            $allData2[] = $row2;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData2 = $allData2;

                        // Memeriksa apakah ada data dengan status 1
                        if (count($recentData) > 0 || count($recentData2) > 0) {
                            echo '<ul class="notification-list">';
                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData
                            foreach ($recentData as $rowStatus1) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus1['status'] == 3) {
                                    $statusText = 'Approved by Supervisor';
                                } elseif ($rowStatus2['sts_cmr'] == 3) {
                                    $statusText = 'Approved by Supervisor';
                                }


                                echo '<li class="notification-item" data-reg-no="' . htmlspecialchars($rowStatus1['reg_no']) . '">
                <a href="../../nqr/qa/ap-spv-detail.php?Id=' . $rowStatus1['reg_no'] . '">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>' . htmlspecialchars($rowStatus1['reg_no']) . '</h4>
                        <p>' . htmlspecialchars($rowStatus1['hours_ago']) . '</p>
                        <p>Status: ' . htmlspecialchars($statusText) . '</p> 
                    </div>
                </a>
            </li>';
                            }

                            // Menampilkan data dari $recentData2
                            foreach ($recentData2 as $rowStatus2) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus1['status'] == 3) {
                                    $statusText = 'Approved by Supervisor';
                                } elseif ($rowStatus2['sts_cmr'] == 3) {
                                    $statusText = 'Approved by Supervisor';
                                }

                                echo '<li class="notification-item" data-reg-no="' . htmlspecialchars($rowStatus2['cmr_no']) . '">
                <a href="../../cmr/qa/ap-spv-cmr-detail.php?Id=' . $rowStatus2['Id'] . '">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>' . htmlspecialchars($rowStatus2['cmr_no']) . '</h4>
                        <p>' . htmlspecialchars($rowStatus2['hours_ago']) . '</p>
                        <p>Status: ' . htmlspecialchars($statusText) . '</p> <!-- Perbaikan -->
                    </div>
                </a>
            </li>';
                            }

                            echo '</ul>'; // Tutup list notifikasi
                        } else {
                            // Menampilkan pesan jika tidak ada data dengan status 1 atau status 2
                            echo '<ul class="notification-list">
            <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>No data waiting this year</h4>
                </div>
            </li>
        </ul>';
                        }
                    } elseif ($_SESSION['role'] == 'OPPPC') {
                        // Melakukan query untuk mendapatkan semua data dengan status 1 pada tahun ini
                        $queryStatus1 = mysqli_query($koneksi, "SELECT reg_no, status_ppc, remark, Id,
        CASE
            WHEN status_ppc = 1 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_mgr_qa, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_mgr_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_mgr_qa, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_mgr_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_mgr_qa, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_mgr_qa, NOW()) > TIMESTAMPDIFF(WEEK, dt_mgr_qa, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_mgr_qa, NOW()) - TIMESTAMPDIFF(WEEK, dt_mgr_qa, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_mgr_qa, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_mgr_qa, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
            WHEN status_ppc = 6 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_fm_ppc, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_fm_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_fm_ppc, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_fm_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_fm_ppc, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_fm_ppc, NOW()) > TIMESTAMPDIFF(WEEK, dt_fm_ppc, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_fm_ppc, NOW()) - TIMESTAMPDIFF(WEEK, dt_fm_ppc, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_fm_ppc, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_fm_ppc, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
            WHEN status_ppc = 7 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_spv_ppc, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_spv_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_spv_ppc, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_spv_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_spv_ppc, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_spv_ppc, NOW()) > TIMESTAMPDIFF(WEEK, dt_spv_ppc, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_spv_ppc, NOW()) - TIMESTAMPDIFF(WEEK, dt_spv_ppc, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_spv_ppc, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_spv_ppc, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
                WHEN status_ppc = 8 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_mgr_ppc, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_mgr_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_mgr_ppc, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_mgr_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_mgr_ppc, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_mgr_ppc, NOW()) > TIMESTAMPDIFF(WEEK, dt_mgr_ppc, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_mgr_ppc, NOW()) - TIMESTAMPDIFF(WEEK, dt_mgr_ppc, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_mgr_ppc, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_mgr_ppc, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
            ELSE ''
        END AS hours_ago
    FROM 
        transaksi 
    WHERE 
        status_ppc IN (1, 6, 7, 8) AND YEAR(dt_op_qa) = $currentYear
    ORDER BY 
        CASE 
            WHEN status_ppc IN (1, 6, 7, 8) THEN dt_op_qa 
            ELSE NOW() 
        END ASC");

                        $queryStatus2 = mysqli_query($koneksi3, "SELECT transaksi.Id, transaksi.cmr_no, status_cmr.sts_cmr_ppc, status_cmr.remark_PPC,
CASE
WHEN status_cmr.sts_cmr_ppc = 1 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_mgr_qa, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_mgr_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_mgr_qa, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_qa, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_qa, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_mgr_qa, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_qa, NOW()) * 7 THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_mgr_qa, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_qa, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_mgr_qa, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_mgr_qa, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    WHEN status_cmr.sts_cmr_ppc = 6 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_fm_qa, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_fm_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_fm_ppc, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_ppc, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_fm_ppc, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_ppc, NOW()) * 7 THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_fm_ppc, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_ppc, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_fm_ppc, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_fm_ppc, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    WHEN status_cmr.sts_cmr_ppc = 7 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, dt_spv_ppc, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_spv_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_spv_ppc, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_ppc, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_spv_ppc, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_ppc, NOW()) * 7 THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_spv_ppc, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_ppc, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_spv_ppc, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_spv_ppc, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    WHEN status_cmr.sts_cmr_ppc = 8 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_mgr_ppc, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_mgr_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_mgr_ppc, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_ppc, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_mgr_ppc, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_ppc, NOW()) * 7 THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_mgr_ppc, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_ppc, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_mgr_ppc, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_mgr_ppc, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    ELSE ''
END AS hours_ago
FROM 
transaksi
INNER JOIN
status_cmr ON transaksi.id = status_cmr.id
WHERE 
status_cmr.sts_cmr_ppc IN (1,6,7,8) AND YEAR(status_cmr.dt_op_qa) = '$currentYear'
ORDER BY 
CASE 
    WHEN status_cmr.sts_cmr_ppc IN (1,6,7,8) THEN status_cmr.dt_op_qa 
    ELSE NOW() 
END ASC");

                        $allData = array();
                        while ($row = mysqli_fetch_assoc($queryStatus1)) {
                            $allData[] = $row;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData = $allData;

                        // Simpan semua data dalam sebuah array
                        $allData2 = array();

                        // Reset kursor untuk kueri kedua
                        mysqli_data_seek($queryStatus2, 0);

                        while ($row2 = mysqli_fetch_assoc($queryStatus2)) {
                            $allData2[] = $row2;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData2 = $allData2;

                        // Memeriksa apakah ada data dengan status 1 atau status 2
                        if (count($recentData) > 0 || count($recentData2) > 0) {
                            echo '<ul class="notification-list">';
                            // Mengambil data dan menampilkannya dalam elemen HTML
                            foreach ($recentData as $rowStatus1) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus1['status_ppc'] == 1) {
                                    $statusText = 'QA Finish';
                                } elseif ($rowStatus1['status_ppc'] == 6) {
                                    $statusText = 'rejected by FM';
                                } elseif ($rowStatus1['status_ppc'] == 7) {
                                    $statusText = 'rejected by SPV';
                                } elseif ($rowStatus1['status_ppc'] == 8) {
                                    $statusText = 'rejected by Manager';
                                }

                                echo '<li class="notification-item" data-reg-no="' . $rowStatus1['reg_no'] . '">
                  <a href="../../nqr/ppc/edit_nqr_ppc.php?Id=' . $rowStatus1['reg_no'] . '">
                      <i class="bi bi-exclamation-circle text-warning"></i>
                      <div>
                          <h4>' . $rowStatus1['reg_no'] . '</h4>
                          <p>' . $rowStatus1['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . $statusText . '</p>';
                                }
                                if (isset($rowStatus1['remark_ppc'])) {
                                    echo '<p>Remark:' . $rowStatus1['remark_ppc'] . '</p>';
                                }
                                echo '</div>
              </a>
          </li>';
                            }

                            foreach ($recentData2 as $rowStatus2) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus2['sts_cmr_ppc'] == 1) {
                                    $statusText = 'QA Finish';
                                } elseif ($rowStatus2['sts_cmr_ppc'] == 6) {
                                    $statusText = 'rejected by FM';
                                } elseif ($rowStatus2['sts_cmr_ppc'] == 7) {
                                    $statusText = 'rejected by SPV';
                                } elseif ($rowStatus2['sts_cmr_ppc'] == 8) {
                                    $statusText = 'rejected by Manager';
                                }

                                echo '<li class="notification-item" data-reg-no="' . $rowStatus2['cmr_no'] . '">
                <a href="../../cmr/ppc/edit_cmr_ppc.php?Id=' . $rowStatus2['Id'] . '">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>' . $rowStatus2['cmr_no'] . '</h4>
                        <p>' . $rowStatus2['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . $statusText . '</p>';
                                }
                                if (isset($rowStatus2['remark_ppc'])) {
                                    echo '<p>Remark:' . $rowStatus2['remark_ppc'] . '</p>';
                                }
                                echo '</div>
            </a>
        </li>';
                            }
                            echo '</ul>';
                        } else {
                            // Menampilkan pesan jika tidak ada data dengan status 1 pada tahun ini
                            echo '<ul class="notification-list">
            <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>No data waiting this year</h4>
                </div>
            </li>
        </ul>';
                        }
                    } elseif ($_SESSION['role'] == 'FMPPC') {
                        // Melakukan query untuk mendapatkan semua data dengan status 1 pada tahun ini
                        $queryStatus1 = mysqli_query($koneksi, "SELECT reg_no, status_ppc,
      CASE
          WHEN status_ppc = 2 THEN 
              CASE
                  WHEN TIMESTAMPDIFF(SECOND, dt_op_ppc, NOW()) < 3600 THEN 'baru saja'
                  ELSE CONCAT(
                      CASE
                          WHEN TIMESTAMPDIFF(MONTH, dt_op_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_op_ppc, NOW()), ' bulan ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(WEEK, dt_op_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_op_ppc, NOW()), ' minggu ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(DAY, dt_op_ppc, NOW()) > TIMESTAMPDIFF(WEEK, dt_op_ppc, NOW()) * 7
                          THEN CONCAT(TIMESTAMPDIFF(DAY, dt_op_ppc, NOW()) - TIMESTAMPDIFF(WEEK, dt_op_ppc, NOW()) * 7, ' hari ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(HOUR, dt_op_ppc, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_op_ppc, NOW()) % 24, ' jam ')
                          ELSE ''
                      END,
                      'lalu'
                  )
              END
          ELSE ''
      END AS hours_ago
  FROM 
      transaksi 
  WHERE 
      status_ppc = 2 AND YEAR(dt_op_qa) = $currentYear
  ORDER BY 
      CASE 
          WHEN status_ppc = 2 THEN dt_op_qa 
          ELSE NOW() 
      END ASC");
                        $queryStatus2 = mysqli_query($koneksi3, "SELECT transaksi.Id, transaksi.cmr_no, status_cmr.sts_cmr_ppc, transaksi.Id,
CASE
    WHEN status_cmr.sts_cmr_ppc = 2 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_op_ppc, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_op_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_op_ppc, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_op_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_op_ppc, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_op_ppc, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_op_ppc, NOW()) * 7
                    THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_op_ppc, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_op_ppc, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_op_ppc, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_op_ppc, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    ELSE ''
END AS hours_ago
FROM 
transaksi
INNER JOIN
status_cmr ON transaksi.id = status_cmr.id
WHERE 
status_cmr.sts_cmr_ppc = 2 AND YEAR(status_cmr.dt_op_qa) = $currentYear
ORDER BY 
CASE 
    WHEN status_cmr.sts_cmr = 2 THEN status_cmr.dt_op_qa 
    ELSE NOW() 
END ASC");

                        // Simpan semua data dalam sebuah array
                        $allData = array();
                        while ($row = mysqli_fetch_assoc($queryStatus1)) {
                            $allData[] = $row;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData = $allData;

                        // Simpan semua data dalam sebuah array
                        $allData2 = array();

                        // Reset kursor untuk kueri kedua
                        mysqli_data_seek($queryStatus2, 0);

                        while ($row2 = mysqli_fetch_assoc($queryStatus2)) {
                            $allData2[] = $row2;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData2 = $allData2;

                        // Memeriksa apakah ada data dengan status 1
                        if (count($recentData) > 0 || count($recentData2) > 0) {
                            echo '<ul class="notification-list">';
                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData
                            foreach ($recentData as $rowStatus1) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus1['status_ppc'] == 2) {
                                    $statusText = 'Requested';
                                }
                                echo '<li class="notification-item" data-reg-no="' . $rowStatus1['reg_no'] . '">
            <a href="../../nqr/ppc/ap-fm-detail-ppc.php?Id=' . $rowStatus1['reg_no'] . '">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>' . $rowStatus1['reg_no'] . '</h4>
                    <p>' . $rowStatus1['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . htmlspecialchars($statusText) . '</p>';
                                }
                                echo '</div>
                </a>
            </li>';
                            }

                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData2
                            foreach ($recentData2 as $rowStatus2) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus2['sts_cmr_ppc'] == 2) {
                                    $statusText = 'Requested';
                                }
                                echo '<li class="notification-item" data-reg-no="' . $rowStatus2['cmr_no'] . '">
            <a href="../../cmr/ppc/ap-fm-cmr-detail-ppc.php?Id=' . $rowStatus2['Id'] . '">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>' . $rowStatus2['cmr_no'] . '</h4>
                    <p>' . $rowStatus2['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . htmlspecialchars($statusText) . '</p>';
                                }
                                echo '</div>
                </a>
            </li>';
                            }

                            echo '</ul>'; // Tutup list notifikasi
                        } else {
                            // Menampilkan pesan jika tidak ada data dengan status 1 atau status 2
                            echo '<ul class="notification-list">
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>No data waiting this year</h4>
                    </div>
                </li>
            </ul>';
                        }

                    } elseif ($_SESSION['role'] == 'SPVPPC') {
                        // Melakukan query untuk mendapatkan semua data dengan status 1 pada tahun ini
                        $queryStatus1 = mysqli_query($koneksi, "SELECT reg_no, status_ppc,
      CASE
          WHEN status_ppc = 3 THEN 
              CASE
                  WHEN TIMESTAMPDIFF(SECOND, dt_fm_ppc, NOW()) < 3600 THEN 'baru saja'
                  ELSE CONCAT(
                      CASE
                          WHEN TIMESTAMPDIFF(MONTH, dt_fm_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_fm_ppc, NOW()), ' bulan ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(WEEK, dt_fm_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_fm_ppc, NOW()), ' minggu ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(DAY, dt_fm_ppc, NOW()) > TIMESTAMPDIFF(WEEK, dt_fm_ppc, NOW()) * 7
                          THEN CONCAT(TIMESTAMPDIFF(DAY, dt_fm_ppc, NOW()) - TIMESTAMPDIFF(WEEK, dt_fm_ppc, NOW()) * 7, ' hari ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(HOUR, dt_fm_ppc, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_fm_ppc, NOW()) % 24, ' jam ')
                          ELSE ''
                      END,
                      'lalu'
                  )
              END
          ELSE ''
      END AS hours_ago
  FROM 
      transaksi 
  WHERE 
      status_ppc = 3 AND YEAR(dt_op_qa) = $currentYear
  ORDER BY 
      CASE 
          WHEN status_ppc = 3 THEN dt_op_qa 
          ELSE NOW() 
      END ASC");

                        $queryStatus2 = mysqli_query($koneksi3, "SELECT transaksi.Id, transaksi.cmr_no, status_cmr.sts_cmr_ppc, transaksi.Id,
CASE
    WHEN status_cmr.sts_cmr_ppc = 3 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_fm_ppc, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_fm_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_fm_ppc, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_ppc, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_fm_ppc, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_ppc, NOW()) * 7
                    THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_fm_ppc, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_ppc, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_fm_ppc, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_fm_ppc, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    ELSE ''
END AS hours_ago
FROM 
transaksi
INNER JOIN
status_cmr ON transaksi.id = status_cmr.id
WHERE 
status_cmr.sts_cmr_ppc = 3 AND YEAR(status_cmr.dt_op_qa) = $currentYear
ORDER BY 
CASE 
    WHEN status_cmr.sts_cmr = 3 THEN status_cmr.dt_op_qa 
    ELSE NOW() 
END ASC");

                        // Simpan semua data dalam sebuah array
                        $allData = array();
                        while ($row = mysqli_fetch_assoc($queryStatus1)) {
                            $allData[] = $row;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData = $allData;

                        // Simpan semua data dalam sebuah array
                        $allData2 = array();

                        // Reset kursor untuk kueri kedua
                        mysqli_data_seek($queryStatus2, 0);

                        while ($row2 = mysqli_fetch_assoc($queryStatus2)) {
                            $allData2[] = $row2;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData2 = $allData2;

                        // Memeriksa apakah ada data dengan status 1
                        if (count($recentData) > 0 || count($recentData2) > 0) {
                            echo '<ul class="notification-list">';
                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData
                            foreach ($recentData as $rowStatus1) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus1['status_ppc'] == 3) {
                                    $statusText = 'Approved by Foreman';
                                }
                                echo '<li class="notification-item" data-reg-no="' . $rowStatus1['reg_no'] . '">
            <a href="../../nqr/ppc/ap-spv-detail-ppc.php?Id=' . $rowStatus1['reg_no'] . '">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>' . $rowStatus1['reg_no'] . '</h4>
                    <p>' . $rowStatus1['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . htmlspecialchars($statusText) . '</p>';
                                }
                                echo '</div>
                </a>
            </li>';
                            }

                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData2
                            foreach ($recentData2 as $rowStatus2) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus2['sts_cmr_ppc'] == 3) {
                                    $statusText = 'Approved by Foreman';
                                }
                                echo '<li class="notification-item" data-reg-no="' . $rowStatus2['cmr_no'] . '">
            <a href="../../cmr/ppc/ap-spv-cmr-detail-ppc.php?Id=' . $rowStatus2['Id'] . '">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>' . $rowStatus2['cmr_no'] . '</h4>
                    <p>' . $rowStatus2['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . htmlspecialchars($statusText) . '</p>';
                                }
                                echo '</div>
                </a>
            </li>';
                            }

                            echo '</ul>'; // Tutup list notifikasi
                        } else {
                            // Menampilkan pesan jika tidak ada data dengan status 1 atau status 2
                            echo '<ul class="notification-list">
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>No data waiting this year</h4>
                    </div>
                </li>
            </ul>';
                        }
                    } elseif ($_SESSION['role'] == 'MGRPPC') {
                        // Melakukan query untuk mendapatkan semua data dengan status 1 pada tahun ini
                        $queryStatus1 = mysqli_query($koneksi, "SELECT reg_no, status_ppc,
      CASE
          WHEN status_ppc = 4 THEN 
              CASE
                  WHEN TIMESTAMPDIFF(SECOND, dt_spv_ppc, NOW()) < 3600 THEN 'baru saja'
                  ELSE CONCAT(
                      CASE
                          WHEN TIMESTAMPDIFF(MONTH, dt_spv_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_spv_ppc, NOW()), ' bulan ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(WEEK, dt_spv_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_spv_ppc, NOW()), ' minggu ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(DAY, dt_spv_ppc, NOW()) > TIMESTAMPDIFF(WEEK, dt_spv_ppc, NOW()) * 7
                          THEN CONCAT(TIMESTAMPDIFF(DAY, dt_spv_ppc, NOW()) - TIMESTAMPDIFF(WEEK, dt_spv_ppc, NOW()) * 7, ' hari ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(HOUR, dt_spv_ppc, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_spv_ppc, NOW()) % 24, ' jam ')
                          ELSE ''
                      END,
                      'lalu'
                  )
              END
          ELSE ''
      END AS hours_ago
  FROM 
      transaksi 
  WHERE 
      status_ppc IN (4) AND YEAR(dt_op_qa) = $currentYear
  ORDER BY 
      CASE 
          WHEN status_ppc IN (4) THEN dt_op_ppc 
          ELSE NOW() 
      END ASC");


                        $queryStatus2 = mysqli_query($koneksi3, "SELECT transaksi.Id, transaksi.cmr_no, status_cmr.sts_cmr_ppc, transaksi.Id,
CASE
    WHEN status_cmr.sts_cmr_ppc = 3 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_spv_ppc, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_spv_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_spv_ppc, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_ppc, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_spv_ppc, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_ppc, NOW()) * 7
                    THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_spv_ppc, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_ppc, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_spv_ppc, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_spv_ppc, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    ELSE ''
END AS hours_ago
FROM 
transaksi
INNER JOIN
status_cmr ON transaksi.id = status_cmr.id
WHERE 
status_cmr.sts_cmr_ppc = 4 AND YEAR(status_cmr.dt_op_qa) = $currentYear
ORDER BY 
CASE 
    WHEN status_cmr.sts_cmr_ppc = 4 THEN status_cmr.dt_op_qa 
    ELSE NOW() 
END ASC");

                        // Simpan semua data dalam sebuah array
                        $allData = array();
                        while ($row = mysqli_fetch_assoc($queryStatus1)) {
                            $allData[] = $row;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData = $allData;

                        // Simpan semua data dalam sebuah array
                        $allData2 = array();

                        // Reset kursor untuk kueri kedua
                        mysqli_data_seek($queryStatus2, 0);

                        while ($row2 = mysqli_fetch_assoc($queryStatus2)) {
                            $allData2[] = $row2;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData2 = $allData2;

                        // Memeriksa apakah ada data dengan status 1
                        if (count($recentData) > 0 || count($recentData2) > 0) {
                            echo '<ul class="notification-list">';
                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData
                            foreach ($recentData as $rowStatus1) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus1['status_ppc'] == 4) {
                                    $statusText = 'Approved by Supervisor';
                                }
                                echo '<li class="notification-item" data-reg-no="' . $rowStatus1['reg_no'] . '">
            <a href="../../nqr/ppc/ap-mgr-detail-ppc.php?Id=' . $rowStatus1['reg_no'] . '">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>' . $rowStatus1['reg_no'] . '</h4>
                    <p>' . $rowStatus1['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . htmlspecialchars($statusText) . '</p>';
                                }
                                echo '</div>
                </a>
            </li>';
                            }

                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData2
                            foreach ($recentData2 as $rowStatus2) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus2['sts_cmr_ppc'] == 4) {
                                    $statusText = 'Approved by Supervisor';
                                }
                                echo '<li class="notification-item" data-reg-no="' . $rowStatus2['cmr_no'] . '">
            <a href="../../cmr/ppc/ap-mgr-cmr-detail-ppc.php?Id=' . $rowStatus2['Id'] . '">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>' . $rowStatus2['cmr_no'] . '</h4>
                    <p>' . $rowStatus2['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . htmlspecialchars($statusText) . '</p>';
                                }
                                echo '</div>
                </a>
            </li>';
                            }

                            echo '</ul>'; // Tutup list notifikasi
                        } else {
                            // Menampilkan pesan jika tidak ada data dengan status 1 atau status 2
                            echo '<ul class="notification-list">
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>No data waiting this year</h4>
                    </div>
                </li>
            </ul>';
                        }
                    } elseif ($_SESSION['role'] == 'OPVDD') {
                        // Melakukan query untuk mendapatkan semua data dengan status 1 pada tahun ini
                        $queryStatus1 = mysqli_query($koneksi, "SELECT reg_no, status_vdd, remark, Id,
        CASE
            WHEN status_vdd = 1 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_mgr_ppc, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_mgr_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_mgr_ppc, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_mgr_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_mgr_ppc, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_mgr_ppc, NOW()) > TIMESTAMPDIFF(WEEK, dt_mgr_ppc, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_mgr_ppc, NOW()) - TIMESTAMPDIFF(WEEK, dt_mgr_ppc, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_mgr_ppc, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_mgr_ppc, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
            WHEN status_vdd = 6 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_fm_vdd, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_fm_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_fm_vdd, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_fm_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_fm_vdd, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_fm_vdd, NOW()) > TIMESTAMPDIFF(WEEK, dt_fm_vdd, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_fm_vdd, NOW()) - TIMESTAMPDIFF(WEEK, dt_fm_vdd, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_fm_vdd, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_fm_vdd, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
            WHEN status_vdd = 7 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_spv_vdd, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_spv_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_spv_vdd, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_spv_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_spv_vdd, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_spv_vdd, NOW()) > TIMESTAMPDIFF(WEEK, dt_spv_vdd, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_spv_vdd, NOW()) - TIMESTAMPDIFF(WEEK, dt_spv_vdd, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_spv_vdd, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_spv_vdd, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
                WHEN status_vdd = 8 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_mgr_vdd, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_mgr_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_mgr_vdd, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_mgr_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_mgr_vdd, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_mgr_vdd, NOW()) > TIMESTAMPDIFF(WEEK, dt_mgr_vdd, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_mgr_vdd, NOW()) - TIMESTAMPDIFF(WEEK, dt_mgr_vdd, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_mgr_vdd, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_mgr_vdd, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
            ELSE ''
        END AS hours_ago
      FROM 
          transaksi 
      WHERE 
          status_vdd IN (1, 6, 7, 8) AND YEAR(dt_op_qa) = $currentYear
      ORDER BY 
          CASE 
              WHEN status_vdd IN (1, 6, 7, 8) THEN dt_mgr_ppc   
              ELSE NOW() 
          END ASC");
                        $queryStatus2 = mysqli_query($koneksi3, "SELECT transaksi.Id, transaksi.cmr_no, status_cmr.sts_cmr_vdd, status_cmr.remark_vdd,
CASE
WHEN status_cmr.sts_cmr_vdd = 1 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_mgr_ppc, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_mgr_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_mgr_ppc, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_ppc, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_ppc, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_mgr_ppc, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_ppc, NOW()) * 7 THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_mgr_ppc, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_ppc, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_mgr_ppc, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_mgr_ppc, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    WHEN status_cmr.sts_cmr_vdd = 6 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_fm_qa, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_fm_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_fm_vdd, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_vdd, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_fm_vdd, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_vdd, NOW()) * 7 THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_fm_vdd, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_vdd, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_fm_vdd, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_fm_vdd, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    WHEN status_cmr.sts_cmr_vdd = 7 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, dt_spv_vdd, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_spv_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_spv_vdd, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_vdd, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_spv_vdd, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_vdd, NOW()) * 7 THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_spv_vdd, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_vdd, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_spv_vdd, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_spv_vdd, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    WHEN status_cmr.sts_cmr_vdd = 8 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_mgr_vdd, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_mgr_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_mgr_vdd, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_vdd, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_mgr_vdd, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_vdd, NOW()) * 7 THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_mgr_vdd, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_mgr_vdd, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_mgr_vdd, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_mgr_vdd, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    ELSE ''
END AS hours_ago
FROM 
transaksi
INNER JOIN
status_cmr ON transaksi.id = status_cmr.id
WHERE 
status_cmr.sts_cmr_vdd IN (1,6,7,8) AND YEAR(status_cmr.dt_op_qa) = '$currentYear'
ORDER BY 
CASE 
    WHEN status_cmr.sts_cmr_vdd IN (1,6,7,8) THEN status_cmr.dt_op_qa 
    ELSE NOW() 
END ASC");

                        $allData = array();
                        while ($row = mysqli_fetch_assoc($queryStatus1)) {
                            $allData[] = $row;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData = $allData;

                        // Simpan semua data dalam sebuah array
                        $allData2 = array();

                        // Reset kursor untuk kueri kedua
                        mysqli_data_seek($queryStatus2, 0);

                        while ($row2 = mysqli_fetch_assoc($queryStatus2)) {
                            $allData2[] = $row2;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData2 = $allData2;

                        // Memeriksa apakah ada data dengan status 1 atau status 2
                        if (count($recentData) > 0 || count($recentData2) > 0) {
                            echo '<ul class="notification-list">';
                            // Mengambil data dan menampilkannya dalam elemen HTML
                            foreach ($recentData as $rowStatus1) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus1['status_vdd'] == 1) {
                                    $statusText = 'QA Finish';
                                } elseif ($rowStatus1['status_vdd'] == 6) {
                                    $statusText = 'rejected by FM';
                                } elseif ($rowStatus1['status_vdd'] == 7) {
                                    $statusText = 'rejected by SPV';
                                } elseif ($rowStatus1['status_vdd'] == 8) {
                                    $statusText = 'rejected by Manager';
                                }

                                echo '<li class="notification-item" data-reg-no="' . $rowStatus1['reg_no'] . '">
                  <a href="../../nqr/vdd/nqrvdd.php?Id=' . $rowStatus1['reg_no'] . '">
                      <i class="bi bi-exclamation-circle text-warning"></i>
                      <div>
                          <h4>' . $rowStatus1['reg_no'] . '</h4>
                          <p>' . $rowStatus1['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . $statusText . '</p>';
                                }
                                if (isset($rowStatus1['remark_vdd'])) {
                                    echo '<p>Remark:' . $rowStatus1['remark_vdd'] . '</p>';
                                }
                                echo '</div>
              </a>
          </li>';
                            }

                            foreach ($recentData2 as $rowStatus2) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus2['sts_cmr_vdd'] == 1) {
                                    $statusText = 'QA Finish';
                                } elseif ($rowStatus2['sts_cmr_vdd'] == 6) {
                                    $statusText = 'rejected by FM';
                                } elseif ($rowStatus2['sts_cmr_vdd'] == 7) {
                                    $statusText = 'rejected by SPV';
                                } elseif ($rowStatus2['sts_cmr_vdd'] == 8) {
                                    $statusText = 'rejected by Manager';
                                }

                                echo '<li class="notification-item" data-reg-no="' . $rowStatus2['cmr_no'] . '">
                <a href="../../cmr/vdd/cmrvdd.php?Id=' . $rowStatus2['Id'] . '">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>' . $rowStatus2['cmr_no'] . '</h4>
                        <p>' . $rowStatus2['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . $statusText . '</p>';
                                }
                                if (isset($rowStatus2['remark_vdd'])) {
                                    echo '<p>Remark:' . $rowStatus2['remark_vdd'] . '</p>';
                                }
                                echo '</div>
            </a>
        </li>';
                            }
                            echo '</ul>';
                        } else {
                            // Menampilkan pesan jika tidak ada data dengan status 1 pada tahun ini
                            echo '<ul class="notification-list">
            <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>No data waiting this year</h4>
                </div>
            </li>
        </ul>';
                        }
                    } elseif ($_SESSION['role'] == 'FMVDD') {
                        // Melakukan query untuk mendapatkan semua data dengan status 1 pada tahun ini
                        $queryStatus1 = mysqli_query($koneksi, "SELECT reg_no, status_vdd,
      CASE
          WHEN status_vdd = 2 THEN 
              CASE
                  WHEN TIMESTAMPDIFF(SECOND, dt_op_vdd, NOW()) < 3600 THEN 'baru saja'
                  ELSE CONCAT(
                      CASE
                          WHEN TIMESTAMPDIFF(MONTH, dt_op_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_op_vdd, NOW()), ' bulan ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(WEEK, dt_op_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_op_vdd, NOW()), ' minggu ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(DAY, dt_op_vdd, NOW()) > TIMESTAMPDIFF(WEEK, dt_op_vdd, NOW()) * 7
                          THEN CONCAT(TIMESTAMPDIFF(DAY, dt_op_vdd, NOW()) - TIMESTAMPDIFF(WEEK, dt_op_vdd, NOW()) * 7, ' hari ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(HOUR, dt_op_vdd, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_op_vdd, NOW()) % 24, ' jam ')
                          ELSE ''
                      END,
                      'lalu'
                  )
              END
          ELSE ''
      END AS hours_ago
  FROM 
      transaksi 
  WHERE 
      status_vdd IN (2) AND YEAR(dt_op_qa) = $currentYear
  ORDER BY 
      CASE 
          WHEN status_vdd IN (2) THEN dt_op_vdd 
          ELSE NOW() 
      END ASC");

                        $queryStatus2 = mysqli_query($koneksi3, "SELECT transaksi.Id, transaksi.cmr_no, status_cmr.sts_cmr_vdd, transaksi.Id,
CASE
    WHEN status_cmr.sts_cmr_vdd = 2 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_op_vdd, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_op_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_op_vdd, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_op_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_op_vdd, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_op_vdd, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_op_vdd, NOW()) * 7
                    THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_op_vdd, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_op_vdd, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_op_vdd, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_op_vdd, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    ELSE ''
END AS hours_ago
FROM 
transaksi
INNER JOIN
status_cmr ON transaksi.id = status_cmr.id
WHERE 
status_cmr.sts_cmr_vdd = 2 AND YEAR(status_cmr.dt_op_qa) = $currentYear
ORDER BY 
CASE 
    WHEN status_cmr.sts_cmr_vdd = 2 THEN status_cmr.dt_op_qa 
    ELSE NOW() 
END ASC");

                        // Simpan semua data dalam sebuah array
                        $allData = array();
                        while ($row = mysqli_fetch_assoc($queryStatus1)) {
                            $allData[] = $row;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData = $allData;

                        // Simpan semua data dalam sebuah array
                        $allData2 = array();

                        // Reset kursor untuk kueri kedua
                        mysqli_data_seek($queryStatus2, 0);

                        while ($row2 = mysqli_fetch_assoc($queryStatus2)) {
                            $allData2[] = $row2;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData2 = $allData2;

                        // Memeriksa apakah ada data dengan status 1
                        if (count($recentData) > 0 || count($recentData2) > 0) {
                            echo '<ul class="notification-list">';
                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData
                            foreach ($recentData as $rowStatus1) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus1['status_vdd'] == 2) {
                                    $statusText = 'Requested';
                                }
                                echo '<li class="notification-item" data-reg-no="' . $rowStatus1['reg_no'] . '">
            <a href="../../nqr/vdd/ap-fm-detail-vdd.php?Id=' . $rowStatus1['reg_no'] . '">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>' . $rowStatus1['reg_no'] . '</h4>
                    <p>' . $rowStatus1['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . htmlspecialchars($statusText) . '</p>';
                                }
                                echo '</div>
                </a>
            </li>';
                            }

                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData2
                            foreach ($recentData2 as $rowStatus2) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus2['sts_cmr_vdd'] == 2) {
                                    $statusText = 'Requested';
                                }
                                echo '<li class="notification-item" data-reg-no="' . $rowStatus2['cmr_no'] . '">
            <a href="../../cmr/vdd/ap-fm-cmr-detail-vdd.php?Id=' . $rowStatus2['Id'] . '">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>' . $rowStatus2['cmr_no'] . '</h4>
                    <p>' . $rowStatus2['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . htmlspecialchars($statusText) . '</p>';
                                }
                                echo '</div>
                </a>
            </li>';
                            }

                            echo '</ul>'; // Tutup list notifikasi
                        } else {
                            // Menampilkan pesan jika tidak ada data dengan status 1 atau status 2
                            echo '<ul class="notification-list">
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>No data waiting this year</h4>
                    </div>
                </li>
            </ul>';
                        }
                    } elseif ($_SESSION['role'] == 'SPVVDD') {
                        // Melakukan query untuk mendapatkan semua data dengan status 1 pada tahun ini
                        $queryStatus1 = mysqli_query($koneksi, "SELECT reg_no, status_vdd,
      CASE
          WHEN status_vdd = 3 THEN 
              CASE
                  WHEN TIMESTAMPDIFF(SECOND, dt_op_vdd, NOW()) < 3600 THEN 'baru saja'
                  ELSE CONCAT(
                      CASE
                          WHEN TIMESTAMPDIFF(MONTH, dt_fm_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_fm_vdd, NOW()), ' bulan ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(WEEK, dt_fm_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_fm_vdd, NOW()), ' minggu ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(DAY, dt_fm_vdd, NOW()) > TIMESTAMPDIFF(WEEK, dt_fm_vdd, NOW()) * 7
                          THEN CONCAT(TIMESTAMPDIFF(DAY, dt_fm_vdd, NOW()) - TIMESTAMPDIFF(WEEK, dt_fm_vdd, NOW()) * 7, ' hari ')
                          ELSE ''
                      END,
                      CASE
                          WHEN TIMESTAMPDIFF(HOUR, dt_fm_vdd, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_fm_vdd, NOW()) % 24, ' jam ')
                          ELSE ''
                      END,
                      'lalu'
                  )
              END
          ELSE ''
      END AS hours_ago
  FROM 
      transaksi 
  WHERE 
      status_vdd IN (3) AND YEAR(dt_op_qa) = $currentYear
  ORDER BY 
      CASE 
          WHEN status_vdd IN (3) THEN dt_op_vdd 
          ELSE NOW() 
      END ASC");
                        $queryStatus2 = mysqli_query($koneksi3, "SELECT transaksi.Id, transaksi.cmr_no, status_cmr.sts_cmr_vdd, transaksi.Id,
CASE
    WHEN status_cmr.sts_cmr_vdd = 3 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_fm_vdd, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_fm_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_fm_vdd, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_vdd, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_fm_vdd, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_vdd, NOW()) * 7
                    THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_fm_vdd, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_fm_vdd, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_fm_vdd, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_fm_vdd, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    ELSE ''
END AS hours_ago
FROM 
transaksi
INNER JOIN
status_cmr ON transaksi.id = status_cmr.id
WHERE 
status_cmr.sts_cmr_vdd = 3 AND YEAR(status_cmr.dt_op_qa) = $currentYear
ORDER BY 
CASE 
    WHEN status_cmr.sts_cmr_vdd = 3 THEN status_cmr.dt_op_qa 
    ELSE NOW() 
END ASC");

                        // Simpan semua data dalam sebuah array
                        $allData = array();
                        while ($row = mysqli_fetch_assoc($queryStatus1)) {
                            $allData[] = $row;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData = $allData;

                        // Simpan semua data dalam sebuah array
                        $allData2 = array();

                        // Reset kursor untuk kueri kedua
                        mysqli_data_seek($queryStatus2, 0);

                        while ($row2 = mysqli_fetch_assoc($queryStatus2)) {
                            $allData2[] = $row2;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData2 = $allData2;

                        // Memeriksa apakah ada data dengan status 1
                        if (count($recentData) > 0 || count($recentData2) > 0) {
                            echo '<ul class="notification-list">';
                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData
                            foreach ($recentData as $rowStatus1) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus1['status_vdd'] == 3) {
                                    $statusText = 'Approved by Foreman';
                                }
                                echo '<li class="notification-item" data-reg-no="' . $rowStatus1['reg_no'] . '">
            <a href="../../nqr/vdd/ap-spv-detail-vdd.php?Id=' . $rowStatus1['reg_no'] . '">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>' . $rowStatus1['reg_no'] . '</h4>
                    <p>' . $rowStatus1['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . htmlspecialchars($statusText) . '</p>';
                                }
                                echo '</div>
                </a>
            </li>';
                            }

                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData2
                            foreach ($recentData2 as $rowStatus2) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus2['sts_cmr_vdd'] == 3) {
                                    $statusText = 'Approved by Foreman';
                                }
                                echo '<li class="notification-item" data-reg-no="' . $rowStatus2['cmr_no'] . '">
            <a href="../../cmr/vdd/ap-spv-cmr-detail-vdd.php?Id=' . $rowStatus2['Id'] . '">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>' . $rowStatus2['cmr_no'] . '</h4>
                    <p>' . $rowStatus2['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . htmlspecialchars($statusText) . '</p>';
                                }
                                echo '</div>
                </a>
            </li>';
                            }

                            echo '</ul>'; // Tutup list notifikasi
                        } else {
                            // Menampilkan pesan jika tidak ada data dengan status 1 atau status 2
                            echo '<ul class="notification-list">
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>No data waiting this year</h4>
                    </div>
                </li>
            </ul>';
                        }
                    } elseif ($_SESSION['role'] == 'MGRVDD') {
                        // Melakukan query untuk mendapatkan semua data dengan status 1 pada tahun ini
                        $queryStatus1 = mysqli_query($koneksi, "SELECT reg_no, status_vdd,
        CASE
            WHEN status_vdd = 4 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_spv_vdd, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_spv_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_spv_vdd, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_spv_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_spv_vdd, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_spv_vdd, NOW()) > TIMESTAMPDIFF(WEEK, dt_spv_vdd, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_spv_vdd, NOW()) - TIMESTAMPDIFF(WEEK, dt_spv_vdd, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_spv_vdd, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_spv_vdd, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
            ELSE ''
        END AS hours_ago
    FROM 
        transaksi 
    WHERE 
        status_vdd IN (4) AND YEAR(dt_op_qa) = $currentYear
    ORDER BY 
        CASE 
            WHEN status_vdd IN (4) THEN dt_op_vdd 
            ELSE NOW() 
        END ASC");
                        $queryStatus2 = mysqli_query($koneksi3, "SELECT transaksi.Id, transaksi.cmr_no, status_cmr.sts_cmr_vdd, transaksi.Id,
CASE
    WHEN status_cmr.sts_cmr_vdd = 4 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_spv_vdd, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_spv_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_spv_vdd, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_vdd, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_spv_vdd, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_vdd, NOW()) * 7
                    THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_spv_vdd, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_vdd, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_spv_vdd, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_spv_vdd, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    ELSE ''
END AS hours_ago
FROM 
transaksi
INNER JOIN
status_cmr ON transaksi.id = status_cmr.id
WHERE 
status_cmr.sts_cmr_vdd = 4 AND YEAR(status_cmr.dt_op_qa) = $currentYear
ORDER BY 
CASE 
    WHEN status_cmr.sts_cmr_vdd = 4 THEN status_cmr.dt_op_qa 
    ELSE NOW() 
END ASC");

                        // Simpan semua data dalam sebuah array
                        $allData = array();
                        while ($row = mysqli_fetch_assoc($queryStatus1)) {
                            $allData[] = $row;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData = $allData;

                        // Simpan semua data dalam sebuah array
                        $allData2 = array();

                        // Reset kursor untuk kueri kedua
                        mysqli_data_seek($queryStatus2, 0);

                        while ($row2 = mysqli_fetch_assoc($queryStatus2)) {
                            $allData2[] = $row2;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData2 = $allData2;

                        // Memeriksa apakah ada data dengan status 1
                        if (count($recentData) > 0 || count($recentData2) > 0) {
                            echo '<ul class="notification-list">';
                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData
                            foreach ($recentData as $rowStatus1) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus1['status_vdd'] == 4) {
                                    $statusText = 'Approved by Supervisor';
                                }
                                echo '<li class="notification-item" data-reg-no="' . $rowStatus1['reg_no'] . '">
             <a href="../../nqr/vdd/ap-mgr-detail-vdd.php?Id=' . $rowStatus1['reg_no'] . '">
                 <i class="bi bi-exclamation-circle text-warning"></i>
                 <div>
                     <h4>' . $rowStatus1['reg_no'] . '</h4>
                     <p>' . $rowStatus1['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . htmlspecialchars($statusText) . '</p>';
                                }
                                echo '</div>
                 </a>
             </li>';
                            }

                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData2
                            foreach ($recentData2 as $rowStatus2) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus2['sts_cmr_vdd'] == 4) {
                                    $statusText = 'Approved by Supervisor';
                                }
                                echo '<li class="notification-item" data-reg-no="' . $rowStatus2['cmr_no'] . '">
             <a href="../../cmr/vdd/ap-mgr-cmr-detail-vdd.php?Id=' . $rowStatus2['Id'] . '">
                 <i class="bi bi-exclamation-circle text-warning"></i>
                 <div>
                     <h4>' . $rowStatus2['cmr_no'] . '</h4>
                     <p>' . $rowStatus2['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . htmlspecialchars($statusText) . '</p>';
                                }
                                echo '</div>
                 </a>
             </li>';
                            }

                            echo '</ul>'; // Tutup list notifikasi
                        } else {
                            // Menampilkan pesan jika tidak ada data dengan status 1 atau status 2
                            echo '<ul class="notification-list">
                 <li class="notification-item">
                     <i class="bi bi-exclamation-circle text-warning"></i>
                     <div>
                         <h4>No data waiting this year</h4>
                     </div>
                 </li>
             </ul>';
                        }
                    } elseif ($_SESSION['role'] == 'BODTA') {
                        // Melakukan query untuk mendapatkan semua data dengan status 1 pada tahun ini
                        $queryStatus1 = mysqli_query($koneksi, "SELECT reg_no, status_vdd,
        CASE
            WHEN status_vdd = 99 THEN 
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, dt_spv_vdd, NOW()) < 3600 THEN 'baru saja'
                    ELSE CONCAT(
                        CASE
                            WHEN TIMESTAMPDIFF(MONTH, dt_spv_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, dt_spv_vdd, NOW()), ' bulan ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(WEEK, dt_spv_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, dt_spv_vdd, NOW()), ' minggu ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(DAY, dt_spv_vdd, NOW()) > TIMESTAMPDIFF(WEEK, dt_spv_vdd, NOW()) * 7
                            THEN CONCAT(TIMESTAMPDIFF(DAY, dt_spv_vdd, NOW()) - TIMESTAMPDIFF(WEEK, dt_spv_vdd, NOW()) * 7, ' hari ')
                            ELSE ''
                        END,
                        CASE
                            WHEN TIMESTAMPDIFF(HOUR, dt_spv_vdd, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, dt_spv_vdd, NOW()) % 24, ' jam ')
                            ELSE ''
                        END,
                        'lalu'
                    )
                END
            ELSE ''
        END AS hours_ago
    FROM 
        transaksi 
    WHERE 
        status_vdd IN (99) AND YEAR(dt_op_qa) = $currentYear
    ORDER BY 
        CASE 
            WHEN status_vdd IN (99) THEN dt_op_vdd 
            ELSE NOW() 
        END ASC");
                        $queryStatus2 = mysqli_query($koneksi3, "SELECT transaksi.Id, transaksi.cmr_no, status_cmr.sts_cmr_vdd, transaksi.Id,
CASE
    WHEN status_cmr.sts_cmr_vdd = 4 THEN 
        CASE
            WHEN TIMESTAMPDIFF(SECOND, status_cmr.dt_spv_vdd, NOW()) < 3600 THEN 'baru saja'
            ELSE CONCAT(
                CASE
                    WHEN TIMESTAMPDIFF(MONTH, status_cmr.dt_spv_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(MONTH, status_cmr.dt_spv_vdd, NOW()), ' bulan ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_vdd, NOW()) > 0 THEN CONCAT(TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_vdd, NOW()), ' minggu ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(DAY, status_cmr.dt_spv_vdd, NOW()) > TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_vdd, NOW()) * 7
                    THEN CONCAT(TIMESTAMPDIFF(DAY, status_cmr.dt_spv_vdd, NOW()) - TIMESTAMPDIFF(WEEK, status_cmr.dt_spv_vdd, NOW()) * 7, ' hari ')
                    ELSE ''
                END,
                CASE
                    WHEN TIMESTAMPDIFF(HOUR, status_cmr.dt_spv_vdd, NOW()) % 24 > 0 THEN CONCAT(TIMESTAMPDIFF(HOUR, status_cmr.dt_spv_vdd, NOW()) % 24, ' jam ')
                    ELSE ''
                END,
                'lalu'
            )
        END
    ELSE ''
END AS hours_ago
FROM 
transaksi
INNER JOIN
status_cmr ON transaksi.id = status_cmr.id
WHERE 
status_cmr.sts_cmr_vdd = 4 AND YEAR(status_cmr.dt_op_qa) = $currentYear
ORDER BY 
CASE 
    WHEN status_cmr.sts_cmr_vdd = 4 THEN status_cmr.dt_op_qa 
    ELSE NOW() 
END ASC");

                        // Simpan semua data dalam sebuah array
                        $allData = array();
                        while ($row = mysqli_fetch_assoc($queryStatus1)) {
                            $allData[] = $row;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData = $allData;

                        // Simpan semua data dalam sebuah array
                        $allData2 = array();

                        // Reset kursor untuk kueri kedua
                        mysqli_data_seek($queryStatus2, 0);

                        while ($row2 = mysqli_fetch_assoc($queryStatus2)) {
                            $allData2[] = $row2;
                        }

                        // Mengambil 3 data terbaru untuk ditampilkan pertama kali
                        $recentData2 = $allData2;

                        // Memeriksa apakah ada data dengan status 1
                        if (count($recentData) > 0 || count($recentData2) > 0) {
                            echo '<ul class="notification-list">';
                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData
                            foreach ($recentData as $rowStatus1) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus1['status_vdd'] == 99) {
                                    $statusText = 'Approved by Manager';
                                }
                                echo '<li class="notification-item" data-reg-no="' . $rowStatus1['reg_no'] . '">
             <a href="../../nqr/vdd/ap-mgr-detail-vdd.php?Id=' . $rowStatus1['reg_no'] . '">
                 <i class="bi bi-exclamation-circle text-warning"></i>
                 <div>
                     <h4>' . $rowStatus1['reg_no'] . '</h4>
                     <p>' . $rowStatus1['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . htmlspecialchars($statusText) . '</p>';
                                }
                                echo '</div>
                 </a>
             </li>';
                            }

                            // Mengambil data dan menampilkannya dalam elemen HTML dari $recentData2
                            foreach ($recentData2 as $rowStatus2) {
                                // Mengonversi nilai status menjadi teks yang deskriptif
                                $statusText = '';
                                if ($rowStatus2['sts_cmr_vdd'] == 4) {
                                    $statusText = 'Approved by Manager';
                                }
                                echo '<li class="notification-item" data-reg-no="' . $rowStatus2['cmr_no'] . '">
             <a href="../../cmr/ta-detail.php?Id=' . $rowStatus2['Id'] . '">
                 <i class="bi bi-exclamation-circle text-warning"></i>
                 <div>
                     <h4>' . $rowStatus2['cmr_no'] . '</h4>
                     <p>' . $rowStatus2['hours_ago'] . '</p>';
                                // Cetak teks status yang telah dikonversi
                                if (!empty($statusText)) {
                                    echo '<p>Status: ' . htmlspecialchars($statusText) . '</p>';
                                }
                                echo '</div>
                 </a>
             </li>';
                            }

                            echo '</ul>'; // Tutup list notifikasi
                        } else {
                            // Menampilkan pesan jika tidak ada data dengan status 1 atau status 2
                            echo '<ul class="notification-list">
                 <li class="notification-item">
                     <i class="bi bi-exclamation-circle text-warning"></i>
                     <div>
                         <h4>No data waiting this year</h4>
                     </div>
                 </li>
             </ul>';
                        }
                    }
                }


                ?>

            </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <!-- <li class="nav-item dropdown pe-3"> -->
        <!-- Navigasi -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- Tombol Toggle untuk Mode Responsif -->
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- Item Navigasi -->
                        <!-- Tulis kode item navigasi lainnya di sini -->
                    </ul>

                    <!-- Navigasi Profil Dropdown -->
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <!-- Tombol Dropdown Profil -->
                            <a class="nav-link nav-profile d-flex align-items-center pe-2" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle d-md-none">
                                <!-- Ditampilkan pada perangkat seluler -->
                                <span class="d-none d-md-block"
                                    style="font-size: 15px; opacity: 0.8; margin-left:-25px;">
                                    Selamat Datang, <?php echo $_SESSION['name'] ?>
                                    <i class="bi bi-caret-down-fill" style="font-size: 0.8em; margin-left:2px;"></i>
                                </span>
                            </a>

                            <!-- Menu Dropdown Profil -->
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                                aria-labelledby="navbarDropdown">
                                <li class="dropdown-header">
                                    <h6><?php echo $_SESSION['name'] ?></h6> <!-- Sedikit ke kanan -->


                                    <span>
                                        <?php
                                        $role_label = '';

                                        switch ($_SESSION['role']) {
                                            case 'OPQA':
                                                $role_label = 'Operator QA';
                                                break;
                                            case 'FMQA':
                                                $role_label = 'Foreman QA';
                                                break;
                                            case 'SPVQA':
                                                $role_label = 'Supervisor QA';
                                                break;
                                            case 'MGRQA':
                                                $role_label = 'Manager QA';
                                                break;
                                            case 'OPPPC':
                                                $role_label = 'Operator PPC';
                                                break;
                                            case 'FMPPC':
                                                $role_label = 'Foreman PPC';
                                                break;
                                            case 'SPVPPC':
                                                $role_label = 'Supervisor PPC';
                                                break;
                                            case 'MGRPPC':
                                                $role_label = 'Manager PPC';
                                                break;
                                            case 'OPVDD':
                                                $role_label = 'Operator VDD';
                                                break;
                                            case 'FMVDD':
                                                $role_label = 'Foreman VDD';
                                                break;
                                            case 'SPVVDD':
                                                $role_label = 'Supervisor VDD';
                                                break;
                                            case 'MGRVDD':
                                                $role_label = 'Manager VDD';
                                                break;
                                            case 'BODTA':
                                                $role_label = 'BOD & TA EXP';
                                                break;
                                            default:
                                                $role_label = '' . $_SESSION['role'] . '';
                                                break;
                                        }

                                        echo $role_label;
                                        ?>
                                    </span>

                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <!-- Item-menu Dropdown Profil -->
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <!-- Logout -->
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="logout.php">
                                        <i class="ri-logout-circle-line"></i>
                                        <span>Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notificationItems = document.querySelectorAll('.notification-item');

                notificationItems.forEach(item => {
                    item.addEventListener('click', function () {
                        const regNo = item.dataset.regNo;
                        alert('You clicked on item with reg_no: ' + regNo);
                        // Di sini Anda dapat menambahkan logika untuk menampilkan detail data sesuai dengan reg_no yang diklik
                    });
                });
            });
            <script>
                document.addEventListener('DOMContentLoaded', function() {
  const viewAllLink = document.querySelector('.badge.bg-primary.p-2.ms-2');
                const allNotifications = document.getElementById('allNotifications');

                viewAllLink.addEventListener('click', function() {
    // Urutkan semua data berdasarkan hours_ago terlama
    const sortedData = <?php echo json_encode($allData); ?>;
    sortedData.sort((a, b) => b.hours_ago - a.hours_ago);

                // Tampilkan semua data yang telah diurutkan
                allNotifications.innerHTML = '';
    sortedData.forEach(row => {
                    allNotifications.innerHTML += `
        <li class="notification-item" data-reg-no="${row.reg_no}">
          <i class="bi bi-exclamation-circle text-warning"></i>
          <div>
            <h4>${row.reg_no}</h4>
            <p>${row.hours_ago} hours ago</p>
          </div>
        </li>
      `;
    });

                allNotifications.style.display = 'block'; // Tampilkan semua elemen
  });
});
        </script>

        <style>
            .notification-list {
                list-style-type: none;
                padding: 0;
                max-height: 300px;
                /* Atur ketinggian maksimum sesuai kebutuhan */
                overflow-y: auto;
                /* Aktifkan scrolling vertikal jika konten melebihi ketinggian maksimum */
            }

            .notification-item {
                border-bottom: 1px solid #ccc;
                padding: 10px;
            }

            .notification-item:last-child {
                border-bottom: none;
                /* Menghilangkan border bottom pada item terakhir */
            }

            .dropdown-item:hover {
                color: red;
                /* Ganti dengan warna yang Anda inginkan */
            }
        </style>