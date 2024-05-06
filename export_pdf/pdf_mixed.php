<?php

function Convert($amount_number)
{
    $amount_number = number_format($amount_number, 2, ".", "");
    $pt = strpos($amount_number, ".");
    $number = $fraction = "";
    if ($pt === false)
        $number = $amount_number;
    else {
        $number = substr($amount_number, 0, $pt);
        $fraction = substr($amount_number, $pt + 1);
    }

    $ret = "";
    $baht = ReadNumber($number);
    if ($baht != "")
        $ret .= $baht . "บาท";

    $satang = ReadNumber($fraction);
    if ($satang != "")
        $ret .=  $satang . "สตางค์";
    else
        $ret .= "ถ้วน";
    return $ret;
}

function ReadNumber($number)
{
    $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
    $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    $number = $number + 0;
    $ret = "";
    if ($number == 0) return $ret;
    if ($number > 1000000) {
        $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
        $number = intval(fmod($number, 1000000));
    }

    $divider = 100000;
    $pos = 0;
    while ($number > 0) {
        $d = intval($number / $divider);
        $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : ((($divider == 10) && ($d == 1)) ? "" : ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
        $ret .= ($d ? $position_call[$pos] : "");
        $number = $number % $divider;
        $divider = $divider / 10;
        $pos++;
    }
    return $ret;
}

require('fpdf/fpdf.php');


$number = $_POST['number'];
$thai_date = $_POST['thai_date'];
$payment = $_POST['payment'];
$refer = $_POST['refer'];
$thai_date_product = $_POST['thai_date_product'];
$inputField = $_POST['inputField'];
$selectedDataDetail = $_POST['selectedDataDetail'];
$selectedDataPrice = $_POST['selectedDataPrice'];
$selectedDataType = $_POST['selectedDataType'];
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
    $pdf->SetXY(42, 82.4 + $i);
    if (isset($selectedDataDetail[$x])) { // ตรวจสอบว่า index นั้นมีการกำหนดหรือไม่
        $trimmedText = trim(iconv('utf-8', 'cp874', $selectedDataDetail[$x]));
        $textWidth = mb_strwidth($trimmedText);
        if ($textWidth > 88) {
            // ข้อความยาวเกินกรอบ
            // ตัดแต่งข้อความให้สั้นลง
            $shortenedText = mb_substr($trimmedText, 0, 88);
        } else {
            // ข้อความอยู่ในกรอบ
            // ใช้ข้อความเต็มรูปแบบ
            $shortenedText = $trimmedText;
        }
        $pdf->Cell(88, 8, $shortenedText, 0);
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

// $x = 0; // เริ่มต้นที่ index 0
// for ($i = 0; $i < 78.75; $i += 5.25) {
//     $pdf->SetXY(170, 82.4 + $i); // กำหนดตำแหน่ง x เป็น 10 เช่นเดิม
//     if (isset($selectedDataPrice[$x])) { // ตรวจสอบว่า index นั้นมีการกำหนดหรือไม่
//         $a = number_format($selectedDataPrice[$x], 2); // จัดรูปแบบเพื่อแสดงทศนิยม 2 ตำแหน่ง
//         $pdf->Cell(0, 8, iconv('utf-8', 'cp874', $a), 0, 'R');
//     } else {
//         $pdf->Cell(0, 8, '', 0, 1, 'C'); // ในกรณีไม่มีการกำหนดค่าให้แสดงช่องว่าง
//     }
//     $x++;
// }

$x = 0; // เริ่มต้นที่ index 0
for ($i = 0; $i < 78.75; $i += 5.25) {
    $pdf->SetXY(120, 82.4 + $i);
    if (isset($selectedDataType[$x])) { // ตรวจสอบว่า index นั้นมีการกำหนดหรือไม่
        $pdf->Cell(0, 8, iconv('utf-8', 'cp874', $selectedDataType[$x]), 0, 1, 'C');
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

$pdf->SetXY(89.5, 68.5);
$pdf->Cell(0, 8, iconv('utf-8', 'cp874', Convert(120)), 0, 1, 'L');

$pdf->Output('I', 'created_pdf.pdf');
