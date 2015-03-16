<?php
	
	require('fpdf/fpdf.php');
include('connection.php');
$firmaId = $_GET['firmaId'];
$fakturaId = $_GET['fakturaId'];
$result=mysql_query("SELECT * from kupac inner join faktura inner join company where kupac.firmaId=$firmaId 
	 and faktura.firmaId=$firmaId ");


while($row = mysql_fetch_array($result)){
	$imeFirme = $row['imeFirme'];
	$adresaFirme = $row['adresaFirme'];
	$pibFirme = $row['pibFirme'];
	$tekRacFirme = $row['tekRacFirme'];
	$brTelFirme = $row['brTelFirme'];
	$brojFakture = $row['brojFakture'];
	$datumIzdavanja = date('d-m-Y',strtotime($row['datumIzdavanja']));
	$mestoIzdavanja = $row['mestoIzdavanja'];
	$datumPrometa = date('d-m-Y',strtotime($row['datumPrometa']));
	$mestoPrometa = $row['mestoPrometa'];
	$rokPlacanja = $row['rokPlacanja'];
	$nacinPlacanja = $row['nacinPlacanja'];
	$company_name = $row['company_name'];
	$company_description = $row['company_description'];
	$company_addres = $row['company_addres'];
	$company_city = $row['company_city'];
	$company_zip_code = $row['company_zip_code'];
	$company_pib = $row['company_pib'];
	$company_activity_code = $row['company_activity_code'];
	$company_iden_number= $row['company_iden_number'];
	$company_account = $row['company_account'];
	$company_phone_number = $row['company_phone_number'];
	$company_fax = $row['company_fax'];
	$company_email = $row['company_email'];
	$company_comment = $row['company_comment'];

}
mysql_close();
	class HEADER extends Fpdf{
		function Header_2(){

$pdf->AddFont('DejaVu','','DejaVuSansCondensed.php',true);
$pdf->AddFont('DejaVu-bold','','DejaVuSans-Bold.php',true);
$pdf ->SetFont("DejaVu","",10);
$pdf ->Cell(105,5,iconv('utf-8','cp1250',$company_description),0,1);
$pdf ->SetFont("DejaVu-bold","",12);
$pdf ->Cell(50,5,iconv('utf-8','cp1250',$company_name),0,1);
$pdf ->SetFont("DejaVu","",10);
$pdf ->Cell(75,5,iconv('UTF-8', 'cp1250',$company_addres.', '.$company_city.', '.$company_zip_code),0,1);
$pdf ->SetFont("DejaVu","",10);
$pdf ->Cell(35,5,iconv('UTF-8', 'cp1250',"PIB: ".$company_pib),0,0);
$pdf ->Cell(50,5,iconv('UTF-8', 'cp1250',"Šira delatnosti: ".$company_activity_code),0,0);
$pdf ->Cell(50,5,iconv('UTF-8', 'cp1250',"Matični broj: ".$company_iden_number),0,1);
$pdf ->Cell(87,5,iconv('UTF-8', 'cp1250',"Tekući račun: ".$company_account),0,1);
$pdf ->Cell(62,5,iconv('utf-8','cp1250','Broj telefona: '.$company_phone_number),0,0);
$pdf ->Cell(62,5,iconv('utf-8','cp1250','Fax: '.$company_fax),0,0);
$pdf ->Cell(62,5,iconv('utf-8','cp1250','E-mail: '.$company_email),0,1);


$pdf ->SetXY(10,50);
$pdf ->SetFont('DejaVu','',10);
$pdf ->Cell(50,5,iconv('utf-8','cp1250','Broj fakture: '),0,0,'R');
$pdf ->SetXY(60,50);
$pdf ->SetFont('DejaVu-bold','',10);
$pdf ->Cell(25,5,$brojFakture,0,0,'C');
$pdf ->Line(85,54,60,54,1,10);

$pdf ->SetXY(10,60);
$pdf ->SetFont('DejaVu','',10);
$pdf ->Cell(50,5,iconv('utf-8','cp1250','Datum izdavanja računa: '),0,0);
$pdf ->SetXY(55,60);
$pdf ->SetFont('DejaVu-bold','',10);
$pdf ->Cell(45,5,$datumIzdavanja.' godine',0,0,'C');
$pdf ->Line(100,64,55,64,1,10);

$pdf ->SetXY(10,68);
$pdf ->SetFont('DejaVu','',10);
$pdf ->Cell(50,5,iconv('utf-8','cp1250','Mesto izdavanja računa: '),0,0);
$pdf ->SetXY(55,68);
$pdf ->SetFont('DejaVu-bold','',10);
$pdf ->Cell(45,5,iconv('utf-8','cp1250',$mestoIzdavanja),0,0,'C');
$pdf ->Line(100,72,55,72,1,10);

$pdf ->SetXY(10,76);
$pdf ->SetFont('DejaVu','',10);
$pdf ->Cell(55,5,iconv('utf-8','cp1250','Datum prometa dobara i usluga: '),0,0);
$pdf ->SetXY(67,76);
$pdf ->SetFont('DejaVu-bold','',10);
$pdf ->Cell(45,5,$datumPrometa.' godine',0,0,'C');
$pdf ->Line(112,80,67,80,1,10);

$pdf ->SetXY(10,84);
$pdf ->SetFont('DejaVu','',10);
$pdf ->Cell(55,5,iconv('utf-8','cp1250','Mesto prometa dobara i usluga: '),0,0);
$pdf ->SetXY(65,84);
$pdf ->SetFont('DejaVu-bold','',10);
$pdf ->Cell(40,5,iconv('utf-8','cp1250',$mestoPrometa),0,0,'C');
$pdf ->Line(105,88,65,88,1,10);

$pdf ->SetXY(10,92);
$pdf ->SetFont('DejaVu','',10);
$pdf ->Cell(55,5,iconv('utf-8','cp1250','Rok plaćanja: '),0,0);
$pdf ->SetXY(35,92);
$pdf ->SetFont('DejaVu-bold','',10);
$pdf ->Cell(40,5,$rokPlacanja.' DANA',0,0,'C');
$pdf ->Line(35,96,75,96,1,10);

$pdf ->SetXY(10,100);
$pdf ->SetFont('DejaVu','',10);
$pdf ->Cell(55,5,iconv('utf-8','cp1250','Nacin plaćanja: '),0,0);
$pdf ->SetXY(37,100);
$pdf ->SetFont('DejaVu-bold','',10);		
$pdf ->Cell(38,5,$nacinPlacanja,0,0,'C');
$pdf ->Line(37,104,75,104,1,10);

$pdf ->SetFont("DejaVu-Bold","",16);
$pdf ->Rect(115,55,90,50);
$pdf ->SetXY(115,60);
$pdf ->Cell(90,5,iconv('utf-8','cp1250',$imeFirme),0,0,'C');
$pdf ->SetFont("DejaVu-Bold","",11);
$pdf ->SetXY(115,75);
$pdf ->Cell(90,5,$adresaFirme,0,0,'C');
$pdf ->SetXY(115,90);
$pdf ->SetFont('DejaVu','',11);
$pdf ->Cell(10,5,'PIB: ',0,0);
$pdf ->Cell(25,5,$pibFirme,0,0,'C');
$pdf ->SetXY(115,95);
$pdf ->Cell(10,5,'Tel: ',0,0);
$pdf ->Cell(30,5,$brTelFirme,0,0);
$pdf ->Cell(10,5,'Fax:',0,0);
$pdf ->Cell(33,5,'018/265-1254',0,0);
$pdf ->SetXY(115,100);
$pdf ->Cell(28,5,iconv('utf-8','cp1250','Tekući račun: '),0,0);
$pdf ->Cell(0,5,$tekRacFirme,0,1);
$pdf ->SetFont('DejaVu','',10);
$pdf ->SetXY(5,120);
$pdf ->Cell(7,7,'R.b.',1,0,'C');
$pdf ->Cell(40,7,'Vrsta usluga',1,0,'C');
$pdf ->Cell(22,7,'Obim usluga',1,0,'C');
$pdf ->Cell(15,7,'Cena',1,0,'C');
$pdf ->Cell(20,7,'vrednost',1,0,'C');
$pdf ->Cell(15,7,'pdv',1,0,'C');
$pdf ->Cell(35,7,'Vrednost sa PDV-om',1,0,'C');
$pdf ->Cell(15,7,'Rabat',1,0,'C');
$pdf ->Cell(30,7,'Ukupna vrednost',1,1,'C');

	}}
?>