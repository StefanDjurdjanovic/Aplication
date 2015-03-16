<?php
include("connection.php");
		header('Content-Type: text/html; charset=utf-8');
	   if($_POST['company_id'])
{
$name=mysql_real_escape_String($_POST['name']);
$description=mysql_real_escape_String($_POST['description']);
$address=mysql_real_escape_String($_POST['address']);
$city=mysql_real_escape_String($_POST['city']);
$zip_code=mysql_real_escape_String($_POST['zip_code']);
$tin=mysql_real_escape_String($_POST['tin']);
$activity_code=mysql_real_escape_String($_POST['activity_code']);
$registration_number=mysql_real_escape_String($_POST['registration_number']);
$account=mysql_real_escape_String($_POST['account']);
$phone_number=mysql_real_escape_String($_POST['phone_number']);
$fax=mysql_real_escape_String($_POST['fax']);
$email=mysql_real_escape_String($_POST['email']);
$comment=mysql_real_escape_String($_POST['comment']);
$sql = " UPDATE settings set  name='$name',description='$description',address='$address'
,city='$city',zip_code='$zip_code',tin='$tin',activity_code='$activity_code'
,registration_number='$registration_number',account='$account',phone_number='$phone_number'
,fax='$fax',email='$email',comment='$comment' ";
mysql_query($sql);
}
?>