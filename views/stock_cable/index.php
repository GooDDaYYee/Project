<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- List table -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;สต๊อกเคเบิ้ล
            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
                </div>
            </form>
            <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=stock-cable&action=create', '_parent')">เพิ่ม Cable</button>
        </div>

        <div class="card-body">
            <div class="card border h-100">
                <table class="table table-striped" id="cableTable">
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
                            <th scope="col">การดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['cables'] as $i => $cable): ?>
                            <tr>
                                <th scope="row"><span class="to_file"><?= $i + 1 ?></span></th>
                                <td><span class="to_file"><?= htmlspecialchars($cable['route_name']) ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($cable['installed_section']) ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($cable['placing_team']) ?></span></td>
                                <td><span class="to_file">ML <?= htmlspecialchars($cable['cable_form']) ?></span></td>
                                <td><span class="to_file">ML <?= htmlspecialchars($cable['cable_to']) ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($cable['cable_used']) ?> เมตร</span></td>
                                <td><span class="to_file"><?= htmlspecialchars($cable['drum_no']) ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($cable['cable_work']) ?></span></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-success edit-btn" data-id="<?= $cable['cable_id'] ?>">แก้ไข</button>
                                        <button type="button" class="btn btn-outline-danger delete-btn" data-id="<?= $cable['cable_id'] ?>">ลบ</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                &nbsp;
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">แก้ไข Cable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="editCableId" name="cable_id">
                    <div class="form-group">
                        <label for="editRoute">Route</label>
                        <input type="text" class="form-control" id="editRoute" name="route" required>
                    </div>
                    <div class="form-group">
                        <label for="editSection">Section</label>
                        <input type="text" class="form-control" id="editSection" name="section" required>
                    </div>
                    <div class="form-group">
                        <label for="editTeam">Team</label>
                        <input type="text" class="form-control" id="editTeam" name="team" required>
                    </div>
                    <div class="form-group">
                        <label for="editCableFrom">Cable From</label>
                        <input type="number" class="form-control" id="editCableFrom" name="cable_form" required>
                    </div>
                    <div class="form-group">
                        <label for="editCableTo">Cable To</label>
                        <input type="number" class="form-control" id="editCableTo" name="cable_to" required>
                    </div>
                    <div class="form-group">
                        <label for="editCableWork">ใช้กับบริษัท</label>
                        <select class="form-control" id="editCableWork" name="cable_work">
                            <option value="Mixed">Mixed</option>
                            <option value="FHB">FHB</option>
                        </select>
                    </div>
                    <input type="hidden" id="editDrumId" name="drum_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" id="saveChanges">บันทึกการแก้ไข</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let currentPage = 1;
        const rowsPerPage = 10;
        const $rows = $('#cableTable tbody tr');
        const totalPages = Math.ceil($rows.length / rowsPerPage);

        function showPage(page) {
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            $rows.hide().slice(start, end).show();

            updatePagination(page);
        }

        function updatePagination(currentPage) {
            const $pagination = $('.pagination');
            $pagination.empty();

            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, startPage + 4);

            if (startPage > 1) {
                $pagination.append(`<li class="page-item"><a class="page-link" href="#" data-page="1">&laquo; หน้าแรก</a></li>`);
            }

            for (let i = startPage; i <= endPage; i++) {
                $pagination.append(`<li class="page-item ${i === currentPage ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`);
            }

            if (endPage < totalPages) {
                $pagination.append(`<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">หน้าสุดท้าย &raquo;</a></li>`);
            }
        }

        $('.pagination').on('click', 'a', function(e) {
            e.preventDefault();
            currentPage = parseInt($(this).data('page'));
            showPage(currentPage);
        });

        $('#search').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $rows.filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
            currentPage = 1;
            showPage(currentPage);
        });

        $('.edit-btn').click(function() {
            const cableId = $(this).data('id');
            // Fetch cable details and populate the form
            $.ajax({
                url: 'index.php?page=stock-cable&action=fetchCableDetails',
                method: 'POST',
                data: {
                    cable_id: cableId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#editCableId').val(response.data.cable_id);
                        $('#editRoute').val(response.data.route_name);
                        $('#editSection').val(response.data.installed_section);
                        $('#editTeam').val(response.data.placing_team);
                        $('#editCableFrom').val(response.data.cable_form);
                        $('#editCableTo').val(response.data.cable_to);
                        $('#editCableWork').val(response.data.cable_work);
                        $('#editDrumId').val(response.data.drum_id);
                        $('#editModal').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สำเร็จ',
                            text: 'เกิดข้อผิดพลาดในการดึงข้อมูลเคเบิล: ' + response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่สำเร็จ',
                        text: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์'
                    });
                }
            });
        });

        $('#saveChanges').click(function() {
            $.ajax({
                url: 'index.php?page=stock-cable&action=update',
                method: 'POST',
                data: $('#editForm').serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#editModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'อัปเดตข้อมูล Cable สำเร็จ',
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สำเร็จ',
                            text: 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล Cable: ' + response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่สำเร็จ',
                        text: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์'
                    });
                }
            });
        });

        $('.delete-btn').click(function() {
            const cableId = $(this).data('id');
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณต้องการลบข้อมูล Cable นี้หรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'index.php?page=stock-cable&action=delete',
                        method: 'POST',
                        data: {
                            cable_id: cableId
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'ลบสำเร็จ!',
                                    'ข้อมูล Cable ถูกลบเรียบร้อยแล้ว',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ไม่สำเร็จ',
                                    text: 'เกิดข้อผิดพลาดในการลบข้อมูล Cable: ' + response.message
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สำเร็จ',
                                text: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์'
                            });
                        }
                    });
                }
            });
        });

        // Initial page load
        showPage(currentPage);
    });
</script>