<?php



require_once('connection.php');

if(isset($_GET['action']))
{
	$action = $_GET['action'];
}
else {
	$action = '';
}

switch($action) {
	case 'add':
	addStatement();
	break;

	case 'update':
	updateStatement();
	break;

	case 'delete':
	deleteStatement();
	break;
}
//Kraj ispitivanja akcije
//Pocetak ispitivanja izgleda

if(isset($_GET['view']))
{
	$view = $_GET['view'];
}
else {
	$view = '';
}

switch($view) {

	case 'edit':
	editStatementView();
	break;

	case 'list':
	default:
	listStatementView();
	break;
}


//Kraj ispitivanja izgleda
//Pocetak funkcija izgleda	
function listStatementView() {



	$query = "SELECT * FROM statement";
	$result = mysql_query($query);
	$rows = array();
	while($row = mysql_fetch_assoc($result)) {
		$rows[] = array(
			'statement_id' => htmlspecialchars($row['statement_id']),	
			'statement_number' => htmlspecialchars($row['statement_number']),
			'company_name' => htmlspecialchars($row['company_name']),
			'bank_name' => htmlspecialchars($row['bank_name']),
			'statement_date' => htmlspecialchars($row['statement_date']),
			'statement_value' => htmlspecialchars($row['statement_value']),
			'payment' => htmlspecialchars($row['payment']),

			);
	}


		//akcije i forma

	$action = "statement.php?view=list&action=add";
	include("statement_form.php");

}



//Kraj funkcija izgleda


//Pocetak funkcija akcija

function AddStatement() {
	$statement_id = $_POST['statement_id'];
	$statement_number = $_POST['statement_number'];
	$company_name = $_POST['company_name'];
	$bank_name = $_POST['bank_name'];
	$statement_date = date('Y-m-d', strtotime($_POST['statement_date']));
	$statement_value = $_POST['statement_value'];
	$payment = $_POST['payment'];


	$query = "INSERT INTO statement (statement_id,statement_number,company_name,bank_name,payment,statement_date, statement_value)
	VALUES (NULL,'$statement_number','$company_name','$bank_name','$payment','$statement_date','$statement_value')";
	$result = mysql_query($query);

	if(!$result) 
	{
		die(mysql_error());
	}

}

function deleteStatement() {
	$statement_id = $_GET['statement_id'];
	$query = "DELETE  FROM statement where statement_id=$statement_id ";





	$result = mysql_query($query);

	if(!$result)
	{
		die(mysql_error());
	}

}
//Kraj funkcija akcija
?>