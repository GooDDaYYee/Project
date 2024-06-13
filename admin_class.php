<?php
session_start();
class Action
{
	private $db;

	public function __construct()
	{
		ob_start();
		include 'connect.php';
		$this->db = $con;
	}

	function __destruct()
	{
		$this->db = null;
		ob_end_flush();
	}

	function save_folder()
	{
		extract($_POST);
		$data = " name ='" . $name . "' ";
		$data .= ", parent_id ='" . $parent_id . "' ";
		if (empty($id)) {
			$data .= ", user_id ='" . $_SESSION['login'] . "' ";

			$check = $this->db->query("SELECT * FROM folders where user_id ='" . $_SESSION['login'] . "' and name  ='" . $name . "'")->rowCount();
			if ($check > 0) {
				return json_encode(array('status' => 2, 'msg' => 'Folder name already exist'));
			} else {
				$save = $this->db->query("INSERT INTO folders set " . $data);
				if ($save) return json_encode(array('status' => 1));
			}
		} else {
			$check = $this->db->query("SELECT * FROM folders where user_id ='" . $_SESSION['login'] . "' and name  ='" . $name . "' and id !=" . $id)->rowCount();
			if ($check > 0) {
				return json_encode(array('status' => 2, 'msg' => 'Folder name already exist'));
			} else {
				$save = $this->db->query("UPDATE folders set " . $data . " where id =" . $id);
				if ($save) return json_encode(array('status' => 1));
			}
		}
	}

	function delete_folder()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM folders where id =" . $id);
		if ($delete) echo 1;
	}

	function delete_file()
	{
		extract($_POST);
		$path = $this->db->query("SELECT file_path from files where id=" . $id)->fetch(PDO::FETCH_ASSOC)['file_path'];
		$delete = $this->db->query("DELETE FROM files where id =" . $id);
		if ($delete) {
			unlink('uploads/' . $path);
			return 1;
		}
	}

	function save_files()
	{
		extract($_POST);
		if (empty($id)) {
			if ($_FILES['upload']['tmp_name'] != '') {
				$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['upload']['name'];
				$move = move_uploaded_file($_FILES['upload']['tmp_name'], 'uploads/' . $fname);

				if ($move) {
					$file = $_FILES['upload']['name'];
					$file = explode('.', $file);
					$chk = $this->db->query("SELECT * FROM files where SUBSTRING_INDEX(name,' ||',1) = '" . $file[0] . "' and folder_id = '" . $folder_id . "' and file_type='" . $file[1] . "' ");
					if ($chk->rowCount() > 0) {
						$file[0] = $file[0] . ' ||' . ($chk->rowCount());
					}
					$data = " name = '" . $file[0] . "' ";
					$data .= ", folder_id = '" . $folder_id . "' ";
					$data .= ", description = '" . $description . "' ";
					$data .= ", user_id = '" . $_SESSION['login'] . "' ";
					$data .= ", file_type = '" . $file[1] . "' ";
					$data .= ", file_path = '" . $fname . "' ";
					$data .= ", is_public = " . (isset($is_public) && $is_public == 'on' ? 1 : 0);

					$save = $this->db->query("INSERT INTO files set " . $data);
					if ($save) return json_encode(array('status' => 1));
				}
			}
		} else {
			$data = " description = '" . $description . "' ";
			$data .= ", is_public = " . (isset($is_public) && $is_public == 'on' ? 1 : 0);
			$save = $this->db->query("UPDATE files set " . $data . " where id=" . $id);
			if ($save) return json_encode(array('status' => 1));
		}
	}

	function file_rename()
	{
		extract($_POST);
		$file[0] = $name;
		$file[1] = $type;
		$chk = $this->db->query("SELECT * FROM files where SUBSTRING_INDEX(name,' ||',1) = '" . $file[0] . "' and folder_id = '" . $folder_id . "' and file_type='" . $file[1] . "' and id != " . $id);
		if ($chk->rowCount() > 0) {
			$file[0] = $file[0] . ' ||' . ($chk->rowCount());
		}
		$save = $this->db->query("UPDATE files set name = '" . $file[0] . "' where id=" . $id);
		if ($save) {
			return json_encode(array('status' => 1, 'new_name' => $file[0] . '.' . $file[1]));
		}
	}
}
