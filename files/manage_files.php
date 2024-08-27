<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include dirname(__FILE__) . '/../connect.php';

if (isset($_GET['files_id'])) {
	$qry = $con->query("SELECT * FROM files WHERE files_id=" . $_GET['files_id']);
	$meta = $qry->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="container-fluid">
	<form action="" id="manage-files">
		<input type="hidden" name="files_id" value="<?php echo isset($_GET['files_id']) ? $_GET['files_id'] : '' ?>">
		<input type="hidden" name="folders_id" value="<?php echo isset($_GET['fid']) ? $_GET['fid'] : '' ?>">
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
			<label for="" class="control-label">รายละเอียด</label>
			<textarea name="description" id="" cols="30" rows="10" class="form-control"><?php echo isset($meta['description']) ? $meta['description'] : '' ?></textarea>
		</div>
		<div class="form-group">
			<label for="is_public" class="control-label"><input type="checkbox" name="is_public" id="is_public" <?php echo isset($meta['is_public']) && $meta['is_public'] == 1 ? 'checked' : '' ?>>
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
				type: 'POST',
				success: function(resp) {
					if (typeof resp != undefined) {
						resp = JSON.parse(resp);
						if (resp.status == 1) {
							Swal.fire({
								icon: 'success',
								title: 'Success',
								text: 'New File successfully added.',
								timer: 1500,
								showConfirmButton: false
							}).then(function() {
								location.reload();
							});
						} else {
							$('#msg').html('<div class="alert alert-danger">' + resp.msg + '</div>');
							end_load();
						}
					}
				}
			});
		});
	});


	function displayname(input, _this) {
		if (input.files && input.files.length > 0) {
			var filenames = [];
			for (var i = 0; i < input.files.length; i++) {
				filenames.push(input.files[i].name);
			}
			_this.siblings('label').html(filenames.join(', '));
		}
	}
</script>