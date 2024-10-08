<?php
if ($_SESSION["lv"] == 0 || $_SESSION["lv"] == 1 || $_SESSION["lv"] == 2) {
	include dirname(__FILE__) . '/../connect.php';
	$meta = [];
	if (isset($_GET['folders_id'])) {
		$stmt = $con->prepare("SELECT * FROM folders WHERE folders_id = :folders_id");
		$stmt->execute([':folders_id' => $_GET['folders_id']]);
		$meta = $stmt->fetch(PDO::FETCH_ASSOC);
	}
?>
	<div class="container-fluid">
		<form action="" id="manage-folder">
			<input type="hidden" name="folders_id" value="<?php echo $_GET['folders_id'] ?? ''; ?>">
			<input type="hidden" name="parent_id" value="<?php echo $_GET['fid'] ?? ''; ?>">
			<div class="form-group">
				<label for="name" class="control-label">
					<h5><b>ชื่อโฟลเดอร์</b></h5>
				</label>
				<input type="text" name="name" id="name" value="<?php echo $meta['name'] ?? ''; ?>" required=" " class="form-control">
			</div>
			<div class="form-group" id="msg"></div>
		</form>
	</div>
	<script>
		$(document).ready(function() {
			$('#manage-folder').submit(function(e) {
				e.preventDefault();
				$('#msg').html('');
				$.ajax({
					url: 'files/ajax.php?action=save_folder',
					method: 'POST',
					data: $(this).serialize(),
					success: function(resp) {
						try {
							resp = JSON.parse(resp);
							if (resp.status == 1) {
								Swal.fire({
									icon: 'success',
									title: 'สำเร็จ',
									text: resp.msg,
									timer: 1500,
									showConfirmButton: false
								}).then(function() {
									location.reload();
								});
							} else {
								$('#msg').html('<div class="alert alert-danger">' + resp.msg + '</div>');
							}
						} catch (e) {
							console.error('Error parsing response:', e);
							$('#msg').html('<div class="alert alert-danger">An unexpected error occurred.</div>');
						}
					},
					error: function() {
						$('#msg').html('<div class="alert alert-danger">An error occurred while processing your request.</div>');
					}
				});
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