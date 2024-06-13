<?php
include 'connect.php';
$folder_parent = isset($_GET['fid']) ? $_GET['fid'] : 0;

// Prepared statement to prevent SQL injection
$stmt = $con->prepare("SELECT * FROM folders WHERE parent_id = :parent_id AND user_id = :user_id ORDER BY name ASC");
$stmt->bindParam(':parent_id', $folder_parent, PDO::PARAM_INT);
$stmt->bindParam(':user_id', $_SESSION['login'], PDO::PARAM_STR);
$stmt->execute();
$folders = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $con->prepare("SELECT * FROM files WHERE folder_id = :folder_id AND user_id = :user_id ORDER BY name ASC");
$stmt->bindParam(':folder_id', $folder_parent, PDO::PARAM_INT);
$stmt->bindParam(':user_id', $_SESSION['login'], PDO::PARAM_STR);
$stmt->execute();
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Include HTML and CSS here -->
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <!-- Main Content -->
  <div id="content">
    <!-- Include Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Search -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
          <input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
          <div class="input-group-append">
            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa fa-search"></i></span>
          </div>
        </div>
      </form>

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
          </a>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small "><?php echo $_SESSION['name'] . ' ' . $_SESSION['lastname']; ?></span>
            <img class="img-profile rounded-circle" src="img/picture.png">
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- List table -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-ui-checks" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z" />
            <path fill-rule="evenodd" d="M2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646l2-2a.5.5 0 1 0-.708-.708L2.5 4.293l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0zm0 8l2-2a.5.5 0 0 0-.708-.708L2.5 12.293l-.646-.647a.5.5 0 0 0-.708.708l1 1a.5.5 0 0 0 .708 0z" />
            <path d="M7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z" />
            <path fill-rule="evenodd" d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
          </svg>&nbsp;จัดการไฟล์
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
                <h4><b>โฟลเดอร์</b></h4>
              </div>
            </div>
            <div class="row">
              <?php
              foreach ($folders as $row) :
              ?>
                <div class="card col-md-3 mt-2 ml-2 mr-2 mb-2 folder-item" data-id="<?php echo $row['id'] ?>">
                  <div class="card-body">
                    <large><span><i class="fa fa-folder"></i></span><b class="to_folder"> <?php echo $row['name'] ?></b></large>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <hr>
            <div class="row">
              <div class="card col-md-12">
                <div class="card-body">
                  <table width="100%">
                    <tr>
                      <th width="40%" class="">ไฟล์</th>
                      <th width="20%" class="">วันที่</th>
                      <th width="40%" class="">รายละเอียด</th>
                    </tr>
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
                        <td>
                          <large><span><i class="fa <?php echo $icon ?>"></i></span><b class="to_file"> <?php echo $name ?></b></large>
                          <input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">
                        </td>
                        <td><i class="to_file"><?php echo date('Y/m/d h:i A', strtotime($row['date_updated'])) ?></i></td>
                        <td><i class="to_file"><?php echo $row['description'] ?></i></td>
                      </tr>
                    <?php endforeach; ?>
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
  </div>
</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

<script>
  $('#new_folder').click(function() {
    uni_modal('', 'manage_folder.php?fid=<?php echo $folder_parent ?>')
  })
  $('#new_file').click(function() {
    uni_modal('', 'manage_files.php?fid=<?php echo $folder_parent ?>')
  })
  $('.folder-item').dblclick(function() {
    location.href = 'index.php?page=files&fid=' + $(this).attr('data-id')
  })
  $('.folder-item').bind("contextmenu", function(event) {
    event.preventDefault();
    $("div.custom-menu").hide();
    var custom = $("<div class='custom-menu'></div>")
    custom.append($('#menu-folder-clone').html())
    custom.find('.edit').attr('data-id', $(this).attr('data-id'))
    custom.find('.delete').attr('data-id', $(this).attr('data-id'))
    custom.appendTo("body")
    custom.css({
      top: event.pageY + "px",
      left: event.pageX + "px"
    });

    $("div.custom-menu .edit").click(function(e) {
      e.preventDefault()
      uni_modal('Rename Folder', 'manage_folder.php?fid=<?php echo $folder_parent ?>&id=' + $(this).attr('data-id'))
    })
    $("div.custom-menu .delete").click(function(e) {
      e.preventDefault()
      _conf("คุณแน่ใจที่จะลบโฟลเดอร์นี้หรือไม่?", 'delete_folder', [$(this).attr('data-id')])
    })
  })

  //FILE
  $('.file-item').bind("contextmenu", function(event) {
    event.preventDefault();

    $('.file-item').removeClass('active')
    $(this).addClass('active')
    $("div.custom-menu").hide();
    var custom = $("<div class='custom-menu file'></div>")
    custom.append($('#menu-file-clone').html())
    custom.find('.edit').attr('data-id', $(this).attr('data-id'))
    custom.find('.delete').attr('data-id', $(this).attr('data-id'))
    custom.find('.download').attr('data-id', $(this).attr('data-id'))
    custom.appendTo("body")
    custom.css({
      top: event.pageY + "px",
      left: event.pageX + "px"
    });

    $("div.file.custom-menu .edit").click(function(e) {
      e.preventDefault()
      $('.rename_file[data-id="' + $(this).attr('data-id') + '"]').siblings('large').hide();
      $('.rename_file[data-id="' + $(this).attr('data-id') + '"]').show();
    })
    $("div.file.custom-menu .delete").click(function(e) {
      e.preventDefault()
      _conf("คุณแน่ใจหรือว่าจะลบไฟล์นี้?", 'delete_file', [$(this).attr('data-id')])
    })
    $("div.file.custom-menu .download").click(function(e) {
      e.preventDefault()
      window.open('download.php?id=' + $(this).attr('data-id'))
    })

    $('.rename_file').keypress(function(e) {
      var _this = $(this)
      if (e.which == 13) {
        start_load()
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
            if (typeof resp != undefined) {
              resp = JSON.parse(resp);
              if (resp.status == 1) {
                _this.siblings('large').find('b').html(resp.new_name);
                end_load();
                _this.hide()
                _this.siblings('large').show()
              }
            }
          }
        })
      }
    })
  })
  //FILE

  $('.file-item').click(function() {
    if ($(this).find('input.rename_file').is(':visible') == true)
      return false;
    uni_modal($(this).attr('data-name'), 'manage_files.php?<?php echo $folder_parent ?>&id=' + $(this).attr('data-id'))
  })
  $(document).bind("click", function(event) {
    $("div.custom-menu").hide();
    $('#file-item').removeClass('active')
  });
  $(document).keyup(function(e) {
    if (e.keyCode === 27) {
      $("div.custom-menu").hide();
      $('#file-item').removeClass('active')
    }
  });
  $(document).ready(function() {
    $('#search').keyup(function() {
      var _f = $(this).val().toLowerCase()
      $('.to_folder').each(function() {
        var val = $(this).text().toLowerCase()
        if (val.includes(_f))
          $(this).closest('.card').toggle(true);
        else
          $(this).closest('.card').toggle(false);
      })
      $('.to_file').each(function() {
        var val = $(this).text().toLowerCase()
        if (val.includes(_f))
          $(this).closest('tr').toggle(true);
        else
          $(this).closest('tr').toggle(false);
      })
    })
  })

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
          alert_toast("Folder successfully deleted.", 'success')
          setTimeout(function() {
            location.reload()
          }, 1500)
        }
      }
    })
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
          alert_toast("Folder successfully deleted.", 'success')
          setTimeout(function() {
            location.reload()
          }, 1500)
        }
      }
    })
  }
</script>