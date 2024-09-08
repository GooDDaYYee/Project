<!-- Existing HTML for displaying cable data -->
<div class="container-fluid">
    <!-- List table -->
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
                        <?php
                        include('connect.php');
                        $strsql = "SELECT * FROM cable c JOIN drum d ON d.drum_id = c.drum_id ORDER BY cable_date ASC";

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
                                        <td><i class="to_file"><?php echo $rs['route_name']; ?></i></td>
                                        <td><i class="to_file"><?php echo $rs['installed_section']; ?></i></td>
                                        <td><i class="to_file"><?php echo $rs['placing_team']; ?></i></td>
                                        <td><i class="to_file">ML <?php echo $rs['cable_form']; ?></i></td>
                                        <td><i class="to_file">ML <?php echo $rs['cable_to']; ?></i></td>
                                        <td><i class="to_file"><?php echo $rs['cable_used']; ?> เมตร</i></td>
                                        <td><i class="to_file"><?php echo $rs['drum_no']; ?></i></td>
                                        <td><i class="to_file"><?php echo $rs['cable_work']; ?></i></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-outline-success" onclick="editCable('<?php echo $rs['cable_id']; ?>', '<?php echo $rs['route_name']; ?>', '<?php echo $rs['installed_section']; ?>', '<?php echo $rs['placing_team']; ?>', '<?php echo $rs['cable_form']; ?>', '<?php echo $rs['cable_to']; ?>', '<?php echo $rs['cable_work']; ?>', '<?php echo $rs['drum_id']; ?>')">แก้ไข</button>
                                                <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('<?php echo $i; ?>', '<?php echo $rs['cable_id']; ?>')">ลบ</button>
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
            <form id="editCableForm" action="stock/update_cable.php" method="post">
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
                    <input type="hidden" name="drum_id" value="<?php echo $rs['drum_id']; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-warning bg-gradient-purple">บันทึกการแก้ไข</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#manufacturer, #company').change(function() {
            var manufacturer = $('#manufacturer').val();
            var company = $('#company').val();
            if (manufacturer && company) {
                $.ajax({
                    type: 'POST',
                    url: 'stock/ajaxData.php',
                    data: {
                        'manufacturer': manufacturer,
                        'company': company,
                        'request_type': 'manufacturer'
                    },
                    success: function(html) {
                        $('#drum_id').html(html);
                    }
                });
            } else {
                $('#drum_id').html('<option value="">ไม่มีข้อมูล</option>');
            }
        });
    });

    function editCable(cable_id, route, section, team, cable_form, cable_to, cable_work, drum_id) {
        $('#editCableId').val(cable_id);
        $('#editRoute').val(route);
        $('#editSection').val(section);
        $('#editTeam').val(team);
        $('#editCableFrom').val(cable_form);
        $('#editCableTo').val(cable_to);
        $('#editCableWork').val(cable_work);
        $('#editDrumId').val(drum_id);
        $('#editCableModal').modal('show');
    }

    function confirmDelete(i, cable_id) {
        if (confirm("คุณแน่ใจหรือไม่ที่ต้องการลบข้อมูลงานลำดับที่' " + i + " นี้?")) {
            window.location.href = 'stock/delete_cable.php?cable_id=' + cable_id;
        }
    }

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


    // sweetalert delete stock drum
    function confirmDelete(i, cable_id) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณต้องการลบข้อมูล สต๊อกเคเบิ้ล ลำดับที่ " + i + " หรือไม่?",
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
                    url: "stock/delete_cable.php?cable_id=" + cable_id,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบสำเร็จ',
                            text: 'ลบข้อมูล สต๊อกเคเบิ้ล ลำดับที่ ' + i + ' เรียบร้อยแล้ว!',
                        }).then(function() {
                            window.location.href = "index.php?page=" + btoa('stock/list_stock_cable');
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สำเร็จ',
                            text: 'ลบข้อมูล สต๊อกเคเบิ้ล ลำดับที่ ' + i + ' ไม่สำเร็จ!',
                        });
                    }
                });
            }
        });
    }

    // sweetalert editCableForm
    $(function() {
        $('#editCableForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "stock/update_cable.php",
                data: $(this).serialize(),
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'แก้ไขข้อ Drum สำเร็จ',
                        }).then(function() {
                            window.location.href = "index.php?page=" + btoa('stock/list_stock_cable');
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
</script>