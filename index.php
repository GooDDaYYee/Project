    <?php
    session_start();
    if (!$_SESSION['login']) {
        header("location: login.php");
        exit(0);
    }

    include_once("header.php");

    ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                    </li>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small "><?php echo $_SESSION['name'] . ' ' . $_SESSION['lastname']; ?></span>
                            <img class="img-profile rounded-circle" src="img/picture.png">
                        </a>
                        <!-- Dropdown - User Information -->
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

            <?php

            $page = isset($_GET['page']) ? $_GET['page'] : 'home';
            $pageFile = $page . '.php';

            if (!file_exists($pageFile)) {
                $pageFile = 'home.php';
            }

            include $pageFile;

            ?>
        </div>
    </div>

    <?php
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