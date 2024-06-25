<?php
include 'connect.php';
$folder_parent = isset($_GET['fid']) ? $_GET['fid'] : 0;

$stmt = $con->prepare("SELECT * FROM folders WHERE parent_id = :parent_id ORDER BY name ASC");
$stmt->bindParam(':parent_id', $folder_parent, PDO::PARAM_INT);
$stmt->execute();
$folders = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $con->prepare("SELECT * FROM files WHERE folder_id = :folder_id ORDER BY name ASC");
$stmt->bindParam(':folder_id', $folder_parent, PDO::PARAM_INT);
$stmt->execute();
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- List table -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการไฟล์
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
            $id = $folder_parent;
            while ($id > 0) {
              $path_stmt = $con->prepare("SELECT * FROM folders WHERE id = :id ORDER BY name ASC");
              $path_stmt->bindParam(':id', $id, PDO::PARAM_INT);
              $path_stmt->execute();
              $path = $path_stmt->fetch(PDO::FETCH_ASSOC);
              echo '<script>
                                    $("#paths").prepend("<a href=\"index.php?page=files&fid=' . $path['id'] . '\">' . $path['name'] . '</a>/")
                                </script>';
              $id = $path['parent_id'];
            }
            echo '<script>
                                $("#paths").prepend("<a href=\"index.php?page=files\">หน้าหลัก</a>/")
                            </script>';
            ?>
          </div>
          <div class="ml-auto">
            <button class="btn btn-primary btn-sm" id="new_folder"><i class="fa fa-plus"></i> Add โฟลเดอร์</button>
            <button class="btn btn-primary btn-sm" id="new_file"><i class="fa fa-upload"></i> Add ไฟล์</button>
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
                  <?php
                  foreach ($folders as $row) :
                  ?>
                    <tr class='folder-item' data-id="<?php echo $row['id'] ?>">
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
                  ?>
                    <tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">
                      <td style="text-align: left;">
                        <span><i class="fa <?php echo $icon ?>"></i></span><b class="to_file"> <?php echo $name ?></b>
                        <input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">
                      </td>
                      <td><i class="to_file"><?php
                                              $timestamp = strtotime($row['date_updated']);
                                              $year_buddhist = date('Y', $timestamp) + 543;
                                              $date_buddhist = date('d/m/', $timestamp) . $year_buddhist . date(' h:i A', $timestamp);
                                              echo $date_buddhist; ?></i></td>
                      <td><i class="to_file"><?php echo $row['description'] ?></i></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
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

<script>
  $('#new_folder').click(function() {
    uni_modal('', 'manage_folder.php?fid=<?php echo $folder_parent ?>');
  });
  $('#new_file').click(function() {
    uni_modal('', 'manage_files.php?fid=<?php echo $folder_parent ?>');
  });
  $('.folder-item').dblclick(function() {
    location.href = 'index.php?page=files&fid=' + $(this).attr('data-id');
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
      uni_modal('Rename Folder', 'manage_folder.php?fid=<?php echo $folder_parent ?>&id=' + $(this).attr('data-id'));
    });
    $("div.custom-menu .delete").click(function(e) {
      e.preventDefault();
      _conf("คุณแน่ใจที่จะลบโฟลเดอร์นี้หรือไม่?", 'delete_folder', [$(this).attr('data-id')]);
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
      window.open('download.php?id=' + $(this).attr('data-id'));
    });

    $('.rename_file').keypress(function(e) {
      var _this = $(this);
      if (e.which == 13) {
        start_load();
        $.ajax({
          url: 'ajax.php?action=file_rename',
          method: 'POST',
          data: {
            id: $(this).attr('data-id'),
            name: $(this).val(),
            type: $(this).attr('data-type'),
            folder_id: '<?php echo $folder_parent ?>'
          },
          success: function(resp) {
            if (typeof resp != 'undefined') {
              resp = JSON.parse(resp);
              if (resp.status == 1) {
                _this.siblings('b.to_file').text(resp.new_name);
                _this.hide();
                _this.siblings('b.to_file').show();
                end_load();
              }
            }
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
    uni_modal($(this).attr('data-name'), 'manage_files.php?<?php echo $folder_parent ?>&id=' + $(this).attr('data-id'));
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

  function delete_folder($id) {
    start_load();
    $.ajax({
      url: 'ajax.php?action=delete_folder',
      method: 'POST',
      data: {
        id: $id
      },
      success: function(resp) {
        if (resp == 1) {
          alert_toast("Folder successfully deleted.", 'success');
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

  function delete_file($id) {
    start_load();
    $.ajax({
      url: 'ajax.php?action=delete_file',
      method: 'POST',
      data: {
        id: $id
      },
      success: function(resp) {
        if (resp == 1) {
          alert_toast("File successfully deleted.", 'success');
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
</script>