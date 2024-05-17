<?php

function Convert($amount_number, $decimal_count)
{
    $amount_number = number_format($amount_number, $decimal_count, ".", "");
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
$number = $_POST['number'];
$thai_date = $_POST['thai_date'];
$payment = $_POST['payment'];
$refer = $_POST['refer'];
$Site = $_POST['Site'];
$work_no = $_POST['work_no'];
$project = $_POST['project'];
$thai_date_product = $_POST['thai_date_product'];
$thai_due_date = $_POST['thai_due_date'];
$inputField = $_POST['inputField'];
$selectedDataDetail = $_POST['selectedDataDetail'];
$selectedDataPrice = $_POST['selectedDataPrice'];
$pr = $_POST['pr'];
$work_no = $_POST['work_no'];
$project = $_POST['project'];
$selectedDataType = $_POST['selectedDataType'];
$selectedDataPrice = $_POST['selectedDataPrice'];
$unit = $_POST['unit'];

require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->AddFont('THSarabun', '', 'THSarabun.php');
$pdf->AddFont('THSarabun', 'B', 'THSarabun Bold.php');

if ($_POST['auCount'] <= 15) {
    if ($_POST['flexRadioDefault'] == "sub1") {
        $pdf->Image('img/quotation_15.png', 1, 1, 210, 297);
    } elseif ($_POST['flexRadioDefault'] == "sub2") {
        $pdf->Image('img/invoice_15.png', 1, 1, 210, 297);
    } elseif ($_POST['flexRadioDefault'] == "sub3") {
        $pdf->Image('img/receipt_15.png', 1, 1, 210, 297);
    }

    // $pdf->SetFont('THSarabun', 'B', 8.8); ตัวหนา
    $pdf->SetFont('THSarabun', '', 12);
    $pdf->SetXY(172, 12);
    $pdf->Cell(0, 8, iconv('utf-8', 'cp874', $number), 0, 1, 'C');

    $pdf->SetXY(172, 18);
    $pdf->Cell(0, 8, iconv('utf-8', 'cp874', $thai_date), 0, 1, 'C');

    $pdf->SetXY(166.5, 63);
    $pdf->Cell(38.5, 8, iconv('utf-8', 'cp874', $refer), 0, 1, 'C');

    $pdf->SetXY(63, 63);
    $pdf->Cell(69, 8, iconv('utf-8', 'cp874', $payment), 0, 1, 'C');

    $thai_date_product = strftime("%d %B %Y", strtotime($thai_date_product));
    $thai_date_product_array = explode(" ", $thai_date_product);
    $thai_date_product = implode(" ", $thai_date_product_array);
    $thai_date_product = strftime("%d %B %Y", strtotime($thai_date_product));
    $thai_month2 = [
        'January' => 'มกราคม',
        'February' => 'กุมภาพันธ์',
        'March' => 'มีนาคม',
        'April' => 'เมษายน',
        'May' => 'พฤษภาคม',
        'June' => 'มิถุนายน',
        'July' => 'กรกฎาคม',
        'August' => 'สิงหาคม',
        'September' => 'กันยายน',
        'October' => 'ตุลาคม',
        'November' => 'พฤศจิกายน',
        'December' => 'ธันวาคม'
    ];

    $thai_date_product = strtr($thai_date_product, $thai_month2);
    $pdf->SetXY(6.5, 63);
    $pdf->Cell(56.5, 8, iconv('utf-8', 'cp874', $thai_date_product), 0, 1, 'C');

    $thai_due_date = strftime("%d %B %Y", strtotime($thai_due_date));
    $thai_due_date_array = explode(" ", $thai_due_date);
    $thai_due_date = implode(" ", $thai_due_date_array);
    $thai_due_date = strftime("%d %B %Y", strtotime($thai_due_date));
    $thai_month = [
        'January' => 'มกราคม',
        'February' => 'กุมภาพันธ์',
        'March' => 'มีนาคม',
        'April' => 'เมษายน',
        'May' => 'พฤษภาคม',
        'June' => 'มิถุนายน',
        'July' => 'กรกฎาคม',
        'August' => 'สิงหาคม',
        'September' => 'กันยายน',
        'October' => 'ตุลาคม',
        'November' => 'พฤศจิกายน',
        'December' => 'ธันวาคม'
    ];
    $thai_due_date = strtr($thai_due_date, $thai_month);
    $pdf->SetXY(132, 63);
    $pdf->Cell(34.5, 8, iconv('utf-8', 'cp874', $thai_due_date), 0, 1, 'C');

    $pdf->SetFont('THSarabun', 'B', 12);
    $pdf->SetXY(21, 73.7);
    $pdf->Cell(59, 8, iconv('utf-8', 'cp874', $work_no), 0, 1, 'L');

    $pdf->SetXY(92.5, 73.7);
    $pdf->Cell(112.5, 8, iconv('utf-8', 'cp874', $project), 0, 1, 'L');

    $pdf->SetXY(15, 68.7);
    $pdf->Cell(48, 8, iconv('utf-8', 'cp874', $Site), 0, 1, 'L');

    $pdf->SetXY(75, 68.7);
    $pdf->Cell(48, 8, iconv('utf-8', 'cp874', $pr), 0, 1, 'L');

    $pdf->SetFont('THSarabun', '', 9.4);

    $x = 0; // เริ่มต้นที่ index 0
    for ($i = 0; $i < 78.75; $i += 5.25) {
        $pdf->SetXY(42, 87.4 + $i);
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
            $pdf->Cell(88, 8, $shortenedText, 0, 1);
        } else {
            $pdf->Cell(88, 8, '', 0, 1, 'C'); // ในกรณีไม่มีการกำหนดค่าให้แสดงช่องว่าง
        }
        $x++;
    }

    $pdf->SetFont('THSarabun', '', 12);
    $num = 1;
    $sum = 0;
    $x = 0; // เริ่มต้นที่ index 0
    for ($i = 0; $i < 78.75; $i += 5.25) {
        if (isset($selectedDataPrice[$x])) { // ตรวจสอบว่า index นั้นมีการกำหนดหรือไม่
            $formatted_unit1 = number_format($selectedDataPrice[$x], 2); // จัดรูปแบบเพื่อแสดงทศนิยม 2 ตำแหน่ง
            $formatted_unit2 = number_format($unit[$x], 2); // จัดรูปแบบเพื่อแสดงทศนิยม 2 ตำแหน่ง
            $pdf->SetXY(18.5, 87.4 + $i);
            $pdf->Cell(23.5, 8, iconv('utf-8', 'cp874', $inputField[$x]), 0, 1, 'C');
            $pdf->SetXY(8.6, 87.4 + $i); // กำหนดตำแหน่ง x เป็น 10 เช่นเดิม
            $pdf->Cell(8, 8, iconv('utf-8', 'cp874', $num++), 0, 1, 'C');
            $pdf->SetXY(171.3, 87.4 + $i); // กำหนดตำแหน่ง x เป็น 10 เช่นเดิม
            $pdf->Cell(13, 8, iconv('utf-8', 'cp874', $formatted_unit1), 0, 1, 'R');
            $pdf->SetXY(154, 87.4 + $i); // กำหนดตำแหน่ง x เป็น 10 เช่นเดิม
            $pdf->Cell(13, 8, iconv('utf-8', 'cp874', $formatted_unit2), 0, 1, 'R');
            $pdf->SetXY(192.5, 87.4 + $i); // กำหนดตำแหน่ง x เป็น 10 เช่นเดิม
            $pdf->Cell(13, 8, iconv('utf-8', 'cp874', number_format($formatted_unit2 * $formatted_unit1, 2)), 0, 1, 'R');
            $pdf->SetXY(132, 87.4 + $i);
            $pdf->Cell(17, 8, iconv('utf-8', 'cp874', $selectedDataType[$x]), 0, 1, 'C');
            $sum += $formatted_unit2 * $formatted_unit1; // เพิ่มค่าของ $formatted_unit2 * $formatted_unit1 ใน $sum
        } else {
            $pdf->Cell(0, 8, '', 0, 1, 'C'); // ในกรณีไม่มีการกำหนดค่าให้แสดงช่องว่าง
        }
        $x++;
    }

    $pdf->SetFont('THSarabun', 'B', 12);
    $pdf->SetXY(192.5, 167.4);
    $pdf->Cell(13, 8, iconv('utf-8', 'cp874', number_format($sum, 2)), 0, 1, 'R');
    $pdf->SetXY(192.5, 179.5);
    $pdf->Cell(13, 8, iconv('utf-8', 'cp874', number_format($sum, 2)), 0, 1, 'R');
    $pdf->SetXY(192.5, 186);
    $pdf->Cell(13, 8, iconv('utf-8', 'cp874', number_format($sum, 2)), 0, 1, 'R');
    $pdf->SetXY(192.5, 192.5);
    $pdf->Cell(13, 8, iconv('utf-8', 'cp874', number_format($sum * 7 / 100, 2)), 0, 1, 'R');
    $pdf->SetXY(192.5, 210.5);
    $pdf->Cell(13, 8, iconv('utf-8', 'cp874', number_format($sum - ($sum * 7 / 100), 2)), 0, 1, 'R');

    $pdf->SetFont('THSarabun', '', 12);
    $pdf->SetXY(6.5, 213);
    $pdf->Cell(142.5, 8, iconv('utf-8', 'cp874', Convert($sum - ($sum * 7 / 100), 2)), 0, 1, 'C');
    /************************************************************************************************************************************************************************************ */
} elseif ($_POST['auCount'] > 15) {
    if ($_POST['flexRadioDefault'] == "sub1") {
        $pdf->Image('img/quotation_20.png', 1, 1, 210, 297);
    } elseif ($_POST['flexRadioDefault'] == "sub2") {
        $pdf->Image('img/invoice_20.png', 1, 1, 210, 297);
    } elseif ($_POST['flexRadioDefault'] == "sub3") {
        $pdf->Image('img/receipt_20.png', 1, 1, 210, 297);
    }

    // $pdf->SetFont('THSarabun', 'B', 8.8); ตัวหนา
    $pdf->SetFont('THSarabun', '', 12);
    $pdf->SetXY(172, 12);
    $pdf->Cell(0, 8, iconv('utf-8', 'cp874', $number), 0, 1, 'C');

    $pdf->SetXY(172, 18);
    $pdf->Cell(0, 8, iconv('utf-8', 'cp874', $thai_date), 0, 1, 'C');

    $pdf->SetXY(166.5, 63);
    $pdf->Cell(38.5, 8, iconv('utf-8', 'cp874', $refer), 0, 1, 'C');

    $pdf->SetXY(63, 63);
    $pdf->Cell(69, 8, iconv('utf-8', 'cp874', $payment), 0, 1, 'C');

    $thai_date_product = strftime("%d %B %Y", strtotime($thai_date_product));
    $thai_date_product_array = explode(" ", $thai_date_product);
    $thai_date_product = implode(" ", $thai_date_product_array);
    $thai_date_product = strftime("%d %B %Y", strtotime($thai_date_product));
    $thai_month2 = [
        'January' => 'มกราคม',
        'February' => 'กุมภาพันธ์',
        'March' => 'มีนาคม',
        'April' => 'เมษายน',
        'May' => 'พฤษภาคม',
        'June' => 'มิถุนายน',
        'July' => 'กรกฎาคม',
        'August' => 'สิงหาคม',
        'September' => 'กันยายน',
        'October' => 'ตุลาคม',
        'November' => 'พฤศจิกายน',
        'December' => 'ธันวาคม'
    ];

    $thai_date_product = strtr($thai_date_product, $thai_month2);
    $pdf->SetXY(6.5, 63);
    $pdf->Cell(56.5, 8, iconv('utf-8', 'cp874', $thai_date_product), 0, 1, 'C');

    $thai_due_date = strftime("%d %B %Y", strtotime($thai_due_date));
    $thai_due_date_array = explode(" ", $thai_due_date);
    $thai_due_date = implode(" ", $thai_due_date_array);
    $thai_due_date = strftime("%d %B %Y", strtotime($thai_due_date));
    $thai_month = [
        'January' => 'มกราคม',
        'February' => 'กุมภาพันธ์',
        'March' => 'มีนาคม',
        'April' => 'เมษายน',
        'May' => 'พฤษภาคม',
        'June' => 'มิถุนายน',
        'July' => 'กรกฎาคม',
        'August' => 'สิงหาคม',
        'September' => 'กันยายน',
        'October' => 'ตุลาคม',
        'November' => 'พฤศจิกายน',
        'December' => 'ธันวาคม'
    ];
    $thai_due_date = strtr($thai_due_date, $thai_month);
    $pdf->SetXY(132, 63);
    $pdf->Cell(34.5, 8, iconv('utf-8', 'cp874', $thai_due_date), 0, 1, 'C');

    $pdf->SetFont('THSarabun', 'B', 12);
    $pdf->SetXY(21, 73.7);
    $pdf->Cell(59, 8, iconv('utf-8', 'cp874', $work_no), 0, 1, 'L');

    $pdf->SetXY(92.5, 73.7);
    $pdf->Cell(112.5, 8, iconv('utf-8', 'cp874', $project), 0, 1, 'L');

    $pdf->SetXY(15, 68.7);
    $pdf->Cell(48, 8, iconv('utf-8', 'cp874', $Site), 0, 1, 'L');

    $pdf->SetXY(75, 68.7);
    $pdf->Cell(48, 8, iconv('utf-8', 'cp874', $pr), 0, 1, 'L');

    $pdf->SetFont('THSarabun', '', 9.4);

    $x = 0; // เริ่มต้นที่ index 0
    for ($i = 0; $i < 105; $i += 5.25) {
        $pdf->SetXY(42, 87.4 + $i);
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
            $pdf->Cell(88, 8, $shortenedText, 0, 1);
        } else {
            $pdf->Cell(88, 8, '', 0, 1, 'C'); // ในกรณีไม่มีการกำหนดค่าให้แสดงช่องว่าง
        }
        $x++;
    }

    $pdf->SetFont('THSarabun', '', 12);
    $num = 1;
    $sum = 0;
    $x = 0; // เริ่มต้นที่ index 0
    for ($i = 0; $i < 105; $i += 5.25) {
        if (isset($selectedDataPrice[$x])) { // ตรวจสอบว่า index นั้นมีการกำหนดหรือไม่
            $formatted_unit1 = number_format($selectedDataPrice[$x], 2); // จัดรูปแบบเพื่อแสดงทศนิยม 2 ตำแหน่ง
            $formatted_unit2 = number_format($unit[$x], 2); // จัดรูปแบบเพื่อแสดงทศนิยม 2 ตำแหน่ง
            $pdf->SetXY(18.5, 87.4 + $i);
            $pdf->Cell(23.5, 8, iconv('utf-8', 'cp874', $inputField[$x]), 0, 1, 'C');
            $pdf->SetXY(8.6, 87.4 + $i); // กำหนดตำแหน่ง x เป็น 10 เช่นเดิม
            $pdf->Cell(8, 8, iconv('utf-8', 'cp874', $num++), 0, 1, 'C');
            $pdf->SetXY(171.3, 87.4 + $i); // กำหนดตำแหน่ง x เป็น 10 เช่นเดิม
            $pdf->Cell(13, 8, iconv('utf-8', 'cp874', $formatted_unit1), 0, 1, 'R');
            $pdf->SetXY(154, 87.4 + $i); // กำหนดตำแหน่ง x เป็น 10 เช่นเดิม
            $pdf->Cell(13, 8, iconv('utf-8', 'cp874', $formatted_unit2), 0, 1, 'R');
            $pdf->SetXY(192.5, 87.4 + $i); // กำหนดตำแหน่ง x เป็น 10 เช่นเดิม
            $pdf->Cell(13, 8, iconv('utf-8', 'cp874', number_format($formatted_unit2 * $formatted_unit1, 2)), 0, 1, 'R');
            $pdf->SetXY(132, 87.4 + $i);
            $pdf->Cell(17, 8, iconv('utf-8', 'cp874', $selectedDataType[$x]), 0, 1, 'C');
            $sum += $formatted_unit2 * $formatted_unit1; // เพิ่มค่าของ $formatted_unit2 * $formatted_unit1 ใน $sum
        } else {
            $pdf->Cell(0, 8, '', 0, 1, 'C'); // ในกรณีไม่มีการกำหนดค่าให้แสดงช่องว่าง
        }
        $x++;
    }

    $pdf->SetFont('THSarabun', 'B', 12);
    $pdf->SetXY(192.5, 194);
    $pdf->Cell(13, 8, iconv('utf-8', 'cp874', number_format($sum, 2)), 0, 1, 'R');
    $pdf->SetXY(192.5, 205.8);
    $pdf->Cell(13, 8, iconv('utf-8', 'cp874', number_format($sum, 2)), 0, 1, 'R');
    $pdf->SetXY(192.5, 212.5);
    $pdf->Cell(13, 8, iconv('utf-8', 'cp874', number_format($sum, 2)), 0, 1, 'R');
    $pdf->SetXY(192.5, 219);
    $pdf->Cell(13, 8, iconv('utf-8', 'cp874', number_format($sum * 7 / 100, 2)), 0, 1, 'R');
    $pdf->SetXY(192.5, 237);
    $pdf->Cell(13, 8, iconv('utf-8', 'cp874', number_format($sum - ($sum * 7 / 100), 2)), 0, 1, 'R');

    $pdf->SetFont('THSarabun', '', 12);
    $pdf->SetXY(6.5, 238.2);
    $pdf->Cell(142.5, 8, iconv('utf-8', 'cp874', Convert($sum - ($sum * 7 / 100), 2)), 0, 1, 'C');
}
$pdf->Output('I', 'created_pdf.pdf');
