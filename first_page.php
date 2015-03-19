<?php 
	
	include("checksession.php");
	
//Pocetak ispitivanja akcije

	require_once('connection.php');
	
	if(isset($_GET['action']))
		{
			$action = $_GET['action'];
		}
	else 
		{
			$action = '';
		}
		
	switch($action) 
	{
		case 'logout':
			logout();
		break;
	}
	
//Kraj ispitivanja akcije

//Pocetak ispitivanja izgleda
	
	if(isset($_GET['view']))
		{
			$view = $_GET['view'];
		}
	else 
		{
			$view = '';
		}
	
	switch($view) 
		{
			case 'list':
			default:
				listFirstPage();
			break;
		}
	
//Kraj ispitivanja izgleda

	function listFirstPage() {
	
		
		
		include("first_page_form.php");
	}
	
	function logout() {
		session_destroy();
		header("Location: index.php");
	}

?>