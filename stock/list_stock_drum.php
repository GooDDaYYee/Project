<?php
if ($_SESSION["lv"] == 0 || $_SESSION["lv"] == 1 || $_SESSION["lv"] == 2) {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- List table -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;สต๊อกดั้ม
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
                    </div>
                </form>
                <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=<?= base64_encode('stock/insert_drum') ?>', '_parent')">เพิ่มDrum</button>
            </div>
            <div class="card-body">
                <div class="card border h-100">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">บริษัทผลิตสาย</th>
                                <th scope="col">Drum Number</th>
                                <th scope="col">Drum To</th>
                                <th scope="col">Description</th>
                                <th scope="col">รับจากบริษัท</th>
                                <th scope="col">Drum เต็ม</th>
                                <th scope="col">Drum ใช้ไป</th>
                                <th scope="col">Drum เหลือ</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('connect.php');
                            $strsql = "SELECT * FROM drum ORDER BY drum_date asc";

                            try {
                                $stmt = $con->prepare($strsql);
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                $rowcount = count($result);

                                if ($rowcount > 0) {
                                    $i = 1;
                                    foreach ($result as $rs) {
                            ?>
                                        <tr>
                                            <th scope="row"><i class="to_file"><?php echo $i; ?></i></th>
                                            <td><i class="to_file"><?php echo $rs['drum_cable_company']; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['drum_no']; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['drum_to']; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['drum_description']; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['drum_company']; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['drum_full']; ?> เมตร</i></td>
                                            <td><i class="to_file"><?php echo $rs['drum_used']; ?> เมตร</i></td>
                                            <td><i class="to_file"><?php echo $rs['drum_remaining']; ?> เมตร</i></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-outline-success" onclick="editDrum('<?php echo $rs['drum_id']; ?>', '<?php echo $rs['drum_no']; ?>', '<?php echo $rs['drum_to']; ?>', '<?php echo $rs['drum_description']; ?>', '<?php echo $rs['drum_company']; ?>', '<?php echo $rs['drum_cable_company']; ?>', '<?php echo $rs['drum_full']; ?>', '<?php echo $rs['drum_used']; ?>')">แก้ไข</button>
                                                    <button type=" button" class="btn btn-outline-danger" onclick="confirmDelete('<?php echo $i ?>','<?php echo $rs['drum_id'] ?>')">ลบ</button>
                                                </div>
                                            </td>
                                        </tr>
                            <?php
                                        $i++;
                                    }
                                } else {
                                    echo "<tr><td colspan='10'>ไม่พบข้อมูล</td></tr>";
                                }
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }

                            $con = null;
                            ?>
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

    <!-- Edit Drum Modal -->
    <div class="modal" id="editDrumModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDrumeModalLabel">แก้ไขงาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editdrum" method="post">
                    <input type="hidden" id="edit_drum_id" name="edit_drum_id">
                    <div class="form-group">
                        <label for="edit_drum_no">Drum Number</label>
                        <input type="text" id="edit_drum_no" name="edit_drum_no" class="form-control" required="">
                        <p id="edit_drum_no_notice" style="display: none; color: red;"></p> <!-- ข้อความแจ้งเตือน -->
                    </div>
                    <div class="form-group">
                        <label for="edit_drum_to">Drum To</label>
                        <input type="text" id="edit_drum_to" name="edit_drum_to" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="edit_drum_description">Description</label>
                        <input type="text" id="edit_drum_description" name="edit_drum_description" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="edit_drum_company">รับจากบริษัท</label>
                        <select class="form-control" id="edit_drum_company" name="edit_drum_company">
                            <option value="">เลือกบริษัท</option>
                            <option value="Mixed">Mixed</option>
                            <option value="FIBERHOME">FIBERHOME</option>
                            <option value="FBH">FBH</option>
                            <option value="CCS">CCS</option>
                            <option value="W&W">W&W</option>
                            <option value="TKI">TKI</option>
                            <option value="MTE">MTE</option>
                            <option value="Poonsub">Poonsub</option>
                        </select>
                        <p id="edit_drum_company_notice" style="display: none; color: red;"></p> <!-- ข้อความแจ้งเตือน -->
                    </div>
                    <div class="form-group">
                        <label for="edit_drum_cable_company">บริษัทผลิตสาย</label>
                        <select class="form-control" id="edit_drum_cable_company" name="edit_drum_cable_company">
                            <option value="">เลือกบริษัท</option>
                            <option value="FUTONG">FUTONG</option>
                            <option value="FIBERHOME">FIBERHOME</option>
                            <option value="TICC">TICC</option>
                            <option value="TUC">TUC</option>
                        </select>
                        <p id="edit_drum_cable_company_notice" style="display: none; color: red;"></p> <!-- ข้อความแจ้งเตือน -->
                    </div>
                    <div class="form-group">
                        <label for="edit_drum_full">Drum เต็ม</label>
                        <input type="number" id="edit_drum_full" name="edit_drum_full" class="form-control" required="">
                        <p id="edit_drum_full_notice" style="display: none; color: red;"></p> <!-- ข้อความแจ้งเตือน -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-warning bg-gradient-purple">บันทึกการแก้ไข</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script>
        // sweetalert delete stock drum
        function confirmDelete(i, drum_id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณต้องการลบข้อมูล Drum ลำดับที่ " + i + " หรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "stock/drum_delete.php?drum_id=" + drum_id,
                        success: function(response) {
                            const data = JSON.parse(response);
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ลบสำเร็จ',
                                    text: 'ลบข้อมูล Drum ลำดับที่ ' + i + ' เรียบร้อยแล้ว!',
                                }).then(function() {
                                    window.location.href = "index.php?page=" + btoa('stock/list_stock_drum');
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ไม่สำเร็จ',
                                    text: data.message,
                                });
                            }
                        },
                        error: function(xhr) {
                            const data = JSON.parse(xhr.responseText);
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สำเร็จ',
                                text: data.message || 'เกิดข้อผิดพลาดบางอย่าง',
                            });
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            $('#editdrum').on('submit', function(e) {
                // เปิดใช้งานฟิลด์ที่ถูกปิดใช้งานก่อนส่งฟอร์ม
                $('#edit_drum_no, #edit_drum_company, #edit_drum_cable_company, #edit_drum_full').prop('disabled', false);
            });
        });

        function editDrum(drum_id, drum_no, drum_to, drum_description, drum_company, drum_cable_company, drum_full, drum_used) {
            $('#edit_drum_id').val(drum_id);
            $('#edit_drum_to').val(drum_to);
            $('#edit_drum_description').val(drum_description);

            if (drum_used > 0) {
                $('#edit_drum_no').val(drum_no).prop('disabled', true);
                $('#edit_drum_company').val(drum_company).prop('disabled', true);
                $('#edit_drum_cable_company').val(drum_cable_company).prop('disabled', true);
                $('#edit_drum_full').val(drum_full).prop('disabled', true);

                $('#edit_drum_no_notice').text('มีการเรียกใช้ดั้มอยู่').show();
                $('#edit_drum_company_notice').text('มีการเรียกใช้ดั้มอยู่').show();
                $('#edit_drum_cable_company_notice').text('มีการเรียกใช้ดั้มอยู่').show();
                $('#edit_drum_full_notice').text('มีการเรียกใช้ดั้มอยู่').show();
            } else {
                $('#edit_drum_no').val(drum_no).prop('disabled', false);
                $('#edit_drum_company').val(drum_company).prop('disabled', false);
                $('#edit_drum_cable_company').val(drum_cable_company).prop('disabled', false);
                $('#edit_drum_full').val(drum_full).prop('disabled', false);

                $('#edit_drum_no_notice').hide();
                $('#edit_drum_company_notice').hide();
                $('#edit_drum_cable_company_notice').hide();
                $('#edit_drum_full_notice').hide();
            }

            $('#editDrumModal').modal('show');
        }

        // sweetalert editForm
        $(function() {
            $('#editdrum').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "stock/update_drum.php",
                    data: $(this).serialize(),
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: 'แก้ไขข้อ Drum สำเร็จ',
                            }).then(function() {
                                window.location.href = "index.php?page=" + btoa('stock/list_stock_drum');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สำเร็จ',
                                text: data.message,
                            });
                        }
                    },
                    error: function(xhr) {
                        const data = JSON.parse(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สำเร็จ',
                            text: data.message || 'เกิดข้อผิดพลาดบางอย่าง',
                        });
                    }
                });
            });
        });

        $(document).ready(function() {
            var rowsPerPage = 10;
            var totalRows = $('tbody tr').length;
            var totalPages = Math.ceil(totalRows / rowsPerPage);
            var maxVisiblePages = 5;

            function renderPagination(currentPage) {
                var startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
                var endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                if (endPage - startPage < maxVisiblePages - 1) {
                    startPage = Math.max(1, endPage - maxVisiblePages + 1);
                }

                $('.pagination').empty();
                if (startPage > 1) {
                    $('.pagination').append('<li class="page-item"><a class="page-link" href="#" data-page="1">&laquo; หน้าแรก</a></li>');
                    $('.pagination').append('<li class="page-item"><a class="page-link" href="#" data-page="' + (startPage - 1) + '">&lsaquo;</a></li>');
                }
                for (var i = startPage; i <= endPage; i++) {
                    $('.pagination').append('<li class="page-item ' + (i === currentPage ? 'active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>');
                }
                if (endPage < totalPages) {
                    $('.pagination').append('<li class="page-item"><a class="page-link" href="#" data-page="' + (endPage + 1) + '">&rsaquo;</a></li>');
                    $('.pagination').append('<li class="page-item"><a class="page-link" href="#" data-page="' + totalPages + '">หน้าสุดท้าย &raquo;</a></li>');
                }
            }

            function showPage(pageNumber) {
                var startRow = (pageNumber - 1) * rowsPerPage;
                var endRow = startRow + rowsPerPage;

                $('tbody tr').hide();
                $('tbody tr').slice(startRow, endRow).show();
            }

            if (totalRows > rowsPerPage) {
                renderPagination(1);
                showPage(1);
            } else {
                $('tbody tr').show();
            }

            $('.pagination').on('click', 'li a', function(e) {
                e.preventDefault();
                var currentPage = parseInt($(this).attr('data-page'));
                renderPagination(currentPage);
                showPage(currentPage);
            });

            $('#search').keyup(function() {
                var searchTerm = $(this).val().toLowerCase();
                $('tbody tr').hide();
                $('tbody tr').each(function() {
                    var rowText = $(this).text().toLowerCase();
                    if (rowText.includes(searchTerm)) {
                        $(this).show();
                    }
                });
            });
        });
    </script>
<?php
} else {
    echo '<script>
    window.location.href = "index.php?page=' . base64_encode('home') . '";
    </script>';
}
?>