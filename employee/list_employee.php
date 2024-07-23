       <!-- Begin Page Content -->
       <div class="container-fluid">

           <!-- List table -->
           <div class="card shadow mb-4">
               <div class="card-header d-flex justify-content-between align-items-center py-3">
                   <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการเงินเดือน
                   <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                       <div class="input-group">
                           <input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
                       </div>
                   </form>
               </div>

               <div class="card-body">
                   <div class="card border h-100">
                       <table class="table table-striped">
                           <thead>
                               <tr>
                                   <th scope="col">ลำดับ</th>
                                   <th scope="col">ชื่อ</th>
                                   <th scope="col">นามสกุล</th>
                                   <th scope="col">อายุ</th>
                                   <th scope="col">เบอร์โทร</th>
                                   <th scope="col">อีเมล</th>
                                   <th scope="col">ตำแหน่ง</th>
                                   <th scope="col">เงินเดือน</th>
                                   <th scope="col"> </th>
                               </tr>
                           </thead>
                           <tbody>
                               <?php
                                include('connect.php');
                                $strsql = "SELECT * FROM employee ORDER BY employee_id ASC";

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
                                               <td><i class="to_file"><?php echo $rs['employee_name']; ?></i></td>
                                               <td><i class="to_file"><?php echo $rs['employee_lastname']; ?></i></td>
                                               <td><i class="to_file"><?php echo $rs['employee_age']; ?></i></td>
                                               <td><i class="to_file"><?php echo $rs['employee_phone']; ?></i></td>
                                               <td><i class="to_file"><?php echo $rs['employee_email']; ?></i></td>
                                               <td><i class="to_file"><?php
                                                                        if ($rs['employee_position'] == 0) {
                                                                            echo "แอดมิน";
                                                                        } elseif ($rs['employee_position'] == 1) {
                                                                            echo "เจ้าของ";
                                                                        } elseif ($rs['employee_position'] == 2) {
                                                                            echo "พนักงานเอกสาร";
                                                                        } elseif ($rs['employee_position'] == 3) {
                                                                            echo "พนักงานปฏิบัติ";
                                                                        } else {
                                                                            echo "ไม่มีข้อมูล";
                                                                        }
                                                                        ?></i></td>
                                               <td><i class="to_file"><?php echo $rs['employee_salary']; ?> บาท</i></td>
                                               <td>
                                                   <div class="btn-group" role="group" aria-label="Basic example">
                                                       <button type="button" class="btn btn-outline-success">แก้ไข</button>
                                                       <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('<?php echo $i; ?>','<?php echo $rs['employee_id']; ?>')">ลบ</button>
                                                   </div>
                                               </td>
                                           </tr>
                               <?php
                                            $i++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>ไม่พบข้อมูล</td></tr>";
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
           function confirmDelete(i, employee_id) {
               if (confirm("คุณแน่ใจหรือไม่ที่ต้องการลบข้อมูลพนักงานลำดับที่ " + i + " นี้?")) {
                   window.location.href = 'employee/delete_employee.php?employee_id=' + employee_id;
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