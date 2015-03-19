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
	addProduct();
	break;

	case 'update':
	updateProduct();
	break;

	case 'delete':
	deleteProduct();
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
	editProductView();
	break;

	case 'list':
	default:
	listProductView();
	break;
}

//Kraj ispitivanja izgleda
//Pocetak funkcija izgleda	
function listProductView() {



	$query = "SELECT * FROM invoice_item";
	$result = mysql_query($query);
	$rows = array();
	while($row = mysql_fetch_assoc($result)) {
		$rows[] = array(
			'invoice_id' => htmlspecialchars($row['invoice_id']), 
			'invoice_item_id' => htmlspecialchars($row['invoice_item_id']),
			'service_type' => htmlspecialchars($row['service_type']),
			'service_range' => htmlspecialchars($row['service_range']),
			'price' => htmlspecialchars($row['price']),
			'value'  => htmlspecialchars($row['value']),
			'vat'  => htmlspecialchars($row['vat']),
           // 'product_pdv_percent'  => htmlspecialchars($row['product_pdv_percent']),
			'vat_value'   => htmlspecialchars($row['vat_value']),
			'rebate' => htmlspecialchars($row['rebate']),
			'total_value' => htmlspecialchars($row['total_value']),


			);
	}


		//akcije i forma
	$customer_id = $_GET['customer_id'];
	$invoice_id = $_GET['invoice_id'];
	$action = "invoice_item.php?view=list&action=add&customer_id=$customer_id&invoice_id=$invoice_id";
	include("invoice_item_form.php");

}



//Kraj funkcija izgleda


//Pocetak funkcija akcija

function AddProduct() {
	$customer_id=$_GET['customer_id'];

	$invoice_id=$_GET['invoice_id'];

	$invoice_item_id = $_POST['invoice_item_id'];

	$service_type = $_POST['service_type'];

	$service_range = $_POST['service_range'];

	$price = $_POST['price'];

	$value = ($_POST['price'] * $_POST['service_range'])-(($_POST['price'] * $_POST['service_range'])*($_POST['vat']/(100+$_POST['vat'])));
	$vat_percent = $_POST['vat'];

	$vat= ($_POST['price'] * $_POST['service_range'])*($_POST['vat']/(100+$_POST['vat']));

	$vat_value =(($_POST['price'] * $_POST['service_range'])-(($_POST['price'] * $_POST['service_range'])*($_POST['vat']/(100+$_POST['vat']))))+
	(($_POST['price'] * $_POST['service_range'])*($_POST['vat']/(100+$_POST['vat'])));
	if ($_POST['rebate']>0) {
		$rabat = (($_POST['price'] * $_POST['service_range']/100)*$_POST['rebate']);
	}else{
		$rebate = $_POST['rebate'];}

		if ($_POST['rebate']>0) {
			$total_value = ((($_POST['price'] * $_POST['service_range'])-(($_POST['price'] * $_POST['service_range'])*($_POST['vat']
				/(100+$_POST['vat']))))+(($_POST['price'] * $_POST['service_range'])*($_POST['vat']/(100+$_POST['vat']))))
			-(($_POST['price']*$_POST['service_range'])/100*$_POST['rebate']);
		}else{
			$total_value = (($_POST['price'] * $_POST['service_range'])-(($_POST['price'] * $_POST['service_range'])
				*($_POST['vat']/(100+$_POST['vat'])))+(($_POST['price'] * $_POST['service_range'])*($_POST['vat']/(100+$_POST['vat']))));}

			$query = "INSERT INTO invoice_item (invoice_item_id,invoice_id,customer_id, service_range, service_type, price, value,
			 vat ,vat_percent,vat_value,rebate,total_value)
			VALUES (NULL,'$invoice_id','$customer_id','$service_range','$service_type','$price','$value',
				'$vat','$vat_percent','$vat_value','$rebate','$total_value')";
			$result = mysql_query($query);

			if(!$result) 
			{
				die(mysql_error());
			}

		}

		

		function deleteProduct() {


			$invoice_item_id = $_GET['invoice_item_id'];
			$invoice_id = $_GET['invoice_id'];
			$query = "DELETE FROM invoice_item WHERE invoice_item_id = $invoice_item_id";


			$result = mysql_query($query);

			if(!$result)
			{
				die(mysql_error());
			}

		}
		function logout() {
		session_destroy();
		header("Location: index.php");
	}
		//Kraj funkcija akcija
		?>