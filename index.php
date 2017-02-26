<?php
	
	include 'user.php';
	
	$email = "";
	$password = "";
	
	if(isset($_POST['USER_EMAIL']))
	{
		$email = $_POST['USER_EMAIL'];
	}
	
	if(isset($_POST['USER_PASSWORD']))
	{
		$email = $_POST['USER_PASSWORD']))
	}
	
	//Instance of a User class
	$user_object = new User();
	
	//Registration of new user
	if (!empty($email) && !emtpy($password))
	{
		$json_registration = $user_object->storeUser($email, $password);
		echo json_encode($json_registration);
	}
	
	//User Login
	if(!empty('email') && !empty('password'))
	{
		$json_array = $user_object->loginUser($email, $password);
		
		echo json_encode($json_array);
	}
?>