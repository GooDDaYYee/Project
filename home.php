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

		<!-- Begin Page Content -->
		<div class="container-fluid">
			<div class="containe-fluid">
				<?php include('connect.php');
				$files = $con->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.user_id = f.user_id where  f.is_public = 1 order by date(f.date_updated) desc");
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
								<h5><b>Files</b></h5>
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
				</div>

				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-ui-checks" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z" />
							<path fill-rule="evenodd" d="M2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646l2-2a.5.5 0 1 0-.708-.708L2.5 4.293l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0zm0 8l2-2a.5.5 0 0 0-.708-.708L2.5 12.293l-.646-.647a.5.5 0 0 0-.708.708l1 1a.5.5 0 0 0 .708 0z" />
							<path d="M7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z" />
							<path fill-rule="evenodd" d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
						</svg>&nbsp;แชร์ไฟล์
					</div>
					<div class="row mt-3 ml-3 mr-3">
						<div class="card col-md-12">
							<div class="card-body">
								<table width="100%">
									<tr>
										<th width="20%" class="">ผู้แชร์</th>
										<th width="30%" class="">เอกสาร</th>
										<th width="20%" class="">วันที่</th>
										<th width="30%" class="">รายละเอียด</th>
									</tr>
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
									?>
										<tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">
											<td><i><?php echo ucwords($row['uname']) ?></i></td>
											<td>
												<large><span><i class="fa <?php echo $icon ?>"></i></span><b> <?php echo $name ?></b></large>
												<input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">
											</td>
											<td><i><?php echo date('Y/m/d h:i A', strtotime($row['date_updated'])) ?></i></td>
											<td><i><?php echo $row['description'] ?></i></td>
										</tr>
									<?php endwhile; ?>
								</table>
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
			window.open('download.php?id=' + $(this).attr('data-id'))
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
</script>