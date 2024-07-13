    <!-- Begin Page Content -->
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
                <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=stock/insert_cable', '_parent')">เพิ่มงาน</button>
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
                                <th scope="col">Cable Form</th>
                                <th scope="col">Cable To</th>
                                <th scope="col">Cable Used</th>
                                <th scope="col">Drum</th>
                                <th scope="col">ใช้กับบริษัท</th>
                                <th scope="col"> </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('connect.php');
                            $strsql = "SELECT * FROM cable c
                            JOIN drum d
                            ON d.drum_id = c.drum_id
                            ORDER BY cable_id ASC";

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
                                            <td><i class="to_file"><?php echo $rs['cable_form']; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['cable_to']; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['cable_used']; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['drum_no']; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['cable_work']; ?></i></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-outline-success">แก้ไข</button>
                                                    <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('<?php echo $i; ?>', '<?php echo $rs['cable_id']; ?>')">ลบ</button>
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
        function confirmDelete(i, cable_id) {
            if (confirm("คุณแน่ใจหรือไม่ที่ต้องการลบข้อมูลงานลำดับที่' " + i + " นี้?")) {
                window.location.href = 'stock/delete_cable.php?cable_id=' + cable_id;
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