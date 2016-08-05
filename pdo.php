<?php

class db_pdo{
	private $db_address = 'localhost';
	private $db_name = 'test';
	private $db_username = 'root';
	private $db_password = '';
	private $db;
	private $dsn = '';

	function __construct() 
	{ 
		$dsn = "mysql:host={$this->db_address};dbname={$this->db_name}";
		$this->db = new PDO($dsn, $this->db_username, $this->db_password);
	} 

	function exec($sql){
		$count =  $this->db->exec($sql);
		if ($this->db->errorCode() != '00000'){ 
			$errorinfo = $this->db->errorInfo();
			return errorinfo
		}
		return $count;
	}
}

$db = new db_pdo();
$sql = "INSERT INTO node1 (title, created) VALUES ('abc', 1234567890);" ;
$result = $db->exec($sql);
echo $result;

// $dsn = "mysql:host=localhost;dbname=test";
// $db = new PDO($dsn, 'root', '');

// $count = $db->exec("INSERT INTO node (title, created) VALUES ('abc', 1234567890); ");
// if ($db->errorCode() != '00000'){ 
// 	var_dump($db->errorInfo()); 
// 	exit; 
// }
// echo$count;
