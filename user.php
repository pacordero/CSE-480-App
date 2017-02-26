<?php
	include ('dbconnect.php');
	
	class User
	{
		private $connect
		
		public function __construct()
		{
			$this->connect = new Dbconnect();
		}
		
		//This will test if the user exist and returns a boolean.
		public function isLoginExist($email, $password)
		{
			//PDO query is used to check regster users
			$statement = $this->connect->prepare("SELECT * FROM USER WHERE USER_PASS = :password AND USER_EMAIL = :email");
			
			//PDO binds entry to protect against SQL injections.	
			$statement->bindParam(':email', $email, PDO::PARAM_STR);
			$statement->bindParam(':pass', $password, PDO::PARAM_STR);
		
			//Execute query
			$executed = $statement->execute();
			
			$number_rows = $statement->stored_result();
			
			if($number_rows > 0)
			{
				//User does exist
				$statememt->close();
				return true;
			}
			else
			{
				//User does not exist
				$statement->close();
				return false;
				
			}
		}
		
		//Store new users and return user detail.
		public function storeUser($email, $password)
		{
			$statement = $this->connect->prepare("INSERT INTO USER(USER_EMAIL,USER_PASS) VALUES(:email, :password)");
			
			$statement->bindParam(':email', $email, PDO::PARAM_STR);
			$statement->bindParam(':password',$password, PDO::PARAM_STR);
			
			$result = $statement->execute();
			
			//Checks if it stored successfully. 
			if($result)
			{
				$statement = $this->connect->prepare("SELECT * FROM USER WHERE USER_EMAIL= :email");
				$statment->bindParam(':email', $email);
				
				$statement->execute();
				$user = $statement->fetchColumn();
				$statement->close;
				
				$json['success'] = 1;
			}
			else
			{
				$json['success'] = 0;
			}
			
			return $json;
		}
		
		//Get user by email and password and return result. 
		public function loginUser($email,$password)
		{
			$json = array();
			
			//Test if user exist 
			$canUserLogin = $this->isLoginExist($email, $password);
			
			if($canUserLogin)
			{
				$json['success'] = 1;
			}
			else
			{
				$json['success'] = 0;
			}
			
			return $json;
			
		}
	
	}
?>

