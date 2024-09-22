<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card col-md-2 offset-2 bg-info float-left">
                <div class="card-body text-white">
                    <h5><b>ผู้ใช้</b></h5>
                    <hr>
                    <span class="card-icon"><i class="fa fa-users"></i></span>
                    <h3 class="text-right"><b><?php echo $data['users_count']; ?></b></h3>
                </div>
            </div>
            <div class="card col-md-2 bg-success offset-2 ml-1 float-left">
                <div class="card-body text-white">
                    <h5><b>พนักงานเอกสาร</b></h5>
                    <hr>
                    <span class="card-icon"><i class="fa fa-users"></i></span>
                    <h3 class="text-right"><b><?php echo $data['document_employees_count']; ?></b></h3>
                </div>
            </div>
            <div class="card col-md-2 bg-warning offset-2 ml-1 float-left">
                <div class="card-body text-white">
                    <h5><b>พนักงานปฏิบัติงาน</b></h5>
                    <hr>
                    <span class="card-icon"><i class="fa fa-users"></i></span>
                    <h3 class="text-right"><b><?php echo $data['operational_employees_count']; ?></b></h3>
                </div>
            </div>
            <div class="card col-md-2 bg-primary offset-2 ml-1 float-left">
                <div class="card-body text-white">
                    <h5><b>ไฟล์</b></h5>
                    <hr>
                    <span class="card-icon"><i class="fa fa-file"></i></span>
                    <h3 class="text-right"><b><?php echo $data['files_count']; ?></b></h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->

<script>
    //FILE
    $('.file-item').bind("contextmenu", function(event) {
        event.preventDefault();

        $('.file-item').removeClass('active')
        $(this).addClass('active')
        $("div.custom-menu").hide();
        var custom = $("<div class='custom-menu file'></div>")
        custom.append($('#menu-file-clone').html())
        custom.find('.download').attr('data-id', $(this).attr('data-id'))
        custom.appendTo("body")
        custom.css({
            top: event.pageY + "px",
            left: event.pageX + "px"
        });

        $("div.file.custom-menu .download").click(function(e) {
            e.preventDefault()
            window.open('files/download.php?id=' + $(this).attr('data-id'))
        })
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
    })

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