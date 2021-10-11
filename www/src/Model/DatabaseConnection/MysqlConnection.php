<?php

namespace Model\DatabaseConnection;

class MySqlConnection{
	private $host;
	private $user;
	private $pass;
	private $database;
	private $conn;
	function __construct(){
		$config = parse_ini_file('aplication.ini');
		$this->host 	=$config['db_host'];
		$this->user 	=$config['db_user'];
		$this->pass 	=$config['db_pass'];
		$this->database =$config['db_database'];
		try{
			$this->conn =  mysqli_connect($this->host, $this->user, $this->pass, $this->database);
		}catch(Exception $e){
			die('Erro Conexao'.$e);
		}		
	}

	public function getConnection(){
		return $this->conn;
	}

	public function TestConnection(){
		if ($this->conn->connect_error) {
		    throw new Exception("Connection failed: " . $this->conn->connect_error);
		} else {
		    echo "Connected to MySQL server successfully!";
		}
	}

}