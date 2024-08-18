<?php
session_start();
class Action
{
	private $db;

	public function __construct()
	{
		ob_start();
		include dirname(__FILE__) . '/../connect.php';
		$this->db = $con;
	}

	function __destruct()
	{
		$this->db = null;
		ob_end_flush();
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

			$check = $this->db->query("SELECT * FROM folders WHERE user_id ='" . $_SESSION['user_id'] . "' and name  ='" . $name . "'")->rowCount();
			if ($check > 0) {
				return json_encode(array('status' => 2, 'msg' => 'ชื่อโฟลเดอร์ซ้ำ'));
			} else {
				$save = $this->db->query("INSERT INTO folders SET " . $data);
				if ($save) {
					$this->add_log('Folder Created', 'Folder name: ' . $name, $_SESSION['user_id']);
					return json_encode(array('status' => 1));
				}
			}
		} else {
			$check = $this->db->query("SELECT * FROM folders WHERE user_id ='" . $_SESSION['user_id'] . "' and name  ='" . $name . "' and folders_id !=" . $folders_id)->rowCount();
			if ($check > 0) {
				return json_encode(array('status' => 2, 'msg' => 'ชื่อโฟลเดอร์ซ้ำ'));
			} else {
				$save = $this->db->query("UPDATE folders SET " . $data . " WHERE folders_id =" . $folders_id);
				if ($save) {
					$this->add_log('Folder Updated', 'Folder name: ' . $name, $_SESSION['user_id']);
					return json_encode(array('status' => 1));
				}
			}
		}
	}

	function delete_folder()
	{
		extract($_POST);
		$folder_name = $this->db->query("SELECT name FROM folders WHERE folders_id=" . $folders_id)->fetch(PDO::FETCH_ASSOC)['name'];
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
			unlink('uploads/' . $file_details['file_path']);
			$this->add_log('File Deleted', 'File name: ' . $file_details['name'], $_SESSION['user_id']);
			return 1;
		}
	}

	function save_files()
	{
		extract($_POST);
		if (empty($files_id)) {
			if (!empty($_FILES['upload']['tmp_name'][0])) {
				foreach ($_FILES['upload']['tmp_name'] as $key => $tmp_name) {
					$fname = strtotime(date("y-m-d H:i")) . '_' . $_FILES['upload']['name'][$key];
					$move = move_uploaded_file($tmp_name, 'uploads/' . $fname);

					if ($move) {
						$file = $_FILES['upload']['name'][$key];
						$file = explode('.', $file);
						$chk = $this->db->query("SELECT * FROM files WHERE SUBSTRING_INDEX(name,' ||',1) = '" . $file[0] . "' and folder_id = '" . $folder_id . "' and file_type='" . $file[1] . "' ");
						if ($chk->rowCount() > 0) {
							$file[0] = $file[0] . ' ||' . ($chk->rowCount());
						}
						$data = " name = '" . $file[0] . "' ";
						$data .= ", folder_id = '" . $folder_id . "' ";
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
		$file[0] = $name;
		$file[1] = $type;
		$chk = $this->db->query("SELECT * FROM files WHERE SUBSTRING_INDEX(name,' ||',1) = '" . $file[0] . "' and folder_id = '" . $folder_id . "' and file_type='" . $file[1] . "' and files_id != " . $files_id);
		if ($chk->rowCount() > 0) {
			$file[0] = $file[0] . ' ||' . ($chk->rowCount());
		}
		$save = $this->db->query("UPDATE files SET name = '" . $file[0] . "' WHERE files_id=" . $files_id);
		if ($save) {
			$this->add_log('File Renamed', 'New name: ' . $file[0], $_SESSION['user_id']);
			return json_encode(array('status' => 1, 'new_name' => $file[0] . '.' . $file[1]));
		}
	}
}
