<?php
class Mysql {
	var $localhost;
	var $user;
	var $password;
	var $db;
	var $db_table;
	var $connect;
	var $select;
	// var $code = "gbk";
	function __construct($localhost, $user, $password, $db, $isp) {
		$this -> localhost = $localhost;
		$this -> user = $user;
		$this -> password = $password;
		$this -> db = $db;
		if (isset($isp))
			$this -> Mysql_connect($isp);
		else
			$this -> Mysql_connect(false);
	}

	function Mysql_Connect($isp) {
		if (isset($isp) && $isp)
			@$this -> connect = mysql_pconnect($this -> localhost, $this -> user, $this -> password) or die('Server connection failed !');
		else
			@$this -> connect = mysql_connect($this -> localhost, $this -> user, $this -> password) or die('Server connection failed !');
		mysql_select_db($this -> db, $this -> connect) or die("Database connection failed !");
		// mysql_query("SET NAMES " . $this -> code);
	}

	public function close() {
		mysql_close($this -> connect);
	}
}

?>