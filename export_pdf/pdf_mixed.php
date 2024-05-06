<?php
require('fpdf/fpdf.php');


$number = $_POST['number'];
$thai_date = $_POST['thai_date'];
$payment = $_POST['payment'];
$refer = $_POST['refer'];
$thai_date_product = $_POST['thai_date_product'];
$inputField = $_POST['inputField'];
$selectedDataDetail = $_POST['selectedDataDetail'];
$unit = $_POST['unit'];


$pdf = new FPDF();

$pdf->AddPage();
$pdf->AddFont('THSarabun', '', 'THSarabun.php');
$pdf->AddFont('THSarabun', 'B', 'THSarabun Bold.php');
$pdf->Image('img/D_CMI0057-2.png', 1, 1, 210, 297);

// $pdf->SetFont('THSarabun', 'B', 8.8); ตัวหนา
$pdf->SetFont('THSarabun', '', 12);


$pdf->SetXY(172, 12);
$pdf->Cell(0, 8, iconv('utf-8', 'cp874', $number), 0, 1, 'C');

$pdf->SetXY(172, 18);
$pdf->Cell(0, 8, iconv('utf-8', 'cp874', $thai_date), 0, 1, 'C');

$pdf->SetXY(-215, 63);
$pdf->Cell(0, 8, iconv('utf-8', 'cp874', $payment), 0, 1, 'C');

$pdf->SetXY(-215, 63);
$pdf->Cell(0, 8, iconv('utf-8', 'cp874', $thai_date_product), 0, 1, 'C');

$pdf->SetFont('THSarabun', 'B', 12);
$pdf->SetXY(89.5, 68.5);
$pdf->Cell(0, 8, iconv('utf-8', 'cp874', $refer), 0, 1, 'L');

$pdf->SetFont('THSarabun', '', 9.4);

$x = 0; // เริ่มต้นที่ index 0
for ($i = 0; $i < 78.75; $i += 5.25) {
    $pdf->SetXY(10, 82.4 + $i);
    if (isset($selectedDataDetail[$x])) { // ตรวจสอบว่า index นั้นมีการกำหนดหรือไม่
        $pdf->Cell(0, 8, iconv('utf-8', 'cp874', $selectedDataDetail[$x]), 0,);
    } else {
        $pdf->Cell(0, 8, '', 0, 1, 'C'); // ในกรณีไม่มีการกำหนดค่าให้แสดงช่องว่าง
    }
    $x++;
}

$x = 0; // เริ่มต้นที่ index 0
for ($i = 0; $i < 78.75; $i += 5.25) {
    $pdf->SetXY(160.4, 82.4 + $i); // กำหนดตำแหน่ง x เป็น 10 เช่นเดิม
    if (isset($unit[$x])) { // ตรวจสอบว่า index นั้นมีการกำหนดหรือไม่
        $formatted_unit = number_format($unit[$x], 2); // จัดรูปแบบเพื่อแสดงทศนิยม 2 ตำแหน่ง
        $pdf->Cell(0, 8, iconv('utf-8', 'cp874', $formatted_unit), 0, 'R');
    } else {
        $pdf->Cell(0, 8, '', 0, 1, 'C'); // ในกรณีไม่มีการกำหนดค่าให้แสดงช่องว่าง
    }
    $x++;
}

//AU
$x = 0; // เริ่มต้นที่ index 0
for ($i = 0; $i < 78.75; $i += 5.25) {
    $pdf->SetXY(-349, 82.4 + $i);
    if (isset($inputField[$x])) { // ตรวจสอบว่า index นั้นมีการกำหนดหรือไม่
        $pdf->Cell(0, 8, iconv('utf-8', 'cp874', $inputField[$x]), 0, 1, 'C');
    } else {
        $pdf->Cell(0, 8, '', 0, 1, 'C'); // ในกรณีไม่มีการกำหนดค่าให้แสดงช่องว่าง
    }
    $x++;
}


// //name Au
// for ($i = 0; $i < 78.75; $i += 5.25) {
//     $pdf->SetXY(22, 82.4 + $i); //+5.25
//     $pdf->Cell(0, 8, iconv('utf-8', 'cp874', 'TPCHDMX067C'), 0, 1);
// }



$pdf->Output('I', 'created_pdf.pdf');
