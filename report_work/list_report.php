<?php
include dirname(__FILE__) . '/../connect.php';
$folder_parent = isset($_GET['fid']) ? base64_decode($_GET['fid']) : 0;
if (!is_numeric($folder_parent)) {
  $folder_parent = 0;
}

$stmt = $con->prepare("SELECT * FROM folders WHERE parent_id = :parent_id AND folders_type = 2   ORDER BY folder_date ASC");
$stmt->bindParam(':parent_id', $folder_parent, PDO::PARAM_INT);
$stmt->execute();
$folders = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($folder_parent == 0) {

  $stmt = $con->prepare("SELECT * FROM files WHERE folders_id AND user_id = '" . $_SESSION['user_id'] . "' IS NULL ORDER BY files_date ASC");
} else {

  $stmt = $con->prepare("SELECT * FROM files WHERE folders_id = :folders_id AND user_id = '" . $_SESSION['user_id'] . "' ORDER BY files_date ASC");
  $stmt->bindParam(':folders_id', $folder_parent, PDO::PARAM_INT);
}
$stmt->execute();
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- List table -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp; รายการปฏิบัติงาน
      <!-- Topbar Search -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
          <input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
        </div>
      </form>
    </div>

    <div class="container-fluid">
      <div class="col-lg-12 card-body">
        <div class="row">
          <div id="paths">
            <?php
            $folders_id = $folder_parent;
            while ($folders_id > 0) {
              $path_stmt = $con->prepare("SELECT * FROM folders WHERE folders_id = :folders_id ORDER BY folder_date ASC");
              $path_stmt->bindParam(':folders_id', $folders_id, PDO::PARAM_INT);
              $path_stmt->execute();
              $path = $path_stmt->fetch(PDO::FETCH_ASSOC);
              echo '<script>
                            $("#paths").prepend("<a href=\"index.php?page=" + btoa("report_work/list_report") + "&fid=" + btoa(\'' . $path['folders_id'] . '\') + "\">' . $path['name'] . '</a>/");
                        </script>';
              $folders_id = $path['parent_id'];
            }
            echo '<script>
                            $("#paths").prepend("<a href=\"index.php?page=' . base64_encode('report_work/list_report') . '\">หน้าหลัก</a>/")
                            </script>';
            ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <div class="card border h-100">
              <table width="100%" class="table-striped">
                <thead>
                  <tr>
                    <th style="padding-top: 10px;" width="40%" scope="col">
                      <h5>ไฟล์</h5>
                    </th>
                    <th style="padding-top: 10px;" width="20%" scope="col">
                      <h5>วันที่</h5>
                    </th>
                    <th style="padding-top: 10px;" width="40%" scope="col">
                      <h5>รายละเอียด</h5>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($folders) && empty($files)) : ?>
                    <tr>
                      <td colspan="3" class="text-center">ไม่พบข้อมูล</td>
                    </tr>
                  <?php else : ?>
                    <?php
                    foreach ($folders as $row) :
                    ?>
                      <tr class='folder-item' data-id="<?php echo $row['folders_id'] ?>">
                        <td style="text-align: left;">
                          <span><i class="fa fa-folder"></i></span><b class="to_folder"> <?php echo $row['name'] ?></b>
                        </td>
                        <td></td>
                        <td></td>
                      </tr>
                    <?php endforeach; ?>
                    <?php
                    foreach ($files as $row) :
                      $name = explode(' ||', $row['name']);
                      $name = isset($name[1]) ? $name[0] . " (" . $name[1] . ")." . $row['file_type'] : $name[0] . "." . $row['file_type'];

                      // Determine the correct icon for the file type
                      $img_arr = array('png', 'jpg', 'jpeg', 'gif', 'psd', 'tif');
                      $doc_arr = array('doc', 'docx');
                      $pdf_arr = array('pdf', 'ps', 'eps', 'prn');
                      $icon = 'fa-file';
                      if (in_array(strtolower($row['file_type']), $img_arr))
                        $icon = 'fa-image';
                      if (in_array(strtolower($row['file_type']), $doc_arr))
                        $icon = 'fa-file-word';
                      if (in_array(strtolower($row['file_type']), $pdf_arr))
                        $icon = 'fa-file-pdf';
                      if (in_array(strtolower($row['file_type']), ['xlsx', 'xls', 'xlsm', 'xlsb', 'xltm', 'xlt', 'xla', 'xlr']))
                        $icon = 'fa-file-excel';
                      if (in_array(strtolower($row['file_type']), ['zip', 'rar', 'tar']))
                        $icon = 'fa-file-archive';
                      if (in_array(strtolower($row['file_type']), ['kmz']))
                        $icon = 'fa fa-globe';
                      if (in_array(strtolower($row['file_type']), ['dwg']))
                        $icon = 'fa fa-cube';
                      if (in_array(strtolower($row['file_type']), ['psd']))
                        $icon = 'fa fa-scissors';

                      // Render the file item
                    ?>
                      <tr class='file-item' data-id="<?php echo $row['files_id'] ?>" data-name="<?php echo $name ?>">
                        <td style="text-align: left;">
                          <span><i class="fa <?php echo $icon ?>"></i></span><b class="to_file"> <?php echo $name ?></b>
                          <input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['files_id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">
                        </td>
                        <td><i class="to_file"><?php
                                                $timestamp = strtotime($row['files_date']);
                                                $year_buddhist = date('Y', $timestamp) + 543;
                                                $date_buddhist = date('d/m/', $timestamp) . $year_buddhist . date(' h:i A', $timestamp);
                                                echo $date_buddhist; ?></i></td>
                        <td><i class="to_file"><?php echo $row['description'] ?></i></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
              &nbsp;
              <div class="pagination-container">
                <nav aria-label="Page navigation">
                  <ul class="pagination justify-content-center">
                    <!-- Pagination items will be dynamically generated here -->
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="menu-folder-clone" style="display: none;">
      <a href="javascript:void(0)" class="custom-menu-list file-option edit">Rename</a>
      <a href="javascript:void(0)" class="custom-menu-list file-option delete">Delete</a>
    </div>
    <div id="menu-file-clone" style="display: none;">
      <a href="javascript:void(0)" class="custom-menu-list file-option edit"><span><i class="fa fa-edit"></i> </span>Rename</a>
      <a href="javascript:void(0)" class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span>Download</a>
      <a href="javascript:void(0)" class="custom-menu-list file-option delete"><span><i class="fa fa-trash"></i> </span>Delete</a>
    </div>
  </div>
</div>

<!-- <div id="preloader"></div> -->
<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<div class="modal fade" id="confirm_modal" role='dialog'>
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ยืนยัน</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">ตกลง</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="uni_modal" role='dialog'>
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">ตกลง</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('#new_folder').click(function() {
    uni_modal('', 'files/manage_folder.php?fid=<?php echo $folder_parent ?>');
  });
  $('#new_file').click(function() {
    uni_modal('', 'files/manage_files.php?fid=<?php echo $folder_parent ?>');
  });
  $('.folder-item').dblclick(function() {
    var encodedPage = btoa('report_work/list_report');
    var encodedFid = btoa($(this).attr('data-id'));
    location.href = 'index.php?page=' + encodedPage + '&fid=' + encodedFid;
  });

  $('.folder-item').bind("contextmenu", function(event) {
    event.preventDefault();
    $("div.custom-menu").hide();
    var custom = $("<div class='custom-menu'></div>");
    custom.append($('#menu-folder-clone').html());
    custom.find('.edit').attr('data-id', $(this).attr('data-id'));
    custom.find('.delete').attr('data-id', $(this).attr('data-id'));
    custom.appendTo("body");
    custom.css({
      top: event.pageY + "px",
      left: event.pageX + "px"
    });

    $("div.custom-menu .edit").click(function(e) {
      e.preventDefault();
      uni_modal('เปลี่ยนชื่อโฟลเดอร์', 'files/manage_folder.php?fid=<?php echo $folder_parent ?>&folders_id=' + $(this).attr('data-id'));
    });
    $("div.custom-menu .delete").click(function(e) {
      e.preventDefault();
      _conf("ไฟล์ทั้งหมด และโฟลเดอร์ทั้งหมดก็จะถูกลบไปด้วย คุณแน่ใจที่จะลบโฟลเดอร์นี้หรือไม่?", 'delete_folder', [$(this).attr('data-id')]);
    });
  });

  $('.file-item').bind("contextmenu", function(event) {
    event.preventDefault();

    $('.file-item').removeClass('active');
    $(this).addClass('active');
    $("div.custom-menu").hide();
    var custom = $("<div class='custom-menu file'></div>");
    custom.append($('#menu-file-clone').html());
    custom.find('.edit').attr('data-id', $(this).attr('data-id'));
    custom.find('.delete').attr('data-id', $(this).attr('data-id'));
    custom.find('.download').attr('data-id', $(this).attr('data-id'));
    custom.appendTo("body");
    custom.css({
      top: event.pageY + "px",
      left: event.pageX + "px"
    });

    $("div.file.custom-menu .edit").click(function(e) {
      e.preventDefault();
      var fileItem = $('.file-item[data-id="' + $(this).attr('data-id') + '"]');
      fileItem.find('b.to_file').hide();
      fileItem.find('input.rename_file').show();
    });
    $("div.file.custom-menu .delete").click(function(e) {
      e.preventDefault();
      _conf("คุณแน่ใจหรือว่าจะลบไฟล์นี้?", 'delete_file', [$(this).attr('data-id')]);
    });
    $("div.file.custom-menu .download").click(function(e) {
      e.preventDefault();
      window.open('files/download.php?id=' + $(this).attr('data-id'));
    });

    $('.rename_file').keypress(function(e) {
      var _this = $(this);
      if (e.which == 13) {
        start_load();
        $.ajax({
          url: 'files/ajax.php?action=file_rename',
          method: 'POST',
          data: {
            files_id: $(this).attr('data-id'),
            name: $(this).val(),
            type: $(this).attr('data-type'),
            folders_id: '<?php echo $folder_parent ?>'
          },
          success: function(resp) {
            if (typeof resp != 'undefined') {
              resp = JSON.parse(resp);
              if (resp.status == 1) {
                _this.siblings('b.to_file').text(resp.new_name);
                _this.hide();
                _this.siblings('b.to_file').show();
              }
            }
            setTimeout(function() {
              location.reload();
            }, 1000);
          },
          error: function() {
            end_load();
          }
        });
      }
    });
  });

  $('.file-item').click(function() {
    if ($(this).find('input.rename_file').is(':visible') == true)
      return false;
    uni_modal($(this).attr('data-name'), 'files/manage_files.php?<?php echo $folder_parent ?>&files_id=' + $(this).attr('data-id'));
  });
  $(document).bind("click", function(event) {
    $("div.custom-menu").hide();
    $('#file-item').removeClass('active');
  });
  $(document).keyup(function(e) {
    if (e.keyCode === 27) {
      $("div.custom-menu").hide();
      $('#file-item').removeClass('active');
    }
  });
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

  function delete_folder($folders_id) {
    start_load();
    $.ajax({
      url: 'files/ajax.php?action=delete_folder',
      method: 'POST',
      data: {
        folders_id: $folders_id
      },
      success: function(resp) {
        if (resp == 1) {
          setTimeout(function() {
            location.reload();
          }, 1500);
        }
        end_load();
      },
      error: function() {
        end_load();
      }
    });
  }

  function delete_file($files_id) {
    start_load();
    $.ajax({
      url: 'files/ajax.php?action=delete_file',
      method: 'POST',
      data: {
        files_id: $files_id
      },
      success: function(resp) {
        if (resp == 1) {
          setTimeout(function() {
            location.reload();
          }, 1500);
        }
        end_load();
      },
      error: function() {
        end_load();
      }
    });
  }

  //ลำดับหน้า
  $(document).ready(function() {
    var rowsPerPage = 20;
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

  //modal*************************************************************************************************************************
  window.start_load = function() {
    $('body').prepend('<div id="preloader2"></div>')
  }
  window.end_load = function() {
    $('#preloader2').fadeOut('fast', function() {
      $(this).remove();
    })
  }

  window.uni_modal = function($title = '', $url = '') {
    start_load()
    $.ajax({
      url: $url,
      error: err => {
        console.log(err)
        alert("An error occurred")
      },
      success: function(resp) {
        if (resp) {
          $('#uni_modal .modal-title').html($title)
          $('#uni_modal .modal-body').html(resp)
          $('#uni_modal').modal('show')
          end_load()
        }
      }
    })
  }
  window._conf = function($msg = '', $func = '', $params = []) {
    $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
    $('#confirm_modal .modal-body').html($msg)
    $('#confirm_modal').modal('show')
  }
  window.alert_toast = function($msg = 'TEST', $bg = 'success') {
    $('#alert_toast').removeClass('bg-success bg-danger bg-info bg-warning')

    if ($bg == 'success')
      $('#alert_toast').addClass('bg-success')
    if ($bg == 'danger')
      $('#alert_toast').addClass('bg-danger')
    if ($bg == 'info')
      $('#alert_toast').addClass('bg-info')
    if ($bg == 'warning')
      $('#alert_toast').addClass('bg-warning')
    $('#alert_toast .toast-body').html($msg)
    $('#alert_toast').toast({
      delay: 3000
    }).toast('show');
  }
  $(document).ready(function() {
    $('#preloader').fadeOut('fast', function() {
      $(this).remove();
    })
  })

  $('#manage-files').submit(function(e) {
    e.preventDefault();
    start_load();
    $.ajax({
      url: 'files/ajax.php?action=save_files',
      data: new FormData($(this)[0]),
      cache: false,
      contentType: false,
      processData: false,
      method: 'POST',
      type: 'POST',
      success: function(resp) {
        if (typeof resp != undefined) {
          resp = JSON.parse(resp);
          if (resp.status == 1) {
            alert_toast("Files uploaded successfully", 'success');
            setTimeout(function() {
              location.reload();
            }, 1500);
          } else {
            alert_toast(resp.msg, 'error');
            end_load();
          }
        }
      }
    });
  });

  $('#manage-folder').submit(function(e) {
    e.preventDefault();
    start_load();
    $.ajax({
      url: 'files/ajax.php?action=save_folder',
      method: 'POST',
      data: $(this).serialize(),
      success: function(resp) {
        if (typeof resp != undefined) {
          resp = JSON.parse(resp);
          if (resp.status == 1) {
            alert_toast(resp.msg, 'success');
            setTimeout(function() {
              location.reload();
            }, 1500);
          } else {
            alert_toast(resp.msg, 'error');
            end_load();
          }
        }
      }
    });
  });

  $('.rename_file').keypress(function(e) {
    var _this = $(this);
    if (e.which == 13) {
      start_load();
      $.ajax({
        url: 'files/ajax.php?action=file_rename',
        method: 'POST',
        data: {
          files_id: $(this).attr('data-id'),
          name: $(this).val(),
          type: $(this).attr('data-type'),
          folders_id: '<?php echo $folder_parent ?>'
        },
        success: function(resp) {
          if (typeof resp != undefined) {
            resp = JSON.parse(resp);
            if (resp.status == 1) {
              alert_toast(resp.msg, 'success');
              _this.siblings('b.to_file').text(resp.new_name);
              _this.hide();
              _this.siblings('b.to_file').show();
              end_load();
            } else {
              alert_toast(resp.msg, 'error');
              end_load();
            }
          }
        }
      });
    }
  });
</script>