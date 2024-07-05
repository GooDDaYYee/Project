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
                <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=stock/insert_drum', '_parent')">เพิ่มDrum</button>
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
                            $strsql = "SELECT * FROM drum ORDER BY drum_id asc";

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
                                            <td><i class="to_file"><?php echo $rs['drum_amount']; ?> เมตร</i></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-outline-success">แก้ไข</button>
                                                    <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('<?php echo $rs['drum_id'] ?>','<?php echo $i ?>')">ลบ</button>
                                                </div>
                                            </td>
                                        </tr>
                            <?php
                                        $i++;
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>ไม่พบข้อมูล</td></tr>";
                                }
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }

                            $con = null;
                            ?>
                        </tbody>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(drum_id, i) {
            if (confirm("คุณแน่ใจหรือไม่ที่ต้องการลบดั้มลำดับที่ " + i + " นี้?")) {
                window.location.href = 'stock/drum_delete.php?drum_id=' + drum_id;
            }
        }

        $(document).ready(function() {
            $('#search').keyup(function() {
                var _f = $(this).val().toLowerCase();
                $('tbody tr').each(function() {
                    var found = false;
                    $(this).find('.to_folder, .to_file').each(function() {
                        var val = $(this).text().toLowerCase();
                        if (val.includes(_f)) {
                            found = true;
                            return false;
                        }
                    });
                    if (found) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>