<?php
	
	
	
//Pocetak ispitivanja akcije

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
			addCustomer();
		break;
		
		case 'update':
			updateCustomer();
		break;
		
		case 'delete':
			deleteCustomer();
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
			editCustomerView();
		break;
		
		case 'list':
		default:
			listCustomerView();
		break;
	}
	
//Kraj ispitivanja izgleda
//Pocetak funkcija izgleda	
function listCustomerView() {
		
		
		$query = "SELECT * FROM customer";
		$result = mysql_query($query);
		$rows = array();
		while($row = mysql_fetch_assoc($result)) {
			$rows[] = array(
			'customer_id' => htmlspecialchars($row['customer_id']),
			'customer_name' => htmlspecialchars($row['customer_name']),
			'customer_address' => htmlspecialchars($row['customer_address']),
			'customer_city'	=> htmlspecialchars($row['customer_city']),
			'customer_zip_code'	=> htmlspecialchars($row['customer_zip_code']),
			'customer_tin'	=> htmlspecialchars($row['customer_tin']),
			'customer_account'	=> htmlspecialchars($row['customer_account']),
			'customer_phone_number'	=> htmlspecialchars($row['customer_phone_number']),
			'customer_fax'	=> htmlspecialchars($row['customer_fax']),
			'customer_vat_status'	=> htmlspecialchars($row['customer_vat_status']),
					
		);
		}
		
		//akcije i forma
		$action = "customer.php?view=list&action=add";
		include("customer_form.php");
		
	}
	


//Kraj funkcija izgleda


//Pocetak funkcija akcija
	
	function AddCustomer() {
		
	$customer_id=$_POST['customer_id'];
	$customer_name = $_POST['customer_name'];
	$customer_address = $_POST['customer_address'];
	$customer_city = $_POST['customer_city'];
	$customer_zip_code = $_POST['customer_zip_code'];
	$customer_tin = $_POST['customer_tin'];
	$customer_account = $_POST['customer_account'];
	$customer_phone_number = $_POST['customer_phone_number'];
	$customer_fax = $_POST['customer_fax'];
	$customer_vat_status = $_POST['customer_vat_status'];
	$customer_name2 = '';
    $sql=mysql_query("select customer_name from customer where customer_name='$customer_name'");
    while($row=mysql_fetch_array($sql))
    {
        $customer_name2 = $row['customer_name'];
    }
    
    
	$customer_name1 = $_POST['customer_name'];
	if($customer_name1 == $customer_name2){
	echo "<div class='alert alert-danger' role='alert'>Firma pod nazivom $customer_name već postoji u bazi podataka, molimo unesite drugi naziv firme
	ukoliko želite otvoriti novu firmu!</div>";
	}else{
	$query = "INSERT INTO customer (customer_id, customer_name, customer_address, customer_city, customer_zip_code,
	 customer_tin ,customer_account,customer_phone_number,customer_fax,customer_vat_status)
	VALUES (NULL,'$customer_name','$customer_address','$customer_city','$customer_zip_code','$customer_tin',
		'$customer_account','$customer_phone_number','$customer_fax','$customer_vat_status')";
    $result = mysql_query($query);

	if(!$result) 
	{
		die(mysql_error());
	}
	
}
	
}
// Kraj funkcija akcija
?>