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
				listBookInvoicesIn();
			break;
		}
	
//Kraj ispitivanja izgleda

	function listBookInvoicesIn() {
	
		
		
		include("book_invoices_in_form.php");
	}
	
	function logout() {
		session_destroy();
		header("Location: index.php");
	}

?>