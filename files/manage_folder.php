<?php
include dirname(__FILE__) . '/../connect.php';
if (isset($_GET['folders_id'])) {
	$qry = $con->query("SELECT * FROM folders WHERE folders_id=" . $_GET['folders_id']);
	if ($qry->rowCount() > 0) {
		$meta = $qry->fetch(PDO::FETCH_ASSOC);
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-folder">
		<input type="hidden" name="folders_id" value="<?php echo isset($_GET['folders_id']) ? $_GET['folders_id'] : '' ?>">
		<input type="hidden" name="parent_id" value="<?php echo isset($_GET['fid']) ? $_GET['fid'] : '' ?>">
		<div class="form-group">
			<label for="name" class="control-label">
				<h5><b>ชื่อโฟลเดอร์</b></h5>
			</label>
			<input type="text" name="name" id="name" value="<?php echo isset($meta['name']) ? $meta['name'] : '' ?>" class="form-control">
		</div>
		<div class="form-group" id="msg"></div>
	</form>
</div>
<script>
	$(document).ready(function() {
		$('#manage-folder').submit(function(e) {
			start_load();
			e.preventDefault();
			$('#msg').html('');
			$.ajax({
				url: 'files/ajax.php?action=save_folder',
				method: 'POST',
				data: $(this).serialize(),
				success: function(resp) {
					if (typeof resp != undefined) {
						resp = JSON.parse(resp);
					}
				},
				complete: function() {
					setTimeout(function() {
						end_load();
						location.reload();
					}, 1000); // 5000 milliseconds = 5 seconds
				}
			});
			setTimeout(function() {
				end_load();
				location.reload();
			}, 1000); // 5000 milliseconds = 5 seconds

		});
	});
</script>