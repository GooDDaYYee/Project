<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Header
    function Header()
    {
        // Company Name
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'PSNK Telecom Company Limited (Head office)', 0, 1, 'C');

        // Company Address and Contact Info
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(
            0,
            7,
            "99/2 Moo 9 T. Sannameng, A. San Sai, Chiang Mai, 50130\n"
                . "Tel: 063-5451398, 064-1954565, 064-7888995\n"
                . "Tax ID: 0-5055-64000-43-4",
            0,
            'C'
        );

        // Invoice Title
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'INVOICE', 0, 1, 'C');
        $this->Ln(10);
    }

    // Customer Information
    function CustomerInfo()
    {
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, 'Customer: Mixed System Co.,Ltd', 0, 1);
        $this->Cell(0, 10, 'Address: 1 Soi Suthisarnwinichai 3, Suthisarn Road, Dindaeng, Bangkok 10400 Thailand', 0, 1);
        $this->Cell(0, 10, 'Tax ID: 0-1055-40993-10-2', 0, 1);
        $this->Cell(0, 10, 'Contact: Management Center', 0, 1);
        $this->Cell(0, 10, 'Tel: 02-276-2236-8, Fax: 02-276-2239', 0, 1);
        $this->Ln(10);
    }

    // Table for Items
    function AddTable()
    {
        // Table Header
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 10, 'ITEM NO.', 1);
        $this->Cell(20, 10, 'AU No.', 1);
        $this->Cell(90, 10, 'Assembly Unit Description', 1);
        $this->Cell(20, 10, 'Unit', 1);
        $this->Cell(20, 10, 'Quantity', 1);
        $this->Cell(30, 10, 'Unit Price', 1);
        $this->Cell(30, 10, 'Amount', 1);
        $this->Ln();

        // Table Rows
        $this->SetFont('Arial', '', 10);
        for ($i = 0; $i < 10; $i++) {
            $this->Cell(20, 10, '', 1);
            $this->Cell(20, 10, '', 1);
            $this->Cell(90, 10, '', 1);
            $this->Cell(20, 10, '', 1);
            $this->Cell(20, 10, '', 1);
            $this->Cell(30, 10, '', 1);
            $this->Cell(30, 10, '', 1);
            $this->Ln();
        }
    }

    // Footer
    function Footer()
    {
        // Footer Content
        $this->SetY(-60);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, 'Conditions: Payment 1 = 100%', 0, 1, 'L');
        $this->Cell(0, 10, 'Bank: Thai Military Bank Public Company Limited, San Sai Chiang Mai Branch 2', 0, 1, 'L');
        $this->Cell(0, 10, 'Account Name: PSNK Telecom Company Limited', 0, 1, 'L');
        $this->Cell(0, 10, 'Account No: 423-118256-4', 0, 1, 'L');
        $this->Ln(10);

        // Signature Section
        $this->SetY(-30);
        $this->Cell(40, 10, 'Goods Received by', 1);
        $this->Cell(40, 10, 'Date', 1);
        $this->Cell(60, 10, 'Delivered by', 1);
        $this->Cell(50, 10, 'Authorized Signature', 1);
        $this->Ln();
    }
}

// Instantiation of inherited class
$pdf = new PDF();
$pdf->AddPage();
$pdf->CustomerInfo();
$pdf->AddTable();
$pdf->Footer();
$pdf->Output('I', 'invoice.pdf');
