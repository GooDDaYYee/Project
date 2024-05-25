<?php
include('connect.php');

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$strsql = "SELECT * FROM bill";
if ($searchTerm) {
    $strsql .= " WHERE bill_id LIKE :search OR bill_date LIKE :search OR bill_site LIKE :search OR total_amount LIKE :search OR vat LIKE :search OR grand_total LIKE :search";
    $searchTerm = "%$searchTerm%";
}
$strsql .= " ORDER BY bill_id DESC";

try {
    $stmt = $con->prepare($strsql);
    if ($searchTerm) {
        $stmt->bindParam(':search', $searchTerm);
    }
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        foreach ($result as $rs) {
            echo "<tr>
                    <th scope='row'>{$rs['bill_id']}</th>
                    <td>" . date('d ', strtotime($rs['bill_date'])) . $thai_month[date('n', strtotime($rs['bill_date']))] . date(' Y', strtotime($rs['bill_date'])) . "</td>
                    <td>{$rs['bill_site']}</td>
                    <td>" . number_format($rs['total_amount'], 2) . "</td>
                    <td>" . number_format($rs['vat'], 2) . "</td>
                    <td>" . number_format($rs['grand_total'], 2) . "</td>
                    <td>
                      <div class='btn-group' role='group' aria-label='Basic example'>
                        <button type='button' class='btn btn-outline-success'>แก้ไข</button>
                        <button type='button' class='btn btn-outline-warning'>ทำเอกสาร</button>
                        <button type='button' class='btn btn-outline-danger' onclick='confirmDelete(\"{$rs['bill_id']}\")'>ลบ</button>
                      </div>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>ไม่พบข้อมูล</td></tr>";
    }
} catch (PDOException $e) {
    echo "Error in SQL query: " . $e->getMessage();
}

$con = null;
