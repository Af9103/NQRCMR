<?php
require_once(__DIR__ . '/../fpdf/fpdf.php');
require(__DIR__ . '/../fpdi/src/autoload.php');
require_once(__DIR__ . '/../koneksi.php');


$pdf = new FPDF('l', 'mm', 'A4');
$pdf->AddFont('ARIALN', '', 'ARIALN.php');
$pdf->AddFont('ARIALNB', '', 'ARIALNB.php');
$pdf->AddPage();
$pdf->SetAutoPageBreak(false, 5);
$pdf->SetFont('ARIALN', '', 9);

// Misalkan $Id sudah didefinisikan sebelumnya
$Id = $_GET['Id']; // Sesuaikan dengan cara Anda mendapatkan nilai Id

// Buat kueri SQL untuk mengambil data dari tabel transaksi berdasarkan Id
$sql = "SELECT * FROM transaksi WHERE Id = '$Id'";

// Eksekusi kueri menggunakan objek koneksi dari file koneksi.php
$result = $koneksi->query($sql);

$pdf->Cell(50, 5, 'PT.KAYABA INDONESIA', 0, 1);
$pdf->Cell(50, 5, 'QA.DEPT', 0, 0);

$pdf->SetFont('ARIALN', 'U', 18);
$pdf->SetXY(80, 10);
$pdf->Cell(130, 15, 'NONCONFORMING QUALITY REPORT', 1, 0, 'C');

$pdf->SetFont('ARIALN', '', 10);
$pdf->SetXY(230, 10);
foreach ($result as $row) {
    $pdf->Cell(65, 5, 'Reg No : ' . $row['reg_no'], 1, 0);
    $pdf->SetXY(230, 15);
    $pdf->Cell(65, 5, 'Issued Date : ' . date('F d, Y', strtotime($row['iss_dt'])), 1, 0);
    $pdf->SetXY(230, 20);
    $pdf->Cell(65, 5, 'Receiv.No   :' . $row['rece_no'], 1, 0);
}

foreach ($result as $row) {
    $pdf->SetY(27);
    $pdf->MultiCell(50, 5, "Supplier Name\n" . $row['supp_name'], 1);
    $pdf->SetXY(60, 27);
    $pdf->MultiCell(50, 5, "Part Name\n" . $row['part_name'], 1);
    $pdf->SetXY(110, 27);
    $pdf->Cell(35, 5, 'Part No', 1, 0);
    $pdf->MultiCell(25, 5, "PO No\n" . '   ' . $row['po_no'], 1);
    $pdf->SetXY(170, 27);
    $pdf->Cell(10, 5, 'Rev', 1, 0);
    $pdf->Cell(25, 5, 'Revision Item', 1, 0, 'C');
    $pdf->Cell(15, 5, 'Date', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Dept.Head', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Sect.Head', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Foreman', 1, 1, 'C');
}

foreach ($result as $row) {
    $pdf->SetX(110);
    $pdf->Cell(35, 5, $row['part_no'], 1, 0, 'C');
    $pdf->SetX(170);
    $pdf->Cell(10, 5, '', 1, 0, 'C');
    $pdf->SetX(180);
    $pdf->Cell(25, 5, ' ', 1, 0, 'C');
    $pdf->Cell(15, 5, '', 1, 0, 'C');
    $pdf->Cell(25, 15, '', 1, 0, 'C');
    $pdf->Cell(25, 15, '', 1, 0, 'C');
    $pdf->Cell(25, 15, '', 1, 1, 'C');
}

$pdf->SetY(37);
$pdf->Cell(100, 70, '', 1, 1, 'C');
$pdf->SetY(37);
$pdf->Cell(10, 5, 'Search of problem :', 0, 0);
$pdf->SetFont('ARIALN', '', 14);
$pdf->SetY(57);
$pdf->Cell(100, 10, $row['problem'], 0, 1, 'C');
$pdf->SetFont('ARIALN', '', 9);
$pdf->SetY(67);
$pdf->Cell(100, 5, '(Detail attached)', 0, 1, 'C');
$pdf->SetY(82);
$pdf->Cell(100, 5, 'INVOICE        ' . $row['invoice'], 0, 1);
$pdf->SetY(87);
$pdf->Cell(100, 5, 'ORDER          : ' . $row['order_no'], 0, 1);
$pdf->SetY(92);
$pdf->Cell(100, 5, 'TOTAL DEL      : ' . $row['total_del'] . '     KGS', 0, 1);
$pdf->SetY(97);
$pdf->Cell(100, 5, 'TOTAL CLAIM    : ' . $row['total_claim'] . '    KGS', 0, 1);
$pdf->SetY(102);
if (!empty($row['note'])) {
    $pdf->Cell(100, 5, '(' . $row['note'] . ')', 0, 1, 'C');
} else {
    $pdf->Cell(100, 5, '', 0, 1, 'C');
}

// Menambahkan label 'Claim' dan 'Complaint[Information]'
$pdf->SetXY(115, 37);
$pdf->Cell(35, 5, 'Claim:', 0, 1);
$pdf->SetX(115);
$pdf->Cell(35, 5, 'Complaint[Information]', 0, 0);
$pdf->SetXY(111, 38);
$pdf->Cell(3, 3, '', 1, 1); // Cell pertama terisi dengan 'X'
$pdf->SetXY(111, 43);
$pdf->Cell(3, 3, '', 1, 0); // Cell kedua terisi dengan 'X'

// Iterasi untuk setiap baris hasil
foreach ($result as $row) {
    // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
    $info = $row['info']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

    // Check the value of $info and fill the corresponding cell accordingly
    if ($info == 1) {
        $pdf->Image('../assets/img/ceklis.png', 110, 37, 5, 5); // Koordinat (110, 37) dengan ukuran 5x5
    } elseif ($info == 2) {
        $pdf->Image('../assets/img/ceklis.png', 110, 42, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
    }

}

$pdf->SetXY(145, 37);
$pdf->Cell(75, 10, '', 1, 1, 'C');
$pdf->SetXY(145, 37);
$pdf->Cell(75, 5, 'Delivery Date', 0, 1);
$pdf->SetXY(145, 42);
$pdf->Cell(75, 5, date("M d'Y", strtotime($row['dev_dt'])), 0, 1, 'C');

$pdf->SetXY(220, 37);
if ($row['sts_mgr_qa'] == 1) {
    if ($row['dt_mgr_qa'] == '0000-00-00 00:00:00') {
        $date_formatted = "";
    } else {
        $date_formatted = date("d-m-Y H:i", strtotime($row['dt_mgr_qa']));
    }
    $pdf->Cell(25, 5, $date_formatted, 0, 1, 'C');
}
$pdf->SetXY(245, 37);
if ($row['sts_spv_qa'] == 1) {
    if ($row['dt_spv_qa'] == '0000-00-00 00:00:00') {
        $date_formatted = "";
    } else {
        $date_formatted = date("d-m-Y H:i", strtotime($row['dt_spv_qa']));
    }
    $pdf->Cell(25, 5, $date_formatted, 0, 1, 'C');
}
$pdf->SetXY(270, 37);
if ($row['sts_fm_qa'] == 1) {
    if ($row['dt_fm_qa'] == '0000-00-00 00:00:00') {
        $date_formatted = "";
    } else {
        $date_formatted = date("d-m-Y H:i", strtotime($row['dt_fm_qa']));
    }
    $pdf->Cell(25, 5, $date_formatted, 0, 1, 'C');
}


$pdf->SetXY(220, 42);
if ($row['sts_mgr_qa'] == 1) {
    $pdf->Cell(25, 5, $row['nm_mgr_qa'], 0, 1, 'C');
}

$pdf->SetXY(245, 42);
if ($row['sts_spv_qa'] == 1) {
    $pdf->Cell(25, 5, $row['nm_spv_qa'], 0, 1, 'C');
}

$pdf->SetXY(270, 42);
if ($row['sts_fm_qa'] == 1) {
    $pdf->Cell(25, 5, $row['nm_fm_qa'], 0, 1, 'C');
}


// Menambahkan label 'Claim' dan 'Complaint[Information]'
$pdf->SetXY(110, 47);
$pdf->Cell(35, 60, '', 1, 1, 'C');
$pdf->SetXY(110, 47);
$pdf->Cell(10, 5, 'location Claim occur', 0, 0);
$pdf->SetXY(115, 57);
$pdf->Cell(10, 5, 'Receiving Insp', 0, 0);
$pdf->SetXY(115, 67);
$pdf->Cell(10, 5, 'In-Process', 0, 0);
$pdf->SetXY(115, 77);
$pdf->Cell(10, 5, 'Customer', 0, 0);
$pdf->SetXY(115, 82);
$pdf->Cell(10, 5, '(............)', 0, 0);
$pdf->SetXY(111, 58);
$pdf->Cell(3, 3, '', 1, 0);
$pdf->SetXY(111, 68);
$pdf->Cell(3, 3, '', 1, 0);
$pdf->SetXY(111, 78);
$pdf->Cell(3, 3, '', 1, 0);

// Iterasi untuk setiap baris hasil
foreach ($result as $row) {
    // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
    $info = $row['lco']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

    // Check the value of $info and fill the corresponding cell accordingly
    if ($info == 1) {
        $pdf->Image('../assets/img/ceklis.png', 110, 57, 5, 5); // Koordinat (110, 57) dengan ukuran 5x5
    } elseif ($info == 2) {
        $pdf->Image('../assets/img/ceklis.png', 110, 67, 5, 5); // Koordinat (110, 67) dengan ukuran 5x5
    } elseif ($info == 3) {
        $pdf->Image('../assets/img/ceklis.png', 110, 77, 5, 5); // Koordinat (110, 77) dengan ukuran 5x5
    }
}


$pdf->SetXY(145, 47);
$pdf->Cell(75, 5, 'Disposition of inventory', 1, 1, 'C');

// Menambahkan label 'Claim' dan 'Complaint[Information]'
$pdf->SetXY(145, 52);
$pdf->Cell(40, 55, '', 1, 1, 'C');
$pdf->SetXY(145, 52);
$pdf->Cell(40, 5, 'At customer', 0, 0);
$pdf->SetXY(150, 57);
$pdf->Cell(40, 5, 'Sorted by Customer', 0, 0);
$pdf->SetXY(115, 57);
$pdf->SetXY(150, 62);
$pdf->Cell(35, 5, '(.............)', 0, 0);
$pdf->SetXY(150, 72);
$pdf->Cell(40, 5, 'Sorted by Supplier', 0, 0);
$pdf->SetXY(150, 77);
$pdf->Cell(35, 5, 'Date:_ _ _ _ _ _', 0, 0);
$pdf->SetFont('ARIALN', '', 7);
$pdf->SetXY(150, 82);
$pdf->Cell(35, 5, '(please come to PT KYB)', 0, 0);
$pdf->SetFont('ARIALN', '', 9);
$pdf->SetXY(150, 92);
$pdf->Cell(40, 5, 'Sorted by PT.KYBI', 0, 0);
$pdf->SetXY(150, 102);
$pdf->Cell(40, 5, 'Keep to use', 0, 0);
$pdf->SetXY(146, 58);
$pdf->Cell(3, 3, '', 1, 0);
$pdf->SetXY(146, 73);
$pdf->Cell(3, 3, '', 1, 0);
$pdf->SetXY(146, 103);
$pdf->Cell(3, 3, '', 1, 0);
$pdf->SetXY(146, 93);
$pdf->Cell(3, 3, '', 1, 0);

// Iterasi untuk setiap baris hasil
foreach ($result as $row) {
    // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
    $info = $row['doi1']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

    // Check the value of $info and fill the corresponding cell accordingly
    if ($info == 1) {
        $pdf->Image('../assets/img/ceklis.png', 145, 57, 5, 5); // Koordinat (145, 57) dengan ukuran 5x5
    } elseif ($info == 2) {
        $pdf->Image('../assets/img/ceklis.png', 145, 72, 5, 5);
    } elseif ($info == 3) {
        $pdf->Image('../assets/img/ceklis.png', 145, 92, 5, 5);
    } elseif ($info == 4) {
        $pdf->Image('../assets/img/ceklis.png', 145, 102, 5, 5);
    }
}


// Iterasi untuk setiap baris hasil
foreach ($result as $row) {
    // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
    $info = $row['doi2']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

    // Check the value of $info and fill the corresponding cell accordingly
    if ($info == 2) {
        $pdf->SetXY(185, 57);
        $pdf->Image('../assets/img/ceklis.png', 185, 57, 5, 5); // Koordinat (185, 57) dengan ukuran 5x5
    } elseif ($info == 3) {
        $pdf->SetXY(185, 77);
        $pdf->Image('../assets/img/ceklis.png', 185, 77, 5, 5); // Koordinat (185, 77) dengan ukuran 5x5
    } elseif ($info == 4) {
        $pdf->SetXY(185, 87);
        $pdf->Image('../assets/img/ceklis.png', 185, 87, 5, 5); // Koordinat (185, 87) dengan ukuran 5x5
    }
}

$pdf->SetXY(185, 52);
$pdf->Cell(35, 55, '', 1, 1, 'C');
$pdf->SetXY(185, 52);
$pdf->Cell(35, 5, 'At PT. KYBI', 0, 0);
$pdf->SetXY(186, 58);
$pdf->Cell(3, 3, '', 1, 0);
$pdf->SetXY(190, 57);
$pdf->Cell(35, 5, 'Sorted by Supplier', 0, 0);
$pdf->SetXY(190, 62);
$pdf->Cell(30, 5, 'Date:_ _ _ _ _ _', 0, 0);
$pdf->SetFont('ARIALN', '', 7);
$pdf->SetXY(190, 67);
$pdf->Cell(30, 5, '(please come to PT KYB)', 0, 0);
$pdf->SetFont('ARIALN', '', 9);
$pdf->SetXY(186, 78);
$pdf->Cell(3, 3, '', 1, 0);
$pdf->SetXY(190, 77);
$pdf->Cell(40, 5, 'Q Sorted by PT.KYBI', 0, 0);
$pdf->SetXY(186, 88);
$pdf->Cell(3, 3, '', 1, 0);
$pdf->SetXY(190, 87);
$pdf->Cell(40, 5, 'Q Keep to use', 0, 0);

foreach ($result as $row) {
    // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
    $info = $row['cof']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

    // Check the value of $info and fill the corresponding cell accordingly
    if ($info == 1) {
        $pdf->SetXY(220, 52);
        $pdf->Image('../assets/img/ceklis.png', 220, 52, 5, 5); // Koordinat (220, 52) dengan ukuran 5x5
    } elseif ($info == 2) {
        $pdf->SetXY(220, 57);
        $pdf->Image('../assets/img/ceklis.png', 220, 57, 5, 5); // Koordinat (220, 57) dengan ukuran 5x5
    }
}

foreach ($result as $row) {
    $pdf->SetXY(220, 47);
    $pdf->Cell(40, 60, '', 1, 1, 'C');
    $pdf->SetXY(225, 47);
    $pdf->Cell(40, 5, 'Claim occurance freq.', 0, 0);
    $pdf->SetXY(221, 53);
    $pdf->Cell(3, 3, '', 1, 0);
    $pdf->SetXY(225, 52);
    $pdf->Cell(40, 5, 'First time', 0, 0);
    $pdf->SetXY(221, 58);
    $pdf->Cell(3, 3, '', 1, 0);
    $pdf->SetXY(225, 57);
    $pdf->Cell(40, 5, 'Reoccured/routin', 0, 0);
    $pdf->SetXY(225, 62);
    if ($row['routin'] != 0) {
        $pdf->Cell(35, 5, '(' . $row['routin'] . ' times)', 0, 0);
    }


    foreach ($result as $row) {
        // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
        $info = $row['dodp']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

        // Check the value of $info and fill the corresponding cell accordingly
        if ($info == 1) {
            $pdf->SetXY(220, 77);
            $pdf->Image('../assets/img/ceklis.png', 220, 77, 5, 5); // Koordinat (220, 77) dengan ukuran 5x5
        } elseif ($info == 2) {
            $pdf->SetXY(220, 82);
            $pdf->Image('../assets/img/ceklis.png', 220, 82, 5, 5); // Koordinat (220, 82) dengan ukuran 5x5
        } elseif ($info == 3) {
            $pdf->SetXY(220, 92);
            $pdf->Image('../assets/img/ceklis.png', 220, 92, 5, 5); // Koordinat (220, 92) dengan ukuran 5x5
        }
    }

    $pdf->SetXY(220, 72);
    $pdf->Cell(40, 5, 'Disposition of defect part', 0, 0);
    $pdf->SetXY(221, 78);
    $pdf->Cell(3, 3, '', 1, 0);
    $pdf->SetXY(225, 77);
    $pdf->Cell(40, 5, 'Keep to use', 0, 0);
    $pdf->SetXY(221, 83);
    $pdf->Cell(3, 3, '', 1, 0);
    $pdf->SetXY(225, 82);
    $pdf->Cell(40, 5, 'Return to Supplier', 0, 0);
    $pdf->SetXY(225, 87);
    $pdf->Cell(35, 5, $row['supp_name'], 0, 0);
    $pdf->SetXY(221, 93);
    $pdf->Cell(3, 3, '', 1, 0);
    $pdf->SetXY(225, 92);
    $pdf->Cell(40, 5, 'Scrapped at PT.KYBI', 0, 0);
}

$pdf->SetXY(260, 52); // Sesuaikan posisi X dan Y sesuai kebutuhan Anda

// Iterasi untuk setiap baris hasil
foreach ($result as $row) {
    // Misalkan $info adalah nilai dari kolom 'pay' dalam tabel transaksi
    $info = $row['p']; // Sesuaikan dengan nama kolom yang benar

    // Check apakah nilai $info adalah 0 atau tidak
    if ($info == 1) {
        // Jika nilai $info adalah 0, isi cell dengan string kosong
        $pdf->Image('../assets/img/ceklis.png', 260, 52, 5, 5);
    }
}

foreach ($result as $row) {
    // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
    $info = $row['stc']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

    // Check the value of $info and fill the corresponding cell accordingly
    if ($info == 1) {
        // Jika nilai $info adalah 1, tambahkan gambar ceklis di dua lokasi
        $pdf->Image('../assets/img/ceklis.png', 265, 77, 5, 5); // Koordinat (265, 77) dengan ukuran 5x5
        $pdf->Image('../assets/img/ceklis.png', 260, 72, 5, 5); // Koordinat (260, 72) dengan ukuran 5x5
    } elseif ($info == 2) {
        // Jika nilai $info adalah 2, tambahkan gambar ceklis di dua lokasi yang berbeda
        $pdf->Image('../assets/img/ceklis.png', 265, 82, 5, 5); // Koordinat (265, 82) dengan ukuran 5x5
        $pdf->Image('../assets/img/ceklis.png', 260, 72, 5, 5); // Koordinat (260, 72) dengan ukuran 5x5
    }
}

foreach ($result as $row) {
    $pdf->SetXY(260, 47);
    $pdf->Cell(35, 60, '', 1, 1, 'C');
    $pdf->SetXY(260, 47);
    $pdf->Cell(40, 5, 'Disposition of this Claim', 0, 0);
    $pdf->SetXY(261, 53);
    $pdf->Cell(3, 3, '', 1, 0);
    $pdf->SetXY(265, 52);
    $pdf->Cell(40, 5, 'Pay compensation', 0, 0);
    preg_match_all('/\$?\d+(?:\.\d+)?/', $row['pay'], $matches);

    // If there's at least one match
    if (!empty($matches[0])) {
        // Display the first match
        $pdf->SetXY(265, 57);
        $pdf->Cell(35, 5, $matches[0][0], 0, 0);

        // If there's a second match, display it
        if (isset($matches[0][1])) {
            $pdf->SetXY(265, 62);
            $pdf->Cell(35, 5, $matches[0][1], 0, 0);

            // If there's a third match, display it
            if (isset($matches[0][2])) {
                $pdf->SetXY(265, 67);
                $pdf->Cell(35, 5, $matches[0][2], 0, 0);
            }
        }
    }
    $pdf->SetXY(265, 67);
    $pdf->Cell(35, 5, '', 0, 0);
    $pdf->SetXY(261, 73);
    $pdf->Cell(3, 3, '', 1, 0);
    $pdf->SetXY(265, 72);
    $pdf->Cell(40, 5, 'Send the replacement', 0, 0);
    $pdf->SetXY(266, 78);
    $pdf->Cell(3, 3, '', 1, 0);
    $pdf->SetXY(270, 77);
    $pdf->Cell(35, 5, 'Q By Air', 0, 0);
    $pdf->SetXY(266, 83);
    $pdf->Cell(3, 3, '', 1, 0);
    $pdf->SetXY(270, 82);
    $pdf->Cell(35, 5, 'Q By Sea', 0, 0);
    $pdf->SetXY(273, 92);
    $pdf->Cell(20, 5, 'PPC Dept', 1, 0);
    $pdf->SetXY(273, 92);
    $pdf->Cell(20, 15, '', 1, 1);

    // Iterasi untuk setiap baris hasil
    foreach ($result as $row) {
        // Misalkan $dt_stc adalah nilai dari kolom 'dt_stc' dalam tabel transaksi
        $dt_stc = $row['dt_stc']; // Sesuaikan dengan nama kolom yang benar

        // Check apakah $dt_stc adalah '0000-00-00', jika ya, kosongkan nilainya
        if ($dt_stc == '0000-00-00') {
            $dt_stc = ''; // Mengosongkan nilai $dt_stc
        }

        // Set posisi X dan Y
        $pdf->SetXY(265, 87);
        // Tulis nilai $dt_stc
        $pdf->Cell(30, 5, $dt_stc, 0, 0);
    }
}

$pdf->SetY(107);
$pdf->Cell(20, 5, 'Fill in by Supplier', 0, 1);

$pdf->SetY(112);
$pdf->Cell(215, 5, 'PROBLEM IDENTIFICATION', 1, 0, 'C');
$pdf->SetXY(226, 112);
$pdf->Cell(30, 5, 'SUPPLIER:', 1, 0, 'C');
$pdf->SetX(260);
$pdf->Cell(35, 5, 'VERIFICATION', 1, 1, 'C');


$pdf->Cell(50, 5, 'ROOT CASE', 1, 0, 'C');
$pdf->Cell(140, 5, 'TEMPORARY ACTION & PERMANENT ACTION', 1, 0, 'C');
$pdf->Cell(25, 5, 'SCHEDULE', 1, 0, 'C');
$pdf->SetX(226);
$pdf->Cell(30, 25, '', 1, 0);
$pdf->SetX(226);
$pdf->Cell(30, 5, 'Approved:', 0, 0, 'C');

$pdf->SetX(260);
$pdf->Cell(12, 5, 'M-1', 1, 0, 'C');
$pdf->Cell(12, 5, 'M-2', 1, 0, 'C');
$pdf->Cell(11, 5, 'M-3', 1, 1, 'C');

$pdf->Cell(50, 75, '', 1, 0);
$pdf->Cell(140, 75, '', 1, 0);
$pdf->Cell(25, 75, '', 1, 0);

$pdf->SetXY(226, 142);
$pdf->Cell(30, 25, '', 1, 0);
$pdf->SetX(226);
$pdf->Cell(30, 5, 'Checked:', 0, 0, 'C');

$pdf->SetXY(260, 122);
$pdf->Cell(12, 10, '', 1, 0);
$pdf->Cell(12, 10, '', 1, 0);
$pdf->Cell(11, 10, '', 1, 0);

$pdf->SetXY(260, 132);
$pdf->Cell(35, 45, '', 1, 1);

$pdf->SetXY(260, 132);
$pdf->Cell(35, 5, 'REMARK:', 0, 0);

$pdf->SetXY(226, 167);
$pdf->Cell(30, 30, '', 1, 0, '');
$pdf->SetX(22);
$pdf->Cell(30, 5, 'Prepared:', 0, 0, 'C');

$pdf->SetXY(260, 177);
$pdf->Cell(20, 20, '', 1, 0);
$pdf->Cell(15, 20, '', 1, 0);

$pdf->SetXY(260, 177);
$pdf->Cell(20, 5, 'JUDGE:', 0, 0);

$pdf->SetXY(260, 182);
$pdf->Cell(20, 5, 'Q OK', 0, 0);
$pdf->SetXY(260, 187);
$pdf->Cell(20, 5, 'Q NG', 0, 0);

$pdf->SetXY(280, 177);
$pdf->Cell(20, 5, 'SIGN', 0, 1);

$pdf->SetFont('ARIALNB', '', 11);
$pdf->SetY(197);
$pdf->Cell(20, 5, 'Bold Line to be filled by PT.KYBI', 0, 1);
$pdf->SetFont('ARIALN', '', 9);
$pdf->Cell(20, 5, 'Route: QA Receiving Insp.PTKYBI -> Supplier -> VD PT.KYBI -> QA Receiving PT.KYBI', 0, 1);


$no_reg_sanitized = preg_replace("/[^a-zA-Z0-9]+/", "", $row['reg_no']);

$pdfPath = "../NQR/" . $no_reg_sanitized . ".pdf";
$pdf->Output($pdfPath, 'F');

$unique_filename = "../file/" . $row['att']; // Path to the second PDF file

use setasign\Fpdi\Fpdi;
// Initialize FPDI
$pdfi = new Fpdi();

// Add pages from the main PDF file
$pageCountMain = $pdfi->setSourceFile($pdfPath);
for ($pageNumber = 1; $pageNumber <= $pageCountMain; $pageNumber++) {
    // Set orientation to landscape for the first page
    if ($pageNumber == 1) {
        $pdfi->AddPage('L', array(297, 220));
    } else {
        $pdfi->AddPage();
    }
    $templateId = $pdfi->importPage($pageNumber);
    $pdfi->useTemplate($templateId);
}

// Add pages from the second PDF file
$pageCountSecond = $pdfi->setSourceFile($unique_filename);
for ($pageNumber = 1; $pageNumber <= $pageCountSecond; $pageNumber++) {
    $templateId = $pdfi->importPage($pageNumber);

    // Get template size
    $templateSize = $pdfi->getTemplateSize($templateId);

    // Tentukan orientasi halaman berdasarkan ukuran
    $orientation = ($templateSize['width'] > $templateSize['height']) ? 'L' : 'P';

    // Tambahkan halaman dengan orientasi yang sesuai
    $pdfi->AddPage($orientation, array($templateSize['width'], $templateSize['height']));
    $pdfi->useTemplate($templateId);
}

ob_end_clean();

// Buat objek PDF dengan FPDF
$pdf = new FPDF();
// Define the destination path for the merged PDF
$mergedPdfPath = "../NQR/" . $no_reg_sanitized . ".pdf";


// Save the merged PDF file to the desired location
$pdfi->Output($mergedPdfPath, 'I');

// Output the merged PDF file for viewing
echo $mergedPdfPath;
?>