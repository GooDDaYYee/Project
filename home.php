<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="containe-fluid">
		<?php include('connect.php');
		$files = $con->query("SELECT f.*, e.employee_name as uname 
                      FROM files f 
                      INNER JOIN users u ON u.user_id = f.user_id 
                      INNER JOIN employee e ON e.employee_id = u.employee_id 
                      WHERE f.is_public = 1 
                      ORDER BY DATE(f.files_date) DESC");
		?>
		<div class="row">
			<div class="col-lg-12">
				<div class="card col-md-2 offset-2 bg-info float-left">
					<div class="card-body text-white">
						<h5><b>ผู้ใช้</b></h5>
						<hr>
						<span class="card-icon"><i class="fa fa-users"></i></span>
						<h3 class="text-right"><b>
								<?php
								$stmt = $con->query('SELECT * FROM users');
								echo $stmt->rowCount();
								?>
							</b></h3>
					</div>
				</div>
				<div class="card col-md-2 bg-success offset-2 ml-1 float-left">
					<div class="card-body text-white">
						<h5><b>พนักงานเอกสาร</b></h5>
						<hr>
						<span class="card-icon"><i class="fa fa-users"></i></span>
						<h3 class="text-right"><b>
								<?php
								$stmt = $con->query("SELECT * FROM employee WHERE employee_position = 'พนักงานเอกสาร'");
								echo $stmt->rowCount();
								?>
							</b></h3>
					</div>
				</div>
				<div class="card col-md-2 bg-warning offset-2 ml-1 float-left">
					<div class="card-body text-white">
						<h5><b>พนักงานปฏิบัติงาน</b></h5>
						<hr>
						<span class="card-icon"><i class="fa fa-users"></i></span>
						<h3 class="text-right"><b>
								<?php
								$stmt = $con->query("SELECT * FROM employee WHERE employee_position = 'พนักงานปฏิบัติงาน'");
								echo $stmt->rowCount();
								?>
							</b></h3>
					</div>
				</div>
				<div class="card col-md-2 bg-primary offset-2 ml-1 float-left">
					<div class="card-body text-white">
						<h5><b>ไฟล์</b></h5>
						<hr>
						<span class="card-icon"><i class="fa fa-file"></i></span>
						<h3 class="text-right"><b>
								<?php
								$stmt = $con->query('SELECT * FROM files');
								echo $stmt->rowCount();
								?>
							</b></h3>
					</div>
				</div>
			</div>
		</div>&nbsp;

		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;แชร์ไฟล์
				<!-- Topbar Search -->
				<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
					<div class="input-group">
						<input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
					</div>
				</form>
			</div>
			<div class="row mt-3 ml-3 mr-3">
				<div class="col-md-12">
					<div class="card border h-100">
						<table width="100%" class="table-striped">
							<thead>
								<tr>
									<th style="padding-top: 10px;" width="20%" scope="col">
										<h5>ผู้แชร์</h5>
									</th>
									<th style="padding-top: 10px;" width="30%" scope="col">
										<h5>เอกสาร</h5>
									</th>
									<th style="padding-top: 10px;" width="20%" scope="col">
										<h5>วันที่</h5>
									</th>
									<th style="padding-top: 10px;" width="30%" scope="col">
										<h5>รายละเอียด</h5>
									</th>
								</tr>
							</thead>
							<?php
							while ($row = $files->fetch(PDO::FETCH_ASSOC)) :
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
								<tr class='file-item' data-id="<?php echo $row['files_id'] ?>" data-name="<?php echo $name ?>">
									<td><i class="to_file"><?php echo ucwords($row['uname']) ?></i></td>
									<td>
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
							<?php endwhile; ?>
						</table>
						<div class="pagination-container">
							<nav aria-label="Page navigation">
								<ul class="pagination justify-content-center">
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
			&nbsp;
		</div>
		<div id="menu-file-clone" style="display: none;">
			<a href="javascript:void(0)" class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span>Download</a>
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

	$(document).ready(function() {
		var rowsPerPage = 20;
		var totalRows = $('tbody tr').length;
		var totalPages = Math.ceil(totalRows / rowsPerPage);

		for (var i = 1; i <= totalPages; i++) {
			$('.pagination').append('<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>');
		}

		$('tbody tr').hide();
		$('tbody tr').slice(0, rowsPerPage).show();
		$('.pagination li:first-child').addClass('active');

		$('.pagination li').on('click', function(e) {
			e.preventDefault();
			var currentPage = $(this).index() + 1;
			var startRow = (currentPage - 1) * rowsPerPage;
			var endRow = startRow + rowsPerPage;

			$('tbody tr').hide();
			$('tbody tr').slice(startRow, endRow).show();

			$('.pagination li').removeClass('active');
			$(this).addClass('active');
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