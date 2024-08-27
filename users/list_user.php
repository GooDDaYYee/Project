<?php
if ($_SESSION["lv"] == 0) {
?>
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
        <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=<?= base64_encode('users/insert_users') ?>', '_parent')">เพิ่มผู้ใช้</button>
      </div>

      <div class="card-body">
        <div class="card border h-100">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">ลำดับ</th>
                <th scope="col">ชื่อผู้ใช้</th>
                <th scope="col">ประเภทผู้ใช้</th>
                <th scope="col">สถานะ</th>
                <th scope="col"> </th>
              </tr>
            </thead>
            <tbody>
              <?php
              include('connect.php');
              $strsql = "SELECT * FROM users ORDER BY users_date ASC";

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
                          <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editModal" data-id="<?php echo $rs['user_id']; ?>" data-username="<?php echo $rs['username']; ?>" data-lv="<?php echo $rs['lv']; ?>" data-status="<?php echo $rs['status']; ?>">แก้ไข</button>
                          <button type="button" class="btn btn-outline-danger" id="delete_users" onclick="confirmDelete('<?php echo $rs['user_id']; ?>','<?php echo $rs['username']; ?>')">ลบ</button>
                        </div>
                      </td>
                    </tr>
              <?php
                    $i++;
                  }
                } else {
                  echo "<tr><td colspan='5'>ไม่พบข้อมูล</td></tr>";
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

  <!-- Edit Modal -->
  <div class="modal" id="editModal">
    <div class="modal-content">
      <form id="editForm" action="users/update_users.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลผู้ใช้</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="edit-user-id" name="user_id">
          <div class="form-group">
            <label for="edit-username">ชื่อผู้ใช้</label>
            <input type="text" class="form-control" id="edit-username" name="username">
          </div>
          <div class="form-group">
            <label for="edit-lv">ประเภทผู้ใช้</label>
            <select class="form-control" id="edit-lv" name="lv">
              <option value="0">แอดมิน</option>
              <option value="1">เจ้าของ</option>
              <option value="2">พนักงานเอกสาร</option>
              <option value="3">พนักงานปฏิบัติ</option>
            </select>
          </div>
          <div class="form-group">
            <label for="edit-status">สถานะ</label>
            <select class="form-control" id="edit-status" name="status">
              <option value="0">แบน</option>
              <option value="1">ปกติ</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
          <button type="submit" class="btn btn-warning bg-gradient-purple">บันทึกการแก้ไข</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // sweetalert delete users
    function confirmDelete(user_id, username) {
      Swal.fire({
        title: 'คุณแน่ใจหรือไม่?',
        html: "คุณต้องการลบผู้ใช้ " + username + " หรือไม่? <br>!! คำเตือนหากลบข้อมูลผู้ใช้ ข้อมูลพนักงานจะหายไปด้วย !!",
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
            url: "users/delete_users.php?user_id=" + user_id,
            success: function(response) {
              Swal.fire({
                icon: 'success',
                title: 'ลบสำเร็จ',
                text: 'ลบผู้ใช้ ' + username + ' เรียบร้อยแล้ว!',
              }).then(function() {
                window.location.href = "index.php?page=" + btoa('users/list_user');
              });
            },
            error: function() {
              Swal.fire({
                icon: 'error',
                title: 'ไม่สำเร็จ',
                text: 'การลบผู้ใช้ ' + username + ' ไม่สำเร็จ!',
              });
            }
          });
        }
      });
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

      // sweetalert editForm
      $('#editForm').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);

        $.ajax({
          type: "POST",
          url: form.attr('action'),
          data: form.serialize(),
          success: function(response) {
            Swal.fire({
              icon: 'success',
              title: 'สำเร็จ',
              text: 'แก้ไขข้อมูลผู้ใช้สำเร็จ',
            }).then(function() {
              window.location.href = "index.php?page=" + btoa('users/list_user');
            });
          },
          error: function() {
            Swal.fire({
              icon: 'error',
              title: 'ไม่สำเร็จ',
              text: 'การแก้ไขข้อมูลผู้ใช้ไม่สำเร็จ!',
            });
          }
        });
      });

      // editForm users
      $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var username = button.data('username');
        var lv = button.data('lv');
        var status = button.data('status');

        var modal = $(this);
        modal.find('#edit-user-id').val(id);
        modal.find('#edit-username').val(username);
        modal.find('#edit-lv').val(lv);
        modal.find('#edit-status').val(status);
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