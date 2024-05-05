<?php
require('fpdf/fpdf.php');


$number = $_POST['number'];
$thai_date = $_POST['thai_date'];
$payment = $_POST['payment'];
$refer = $_POST['refer'];


$pdf = new FPDF();

$pdf->AddPage();
$pdf->AddFont('THSarabun', '', 'THSarabun.php');
$pdf->AddFont('THSarabun', 'B', 'THSarabun Bold.php');
$pdf->Image('img/D_CMI0057-2.png', 1, 1, 210, 297);

// $pdf->SetFont('THSarabun', 'B', 8.8); ตัวหนา
$pdf->SetFont('THSarabun', '', 12);


$pdf->SetXY(172, 12);
$pdf->Cell(0, 8, iconv('utf-8', 'cp874', $number), 0, 1, 'C');

$pdf->SetXY(173.5, 18);
$pdf->Cell(0, 8, iconv('utf-8', 'cp874', $thai_date), 0, 1, 'C');

$pdf->SetXY(-215, 63);
$pdf->Cell(0, 8, iconv('utf-8', 'cp874', $payment), 0, 1, 'C');

$pdf->SetFont('THSarabun', 'B', 12);
$pdf->SetXY(89.5, 68.5);
$pdf->Cell(0, 8, iconv('utf-8', 'cp874', $refer), 0, 1, 'L');

$pdf->SetFont('THSarabun', '', 9.4);
//AU
for ($i = 0; $i < 78.75; $i += 5.25) {
    $pdf->SetXY(22, 82.4 + $i); //+5.25
    $pdf->Cell(0, 8, iconv('utf-8', 'cp874', 'TPCHDMX067C'), 0, 1,);
}
// //name Au
// for ($i = 0; $i < 78.75; $i += 5.25) {
//     $pdf->SetXY(22, 82.4 + $i); //+5.25
//     $pdf->Cell(0, 8, iconv('utf-8', 'cp874', 'TPCHDMX067C'), 0, 1);
// }



$pdf->Output('I', 'created_pdf.pdf');
