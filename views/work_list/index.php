<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp; รายการปฏิบัติงาน
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
                </div>
            </form>
        </div>

        <div class="container-fluid">
            <div class="col-lg-12 card-body">
                <div class="row">
                    <div id="breadcrumbs">
                        <a href="index.php?page=<?= base64_encode('work_list') ?>">หน้าหลัก</a> /
                        <?php foreach ($data['breadcrumbs'] as $crumb): ?>
                            <a href="index.php?page=<?= base64_encode('work_list') ?>&fid=<?= base64_encode($crumb['folders_id']) ?>"><?= htmlspecialchars($crumb['name']) ?></a> /
                        <?php endforeach; ?>
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
                                    <?php foreach ($data['folders'] as $folder): ?>
                                        <tr class='folder-item' data-id="<?= $folder['folders_id'] ?>">
                                            <td style="text-align: left;">
                                                <span><i class="fa fa-folder"></i></span><b class="to_folder"> <?= htmlspecialchars($folder['name']) ?></b>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php foreach ($data['files'] as $file): ?>
                                        <tr class='file-item' data-id="<?= $file['files_id'] ?>" data-name="<?= htmlspecialchars($file['name']) ?>">
                                            <td style="text-align: left;">
                                                <span><i class="fa <?= $this->getFileIcon($file['file_type']) ?>"></i></span><b class="to_file"> <?= htmlspecialchars($file['name']) ?></b>
                                                <input type="text" class="rename_file" value="<?= htmlspecialchars($file['name']) ?>" data-id="<?= $file['files_id'] ?>" data-type="<?= $file['file_type'] ?>" style="display: none">
                                            </td>
                                            <td><i class="to_file"><?= $this->formatDate($file['files_date']) ?></i></td>
                                            <td><i class="to_file"><?= htmlspecialchars($file['description']) ?></i></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="pagination-container">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center"></ul>
                                </nav>
                            </div>
                        </div>
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

<script>
    $(document).ready(function() {
        var rowsPerPage = 20;
        var $rows = $('tbody tr');
        var totalPages = Math.ceil($rows.length / rowsPerPage);

        function showPage(page) {
            var start = (page - 1) * rowsPerPage;
            var end = start + rowsPerPage;

            $rows.hide().slice(start, end).show();

            var $pagination = $('.pagination');
            $pagination.empty();

            var maxVisiblePages = 5;
            var startPage = Math.max(1, page - Math.floor(maxVisiblePages / 2));
            var endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            if (startPage > 1) {
                $pagination.append('<li class="page-item"><a class="page-link" href="#" data-page="1">&laquo; หน้าแรก</a></li>');
            }

            for (var i = startPage; i <= endPage; i++) {
                $pagination.append('<li class="page-item ' + (i === page ? 'active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>');
            }

            if (endPage < totalPages) {
                $pagination.append('<li class="page-item"><a class="page-link" href="#" data-page="' + totalPages + '">หน้าสุดท้าย &raquo;</a></li>');
            }
        }

        $('.pagination').on('click', 'a', function(e) {
            e.preventDefault();
            showPage(parseInt($(this).data('page')));
        });

        $('#search').on('keyup', function() {
            var searchTerm = $(this).val().toLowerCase();
            $rows.each(function() {
                var rowText = $(this).text().toLowerCase();
                $(this).toggle(rowText.indexOf(searchTerm) > -1);
            });
        });
        $('.folder-item').dblclick(function() {
            var encodedPage = btoa('work_list');
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
                var folderId = $(this).attr('data-id');
                var newName = prompt("Enter new folder name:");
                if (newName) {
                    $.ajax({
                        url: 'index.php?action=renameFolder',
                        method: 'POST',
                        data: {
                            folder_id: folderId,
                            new_name: newName
                        },
                        success: function(response) {
                            var result = JSON.parse(response);
                            if (result.success) {
                                location.reload();
                            } else {
                                alert("Failed to rename folder.");
                            }
                        }
                    });
                }
            });

            $("div.custom-menu .delete").click(function(e) {
                e.preventDefault();
                var folderId = $(this).attr('data-id');
                if (confirm("Are you sure you want to delete this folder?")) {
                    $.ajax({
                        url: 'index.php?action=deleteFolder',
                        method: 'POST',
                        data: {
                            folder_id: folderId
                        },
                        success: function(response) {
                            var result = JSON.parse(response);
                            if (result.success) {
                                location.reload();
                            } else {
                                alert("Failed to delete folder.");
                            }
                        }
                    });
                }
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
                fileItem.find('input.rename_file').show().focus();
            });

            $("div.file.custom-menu .delete").click(function(e) {
                e.preventDefault();
                var fileId = $(this).attr('data-id');
                if (confirm("Are you sure you want to delete this file?")) {
                    $.ajax({
                        url: 'index.php?action=deleteFile',
                        method: 'POST',
                        data: {
                            file_id: fileId
                        },
                        success: function(response) {
                            var result = JSON.parse(response);
                            if (result.success) {
                                location.reload();
                            } else {
                                alert("Failed to delete file.");
                            }
                        }
                    });
                }
            });

            $("div.file.custom-menu .download").click(function(e) {
                e.preventDefault();
                window.open('index.php?action=downloadFile&id=' + $(this).attr('data-id'));
            });
        });

        $('.rename_file').keypress(function(e) {
            var _this = $(this);
            if (e.which == 13) {
                $.ajax({
                    url: 'index.php?action=renameFile',
                    method: 'POST',
                    data: {
                        file_id: $(this).attr('data-id'),
                        new_name: $(this).val(),
                    },
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.success) {
                            _this.siblings('b.to_file').text(_this.val());
                            _this.hide();
                            _this.siblings('b.to_file').show();
                        } else {
                            alert("Failed to rename file.");
                        }
                    }
                });
            }
        });

        $(document).bind("click", function(event) {
            $("div.custom-menu").hide();
            $('.file-item').removeClass('active');
        });

        $(document).keyup(function(e) {
            if (e.keyCode === 27) {
                $("div.custom-menu").hide();
                $('.file-item').removeClass('active');
            }
        });

        // Initial page load
        showPage(1);
    });
</script>