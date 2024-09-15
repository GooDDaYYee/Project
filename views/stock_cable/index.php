<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;สต๊อกเคเบิ้ล
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
                </div>
            </form>
            <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=<?= base64_encode('stock/insert_cable') ?>', '_parent')">เพิ่มงาน</button>
        </div>
        <div class="card-body">
            <div class="card border h-100">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">Route</th>
                            <th scope="col">Section</th>
                            <th scope="col">Team</th>
                            <th scope="col">Cable จาก</th>
                            <th scope="col">Cable ถึง</th>
                            <th scope="col">Cable ใช้ไป</th>
                            <th scope="col">Drum</th>
                            <th scope="col">ใช้กับบริษัท</th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['cables'] as $index => $cable): ?>
                            <tr>
                                <th scope="row"><i class="to_file"><?= $index + 1 ?></i></th>
                                <td><i class="to_file"><?= htmlspecialchars($cable['route_name']) ?></i></td>
                                <td><i class="to_file"><?= htmlspecialchars($cable['installed_section']) ?></i></td>
                                <td><i class="to_file"><?= htmlspecialchars($cable['placing_team']) ?></i></td>
                                <td><i class="to_file">ML <?= htmlspecialchars($cable['cable_form']) ?></i></td>
                                <td><i class="to_file">ML <?= htmlspecialchars($cable['cable_to']) ?></i></td>
                                <td><i class="to_file"><?= htmlspecialchars($cable['cable_used']) ?> เมตร</i></td>
                                <td><i class="to_file"><?= htmlspecialchars($cable['drum_no']) ?></i></td>
                                <td><i class="to_file"><?= htmlspecialchars($cable['cable_work']) ?></i></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-success edit-cable" data-id="<?= $cable['cable_id'] ?>">แก้ไข</button>
                                        <button type="button" class="btn btn-outline-danger delete-cable" data-id="<?= $cable['cable_id'] ?>" data-index="<?= $index + 1 ?>">ลบ</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="pagination-container">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing Cable -->
<div class="modal" id="editCableModal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editCableModalLabel">แก้ไขงาน</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="editCableForm">
                <input type="hidden" id="editCableId" name="cable_id">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="editRoute">Route</label>
                        <input type="text" id="editRoute" name="route" class="form-control" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="editSection">Section</label>
                        <input type="text" id="editSection" name="section" class="form-control" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="editTeam">Team</label>
                        <input type="text" id="editTeam" name="team" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="editCableFrom">Cable From</label>
                        <input type="number" id="editCableFrom" name="cable_form" class="form-control" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="editCableTo">Cable To</label>
                        <input type="number" id="editCableTo" name="cable_to" class="form-control" required>
                    </div>
                    <div class="col-sm-3">
                        <label for="editCableWork">ใช้กับบริษัท</label>
                        <select class="form-control" id="editCableWork" name="cable_work">
                            <option value="Mixed">Mixed</option>
                            <option value="FHB">FHB</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            <button type="button" class="btn btn-warning bg-gradient-purple" id="saveEditCable">บันทึกการแก้ไข</button>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var rowsPerPage = 10;
    var $rows = $('tbody tr');
    var totalPages = Math.ceil($rows.length / rowsPerPage);

    function showPage(page) {
        var start = (page - 1) * rowsPerPage;
        var end = start + rowsPerPage;

        $rows.hide().slice(start, end).show();

        var $pagination = $('.pagination');
        $pagination.empty();

        var maxVisiblePages = 5;
        var startPage = Math.max(1, page - Math.floor(maxVisiblePages / 2));
        var endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        if (startPage > 1) {
            $pagination.append('<li class="page-item"><a class="page-link" href="#" data-page="1">&laquo; หน้าแรก</a></li>');
        }

        for (var i = startPage; i <= endPage; i++) {
            $pagination.append('<li class="page-item ' + (i === page ? 'active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>');
        }

        if (endPage < totalPages) {
            $pagination.append('<li class="page-item"><a class="page-link" href="#" data-page="' + totalPages + '">หน้าสุดท้าย &raquo;</a></li>');
        }
    }

    $('.pagination').on('click', 'a', function(e) {
        e.preventDefault();
        showPage(parseInt($(this).data('page')));
    });

    $('#search').on('keyup', function() {
        var searchTerm = $(this).val().toLowerCase();
        $rows.each(function() {
            var rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.indexOf(searchTerm) > -1);
        });
    });

    $('.edit-cable').click(function() {
        var cableId = $(this).data('id');
        // Fetch cable details and populate the form
        // You'll need to implement this AJAX call
    });

    $('#saveEditCable').click(function() {
        var formData = $('#editCableForm').serialize();
        $.ajax({
            url: 'index.php?action=updateCable',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Cable updated successfully');
                    location.reload();
                } else {
                    alert('Error updating cable: ' + response.message);
                }
            },
            error: function() {
                alert('Error updating cable');
            }
        });
    });

    $('.delete-cable').click(function() {
        var cableId = $(this).data('id');
        var index = $(this).data('index');
        
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณต้องการลบข้อมูล สต๊อกเคเบิ้ล ลำดับที่ " + index + " หรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'index.php?action=deleteCable',
                    method: 'POST',
                    data: { cable_id: cableId },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('ลบสำเร็จ', 'ลบข้อมูล สต๊อกเคเบิ้ล ลำดับที่ ' + index + ' เรียบร้อยแล้ว!', 'success')
                            .then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('ไม่สำเร็จ', 'ลบข้อมูล สต๊อกเคเบิ้ล ลำดับที่ ' + index + ' ไม่สำเร็จ!', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('ไม่สำเร็จ', 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์', 'error');
                    }
                });
            }
        });
    });

    // Initial page load
    showPage(1);
});
</script>