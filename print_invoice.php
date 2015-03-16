

<?php 
require('fpdf/fpdf.php');
include('connection.php');


$customer_id = $_GET['customer_id'];
$invoice_id = $_GET['invoice_id'];
$result=mysql_query("SELECT * from customer inner join invoice inner join settings where customer.customer_id=$customer_id 
	 and invoice.invoice_id=$invoice_id ");


while($row = mysql_fetch_array($result)){
	$customer_name = $row['customer_name'];
	$customer_address = $row['customer_address'];
	$customer_tin = $row['customer_tin'];
	$customer_zip_code = $row['customer_zip_code'];
	$customer_city = $row['customer_city'];
	$customer_fax = $row['customer_fax'];
	$customer_account = $row['customer_account'];
	$customer_phone_number = $row['customer_phone_number'];
	$number = $row['number'];
	$date_traffic = date('d-m-Y',strtotime($row['date_traffic']));
	$place_traffic = $row['place_traffic'];
	$date_turnover = date('d-m-Y',strtotime($row['date_turnover']));
	$place_turnover = $row['place_turnover'];
	$date_payment = $row['date_payment'];
	$payment_method = $row['payment_method'];
	$name = $row['name'];
	$description = $row['description'];
	$address = $row['address'];
	$city = $row['city'];
	$zip_code = $row['zip_code'];
	$tin = $row['tin'];
	$activity_code = $row['activity_code'];
	$registration_number= $row['registration_number'];
	$account = $row['account'];
	$phone_number = $row['phone_number'];
	$fax = $row['fax'];
	$email = $row['email'];
	$comment = $row['comment'];}

$pdf = new FPDF( 'P', 'mm', 'A4');
$pdf ->AddPage();

$pdf->AddFont('DejaVu','','DejaVuSansCondensed.php',true);
$pdf->AddFont('DejaVu-bold','','DejaVuSans-Bold.php',true);
$pdf ->SetFont("DejaVu","",10);
$pdf ->Cell(105,5,iconv('utf-8','cp1250',$description),0,1);
$pdf ->SetFont("DejaVu-bold","",12);
$pdf ->Cell(50,5,iconv('utf-8','cp1250',$name),0,1);
$pdf ->SetFont("DejaVu","",10);
$pdf ->Cell(75,5,iconv('UTF-8', 'cp1250',$address.', '.$city.', '.$zip_code),0,1);
$pdf ->SetFont("DejaVu","",10);
$pdf ->Cell(35,5,iconv('UTF-8', 'cp1250',"PIB: ".$tin),0,0);
$pdf ->Cell(50,5,iconv('UTF-8', 'cp1250',"Šira delatnosti: ".$activity_code),0,0);
$pdf ->Cell(50,5,iconv('UTF-8', 'cp1250',"Matični broj: ".$registration_number),0,1);
$pdf ->Cell(87,5,iconv('UTF-8', 'cp1250',"Tekući račun: ".$account),0,1);
$pdf ->Cell(62,5,iconv('utf-8','cp1250','Broj telefona: '.$phone_number),0,0);
$pdf ->Cell(62,5,iconv('utf-8','cp1250','Fax: '.$fax),0,0);
$pdf ->Cell(62,5,iconv('utf-8','cp1250','E-mail: '.$email),0,1);


$pdf ->SetXY(10,50);
$pdf ->SetFont('DejaVu','',10);
$pdf ->Cell(50,5,iconv('utf-8','cp1250','Broj fakture: '),0,0,'R');
$pdf ->SetXY(60,50);
$pdf ->SetFont('DejaVu-bold','',10);
$pdf ->Cell(25,5,$number,0,0,'C');
$pdf ->Line(85,54,60,54,1,10);

$pdf ->SetXY(10,60);
$pdf ->SetFont('DejaVu','',10);
$pdf ->Cell(50,5,iconv('utf-8','cp1250','Datum izdavanja računa: '),0,0);
$pdf ->SetXY(55,60);
$pdf ->SetFont('DejaVu-bold','',10);
$pdf ->Cell(45,5,$date_traffic.' godine',0,0,'C');
$pdf ->Line(100,64,55,64,1,10);

$pdf ->SetXY(10,68);
$pdf ->SetFont('DejaVu','',10);
$pdf ->Cell(50,5,iconv('utf-8','cp1250','Mesto izdavanja računa: '),0,0);
$pdf ->SetXY(55,68);
$pdf ->SetFont('DejaVu-bold','',10);
$pdf ->Cell(45,5,iconv('utf-8','cp1250',$place_traffic),0,0,'C');
$pdf ->Line(100,72,55,72,1,10);

$pdf ->SetXY(10,76);
$pdf ->SetFont('DejaVu','',10);
$pdf ->Cell(55,5,iconv('utf-8','cp1250','Datum prometa dobara i usluga: '),0,0);
$pdf ->SetXY(67,76);
$pdf ->SetFont('DejaVu-bold','',10);
$pdf ->Cell(45,5,$date_turnover.' godine',0,0,'C');
$pdf ->Line(112,80,67,80,1,10);

$pdf ->SetXY(10,84);
$pdf ->SetFont('DejaVu','',10);
$pdf ->Cell(55,5,iconv('utf-8','cp1250','Mesto prometa dobara i usluga: '),0,0);
$pdf ->SetXY(65,84);
$pdf ->SetFont('DejaVu-bold','',10);
$pdf ->Cell(40,5,iconv('utf-8','cp1250',$place_turnover),0,0,'C');
$pdf ->Line(105,88,65,88,1,10);

$pdf ->SetXY(10,92);
$pdf ->SetFont('DejaVu','',10);
$pdf ->Cell(55,5,iconv('utf-8','cp1250','Rok plaćanja: '),0,0);
$pdf ->SetXY(35,92);
$pdf ->SetFont('DejaVu-bold','',10);
$pdf ->Cell(40,5,$date_payment.' DANA',0,0,'C');
$pdf ->Line(35,96,75,96,1,10);

$pdf ->SetXY(10,100);
$pdf ->SetFont('DejaVu','',10);
$pdf ->Cell(55,5,iconv('utf-8','cp1250','Nacin plaćanja: '),0,0);
$pdf ->SetXY(37,100);
$pdf ->SetFont('DejaVu-bold','',10);		
$pdf ->Cell(38,5,$payment_method,0,0,'C');
$pdf ->Line(37,104,75,104,1,10);

$pdf ->SetFont("DejaVu-Bold","",16);
$pdf ->Rect(115,55,90,50);
$pdf ->SetXY(115,60);
$pdf ->Cell(90,5,iconv('utf-8','cp1250',$customer_name),0,0,'C');
$pdf ->SetFont("DejaVu-Bold","",11);
$pdf ->SetXY(115,75);
$pdf ->Cell(90,5,$customer_address,0,0,'C');
$pdf ->SetXY(115,80);
$pdf ->SetFont('DejaVu','',11);
$pdf ->Cell(90,5,$customer_zip_code.(',').$customer_city,0,0,'C');
$pdf ->SetXY(115,90);
$pdf ->SetFont('DejaVu','',11);
$pdf ->Cell(10,5,'PIB: ',0,0);
$pdf ->Cell(25,5,$customer_tin,0,0,'C');
$pdf ->SetXY(115,95);
$pdf ->Cell(10,5,'Tel: ',0,0);
$pdf ->Cell(30,5,$customer_phone_number,0,0);
$pdf ->Cell(10,5,'Fax:',0,0);
$pdf ->Cell(33,5,$customer_fax,0,0);
$pdf ->SetXY(115,100);
$pdf ->Cell(28,5,iconv('utf-8','cp1250','Tekući račun: '),0,0);
$pdf ->Cell(0,5,$customer_account,0,1);
$pdf ->SetFont('DejaVu','',10);
$pdf ->SetXY(2,110);
$pdf ->Cell(7,7,'R.b.',1,0,'C');
$pdf ->Cell(40,7,'Vrsta usluga',1,0,'C');
$pdf ->Cell(22,7,'Obim usluga',1,0,'C');
$pdf ->Cell(18,7,'Cena',1,0,'C');
$pdf ->Cell(21,7,'vrednost',1,0,'C');
$pdf ->Cell(18,7,'pdv',1,0,'C');
$pdf ->Cell(35,7,'Vrednost sa PDV-om',1,0,'C');
$pdf ->Cell(15,7,'Rabat',1,0,'C');
$pdf ->Cell(30,7,'Ukupna vrednost',1,1,'C');
$customer_id = $_GET['customer_id'];
$invoice_id = $_GET['invoice_id'];
include('connection.php');
$order_number = 1;
$total_value_invoice = 0;
$vat_total_value =0;
$vat_sum = 0;
$result = mysql_query("SELECT * from invoice_item where customer_id=$customer_id and invoice_id = $invoice_id");
while($row = mysql_fetch_assoc($result)){
 $service_type = $row['service_type'];
 $service_range = $row['service_range'];
 $price = $row['price'];
 $value = $row['value'];
 $vat = $row['vat'];	
 $vat_value = $row['vat_value'];
 $rebate = $row['rebate'];
 $total_value = $row['total_value'];
 $vat_total_value += $value;
 $total_value_invoice += $total_value;
 $vat_sum += $vat;
 $pdf ->SetX(2);
 $pdf ->Cell(7,7,$order_number++,1,0,'C');
 $pdf ->Cell(40,7,$service_type,1,0,'C');
 $pdf ->Cell(22,7,$service_range,1,0,'C');
 $pdf ->Cell(18,7,$price,1,0,'C');
 $pdf ->Cell(21,7,$value,1,0,'C');
 $pdf ->Cell(18,7,$vat,1,0,'C');
 $pdf ->Cell(35,7,$vat_value,1,0,'C');
 $pdf ->Cell(15,7,$rebate,1,0,'C');
 $pdf ->Cell(30,7,$total_value,1,1,'C');
}
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.php',true);
$pdf->AddFont('DejaVu-bold','','DejaVuSans-Bold.php',true);
$pdf ->Cell(168,7,'Ukupno',0,0,'R');
$pdf ->SetFont('DejaVu-bold','',10);
$pdf ->Cell(30,7,$total_value_invoice,1,1,'C');
$pdf ->SetFont('DejaVu-Bold','',10);
$pdf ->SetXY(120,230);
$pdf ->Cell(40,7,'VREDNOST ROBE: ',0,0,'L');
$pdf ->SetFont('DejaVu','',10);
$pdf ->SetXY(160,230);
$pdf ->Cell(30,7,$vat_total_value,0,1,'L');
$pdf ->SetFont('DejaVu-Bold','',10);
$pdf ->SetXY(120,240);
$pdf ->Cell(30,7,'PDV: ',0,0,'L');
$pdf ->SetFont('DejaVu','',10);
$pdf ->SetXY(160,240);
$pdf ->Cell(30,7,$vat_sum,0,1,'L');
$pdf ->SetFont('DejaVu-Bold','',10);
$pdf ->SetXY(120,250);
$pdf ->Cell(30,7,'ZA UPLATU: ',0,0,'L');
$pdf ->SetFont('DejaVu','',10);
$pdf ->SetXY(160,250);
$pdf ->Cell(30,7,$vat_sum + $vat_total_value,0,1,'L');
$pdf ->SetFont('DejaVu-bold','',10);
$pdf ->SetXY(10,215);
$pdf ->MultiCell(30,7,'NAPOMENA: ',0,1);
$pdf ->SetFont('DejaVu','',11);
$pdf->drawTextBox(iconv('utf-8','cp1250','Račun je plativ u roku od ').$date_payment.' DANA. Valuta '.$date_traffic.iconv('utf-8','cp1250',
	'. U slučaju kašnjenja sa plaćanjem zaračunavamo zateznu kamatu.                            ').iconv('utf-8','cp1250','Napomena o poreskom oslobođenju:              '
	.$comment), 90, 30, 'L', 'M');
$pdf ->SetXY(10,250);
$pdf ->Cell(0,8,iconv('utf-8','cp1250','Usluge izvršio:'),0,1);
$pdf ->Cell(40,2,'---------------------------   M.P. ----------------------' ,0,1);
$pdf ->SetFont('DejaVu','',8);
$pdf ->Cell(40,3,'Ime,prezime i potpis',0,1);
$pdf ->SetFont('DejaVu','',11);
$pdf ->Cell(0,8,iconv('utf-8','cp1250','Usluge primio:'),0,1);
$pdf ->Cell(40,2,'---------------------------   M.P. ----------------------' ,0,1);
$pdf ->SetFont('DejaVu','',8);
$pdf ->Cell(40,3,'Primio',0,1,'C');

$pdf ->output(); 

?>