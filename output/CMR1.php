<?php
require(__DIR__ . '/../library/tcpdf.php');
require_once(__DIR__ . '/../koneksi.php');
require_once(__DIR__ . '/../vendor/autoload.php');


$pdf = new TCPDF('l', 'mm', 'A4');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->AddPage();
$pdf->AddFont('cid0jp', '', 'cid0jp.php');
$pdf->SetAutoPageBreak(false, 5);
$pdf->SetFont('cid0jp', '', 10);

// Misalkan $Id sudah didefinisikan sebelumnya
$Id = $_GET['Id']; // Sesuaikan dengan cara Anda mendapatkan nilai Id

// Buat kueri SQL untuk mengambil data dari tabel transaksi berdasarkan Id
$sql = "SELECT * FROM transaksi WHERE Id = '$Id'";

// Eksekusi kueri menggunakan objek koneksi dari file koneksi.php
$result = $koneksi3->query($sql);

$pdf->Cell(50, 5, '様式１', 0, 1);
$pdf->Cell(50, 5, '(CKD PART ONLY)', 0, 0);
$pdf->SetFont('cid0jp', '', 12);
$pdf->SetXY(60, 10);
$pdf->Cell(110, 15, '', 1, 1, 'C');
$pdf->SetXY(60, 10);
$pdf->Cell(110, 7.5, 'Claim Report(CMR)', 0, 1, 'C');
$pdf->SetXY(60, 17);
$pdf->Cell(110, 7.5, 'クレーム状況報告書', 0, 1, 'C');

foreach ($result as $row) {
    $pdf->SetFont('cid0jp', '', 8);
    $pdf->SetXY(205, 10);
    $pdf->Cell(40, 5, 'Issue Date(発行日）', 1, 0);
    $formatted_date = date("M d' Y", strtotime($row['iss_dt']));
    $pdf->Cell(40, 5, $formatted_date, 1, 1);

    $pdf->SetXY(205, 15);
    $pdf->MultiCell(40, 10, "Company Name\n" . '（拠点名)', 1);
    $pdf->SetXY(245, 15);
    $pdf->Cell(40, 10, $row['supp_name'], 1, 1);
    $pdf->SetXY(150, 20);
    $pdf->Cell(30, 5, '', 0, 0);
    $pdf->MultiCell(20, 10, "KYB\n" . 'Receiving', 1, 'C');
    $pdf->SetXY(200, 25);
    $pdf->SetFont('times', '', 9);
    $pdf->Cell(25, 5, 'Procurement', 1, 0, 'C');
    $pdf->Cell(20, 5, 'PPC', 1, 0, 'C');
    $pdf->Cell(20, 5, 'QA DEPT', 1, 0, 'C');
    $pdf->Cell(20, 5, 'A.G.M', 1, 1, 'C');

    $pdf->SetFont('cid0jp', '', 9);
    $pdf->Cell(100, 5, ' Ｔｏ ; Supplier Name (ｻﾌﾟﾗｲﾔ名) : ' . $row['supp_name'], 1, 0);
    $pdf->Cell(70, 5, 'KYB CMR No.              :', 1, 0);
    $pdf->Cell(20, 15, '', 1, 0);
    $pdf->SetFont('times', '', 9);
    $pdf->Cell(25, 5, 'Approved', 1, 0, 'C');
    $pdf->Cell(20, 5, 'Reviewed', 1, 0, 'C');
    $pdf->Cell(20, 5, 'Written', 1, 0, 'C');
    $pdf->Cell(20, 5, 'Checked', 1, 1, 'C');

    $pdf->SetFont('cid0jp', '', 9);
    $pdf->Cell(100, 5, 'CMR No.(PTKYB CMRN o .  : ' . $row['cmr_no'], 1, 0);
    $pdf->Cell(70, 5, 'B/L date(船積日)           :   ', 1, 0);

    $pdf->SetXY(200, 35);
    $pdf->Cell(25, 10, '', 1, 0);
    $pdf->Cell(20, 10, '', 1, 0);
    $pdf->Cell(20, 10, '', 1, 0);
    $pdf->Cell(20, 10, '', 1, 1);

    $pdf->SetY(40);
    $pdf->Cell(100, 5, 'Found Date (発見日）     : ' . date("M d' Y", strtotime($row['found_dt'])), 1, 0);
    $pdf->Cell(70, 5, 'A/R Date (到着日）      :' . date("M d' Y", strtotime($row['ar_dt'])), 1, 1);

    $pdf->SetFont('cid0jp', '', 7);
    $pdf->Cell(50, 10, 'Location claim occur（クレーム発生場所)', 1, 0, 'C');
    $pdf->Cell(75, 10, 'Disposition of inventory（在庫品処理）', 1, 0, 'C');
    $pdf->Cell(45, 10, '', 1, 1, 'C');
    $pdf->SetXY(135, 45);
    $pdf->Cell(45, 5, 'Claim occurrence frequency', 0, 0, 'C');
    $pdf->SetXY(135, 50);
    $pdf->Cell(45, 5, '(発生頻度）', 0, 0, 'C');
    $pdf->SetXY(180, 45);
    $pdf->Cell(60, 10, 'Dispatch of defective parts', 1, 0, 'C');
    $pdf->Cell(45, 10, '', 1, 1, 'C');
    $pdf->SetXY(240, 45);
    $pdf->Cell(45, 5, 'Disposition of Defect parts', 0, 0, 'C');
    $pdf->SetXY(240, 50);
    $pdf->Cell(45, 5, '(不良部品の処分)', 0, 1, 'C');


    // Iterasi untuk setiap baris hasil
    foreach ($result as $row) {
        // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
        $info = $row['lco']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

        // Check the value of $info and fill the corresponding cell accordingly
        if ($info == 1) {
            $pdf->Image('../assets/img/ceklis.png', 10, 60, 5, 5); // Koordinat (110, 37) dengan ukuran 5x5
        } elseif ($info == 2) {
            $pdf->Image('../assets/img/ceklis.png', 10, 70, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        } elseif ($info == 3) {
            $pdf->Image('../assets/img/ceklis.png', 10, 80, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        }

    }
    $pdf->Cell(50, 50, '', 1, 0);
    $pdf->SetXY(10, 60);
    $pdf->Cell(50, 5, '□   Receiving Inspect(受入検査)', 0, 0, '');
    $pdf->SetXY(10, 70);
    $pdf->Cell(50, 5, '□   In-Process(工程内)', 0, 0);
    $pdf->SetXY(10, 80);
    $pdf->Cell(50, 5, '□   Customer(客先)', 0, 0);

    foreach ($result as $row) {
        // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
        $info = $row['doi1']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

        // Check the value of $info and fill the corresponding cell accordingly
        if ($info == 1) {
            $pdf->Image('../assets/img/ceklis.png', 60, 60, 5, 5); // Koordinat (110, 37) dengan ukuran 5x5
        } elseif ($info == 2) {
            $pdf->Image('../assets/img/ceklis.png', 60, 70, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        } elseif ($info == 3) {
            $pdf->Image('../assets/img/ceklis.png', 60, 80, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        }

    }
    $pdf->SetXY(60, 55);
    $pdf->Cell(40, 50, '', 1, 0);
    $pdf->SetXY(50, 55);
    $pdf->Cell(50, 5, 'At customer(客先にて)', 0, 0, 'C');
    $pdf->SetXY(60, 60);
    $pdf->Cell(50, 5, '□   Sorted by Customer', 0, 1);
    $pdf->SetXY(65, 65);
    $pdf->Cell(50, 5, '(客先による選別)', 0, 1);
    $pdf->SetXY(60, 70);
    $pdf->Cell(50, 5, '□   Sorted by PT.KYB', 0, 1);
    $pdf->SetXY(65, 75);
    $pdf->Cell(50, 5, '(拠点による選別)', 0, 1);
    $pdf->SetXY(60, 80);
    $pdf->Cell(50, 5, '□   Keep to use', 0, 1);
    $pdf->SetXY(65, 85);
    $pdf->Cell(50, 5, '(継続使用)', 0, 1);

    foreach ($result as $row) {
        // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
        $info = $row['doi2']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

        // Check the value of $info and fill the corresponding cell accordingly
        if ($info == 1) {
            $pdf->Image('../assets/img/ceklis.png', 100, 60, 5, 5); // Koordinat (110, 37) dengan ukuran 5x5
        } elseif ($info == 2) {
            $pdf->Image('../assets/img/ceklis.png', 100, 70, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        } elseif ($info == 3) {
            $pdf->Image('../assets/img/ceklis.png', 100, 80, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        } elseif ($info == 4) {
            $pdf->Image('../assets/img/ceklis.png', 100, 90, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        }

    }

    $pdf->SetXY(100, 55);
    $pdf->Cell(35, 50, '', 1, 0);
    $pdf->SetXY(95, 55);
    $pdf->Cell(45, 5, 'At PT.KYB(PT.KYBにて)', 0, 0, 'C');
    $pdf->SetXY(100, 60);
    $pdf->Cell(50, 5, '□   Sorted by PT.KYB', 0, 1);
    $pdf->SetX(105);
    $pdf->Cell(50, 5, '(PT.KYBによる選別)', 0, 1);
    $pdf->SetX(100);
    $pdf->Cell(50, 5, '□   Keep to use', 0, 1);
    $pdf->SetX(105);
    $pdf->Cell(50, 5, '(継続使用)', 0, 1);
    $pdf->SetX(100);
    $pdf->Cell(50, 5, '□   Return to KYB', 0, 1);
    $pdf->SetX(105);
    $pdf->Cell(50, 5, '(ＫＹＢ返却)', 0, 1);
    $pdf->SetX(100);
    $pdf->Cell(50, 5, '□   Other', 0, 1);
    $pdf->SetX(105);
    $pdf->Cell(50, 5, '(その他）', 0, 1);

    foreach ($result as $row) {
        // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
        $info = $row['cof']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

        // Check the value of $info and fill the corresponding cell accordingly
        if ($info == 1) {
            $pdf->Image('../assets/img/ceklis.png', 135, 60, 5, 5); // Koordinat (110, 37) dengan ukuran 5x5
        } elseif ($info == 2) {
            $pdf->Image('../assets/img/ceklis.png', 135, 70, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        } elseif ($info == 3) {
            $pdf->Image('../assets/img/ceklis.png', 135, 80, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        } elseif ($info == 4) {
            $pdf->Image('../assets/img/ceklis.png', 135, 90, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        } elseif ($info == 5) {
            $pdf->Image('../assets/img/ceklis.png', 135, 100, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        }

    }
    $pdf->SetXY(135, 55);
    $pdf->Cell(45, 50, '', 1, 0);
    $pdf->SetXY(135, 60);
    $pdf->Cell(50, 5, '□   First Time', 0, 1);
    $pdf->SetX(140);
    $pdf->Cell(50, 5, '(初回)', 0, 1);
    $pdf->SetX(135);
    $pdf->Cell(50, 5, '□   Reoccurred', 0, 1);
    $pdf->SetX(140);
    $pdf->Cell(50, 5, '(再発)', 0, 1);
    $pdf->SetX(135);
    $pdf->Cell(50, 5, '□   Intermittently', 0, 1);
    $pdf->SetX(140);
    $pdf->Cell(50, 5, '(断続的)', 0, 1);
    $pdf->SetX(135);
    $pdf->Cell(50, 5, '□   Continuously', 0, 1);
    $pdf->SetX(140);
    $pdf->Cell(50, 5, '(継続的)', 0, 1);
    $pdf->SetX(135);
    $pdf->Cell(50, 5, '□   Other(その他)', 0, 1);

    foreach ($result as $row) {
        // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
        $info = $row['dispatch']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

        // Check the value of $info and fill the corresponding cell accordingly
        if ($info == 1) {
            $pdf->Image('../assets/img/ceklis.png', 180, 85, 5, 5); // Koordinat (110, 37) dengan ukuran 5x5
        } elseif ($info == 2) {
            $pdf->Image('../assets/img/ceklis.png', 180, 95, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        }

    }
    $pdf->SetFont('times', '', 9);
    $pdf->SetXY(180, 55);
    $pdf->Cell(60, 50, '', 1, 0);
    $pdf->SetXY(180, 55);
    $pdf->Cell(45, 5, 'In case of rust, mixed parts and', 0, 1);
    $pdf->SetX(180);
    $pdf->Cell(45, 5, 'machining defective claims,', 0, 1);
    $pdf->SetX(180);
    $pdf->Cell(45, 5, 'dispatch of the samples is required to', 0, 1);
    $pdf->SetX(180);
    $pdf->Cell(45, 5, 'investigate at KYB   (n=3 pcs, at least)', 0, 1);
    $pdf->SetFont('cid0jp', '', 8);
    $pdf->SetX(180);
    $pdf->Cell(45, 5, '(錆、異品、加工不良等のｸﾚｰﾑの場合', 0, 1);
    $pdf->SetX(180);
    $pdf->Cell(45, 5, '現品の送付要。最低３個)', 0, 1);
    $pdf->SetX(180);
    $pdf->Cell(45, 5, '□   Dispatch with  this report', 0, 1);
    $pdf->SetX(185);
    $pdf->Cell(45, 5, '(別途送付)', 0, 1);
    $pdf->SetX(180);
    $pdf->Cell(45, 5, '□   Dispatch separetely', 0, 1);
    $pdf->SetX(185);
    $pdf->Cell(45, 5, '(別途送付)', 0, 1);

    foreach ($result as $row) {
        // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
        $info = $row['dispo']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

        // Check the value of $info and fill the corresponding cell accordingly
        if ($info == 1) {
            $pdf->Image('../assets/img/ceklis.png', 240, 55, 5, 5); // Koordinat (110, 37) dengan ukuran 5x5
        } elseif ($info == 2) {
            $pdf->Image('../assets/img/ceklis.png', 240, 65, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        } elseif ($info == 3) {
            $pdf->Image('../assets/img/ceklis.png', 240, 75, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        }

    }
    $pdf->SetXY(240, 55);
    $pdf->Cell(45, 50, '', 1, 0);
    $pdf->SetX(240);
    $pdf->Cell(45, 5, '□   Keep to use', 0, 1);
    $pdf->SetX(245);
    $pdf->Cell(45, 5, '(継続使用)', 0, 1);
    $pdf->SetX(240);
    $pdf->Cell(45, 5, '□   Return to KYB', 0, 1);
    $pdf->SetX(245);
    $pdf->Cell(45, 5, '(KYB返却)', 0, 1);
    $pdf->SetX(240);
    $pdf->Cell(45, 5, '□   Scrapped at PT.KYB', 0, 1);
    $pdf->SetX(245);
    $pdf->Cell(45, 5, '(PT.KYBにて廃却)', 0, 1);

    $pdf->SetY(105);
    $pdf->Cell(10, 10, 'NO.', 1, 0, 'C');
    $pdf->SetX(20);
    $pdf->Cell(20, 10, '', 1, 0, 'C');
    $pdf->SetXY(40, 105);
    $pdf->Cell(20, 10, '', 1, 0, 'C');
    $pdf->SetXY(60, 105);
    $pdf->Cell(15, 10, '', 1, 0, 'C');
    $pdf->SetXY(75, 105);
    $pdf->Cell(20, 10, '', 1, 0, 'C');
    $pdf->SetXY(95, 105);
    $pdf->Cell(40, 10, '', 1, 0, 'C');
    $pdf->SetXY(135, 105);
    $pdf->Cell(30, 10, '', 1, 0, 'C');
    $pdf->SetXY(165, 105);
    $pdf->Cell(30, 10, '', 1, 0, 'C');
    $pdf->SetXY(195, 105);
    $pdf->Cell(30, 10, '', 1, 0, 'C');
    $pdf->SetXY(225, 105);
    $pdf->Cell(30, 10, '', 1, 0, 'C');
    $pdf->SetXY(255, 105);
    $pdf->Cell(30, 10, '', 1, 0, 'C');

    $pdf->SetXY(20, 105);
    $pdf->Cell(20, 5, 'Invoice No', 0, 0, 'C');
    $pdf->SetXY(20, 110);
    $pdf->Cell(20, 5, 'インボイスNo.', 0, 0, 'C');
    $pdf->SetXY(40, 105);
    $pdf->Cell(20, 5, 'Order No.', 0, 0, 'C');
    $pdf->SetXY(40, 110);
    $pdf->Cell(20, 5, 'オーダーNo.', 0, 0, 'C');
    $pdf->SetXY(60, 105);
    $pdf->Cell(15, 5, 'Product', 0, 0, 'C');
    $pdf->SetXY(60, 110);
    $pdf->Cell(15, 5, '(製品)', 0, 0, 'C');
    $pdf->SetXY(75, 105);
    $pdf->Cell(20, 5, 'Model', 0, 0, 'C');
    $pdf->SetXY(75, 110);
    $pdf->Cell(20, 5, '(モデル)', 0, 0, 'C');
    $pdf->SetXY(95, 105);
    $pdf->Cell(40, 5, 'Product Name', 0, 0, 'C');
    $pdf->SetXY(95, 110);
    $pdf->Cell(40, 5, '(部品名)', 0, 0, 'C');
    $pdf->SetXY(135, 105);
    $pdf->Cell(30, 5, 'Part Number', 0, 0, 'C');
    $pdf->SetXY(135, 110);
    $pdf->Cell(30, 5, '(部品番号)', 0, 0, 'C');
    $pdf->SetXY(165, 105);
    $pdf->Cell(30, 5, 'Quantity Ordered', 0, 0, 'C');
    $pdf->SetXY(165, 110);
    $pdf->Cell(30, 5, '(オーダー数)', 0, 0, 'C');
    $pdf->SetXY(195, 105);
    $pdf->Cell(30, 5, 'Quantity Delivered', 0, 0, 'C');
    $pdf->SetXY(195, 110);
    $pdf->Cell(30, 5, '(納入数)', 0, 0, 'C');
    $pdf->SetXY(225, 105);
    $pdf->Cell(30, 5, 'Quantity Defect', 0, 0, 'C');
    $pdf->SetXY(225, 110);
    $pdf->Cell(30, 5, '(不良数)', 0, 0, 'C');
    $pdf->SetXY(255, 105);
    $pdf->Cell(30, 5, 'Crate Number', 0, 0, 'C');
    $pdf->SetXY(255, 110);
    $pdf->Cell(30, 5, '(ケース番号)', 0, 0, 'C');

    $pdf->SetY(115);
    $pdf->Cell(10, 5, '1', 1, 0, 'C');
    $pdf->SetX(20);
    $pdf->Cell(20, 5, $row['invoice'], 1, 0, 'C');
    $pdf->SetX(40);
    $pdf->Cell(20, 5, $row['order_no'], 1, 0, 'C');
    $pdf->SetX(60);
    $pdf->Cell(15, 5, $row['product'], 1, 0, 'C');
    $pdf->SetX(75);
    $pdf->Cell(20, 5, $row['model'], 1, 0, 'C');
    $pdf->SetX(95);
    $pdf->Cell(40, 5, $row['part_name'], 1, 0, 'C');
    $pdf->SetX(135);
    $pdf->Cell(30, 5, $row['part_num'], 1, 0, 'C');
    $pdf->SetX(165);
    $pdf->Cell(30, 5, $row['qty_order'], 1, 0, 'C');
    $pdf->SetX(195);
    $pdf->Cell(30, 5, $row['qty_del'], 1, 0, 'C');
    $pdf->SetX(225);
    $pdf->Cell(30, 5, $row['qty_def'], 1, 0, 'C');
    $pdf->SetX(255);
    $pdf->Cell(30, 5, $row['crate_num'], 1, 0, 'C');

    $pdf->SetY(120);
    $pdf->Cell(10, 5, '', 1, 0, 'C');
    $pdf->SetX(20);
    $pdf->Cell(20, 5, '', 1, 0, 'C');
    $pdf->SetX(40);
    $pdf->Cell(20, 5, '', 1, 0, 'C');
    $pdf->SetX(60);
    $pdf->Cell(15, 5, '', 1, 0, 'C');
    $pdf->SetX(75);
    $pdf->Cell(20, 5, '', 1, 0, 'C');
    $pdf->SetX(95);
    $pdf->Cell(40, 5, '', 1, 0, 'C');
    $pdf->SetX(135);
    $pdf->Cell(30, 5, '', 1, 0, 'C');
    $pdf->SetX(165);
    $pdf->Cell(30, 5, '', 1, 0, 'C');
    $pdf->SetX(195);
    $pdf->Cell(30, 5, '', 1, 0, 'C');
    $pdf->SetX(225);
    $pdf->Cell(30, 5, '', 1, 0, 'C');
    $pdf->SetX(255);
    $pdf->Cell(30, 5, '', 1, 0, 'C');

    $pdf->SetY(125);
    $pdf->Cell(10, 5, '', 1, 0, 'C');
    $pdf->SetX(20);
    $pdf->Cell(20, 5, '', 1, 0, 'C');
    $pdf->SetX(40);
    $pdf->Cell(20, 5, '', 1, 0, 'C');
    $pdf->SetX(60);
    $pdf->Cell(15, 5, '', 1, 0, 'C');
    $pdf->SetX(75);
    $pdf->Cell(20, 5, '', 1, 0, 'C');
    $pdf->SetX(95);
    $pdf->Cell(40, 5, '', 1, 0, 'C');
    $pdf->SetX(135);
    $pdf->Cell(30, 5, '', 1, 0, 'C');
    $pdf->SetX(165);
    $pdf->Cell(30, 5, '', 1, 0, 'C');
    $pdf->SetX(195);
    $pdf->Cell(30, 5, '', 1, 0, 'C');
    $pdf->SetX(225);
    $pdf->Cell(30, 5, '', 1, 0, 'C');
    $pdf->SetX(255);
    $pdf->Cell(30, 5, '', 1, 0, 'C');

    $pdf->SetFont('cid0jp', '', 9);
    $pdf->SetY(130);
    $pdf->MultiCell(120, 10, "DISPOSITION OF THIS CLAIM(Requirement from PT.KYB.I)\n" . '(本クレームの処理要求)', 1, 'C');
    $pdf->SetXY(130, 130);
    $pdf->MultiCell(155, 10, "Description of the defect\n" . '(不良状況)', 1, 'C');

    foreach ($result as $row) {
        // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
        $info = $row['dotc']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

        // Check the value of $info and fill the corresponding cell accordingly
        if ($info == 1) {
            $pdf->Image('ceklis.png', 10, 140, 5, 5); // Koordinat (110, 37) dengan ukuran 5x5
        } elseif ($info == 2) {
            $pdf->Image('ceklis.png', 10, 180, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        }

    }

    foreach ($result as $row) {
        // Misalkan $info adalah nilai dari kolom 'info' dalam tabel transaksi
        $info = $row['stc']; // Misalnya, sesuaikan ini dengan nilai yang sesuai dari kolom 'info'

        // Check the value of $info and fill the corresponding cell accordingly
        if ($info == 1) {
            $pdf->Image('ceklis.png', 20, 190, 5, 5); // Koordinat (110, 37) dengan ukuran 5x5
        } elseif ($info == 2) {
            $pdf->Image('ceklis.png', 20, 200, 5, 5); // Koordinat (110, 42) dengan ukuran 5x5
        }

    }
    $pdf->SetY(140);
    $pdf->Cell(120, 65, '', 1, 0);
    $pdf->SetX(10);
    $pdf->Cell(45, 5, '□   Pay compensation(金銭処理)', 0, 1);
    $pdf->SetX(20);
    $pdf->Cell(45, 5, 'Items(内訳)', 0, 1);
    $pdf->SetX(20);
    $pdf->Cell(100, 5, '', 1, 1);
    $pdf->SetX(20);
    $pdf->Cell(100, 25, '', 1, 1);
    $pdf->SetX(10);
    $pdf->Cell(100, 5, '□   Send the replacement(代品処理)', 0, 1);
    $pdf->SetX(20);
    $pdf->Cell(100, 5, '', 0, 1);
    $pdf->SetX(20);
    $pdf->Cell(100, 5, '□   AIR (航空便)', 0, 1);
    $pdf->SetX(20);
    $pdf->Cell(100, 5, '', 0, 1);
    $pdf->SetX(20);
    $pdf->Cell(100, 5, '□   SEA (船便)', 0, 1);


    $pdf->SetFont('times', '', 9);
    $pdf->SetXY(130, 140);
    $pdf->Cell(155, 65, '', 1, 1);
    $pdf->SetXY(135, 140);
    $pdf->Cell(140, 5, 'Part Name                   : ' . $row['part_name'], 0, 1);
    $pdf->SetXY(135, 145);
    $pdf->Cell(140, 5, 'Part No.                       :    ' . $row['part_num'], 0, 1);
    $pdf->SetXY(135, 150);
    $pdf->Cell(140, 5, 'Product                        : ' . $row['product'], 0, 1);
    $pdf->SetXY(135, 155);
    $pdf->Cell(140, 5, 'Arrival Date                : ' . date("M d' Y", strtotime($row['ar_dt'])), 0, 1);
    $pdf->SetXY(135, 160);
    $pdf->Cell(140, 5, 'Packing List No          : ' . $row['invoice'], 0, 1);
    $pdf->SetXY(135, 165);
    $pdf->Cell(140, 5, 'Handling Date             : ' . date("M d' Y", strtotime($row['hand_dt'])), 0, 1);
    $pdf->SetXY(135, 170);
    $pdf->Cell(140, 5, 'Quantity Delivered      :       ' . $row['qty_del'] . '     PCS', 0, 1);
    $pdf->SetXY(135, 175);
    $pdf->Cell(140, 5, 'Quantity Problem        :       ' . $row['qty_def'] . '     PCS', 0, 1);
    $pdf->SetFont('cid0jp', '', 9);
    $pdf->SetXY(135, 180);
    if ($row['lco'] == 1) {
        $location_text = 'Receiving Inspect (受入検査)';
    } elseif ($row['lco'] == 2) {
        $location_text = 'In-process (工程内)';
    } elseif ($row['lco'] == 3) {
        $location_text = 'Customer (客先)';
    } else {
        $location_text = ''; // Kosongkan jika selain nilai 1, 2, atau 3
    }

    $pdf->Cell(140, 5, 'Location                   : ' . $location_text, 0, 1);
    $pdf->SetFont('times', '', 9);
    $pdf->SetXY(135, 185);
    $pdf->Cell(140, 5, 'Problem                       : ' . $row['problem'], 0, 1);
    $pdf->SetXY(140, 190);
    $pdf->Cell(135, 5, '                                 (DETAIL ATTCHED', 0, 1);

    $pdf->SetFont('cid0jp', '', 7);
    $pdf->SetXY(130, 198);
    $pdf->Cell(155, 3, 'Corrective & preventive action to be taken by KYB (KYBに要求する是正＆再発防止策)', 1, 1, 'C');

    $pdf->SetFont('times', '', 8);
    $pdf->SetY(205);
    $pdf->Cell(100, 5, 'N.\administrasi Qa receiving\CMR\[CMR 2022.xls]42', 0, 0);

    $pdf->SetX(185);
    $pdf->Cell(10, 5, 'Info to:', 0, 0);

    $pdf->SetX(215);
    $pdf->Cell(10, 5, 'PROC', 0, 0);

    $pdf->SetX(235);
    $pdf->Cell(10, 5, 'VD', 0, 0);

    $pdf->SetX(255);
    $pdf->Cell(10, 5, 'PPC', 0, 0);

    $pdf->SetX(275);
    $pdf->Cell(10, 5, 'T & A', 0, 0);
}



// Mengambil nomor CMR dan membersihkannya
$no_cmr_sanitized = preg_replace("/[^a-zA-Z0-9]+/", "", $row['cmr_no']);
$pdfPath = "C:/xamppp/htdocs/nqrcmr/CMR/" . $no_cmr_sanitized . ".pdf";
$pdf->Output($pdfPath, 'F');

// Cek apakah file PDF utama ada
if (!file_exists($pdfPath)) {
    die("Error: File not found - " . $pdfPath);
}

$unique_filename = "../file cmr/" . $row['att']; // Path to the second PDF file
use setasign\Fpdi\Tcpdf\Fpdi;
// Inisialisasi FPDI dengan TCPDF
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

// Tentukan path tujuan untuk PDF yang digabungkan
$mergedPdfPath = "C:/xamppp/htdocs/nqrcmr/CMR/" . $no_cmr_sanitized . ".pdf";

// Simpan file PDF yang digabungkan ke lokasi yang diinginkan
$pdfi->Output($mergedPdfPath, 'I');

// Outputkan path PDF yang digabungkan untuk ditampilkan
echo $mergedPdfPath;


// $pdf->Output();

?>