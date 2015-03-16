<?php
include("connection.php");
		
		if($_POST['invoice_id'])
{
$invoice_id=mysql_escape_String($_POST['invoice_id']);
$number=mysql_escape_String($_POST['number']);
$date_traffic=mysql_escape_String($_POST['date_traffic']);
$place_traffic=mysql_escape_String($_POST['place_traffic']);
$date_turnover=mysql_escape_String($_POST['date_turnover']);
$place_turnover=mysql_escape_String($_POST['place_turnover']);
$date_payment=mysql_escape_String($_POST['date_payment']);
$payment_method=mysql_escape_String($_POST['payment_method']);
$invoice_type=mysql_escape_String($_POST['invoice_type']);
$sql = "update invoice set number='$number',date_traffic='$date_traffic',place_traffic='$place_traffic',
date_turnover='$date_turnover',place_turnover='$place_turnover',date_payment='$date_payment',
payment_method='$payment_method',invoice_type='$invoice_type' where invoice_id='$invoice_id'";
mysql_query($sql);
}
?>