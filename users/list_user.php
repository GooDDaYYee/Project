    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- List table -->
      <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
          <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการผู้ใช้
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
            </div>
          </form>
          <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=users/register', '_parent')">เพิ่มผู้ใช้</button>
        </div>

        <div class="card-body">
          <div class="card border h-100">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">ลำดับ</th>
                  <th scope="col">ชื่อผู้ใช้</th>
                  <th scope="col">ชื่อ</th>
                  <th scope="col">นามสกุล</th>
                  <th scope="col">ประเภทผู้ใช้</th>
                  <th scope="col">สถานะ</th>
                  <th scope="col"> </th>
                </tr>
              </thead>
              <tbody>
                <?php
                include('connect.php');
                $strsql = "SELECT * FROM users ORDER BY user_id ASC";

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
                        <td><i class="to_file"><?php echo $rs['username']; ?></i></td>
                        <td><i class="to_file"><?php echo $rs['name']; ?></i></td>
                        <td><i class="to_file"><?php echo $rs['lastname']; ?></i></td>
                        <td><i class="to_file"><?php
                                                if ($rs['lv'] == 0) {
                                                  echo "แอดมิน";
                                                } elseif ($rs['lv'] == 1) {
                                                  echo "เจ้าของ";
                                                } elseif ($rs['lv'] == 2) {
                                                  echo "พนักงานเอกสาร";
                                                } elseif ($rs['lv'] == 3) {
                                                  echo "พนักงานปฏิบัติ";
                                                } else {
                                                  echo "ไม่มีข้อมูล";
                                                }
                                                ?></td>
                        <td><i class="to_file"><?php
                                                if ($rs['status'] == 0) {
                                                  echo "แบน";
                                                } elseif ($rs['status'] == 1) {
                                                  echo "ปกติ";
                                                }
                                                ?></i></td>
                        <td>
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-success">แก้ไข</button>
                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('<?php echo $rs['user_id']; ?>','<?php echo $rs['username']; ?>')">ลบ</button>
                          </div>
                        </td>
                      </tr>
                <?php
                      $i++;
                    }
                  } else {
                    echo "<tr><td colspan='7'>ไม่พบข้อมูล</td></tr>";
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
      function confirmDelete(user_id, username) {
        if (confirm("คุณแน่ใจหรือไม่ที่ต้องการลบข้อมูลชื่อผู้ใช้ " + username + " นี้?")) {
          window.location.href = 'users/delete_users.php?user_id=' + user_id;
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