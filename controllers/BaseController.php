<?php
define('ROOT_DIR', __DIR__);
require_once __DIR__ . '/../config/Database.php';

abstract class BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    protected function render($view, $data = [], $layout = true)
    {
        extract($data);
        $content = "views/{$view}.php";
        if ($layout) {
            include 'layouts/layout.php';
        } else {
            include $content;
        }
    }

    protected function jsonResponse($success, $message, $data = null, $statusCode = 200)
    {
        $response = [
            'success' => $success,
            'message' => $message,
            'status' => $statusCode,
            'timestamp' => time(),
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        header('Content-Type: application/json; charset=utf-8');
        http_response_code($statusCode);

        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit();
    }

    protected function successResponse($message = "OK", $data = null, $statusCode = 200)
    {
        $this->jsonResponse(true, $message, $data, $statusCode);
    }

    protected function errorResponse($message = "Error", $data = null, $statusCode = 400)
    {
        $this->jsonResponse(false, $message, $data, $statusCode);
    }

    protected function notFoundResponse($message = 'Resource not found')
    {
        $this->errorResponse($message, null, 404);
    }

    protected function validationErrorResponse($errors, $message = 'Validation failed')
    {
        $this->errorResponse($message, ['errors' => $errors], 422);
    }

    protected function getFileIcon($fileType)
    {
        $fileType = strtolower($fileType);
        $iconMap = [
            'image' => ['png', 'jpg', 'jpeg', 'gif', 'psd', 'tif'],
            'word' => ['doc', 'docx'],
            'pdf' => ['pdf', 'ps', 'eps', 'prn'],
            'excel' => ['xlsx', 'xls', 'xlsm', 'xlsb', 'xltm', 'xlt', 'xla', 'xlr'],
            'archive' => ['zip', 'rar', 'tar'],
            'globe' => ['kmz'],
            'cube' => ['dwg'],
            'scissors' => ['psd']
        ];

        foreach ($iconMap as $icon => $extensions) {
            if (in_array($fileType, $extensions)) {
                return "fa-file-{$icon}";
            }
        }

        return 'fa-file';
    }

    protected function formatDate($date)
    {
        $timestamp = strtotime($date);
        $year_buddhist = date('Y', $timestamp) + 543;
        return date('d/m/', $timestamp) . $year_buddhist . date(' h:i A', $timestamp);
    }

    protected function logAction($status, $detail)
    {
        $stmt = $this->db->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
        $stmt->execute([
            ':log_status' => $status,
            ':log_detail' => $detail,
            ':user_id' => $_SESSION['user_id']
        ]);
    }

    protected function formatThaiDate($date)
    {
        $timestamp = strtotime($date);
        $thai_month = array(
            1 => "มกราคม",
            2 => "กุมภาพันธ์",
            3 => "มีนาคม",
            4 => "เมษายน",
            5 => "พฤษภาคม",
            6 => "มิถุนายน",
            7 => "กรกฎาคม",
            8 => "สิงหาคม",
            9 => "กันยายน",
            10 => "ตุลาคม",
            11 => "พฤศจิกายน",
            12 => "ธันวาคม"
        );
        $thai_month_num = date('n', $timestamp);
        return date('d', $timestamp) . ' ' . $thai_month[$thai_month_num] . ' ' . (date('Y', $timestamp));
    }
    protected function Convert($amount_number, $decimal_count)
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
        $baht = $this->ReadNumber($number);
        if ($baht != "") {
            $ret .= $baht . "บาท";
        }

        $satang = $this->ReadNumber($fraction);
        if ($satang != "") {
            $ret .=  $satang . "สตางค์";
        } else {
            $ret .= "ถ้วน";
        }
        return $ret;
    }

    protected function ReadNumber($number)
    {
        $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
        $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
        $number = $number + 0;
        $ret = "";
        if ($number == 0) return $ret;
        if ($number > 1000000) {
            $ret .= $this->ReadNumber(intval($number / 1000000)) . "ล้าน";
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

    protected function trimText($text, $maxLength)
    {
        if (mb_strlen($text) <= $maxLength) {
            return $text;
        }

        $text = mb_substr($text, 0, $maxLength);
        $lastSpace = mb_strrpos($text, ' ');

        if ($lastSpace !== false) {
            $text = mb_substr($text, 0, $lastSpace);
        }

        return $text;
    }

    protected function convertToThaiDate($date)
    {
        $thai_months = array(
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
        );

        $english_date = date("d F Y", strtotime($date));
        return strtr($english_date, $thai_months);
    }

    protected function exPDF()
    {
        if (isset($_POST['billId']) || isset($_POST['company'])) {
            $billId = $_POST['billId'];
            $company = $_POST['company'];
            $docType = $_POST['documentType'];

            $queries = [
                'address_psnk' => "SELECT * FROM company_address WHERE company_address_type = 0",
                'address_mixed' => "SELECT * FROM company_address WHERE company_address_type = 1",
                'address_fbh' => "SELECT * FROM company_address WHERE company_address_type = 2",
                'address_bank' => "SELECT * FROM bill_bank WHERE bank_id = 1",
            ];
            $strsql = "SELECT * FROM bill WHERE bill_id = ?";
            try {
                $results = [];
                foreach ($queries as $key => $query) {
                    $stmt = $this->db->prepare($query);
                    $stmt->execute();
                    $results[$key] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }

                $stmt = $this->db->prepare($strsql);
                $stmt->execute([$billId]);
                $bill = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($bill) {

                    require_once __DIR__ . '/../libs/mpdf/vendor/autoload.php';

                    $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
                    $fontDirs = $defaultConfig['fontDir'];
                    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
                    $fontData = $defaultFontConfig['fontdata'];
                    $mpdf = new \Mpdf\Mpdf([
                        'fontDir' => array_merge($fontDirs, [
                            __DIR__ . '/../libs/mpdf/font',
                        ]),
                        'fontdata' => $fontData + [
                            'th_sarabun' => [
                                'R' => 'THSarabun.ttf',
                                'B' => 'THSarabun-Bold.ttf',
                                'I' => 'THSarabun-Italic.ttf',
                                'BI' => 'THSarabun-BoldItalic.ttf',
                            ]
                        ],
                        'default_font' => 'th_sarabun',
                        'format' => 'A4',
                        'margin_top' => 5,
                        'margin_bottom' => 5,
                        'margin_left' => 5,
                        'margin_right' => 5
                    ]);

                    $html = '
                        <style>
                            table {
                                width: 100%;
                                border-collapse: collapse;
                                margin-top: 5px;
                                margin-bottom: 5px;
                            }
        
                            th, td {
                                border: 1px solid black;
                                padding: 3px 5px;
                                text-align: center;
                            }
        
                            .header { text-align: center; }
        
                            .no-border { border: none; }
        
                            body { font-size: 12pt; }
        
                            table { width: 100%; border-collapse: collapse; margin-top: 5px; margin-bottom: 5px; }
         
                            th, td { border: 1px solid black; padding: 2px 3px; text-align: center; } /* ลด padding */
        
                            .header h2, .header p { margin: 0; padding: 1px 0; line-height: 1.1; } /* ลด padding และ line-height */
        
                            .right { text-align: right; }
        
                            .center { text-align: center; }
        
                            .left { text-align: left; }
        
                            .hide{
                                padding: 0;
                                margin: 0;
                            }
        
                        </style>
        
                        <table>
                            <tr>
                                <td colspan="3" style="border: none; vertical-align: top;" class="center">
                                    <div class="header">'
                        .  $results['address_psnk'][0]['company_address_detaill'] .
                        '</div>
                                </td>
                                <td colspan="4" style="border: none; vertical-align: top;" class="center">
                                    <div class="header">';
                    if ($docType == 'quotation') {
                        $html .= '<h2>ใบเสนอราคา / Quotation</h2>';
                    } elseif ($docType == 'invoice') {
                        $html .= '<h2>ใบแจ้งหนี้ / ใบวางบิล / INVOICE</h2>';
                    } elseif ($docType == 'receipt') {
                        $html .= '<h2>ใบเสร็จรับเงิน / ใบกำกับภาษี / RECEIPT</h2>';
                    }
                    $html .= '<table>
                                            <tr>
                                                <td style="border: none;" class="right">เลขที่ :</td>
                                                <td style="border: none;" class="center">' . $bill['bill_name'] . '</td>
                                            </tr>
                                            <tr>
                                                <td style="border: none;" class="right">วันที่ :</td>
                                                <td style="border: none;" class="center">' . $this->convertToThaiDate($bill['bill_date']) . '</td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>';
                    if ($company == 'Mixed') {
                        $html .= '
                                <tr>
                                <td colspan="3" style="vertical-align: top;" class="left">'
                            .  $results['address_mixed'][0]['company_address_detaill'] .
                            '</td>
                                <td colspan="4" style="vertical-align: top;" class="left">'
                            .  $results['address_mixed'][0]['company_address_name'] .
                            '</td>
                            </tr>';
                    } elseif ($company == 'FBH') {
                        $html .= '
                                <tr>
                                <td colspan="3" style="vertical-align: top;" class="left">'
                            .  $results['address_fbh'][0]['company_address_detaill'] .
                            '</td>
                                <td colspan="4" style="vertical-align: top;" class="left">'
                            .  $results['address_fbh'][0]['company_address_name'] .
                            '</td>
                            </tr>';
                    }
                    $html .= '
                            <tr>
                                <th colspan="2" class="center">Delivery Date (วันที่ส่งสินค้า)</th>
                                <th colspan="1" class="center">Payment Term (เงื่อนไขการชำระเงิน)</th>
                                <th colspan="2" class="center">Due Date (วันครบกำหนด)</th>
                                <th colspan="2" class="center">เลขที่ใบแจ้งหนี้/ใบส่งของ</th>
                            </tr>
                            <tr>
                                <td colspan="2" class="center">' . $this->convertToThaiDate($bill['bill_date_product']) . '</td>
                                <td colspan="1" class="center">' . $bill['bill_payment'] . '</td>
                                <td colspan="2" class="center">' . $this->convertToThaiDate($bill['bill_due_date']) . '</td>
                                <td colspan="2" class="center">' . $bill['bill_refer'] . '</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="left"><strong>Site :</strong> ' . $bill['bill_site'] . '</td>
                                <td colspan="3" class="left"><strong>PR No :</strong> ' . $bill['bill_pr'] . '</td>
                                <td colspan="2" class="center"><strong>Payment 100%</strong></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="left"><strong>Work No : </strong> ' . $bill['bill_work_no'] . '</td>
                                <td colspan="4" class="left"><strong>Project : </strong> ' . $bill['bill_project'] . '</td>
                            </tr>
                        <tr>
                            <th class="center" style="width: 8%;">ITEM NO.</th>';
                    if ($company == 'Mixed') {
                        $html .= '<th class="center" style="width: 12%;">AU no.</th>';
                    } elseif ($company == 'FBH') {
                        $html .= '<th class="center" style="width: 18%;">AU no.</th>';
                    }
                    $html .= '
                            <th class="left" style="width: 50%;">Assembly Unit Description (รายการ)</th>
                            <th class="center" style="width: 10%;">Unit</th>
                            <th class="center" style="width: 8%;">Quantity</th>
                            <th class="center" style="width: 13%;">Unit Price</th>
                            <th class="center" style="width: 10%;">Amount</th>
                        </tr>';


                    $list = 0;
                    if ($bill['list_num'] <= 15) {
                        $list = 78.75;
                    } elseif ($bill['list_num'] > 15) {
                        $list = 105;
                    }



                    $strsql = "SELECT * FROM bill_detail b INNER JOIN au_all a ON b.au_id = a.au_id WHERE b.bill_id = ?";
                    $stmt = $this->db->prepare($strsql);
                    $stmt->execute([$billId]);
                    $bill_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $x = 0;
                    for ($i = 0; $i < $list; $i += 5.25) {
                        if (isset($bill_details[$x])) {
                            $formatted_unit1 = number_format($bill_details[$x]['au_price'], 2, '.', ',');
                            $formatted_unit2 = number_format($bill_details[$x]['unit'], 2, '.', ',');

                            $html .= '
                                    <tr>
                                        <td class="center">' . ($x + 1) . '</td>
                                        <td class="center">' . $bill_details[$x]['au_name'] . '</td>
                                        <td class="left">' . $this->trimText($bill_details[$x]['au_detail'], 75) . '</td>
                                        <td class="center">' . $bill_details[$x]['au_type'] . '</td>
                                        <td class="right">' . $formatted_unit2 . '</td>
                                        <td class="right">' . $formatted_unit1 . '</td>
                                        <td class="right">' . number_format($bill_details[$x]['price'], 2, '.', ',') . '</td>
                                    </tr>';
                        } else {
                            $html .= '
                                    <tr>
                                        <td class="center">' . ($x + 1) . '</td>
                                        <td class="center"></td>
                                        <td class="left"></td>
                                        <td class="center"></td>
                                        <td class="right"></td>
                                        <td class="right"></td>
                                        <td class="right"></td>
                                    </tr>';
                        }
                        $x++;
                    }

                    $html .= '
                    <tr>
                        <td colspan="6" class="right"><strong>Total</strong></td>
                        <td class="right">' . number_format($bill['total_amount'], 2, '.', ',') . '</td>
                    </tr>
                    <tr>
                        <td colspan="7" class="center" style="color:red;">เงื่อนไข: Payment 1 = 100%</td>
                    </tr>
                    <tr>
                        <td colspan="5" rowspan="';
                    if ($docType == 'quotation' || $docType == 'invoice') {
                        $html .= '3';
                    } elseif ($docType == 'receipt') {
                        $html .= '4';
                    }
                    $html .= '" style="vertical-align: top;" class="left">'
                        //แสดข้อมูล ธนาคาร
                        .  $results['address_bank'][0]['bank_detail'] .
                        '</td>
                        <td class="right"><strong>Final BOQ 100%</strong></td>
                        <td class="right">' . number_format($bill['total_amount'], 2, '.', ',') . '</td>
                    </tr>
                    <tr>
                        <td class="right"><strong>Payment 100%</strong></td>
                        <td class="right">' . number_format($bill['total_amount'], 2, '.', ',') . '</td>
                    </tr>
                    <tr>
                        <td class="right"><strong>VAT 7%</strong></td>
                        <td class="right">' . number_format($bill['vat'], 2, '.', ',') . '</td>
                    </tr>';
                    if ($docType == 'receipt') {
                        $html .= '<tr>
                                        <td class="right"><strong>หัก ณ ที่จ่าย 3%</strong></td>
                                        <td class="right">' . number_format($bill['withholding'], 2, '.', ',') . '</td>
                                    </tr>';
                    }

                    $html .= ' <tr>
                                <td colspan="5" class="center">
                                    <table class="hide">
                                        <tr>
                                            <td style="border: none;" class="left hide">
                                                <strong>จำนวนเงิน (บาท)</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: none;" class="center hide">
                                                ';
                    if ($docType == 'receipt') {
                        $amountToConvert = $bill['grand_total'] - $bill['withholding'];
                        if ($amountToConvert < 0) {
                            $html .= '<span style="color: red;">Error: Negative amount after withholding</span>';
                        } else {
                            $html .= $this->Convert($amountToConvert, 2);
                        }
                    } else {
                        $html .= $this->Convert($bill['grand_total'], 2);
                    }
                    $html .= '
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="right"><strong>Grand Total</strong></td>
                                <td class="right">';
                    if ($docType == 'receipt') {
                        $amountToConvert = $bill['grand_total'] - $bill['withholding'];
                        $html .= number_format($amountToConvert, 2, '.', ',');
                    } else {
                        $html .= number_format($bill['grand_total'], 2, '.', ',');
                    }
                    $html .= '</td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td style="width: 50%;" class="center">ได้รับการตรวจสอบตามรายการขั้นต้นไว้ถูกต้องและเรียบร้อยแล้ว</td>
                                <td style="width: 20%;" class="center">นันท์นภัส ศุทธนาต์ภัสสร</td>
                                <td style="width: 30%;" class="center">บริษัท พีเอสเอ็นเค เทเลคอม จำกัด</td>
                            </tr>
                            <tr>
                                <td class="center"><br><br><br><br><br><br><br></td>
                                <td class="center"></td>
                                <td class="center"></td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="center hide">
                                        <tr>
                                            <td style="border: none;" class="hide">
                                                ผู้ตรวจสอบและรับวางบิล / Goods Received by
                                            </td>
                                            <td style="border: none;" class="hide">
                                                วันที่ / Date
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="center">ผู้ส่งสินค้า / Delivery by</td>
                                <td class="center">ผู้รับมอบอำนาจ / Authorized Signature</td>
                            </tr>
                        </table>
                        ';

                    // สร้าง mpdf และแสดงผล
                    $mpdf->WriteHTML($html);
                    $mpdf->Output($bill['bill_name'] . '.pdf', 'I');
                }
                $this->logAction('PDF Created', "Bill $company Type $docType");
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Invalid request.";
        }
    }

    private function fetchSalaries2($month, $year)
    {
        if ($month && $year) {
            $gregorian_year = $year + 543;
            $sql = "SELECT s.*, 
                    DATE_FORMAT(s.salary_date, '%M') AS salary_month,
                    DATE_FORMAT(s.salary_date, '%Y') AS salary_year,
                    e.employee_name, 
                    e.employee_lastname 
                    FROM salary s
                    INNER JOIN employee e ON s.employee_id = e.employee_id
                    WHERE MONTH(s.salary_date) = :month AND YEAR(s.salary_date) = :year AND DAY(s.salary_date) = 1
                    ORDER BY s.salary_id ASC";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':month', $month, PDO::PARAM_INT);
            $stmt->bindParam(':year', $gregorian_year, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }

    protected function exPDFSalary()
    {
        $month = isset($_GET['month']) ? $_GET['month'] : date('n');
        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

        require_once __DIR__ . '/../libs/mpdf/vendor/autoload.php';

        $queries = [
            'address_psnk' => "SELECT * FROM company_address WHERE company_address_type = 0",
        ];
        $results = [];
        foreach ($queries as $key => $query) {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $results[$key] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Fetch salary data for the specified month and year
        $salaries = $this->fetchSalaries2($month, $year);

        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [
                __DIR__ . '/../libs/mpdf/font',
            ]),
            'fontdata' => $fontData + [
                'th_sarabun' => [
                    'R' => 'THSarabun.ttf',
                    'B' => 'THSarabun-Bold.ttf',
                    'I' => 'THSarabun-Italic.ttf',
                    'BI' => 'THSarabun-BoldItalic.ttf',
                ]
            ],
            'default_font' => 'th_sarabun',
            'format' => 'A4-L',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_left' => 20,
            'margin_right' => 20
        ]);

        $monthNames = [
            1 => "มกราคม",
            2 => "กุมภาพันธ์",
            3 => "มีนาคม",
            4 => "เมษายน",
            5 => "พฤษภาคม",
            6 => "มิถุนายน",
            7 => "กรกฎาคม",
            8 => "สิงหาคม",
            9 => "กันยายน",
            10 => "ตุลาคม",
            11 => "พฤศจิกายน",
            12 => "ธันวาคม"
        ];

        $html = '
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: center; }
        .header { text-align: center; }
        .right { text-align: right; }
        .left { text-align: left; }
    </style>
    <table>
        <tr>
            <td colspan="7" style="border: none; text-align: center;">
                <h2>สรุปเงินเดือน ประจำเดือน ' . $monthNames[(int)$month] . ' พ.ศ.' . ($year + 543) . '</h2>
                ' . $results['address_psnk'][0]['company_address_detaill'] . '
            </td>
        </tr>
        <br>
        <tr>
            <th style="width: 5%;">ลำดับ</th>
            <th style="width: 20%;">ชื่อ - นามสกุล</th>
            <th style="width: 15%;">เงินเดือน</th>
            <th style="width: 15%;">ค่าล่วงเวลา</th>
            <th style="width: 15%;">ประกันสังคม</th>
            <th style="width: 15%;">ค่าใช้จ่ายอื่นๆ</th>
            <th style="width: 15%;">รวม</th>
        </tr>';

        $totalSalary = $totalOT = $totalSocialSecurity = $totalOther = $grandTotal = 0;

        foreach ($salaries as $index => $salary) {
            $html .= '
        <tr>
            <td>' . ($index + 1) . '</td>
            <td class="center">' . $salary['employee_name'] . ' ' . $salary['employee_lastname'] . '</td>
            <td class="right">' . number_format($salary['salary'], 2) . '</td>
            <td class="right">' . number_format($salary['ot'], 2) . '</td>
            <td class="right">' . number_format($salary['social_security'], 2) . '</td>
            <td class="right">' . number_format($salary['other'], 2) . '</td>
            <td class="right">' . number_format($salary['total_salary'], 2) . '</td>
        </tr>';

            $totalSalary += $salary['salary'];
            $totalOT += $salary['ot'];
            $totalSocialSecurity += $salary['social_security'];
            $totalOther += $salary['other'];
            $grandTotal += $salary['total_salary'];
        }

        $html .= '
        <tr>
            <th colspan="6" class="right">รวม</th>
            <th class="right">' . number_format($grandTotal, 2) . '</th>
        </tr>
    </table>';

        $mpdf->WriteHTML($html);
        $mpdf->Output('salary_summary_' . $month . '_' . $year . '.pdf', 'I');
    }
}
