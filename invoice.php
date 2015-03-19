<?php


include("checksession.php");
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
	addInvoice();
	break;

	case 'update':
	updateInvoice();
	break;

	case 'delete':
	deleteInvoice();
	break;

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
else {
	$view = '';
}

switch($view) {

	case 'edit':
	editInvoiceView();
	break;

	case 'list':
	default:
	listInvoiceView();
	break;
}

//Kraj ispitivanja izgleda
//Pocetak funkcija izgleda	
function listInvoiceView() {



	$query = "SELECT * FROM invoice";
	$result = mysql_query($query);
	$rows = array();
	while($row = mysql_fetch_assoc($result)) {
		$rows[] = array(
			'customer_id' => htmlspecialchars($row['customer_id']), 
			'invoice_id' => htmlspecialchars($row['invoice_id']),
			'number' => htmlspecialchars($row['number']),
			'date_traffic' => htmlspecialchars($row['date_traffic']),
			'place_traffic' => htmlspecialchars($row['place_traffic']),
			'date_turnover'  => htmlspecialchars($row['date_turnover']),
			'place_turnover'  => htmlspecialchars($row['place_turnover']),
			'date_payment'   => htmlspecialchars($row['date_payment']),
			'payment_method' => htmlspecialchars($row['payment_method']),
			'invoice_type' => htmlspecialchars($row['invoice_type']),


			);
	}


		//akcije i forma
	$customer_id = $_GET['customer_id'];
	$action = "invoice.php?view=list&action=add&customer_id=$customer_id;";
	include("invoice_form.php");

}



//Kraj funkcija izgleda


//Pocetak funkcija akcija

function AddInvoice() {
	$customer_id=$_GET['customer_id'];
	$invoice_id = $_POST['invoice_id'];
	$number = $_POST['number'];
	$date_traffic = date('Y-m-d', strtotime($_POST['date_traffic']));
	$place_traffic = $_POST['place_traffic'];
	$date_turnover = date('Y-m-d', strtotime($_POST['date_turnover']));
	$place_turnover = $_POST['place_turnover'];
	$date_payment = $_POST['date_payment'];
	$payment_method = $_POST['payment_method'];
	$invoice_type = $_POST['invoice_type'];
	$number2 = '';
    $sql=mysql_query("select number from invoice where number=$number");
    while($row=mysql_fetch_array($sql))
    {
        $number2 = $row['number'];
    }
	
    
	$number1 = $_POST['number'];
	if($number1 == $number2){
	echo "<div class='alert alert-danger' role='alert'>Faktura pod ovim brojem već postoji u bazi podataka, molimo unesite drugi broj fakture
	ukoliko želite novu fakturu!</div>";
	

}else{
	$query = "INSERT INTO invoice (invoice_id,customer_id, number, date_traffic, place_traffic, date_turnover,
	 place_turnover ,date_payment,payment_method,invoice_type)
	VALUES (NULL,'$customer_id','$number','$date_traffic','$place_traffic','$date_turnover','$place_turnover',
		'$date_payment','$payment_method','$invoice_type')";
$result = mysql_query($query);

	if(!$result) 
	{
		die(mysql_error());
	}
	
}
	
}
function logout() {
		session_destroy();
		header("Location: index.php");
	}

//Kraj funkcija akcija
?>