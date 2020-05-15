<?php

namespace m07uf4pr01\ApiTransactions;

class DBConn {
	private $host;
	private $dbname;
	private $user;
	private $password;
	public $conn;

	public function __construct() {
		$this->host = 'localhost';
		$this->dbname = 'm06_uf4_pr1';
		$this->user = 'ps';
		$this->password = '';
	}
	
	public function connect() {
		$this->conn = null;

		try {
			$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->user, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(Exception $e) {
			echo $e->getMessage();
		}
		return $this->conn;
	}
}
