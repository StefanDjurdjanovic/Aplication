<?php
	
	include("db_config.php");
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$query = "SELECT  active,username, password FROM user WHERE username = '$username' AND active = 1 ";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	
	if($uesrname == $row['username'] && $active == $row['active'])
		{
			session_start();
			$_SESSION['id'] = $row['id'];
			$_SESSION['logged_in'] = true;
			header("Location:first_page.php");	
		}
	else
		{
			header("Location:index.php?login=error");
		}
?>