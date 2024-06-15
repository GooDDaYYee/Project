    <?php
    session_start();
    if (!$_SESSION['login']) {
        header("location: login.php");
        exit(0);
    }

    include_once("header.php");

    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $pageFile = $page . '.php';

    if (!file_exists($pageFile)) {
        $pageFile = 'home.php';
    }

    include $pageFile;

    include_once("footer.php");
    ?>

    <div id="preloader"></div>
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
    </script>