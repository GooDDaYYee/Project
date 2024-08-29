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
		$stmt->bindParam(':log_status', $log_status);
		$stmt->bindParam(':log_detail', $log_detail);
		$stmt->bindParam(':user_id', $user_id);
		$stmt->execute();
	}

	function save_folder()
	{
		extract($_POST);
		$data = " name ='" . $name . "' ";
		$data .= ", parent_id ='" . $parent_id . "' ";

		if (empty($folders_id)) {
			$data .= ", user_id ='" . $_SESSION['user_id'] . "' ";

			$check = $this->db->query("SELECT * FROM folders WHERE user_id ='" . $_SESSION['user_id'] . "' and name ='" . $name . "' and parent_id ='" . $parent_id . "'")->rowCount();
			if ($check > 0) {
				return json_encode(array('status' => 2, 'msg' => 'ชื่อโฟลเดอร์ซ้ำในระดับเดียวกัน'));
			} else {
				$save = $this->db->query("INSERT INTO folders SET " . $data);
				if ($save) {
					$new_folder_id = $this->db->lastInsertId();
					$folder_path = $this->get_folder_path($parent_id) . '/' . $name;
					mkdir('uploads/' . $folder_path, 0755, true);
					$this->add_log('Folder Created', 'Folder name: ' . $name, $_SESSION['user_id']);
					return json_encode(array('status' => 1));
				}
			}
		} else {
			$check = $this->db->query("SELECT * FROM folders WHERE user_id ='" . $_SESSION['user_id'] . "' and name ='" . $name . "' and folders_id !=" . $folders_id . " and parent_id ='" . $parent_id . "'")->rowCount();
			if ($check > 0) {
				return json_encode(array('status' => 2, 'msg' => 'ชื่อโฟลเดอร์ซ้ำในระดับเดียวกัน'));
			} else {
				$save = $this->db->query("UPDATE folders SET " . $data . " WHERE folders_id =" . $folders_id);
				if ($save) {
					$folder_path = $this->get_folder_path($parent_id) . '/' . $name;
					rename('uploads/' . $this->get_folder_path($parent_id, true), 'uploads/' . $folder_path);
					$this->add_log('Folder Updated', 'Folder name: ' . $name, $_SESSION['user_id']);
					return json_encode(array('status' => 1));
				}
			}
		}
	}

	private function get_folder_path($parent_id, $include_last_folder = false)
	{
		$path = '';
		while ($parent_id != 0) {
			$folder = $this->db->query("SELECT name, parent_id FROM folders WHERE folders_id = " . $parent_id)->fetch(PDO::FETCH_ASSOC);
			$path = $folder['name'] . '/' . $path;
			$parent_id = $folder['parent_id'];
		}
		return $include_last_folder ? $path : rtrim($path, '/');
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

		if (empty($files_id)) {
			if (!empty($_FILES['upload']['tmp_name'][0])) {
				foreach ($_FILES['upload']['tmp_name'] as $key => $tmp_name) {
					$fname = strtotime(date("y-m-d H:i")) . '_' . $_FILES['upload']['name'][$key];
					$folder_path = $folders_id ? $this->get_folder_path($folders_id) : '';
					$file_path = 'uploads/' . ($folder_path ? $folder_path . '/' : '') . $fname;

					$move = move_uploaded_file($tmp_name, $file_path);

					if ($move) {
						$file = $_FILES['upload']['name'][$key];
						$file = explode('.', $file);
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
					}
				}
				return json_encode(array('status' => 1));
			}
		} else {
			$data = " description = '" . $description . "' ";
			$data .= ", is_public = " . (isset($is_public) && $is_public == 'on' ? 1 : 0);
			$save = $this->db->query("UPDATE files SET " . $data . " WHERE files_id=" . $files_id);
			if ($save) {
				$this->add_log('File Updated', 'File ID: ' . $files_id, $_SESSION['user_id']);
				return json_encode(array('status' => 1));
			}
		}
	}


	function file_rename()
	{
		extract($_POST);
		$file_name = $name;
		$file_type = $type;

		$chk = $this->db->query("SELECT * FROM files WHERE SUBSTRING_INDEX(name, ' ||', 1) = '" . $file_name . "' AND folders_id = '" . $folders_id . "' AND file_type = '" . $file_type . "' AND files_id != " . $files_id);

		if ($chk->rowCount() > 0) {
			$count = $chk->rowCount();
			$file_name = $file_name . ' ||' . $count;
		}

		$update = $this->db->query("UPDATE files SET name = '" . $file_name . "' WHERE files_id = " . $files_id);

		if ($update) {
			return true;
		} else {
			return false;
		}
	}
}
