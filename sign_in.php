<?php
	require 'class_mysql.php';
	session_start ();
	/**
	 * Created by PhpStorm
	 * User:    Ruo
	 * Date:    2014/9/16
	 * Time:    16:04
	 */
	if (isset($_POST['sign_in']) && $_SESSION['code'] == $_POST['code']) {
		if ($_POST['username'] == '' || $_POST['password'] == '' || strlen ($_POST['password']) < 3 || strlen ($_POST['password']) > 20) {
			echo 1;
			header ("location: http://localhost/chat3/");
		}else if(hasUser($_POST['username'],$_POST['password'])){
			header ("location: http://localhost/chat3/");
		}
	} else {
		echo 1;
		header ("location: http://localhost/chat2/");
	}
	/**
	 * hasUser
	 *
	 * @param $username
	 *
	 * @return bool
	 */
	function hasUser ($username, $password) {
		$con = new Mysql('localhost', 'root', '', 'chat', FALSE);
		$sql = "SELECT * FROM `user` WHERE `username`='" . $username . "' AND `password`='" . md5($password) . "';";
		$result = mysql_query ($sql) or die("Failure");
		if (mysql_num_rows ($result) != 1) {
			echo 1;
			header ("location: http://localhost/chat3/");

			return false;
		} else {
			$_SESSION['user'] = mysql_fetch_assoc($result);
			$_SESSION['login'] = true;
			echo 0;

			return true;
		}
	}

	/* End of file sign_in.php */