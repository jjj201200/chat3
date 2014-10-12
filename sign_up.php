<?php
	require 'class_mysql.php';
	session_start();
	/**
	 * Created by PhpStorm
	 * User:    Ruo
	 * Date:    2014/9/16
	 * Time:    16:04
	 */
	if (isset($_POST['sign_up'])&&$_SESSION['code']==$_POST['code']) {
		if ($_POST['username'] == '' || $_POST['password'] == '' || strlen ($_POST['password']) < 3 || strlen ($_POST['password']) > 20) {
			echo 1;
			header("location: http://localhost/chat3/");
		}
		if(hasUser($_POST['username'])||$_POST['password'] != $_POST['confirm_password']){
			var_dump($_POST['password'] != $_POST['confirm_password']);
			header("location: http://localhost/chat3/");
			return false;
		}else{
			$con = new Mysql('localhost', 'root', '', 'chat', FALSE);
			$sql  = "INSERT INTO `user` (`uid`, `username`, `password`) VALUES('','".$_POST['username']."','".md5($_POST['password'])."')";
			$result = mysql_query ($sql) or die("Failure");
			echo 0;
			header("location: http://localhost/chat3/");
			exit;
		}
	}else{
		echo 1;
		header("location: http://localhost/chat3/");
	}
	/**
	 * hasUser
	 *
	 * @param $username
	 *
	 * @return bool
	 */
	function hasUser ($username) {
	$con = new Mysql('localhost', 'root', '', 'chat', FALSE);
	$sql = "SELECT * FROM `user` WHERE `username`='" . $username . "';";
	$result = mysql_query ($sql) or die("Failure");
	if(mysql_num_rows($result)==1){
		echo 1;
		header("location: http://localhost/chat3/");
		return true;
	}else{
		echo 0;
		return false;
	}

}

	/* End of file sign_up.php */