<?php
//Keegan Verwey
//19004753

// Connect to WEDE6011POE_DB (createTable.php Connection)
$servername = "localhost";         
$username = "root";
$password = "";
$dbName = "WEDE6011POE_DB";
$connectionString;

$connectionString= mysqli_connect($servername, $username, $password, $dbName);


if (!$connectionString) {
  echo die("Connection failed: " . mysqli_connect_error());
}


//Script Execution DB Class Library
class DBScriptExecution {
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $dbName = "WEDE6011POE_DB";
	private $connectionString;
	
	function __construct() {
		$this->connectionString = $this->connectDB();
	}
	
    //CONNECT TO WEDE6011POE_DB
	function connectDB() {
		$connectionString = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
		return $connectionString;
	}

	//Function for inserting data into the database
    function executeInsert($script) {
		$queryRes = mysqli_query($this->connectionString, $script);
	}
		
	//Function for selecting data into the database
	function executeSQL($script) {
		$queryRes = mysqli_query($this->connectionString, $script);
		if(!empty($queryRes))
		{
			while($row = mysqli_fetch_assoc($queryRes)) {
				$resultFromDB[] = $row;
			}		
			if(!empty($resultFromDB))
				return $resultFromDB;
		}
		
	}
	
}
?>