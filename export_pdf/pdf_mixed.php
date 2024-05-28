<?php
function Convert($amount_number, $decimal_count)
{
    $amount_number = number_format($amount_number, $decimal_count, ".", "");
    $pt = strpos($amount_number, ".");
    $number = $fraction = "";
    if ($pt === false) {
        $number = $amount_number;
    } else {
        $number = substr($amount_number, 0, $pt);
        $fraction = substr($amount_number, $pt + 1);
    }

    $ret = "";
    $baht = ReadNumber($number);
    if ($baht != "") {
        $ret .= $baht . "บาท";
    }

    $satang = ReadNumber($fraction);
    if ($satang != "") {
        $ret .=  $satang . "สตางค์";
    } else {
        $ret .= "ถ้วน";
    }
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

include('../connect.php');

if (isset($_POST['billId'])) {
    $billId = $_POST['billId'];
    $strsql = "SELECT * FROM bill WHERE bill_id = ?";
    try {
        $stmt = $con->prepare($strsql);
        $stmt->execute([$billId]);
        $bill = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($bill) {
            require('fpdf/fpdf.php');
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->AddFont('THSarabun', '', 'THSarabun.php');
            $pdf->AddFont('THSarabun', 'B', 'THSarabun Bold.php');

            $documentType = isset($_POST['documentType']) ? $_POST['documentType'] : '';

            $list = 0;
            if ($bill['list_num'] <= 15) {
                $list = 78.75;
                if ($documentType == "quotation") {
                    $imagePath = 'img/quotation_15.png';
                } elseif ($documentType == "invoice") {
                    $imagePath = 'img/invoice_15.png';
                } elseif ($documentType == "receipt") {
                    $imagePath = 'img/receipt_15.png';
                }
            } elseif ($bill['list_num'] > 15) {
                $list = 105;
                if ($documentType == "quotation") {
                    $imagePath = 'img/quotation_20.png';
                } elseif ($documentType == "invoice") {
                    $imagePath = 'img/invoice_20.png';
                } elseif ($documentType == "receipt") {
                    $imagePath = 'img/receipt_20.png';
                }
            }

            $pdf->Image($imagePath, 1, 1, 210, 297);

            $pdf->SetFont('THSarabun', '', 12);
            $pdf->SetXY(172, 12);
            $pdf->Cell(0, 8, iconv('utf-8', 'cp874', $bill['bill_id']), 0, 1, 'C');

            $bill_date = date("d F Y", strtotime($bill['bill_date']));
            $bill_date = strtr($bill_date, array(
                'January' => 'มกราคม', 'February' => 'กุมภาพันธ์', 'March' => 'มีนาคม',
                'April' => 'เมษายน', 'May' => 'พฤษภาคม', 'June' => 'มิถุนายน',
                'July' => 'กรกฎาคม', 'August' => 'สิงหาคม', 'September' => 'กันยายน',
                'October' => 'ตุลาคม', 'November' => 'พฤศจิกายน', 'December' => 'ธันวาคม'
            ));
            $pdf->SetXY(172, 18);
            $pdf->Cell(0, 8, iconv('utf-8', 'cp874', $bill_date), 0, 1, 'C');

            $pdf->SetXY(166.5, 63);
            $pdf->Cell(38.5, 8, iconv('utf-8', 'cp874', $bill['bill_refer']), 0, 1, 'C');

            $pdf->SetXY(63, 63);
            $pdf->Cell(69, 8, iconv('utf-8', 'cp874', $bill['bill_payment']), 0, 1, 'C');

            $thai_date_product = date("d F Y", strtotime($bill['bill_date_product']));
            $thai_date_product = strtr($thai_date_product, array(
                'January' => 'มกราคม', 'February' => 'กุมภาพันธ์', 'March' => 'มีนาคม',
                'April' => 'เมษายน', 'May' => 'พฤษภาคม', 'June' => 'มิถุนายน',
                'July' => 'กรกฎาคม', 'August' => 'สิงหาคม', 'September' => 'กันยายน',
                'October' => 'ตุลาคม', 'November' => 'พฤศจิกายน', 'December' => 'ธันวาคม'
            ));
            $pdf->SetXY(6.5, 63);
            $pdf->Cell(56.5, 8, iconv('utf-8', 'cp874', $thai_date_product), 0, 1, 'C');

            $thai_due_date = date("d F Y", strtotime($bill['bill_due_date']));
            $thai_due_date = strtr($thai_due_date, array(
                'January' => 'มกราคม', 'February' => 'กุมภาพันธ์', 'March' => 'มีนาคม',
                'April' => 'เมษายน', 'May' => 'พฤษภาคม', 'June' => 'มิถุนายน',
                'July' => 'กรกฎาคม', 'August' => 'สิงหาคม', 'September' => 'กันยายน',
                'October' => 'ตุลาคม', 'November' => 'พฤศจิกายน', 'December' => 'ธันวาคม'
            ));
            $pdf->SetXY(132, 63);
            $pdf->Cell(34.5, 8, iconv('utf-8', 'cp874', $thai_due_date), 0, 1, 'C');

            $pdf->SetFont('THSarabun', 'B', 12);
            $pdf->SetXY(21, 73.7);
            $pdf->Cell(59, 8, iconv('utf-8', 'cp874', $bill['bill_work_no']), 0, 1, 'L');

            $pdf->SetXY(92.5, 73.7);
            $pdf->Cell(112.5, 8, iconv('utf-8', 'cp874', $bill['bill_project']), 0, 1, 'L');

            $pdf->SetXY(15, 68.7);
            $pdf->Cell(48, 8, iconv('utf-8', 'cp874', $bill['bill_site']), 0, 1, 'L');

            $pdf->SetXY(75, 68.7);
            $pdf->Cell(48, 8, iconv('utf-8', 'cp874', $bill['bill_pr']), 0, 1, 'L');

            $pdf->Output('I', 'created_pdf.pdf');
        } else {
            echo "Bill not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
