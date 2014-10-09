<?php
	require 'class_mysql.php';
	session_start ();
	if (isset($_POST['year']) && isset($_POST['month']) && isset($_POST['day'])) {
		$con = new Mysql('localhost', 'root', '', 'chat', FALSE);
		// $con = new Mysql('mysql.hostingforfun.org', 'u402829064_ruo', 'jiangxin0037.', 'u402829064_chat', false);
		// $con = new Mysql('tw.njut.edu.cn', 'ruo', '0037', 'chat', false);
		mysql_query ("SET NAMES UTF8");
		$sql = "SELECT `chat`.*,`user`.`username`,`user`.`uid` FROM `chat` JOIN `user` WHERE `publisher`=`uid` AND `date`='" . $_POST['year'] . "-" . str_pad ($_POST['month'], 2, '0') . "-" . str_pad ($_POST['day'], 2, '0') . "';";
		$result = mysql_query ($sql) or die("Failure");
		$array = array ();
		while ($res = mysql_fetch_row ($result)) {
			$res[4] = stripslashes ($res[4]);
			$res[5] = explode ('-', $res[5]);
			$res[6] = explode ('-', $res[6]);
			array_push ($array, $res);
		}
		echo json_encode ($array);
	}
	if (isset($_POST['sign_out']) && $_POST['sign_out'] == TRUE) {
		session_destroy ();
		echo 0;
	}

?>