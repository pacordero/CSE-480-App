<?php

	include('config.php');

	class DbConnect
	{
		private $connect;
		
		//Connect to the database. Gives error if failed connection.
		public function __construct()
		{
			$this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
		
			if(mysqli_connect_errno($this->connect))
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		}
		
		//Return database handler
		public function getDb()
		{
			return $this->connect;
		}
	}	

?>