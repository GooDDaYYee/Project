<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include dirname(__FILE__) . '/../connect.php';

$meta = [];
if (isset($_GET['files_id'])) {
	$stmt = $con->prepare("SELECT * FROM files WHERE files_id = :files_id");
	$stmt->execute([':files_id' => $_GET['files_id']]);
	$meta = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="container-fluid">
	<form action="" id="manage-files">
		<input type="hidden" name="files_id" value="<?php echo $_GET['files_id'] ?? ''; ?>">
		<input type="hidden" name="folders_id" value="<?php echo $_GET['fid'] ?? ''; ?>">
		<?php if (!isset($_GET['files_id']) || empty($_GET['files_id'])) : ?>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Upload</span>
				</div>
				<div class="custom-file">
					<input type="file" class="custom-file-input" name="upload[]" id="upload" onchange="displayname(this,$(this))" multiple accept="*/*">
					<label class="custom-file-label" for="upload">เลือกไฟล์</label>
				</div>
			</div>
		<?php endif; ?>
		<div class="form-group">
			<label for="description" class="control-label">รายละเอียด</label>
			<textarea name="description" id="description" cols="30" rows="10" class="form-control"><?php echo $meta['description'] ?? ''; ?></textarea>
		</div>
		<div class="form-group">
			<label for="is_public" class="control-label">
				<input type="checkbox" name="is_public" id="is_public" <?php echo isset($meta['is_public']) && $meta['is_public'] == 1 ? 'checked' : ''; ?>>
				แชร์เอกสาร
			</label>
		</div>
		<div class="form-group" id="msg"></div>
	</form>
</div>
<script>
	$(document).ready(function() {
		$('#manage-files').submit(function(e) {
			e.preventDefault();
			$('#msg').html('');
			$.ajax({
				url: 'files/ajax.php?action=save_files',
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				success: function(resp) {
					try {
						resp = JSON.parse(resp);
						if (resp.status == 1) {
							Swal.fire({
								icon: 'success',
								title: 'สำเร็จ',
								text: 'เพิ่มไฟล์ใหม่สำเร็จแล้ว',
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

	function displayname(input, _this) {
		if (input.files && input.files.length > 0) {
			var filenames = Array.from(input.files).map(file => file.name);
			_this.siblings('label').html(filenames.join(', '));
		}
	}
</script>