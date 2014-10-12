<?php
	require 'class_mysql.php';
	session_start ();
	date_default_timezone_set ('Asia/Shanghai');
	if (!empty($_FILES) && $_SESSION['code'] == $_POST['code']) {
		$con = new Mysql('localhost', 'root', '', 'chat', FALSE);
		// $con = new Mysql('mysql.hostingforfun.org', 'u402829064_ruo', 'jiangxin0037.', 'u402829064_chat', false);
		// $con = new Mysql('tw.njut.edu.cn', 'ruo', '0037', 'chat', false);
		mysql_query ("SET NAMES UTF8");
		$sql        = "INSERT INTO `chat` (`id`,`date`, `time`,`publisher`, `tucao`, `imgJson`,`soundJson`) VALUES ('','" . date ("Y-m-d") . "','" . date ("H:i:s") . "','".$_SESSION['user']['uid']."','" . addslashes ($_POST['tucao']) . "','";
		$images_sql = "";
		$sounds_sql = "";
		$imageType  = array ('jpg', 'jpeg', 'gif', 'bmp', 'svg', 'png');
		$soundType  = array ('mp3', 'wma', 'wav', 'mod', 'ogg');
		// echo var_dump($_FILES);
		foreach ($_FILES["file_upload"]['name'] as $key => $name) {
			$timestamp = date ("Y_m_d") . " " . date ("H_i_s") . " " . rand (0, 9) . rand (0, 9) . rand (0, 9);
			echo 'name:' . $name . '<br />';
			$explode = explode ('.', $name);
			$type    = strtolower (end ($explode));
			echo in_array ($type, $imageType);
			echo 'type:' . $type . '<br />';
			if (in_array ($type, $imageType)) {
				move_uploaded_file ($_FILES["file_upload"]["tmp_name"][$key], "img/" . $timestamp . "." . $type);
				$images_sql .= $timestamp . '.' . $type . '-';
			} else if (in_array ($type, $soundType)) {
				move_uploaded_file ($_FILES["file_upload"]["tmp_name"][$key], "sound/" . $timestamp . "." . $type);
				$sounds_sql .= $timestamp . '.' . $type . '-';
			}else{
				return false;
			}
			// echo $_FILES["file_upload"]["type"][$key];
		}
		if ($images_sql != "") {
			$sql .= $images_sql;
			$sql = substr ($sql, 0, strlen ($sql) - 1);
		}
		$sql .= "','";
		if ($sounds_sql != "") {
			$sql .= $sounds_sql;
			$sql = substr ($sql, 0, strlen ($sql) - 1);
		}
		$sql .= "');";
		echo $sql;

		$result = mysql_query ($sql);
		// echo $result;
	}
	else if (isset($_POST['tucao']) && $_POST['tucao'] != "" && $_SESSION['code'] == $_POST['code']) {
		$con = new Mysql('localhost', 'root', '', 'chat', FALSE);
		// $con = new Mysql('mysql.hostingforfun.org', 'u402829064_ruo', 'jiangxin0037.', 'u402829064_chat', false);
		// $con = new Mysql('tw.njut.edu.cn', 'ruo', '0037', 'chat', false);
		mysql_query ("SET NAMES UTF8");
		$sql = "INSERT INTO `chat` (`id`,`date`, `time`,`publisher`, `tucao`, `imgJson`) VALUES ('','" . date ("Y-m-d") . "','" . date ("H:i:s") . "','".$_SESSION['user']['uid']."','" . addslashes ($_POST['tucao']) . "','');";
		 echo $sql;
		$result = mysql_query ($sql);
	}
?>