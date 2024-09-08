<?php
session_start();

class Action
{
	private $db;

	public function __construct()
	{
		include dirname(__FILE__) . '/../connect.php';
		$this->db = $con;
	}

	function __destruct()
	{
		$this->db = null;
	}

	private function add_log($log_status, $log_detail, $user_id)
	{
		$stmt = $this->db->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
		$stmt->execute([':log_status' => $log_status, ':log_detail' => $log_detail, ':user_id' => $user_id]);
	}

	function save_folder()
	{
		extract($_POST);
		$data = ["name" => $name, "parent_id" => $parent_id, "folders_type" => 1];

		if (empty($folders_id)) {
			$data["user_id"] = $_SESSION['user_id'];

			$stmt = $this->db->prepare("SELECT COUNT(*) FROM folders WHERE user_id = :user_id AND name = :name AND parent_id = :parent_id");
			$stmt->execute([':user_id' => $_SESSION['user_id'], ':name' => $name, ':parent_id' => $parent_id]);
			$check = $stmt->fetchColumn();

			if ($check > 0) {
				return json_encode(['status' => 2, 'msg' => 'ชื่อโฟลเดอร์ซ้ำในระดับเดียวกัน']);
			}

			$stmt = $this->db->prepare("INSERT INTO folders (name, parent_id, folders_type, user_id) VALUES (:name, :parent_id, :folders_type, :user_id)");
			$stmt->execute($data);
			$new_folder_id = $this->db->lastInsertId();

			$folder_path = $this->get_folder_path($parent_id) . '/' . $name;
			$full_path = 'uploads/' . $folder_path;

			if (!file_exists($full_path) && mkdir($full_path, 0755, true)) {
				$this->add_log('Folder Created', 'Folder name: ' . $name, $_SESSION['user_id']);
				return json_encode(['status' => 1, 'msg' => 'Folder created successfully']);
			} else {
				$this->db->prepare("DELETE FROM folders WHERE folders_id = ?")->execute([$new_folder_id]);
				return json_encode(['status' => 2, 'msg' => 'กรุณาใส่ชื่อโฟลเดอร์']);
			}
		} else {
			$stmt = $this->db->prepare("SELECT COUNT(*) FROM folders WHERE user_id = :user_id AND name = :name AND folders_id != :folders_id AND parent_id = :parent_id");
			$stmt->execute([':user_id' => $_SESSION['user_id'], ':name' => $name, ':folders_id' => $folders_id, ':parent_id' => $parent_id]);
			$check = $stmt->fetchColumn();

			if ($check > 0) {
				return json_encode(['status' => 2, 'msg' => 'ชื่อโฟลเดอร์ซ้ำในระดับเดียวกัน']);
			}

			$old_name = $this->db->query("SELECT name FROM folders WHERE folders_id = " . $folders_id)->fetchColumn();
			$stmt = $this->db->prepare("UPDATE folders SET name = :name, parent_id = :parent_id WHERE folders_id = :folders_id");
			$stmt->execute([':name' => $name, ':parent_id' => $parent_id, ':folders_id' => $folders_id]);

			$old_path = 'uploads/' . $this->get_folder_path($parent_id) . '/' . $old_name;
			$new_path = 'uploads/' . $this->get_folder_path($parent_id) . '/' . $name;

			if (rename($old_path, $new_path)) {
				$this->add_log('Folder Updated', 'Folder name: ' . $name, $_SESSION['user_id']);
				return json_encode(['status' => 1, 'msg' => 'Folder updated successfully']);
			} else {
				return json_encode(['status' => 2, 'msg' => 'Failed to rename folder in filesystem']);
			}
		}
	}

	private function get_folder_path($folder_id)
	{
		$path = '';
		while ($folder_id != 0) {
			$folder_query = $this->db->prepare("SELECT name, parent_id FROM folders WHERE folders_id = :folder_id");
			$folder_query->bindParam(':folder_id', $folder_id);
			$folder_query->execute();
			$folder = $folder_query->fetch(PDO::FETCH_ASSOC);
			$path = $folder['name'] . '/' . $path;
			$folder_id = $folder['parent_id'];
		}
		return rtrim($path, '/');
	}

	private function delete_folder_recursively($folder_path)
	{
		$files = glob($folder_path . '/*');
		foreach ($files as $file) {
			if (is_dir($file)) {

				$this->delete_folder_recursively($file);
			} else {
				unlink($file);
			}
		}

		rmdir($folder_path);
	}

	private function delete_child_folders($parent_id)
	{
		$child_folders = $this->db->query("SELECT folders_id, name FROM folders WHERE parent_id=" . $parent_id);
		while ($child_folder = $child_folders->fetch(PDO::FETCH_ASSOC)) {
			$child_folder_id = $child_folder['folders_id'];
			$child_folder_path = 'uploads/' . $this->get_folder_path($child_folder_id);

			$this->db->query("DELETE FROM files WHERE folders_id=" . $child_folder_id);

			$this->delete_child_folders($child_folder_id);
			if (is_dir($child_folder_path)) {
				$this->delete_folder_recursively($child_folder_path);
			}
			$this->db->query("DELETE FROM folders WHERE folders_id=" . $child_folder_id);
		}
	}

	function delete_folder()
	{
		extract($_POST);

		$folder = $this->db->query("SELECT name, parent_id FROM folders WHERE folders_id=" . $folders_id)->fetch(PDO::FETCH_ASSOC);
		$folder_name = $folder['name'];
		$parent_id = $folder['parent_id'];
		$folder_path = 'uploads/' . $this->get_folder_path($folders_id); // Path to the folder in uploads

		$this->db->query("DELETE FROM files WHERE folders_id=" . $folders_id);

		$this->delete_child_folders($folders_id);

		if (is_dir($folder_path)) {
			$this->delete_folder_recursively($folder_path);
		}

		$delete = $this->db->query("DELETE FROM folders WHERE folders_id =" . $folders_id);
		if ($delete) {
			$this->add_log('Folder Deleted', 'Folder name: ' . $folder_name, $_SESSION['user_id']);
			echo 1;
		}
	}

	function delete_file()
	{
		extract($_POST);
		$file_details = $this->db->query("SELECT name, file_path FROM files WHERE files_id=" . $files_id)->fetch(PDO::FETCH_ASSOC);
		$delete = $this->db->query("DELETE FROM files WHERE files_id =" . $files_id);
		if ($delete) {
			$file_path = 'uploads/' . $file_details['file_path'];
			if (file_exists($file_path)) {
				unlink($file_path);
			}
			$this->add_log('File Deleted', 'File name: ' . $file_details['name'], $_SESSION['user_id']);
			return 1;
		}
	}

	function save_files()
	{
		extract($_POST);
		$folders_id = !empty($folders_id) ? $folders_id : NULL;
		$upload_errors = array();

		if (empty($files_id)) {
			if (!empty($_FILES['upload']['tmp_name'][0])) {
				foreach ($_FILES['upload']['tmp_name'] as $key => $tmp_name) {
					// File validation
					$file_name = $_FILES['upload']['name'][$key];
					$file_size = $_FILES['upload']['size'][$key];
					$file_tmp = $_FILES['upload']['tmp_name'][$key];
					$file_type = $_FILES['upload']['type'][$key];
					$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

					$extensions = array("jpeg", "jpg", "png", "gif", "pdf", "doc", "docx", "xls", "xlsx", "txt");

					if (!in_array($file_ext, $extensions)) {
						$upload_errors[] = "Extension not allowed: $file_name";
						continue;
					}

					if ($file_size > 5242880) { // 5 MB file size limit
						$upload_errors[] = "File size must be less than 5 MB: $file_name";
						continue;
					}

					$fname = strtotime(date("y-m-d H:i")) . '_' . $file_name;
					$folder_path = $folders_id ? $this->get_folder_path($folders_id) : '';
					$file_path = 'uploads/' . ($folder_path ? $folder_path . '/' : '') . $fname;

					$move = move_uploaded_file($file_tmp, $file_path);

					if ($move) {
						$file = explode('.', $file_name);
						$chk = $this->db->query("SELECT * FROM files WHERE SUBSTRING_INDEX(name,' ||',1) = '" . $file[0] . "' and (folders_id = '" . $folders_id . "' OR folders_id IS NULL) and file_type='" . $file[1] . "' ");
						if ($chk->rowCount() > 0) {
							$file[0] = $file[0] . ' ||' . ($chk->rowCount());
						}
						$data = " name = '" . $file[0] . "' ";
						$data .= ", folders_id = " . ($folders_id !== NULL ? "'" . $folders_id . "'" : "NULL") . " ";
						$data .= ", description = '" . $description . "' ";
						$data .= ", user_id = '" . $_SESSION['user_id'] . "' ";
						$data .= ", file_type = '" . $file[1] . "' ";
						$data .= ", file_path = '" . $fname . "' ";
						$data .= ", is_public = " . (isset($is_public) && $is_public == 'on' ? 1 : 0);

						$save = $this->db->query("INSERT INTO files SET " . $data);
						if ($save) {
							$this->add_log('File Uploaded', 'File name: ' . $file[0], $_SESSION['user_id']);
						}
					} else {
						$upload_errors[] = "Failed to upload file: $file_name";
					}
				}
				if (empty($upload_errors)) {
					return json_encode(array('status' => 1, 'msg' => 'Files uploaded successfully'));
				} else {
					return json_encode(array('status' => 2, 'msg' => implode("<br>", $upload_errors)));
				}
			}
		} else {
			$data = " description = '" . $description . "' ";
			$data .= ", is_public = " . (isset($is_public) && $is_public == 'on' ? 1 : 0);
			$save = $this->db->query("UPDATE files SET " . $data . " WHERE files_id=" . $files_id);
			if ($save) {
				$this->add_log('File Updated', 'File ID: ' . $files_id, $_SESSION['user_id']);
				return json_encode(array('status' => 1, 'msg' => 'File updated successfully'));
			}
		}
	}


	function file_rename()
	{
		extract($_POST);
		$file_name = $name;
		$file_type = $type;

		// Check if a file with the same name exists in the same folder
		$chk = $this->db->prepare("SELECT * FROM files WHERE SUBSTRING_INDEX(name, ' ||', 1) = :file_name AND folders_id " . ($folders_id ? "= :folders_id" : "IS NULL") . " AND file_type = :file_type AND files_id != :files_id");
		$chk->bindParam(':file_name', $file_name);
		$chk->bindParam(':file_type', $file_type);
		$chk->bindParam(':files_id', $files_id);
		if ($folders_id) {
			$chk->bindParam(':folders_id', $folders_id);
		}
		$chk->execute();

		if ($chk->rowCount() > 0) {
			$count = $chk->rowCount();
			$file_name = $file_name . ' ||' . $count;
		}

		// Fetch the old file's name and path
		$old_file_query = $this->db->prepare("SELECT name, file_path, folders_id FROM files WHERE files_id = :files_id");
		$old_file_query->bindParam(':files_id', $files_id);
		$old_file_query->execute();
		$old_file = $old_file_query->fetch(PDO::FETCH_ASSOC);
		$old_name = $old_file['name'];
		$old_folders_id = $old_file['folders_id'];

		// Get the folder path
		$folder_path = $old_folders_id ? $this->get_folder_path($old_folders_id) : '';
		$old_path = 'uploads/' . ($folder_path ? $folder_path . '/' : '') . $old_file['file_path'];

		$new_file_name = $file_name . '.' . $file_type;
		$new_path = 'uploads/' . ($folder_path ? $folder_path . '/' : '') . $new_file_name;

		// Attempt to rename the file in the filesystem
		if (file_exists($old_path) && rename($old_path, $new_path)) {
			// Update the database with the new file name and path
			$update = $this->db->prepare("UPDATE files SET name = :file_name, file_path = :file_path WHERE files_id = :files_id");
			$update->bindParam(':file_name', $file_name);
			$update->bindParam(':file_path', $new_file_name);
			$update->bindParam(':files_id', $files_id);

			if ($update->execute()) {
				$this->add_log('File Renamed', 'Old name: ' . $old_name . ', New name: ' . $file_name, $_SESSION['user_id']);
				return json_encode(array('status' => 1, 'msg' => 'File renamed successfully', 'new_name' => $new_file_name));
			} else {
				// Revert the file rename if database update fails
				rename($new_path, $old_path);
				return json_encode(array('status' => 2, 'msg' => 'Failed to update file name in database'));
			}
		} else {
			// If the file doesn't exist or rename fails
			if (!file_exists($old_path)) {
				return json_encode(array('status' => 2, 'msg' => 'Old file does not exist'));
			} else {
				return json_encode(array('status' => 2, 'msg' => 'Failed to rename file in filesystem'));
			}
		}
	}
}
