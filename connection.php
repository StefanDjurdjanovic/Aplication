<?php
	
	$db_host = "localhost"; //MySQL Host : MySQL Port
	$db_user = "root"; //Korisnik koji pristupa bazi
	$db_password = ""; //Lozinka korisnika koji pristupa bazi
	$db_name = "aplication"; //Ime MySQL baze kojoj se pristupa
	

	$connection = mysql_connect($db_host, $db_user, $db_password);
	mysql_query("SET character_set_results=utf8", $connection);
    mb_language('uni'); 
    mb_internal_encoding('UTF-8');
    mysql_select_db($db_name, $connection);
    mysql_query("set names 'utf8'",$connection);
	if(!$connection)
		{
			echo "Uspostavljanje veze sa serverom...<br />";
			echo "Greška (".mysql_errno()."), a razlog - ".mysql_error();
			
		}
		
	$db_select = mysql_select_db($db_name, $connection);	
	if(!$db_select)
		{
			echo "Uspostavljanje veze sa bazom...<br />";
			echo "Greška (".mysql_errno()."), a razlog - ".mysql_error();
		}
		
?>