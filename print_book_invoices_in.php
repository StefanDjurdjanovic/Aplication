<?php 
require('fpdf/fpdf.php');
include('connection.php');



$pdf = new FPDF( 'L', 'mm', 'A4');
$pdf ->AddPage();

$pdf->AddFont('DejaVu','','DejaVuSansCondensed.php',true);
$pdf->AddFont('DejaVu-bold','','DejaVuSans-Bold.php',true);
$pdf->SetFont('DejaVu','','22');
$pdf ->Cell(0,10,"KNJIGA ULAZNIH FAKTURA",0,1,'C');
$pdf ->SetFont('DejaVu-bold','','10');
$pdf ->SetXY(4,30);
$pdf ->multicell(10,4.9,'Redni broj',1,1);
$pdf ->SetXY(14,30);
$pdf ->Multicell(22,4.9,'Datum izdavanja fakture',1,1);
$pdf ->SetXY(36,30);
$pdf ->Multicell(27,7.4,iconv('utf-8','cp1250','Naziv dobavljača'),1,1);
$pdf ->SetXY(63,30);
$pdf ->Multicell(20,14.9,'PIB',1,'C',false);
$pdf ->SetXY(83,30);
$pdf ->Multicell(37,3.7,'Nabavljena dobra i usluge od lica koji su obveznici PDV-a',1,1);
$pdf ->SetXY(120,30);
$pdf ->Multicell(37,3.7,'Nabavljena dobra i usluge od lica koji nisu obveznici PDV-a',1,1);
$pdf ->SetXY(157,30);
$pdf ->Multicell(43,4.9,iconv('utf-8','cp1250','Nabavljena dobra i usluge čiji je promet oslobođen PDV-a'),1,1);
$pdf ->SetXY(200,30);
$pdf ->Multicell(45,3.7,iconv('utf-8','cp1250','IZNOS obračunatog PDV-a za izvršene nabavke po OPŠTOJ stopi (20%)'),1,1);
$pdf ->SetXY(245,30);
$pdf ->Multicell(47,3.7,iconv('utf-8','cp1250','IZNOS obračunatog PDV-a za izvršene nabavke po POSEBNOJ stopi (10%)'),1,1);

$result=mysql_query("SELECT a.customer_id,a.customer_vat_status,a.customer_name,b.number,b.date_traffic,a.customer_tin
      ,b.invoice_id,c.invoice_value,d.invoice_value1,e.vat,f.vat1,g.vat2 from customer a 
      left join(
        select customer_id,invoice_id,number,date_traffic,invoice_type
        from invoice group by invoice_id
      )b on a.customer_id=b.customer_id
    left join 
    (
      select invoice_id,sum(total_value) invoice_value
      from invoice_item 
      group by invoice_id
    )c on b.invoice_id=c.invoice_id and a.customer_vat_status='da'   
    left join 
    (
      select invoice_id,sum(total_value) invoice_value1
      from invoice_item 
      group by invoice_id
    )d on b.invoice_id=d.invoice_id and a.customer_vat_status='ne' 
    left join 
    (
      select invoice_id,sum(vat) vat,vat_percent
      from invoice_item where vat_percent='0'
      group by invoice_id
    )e on b.invoice_id=e.invoice_id 
    left join (
      select invoice_id,vat_percent,sum(vat) vat1
      from invoice_item where vat_percent='10' 
      group by invoice_id
    )f on b.invoice_id=f.invoice_id  and a.customer_vat_status='da'
    left join (
      select invoice_id,vat_percent,sum(vat) vat2
      from invoice_item where vat_percent='20' 
      group by invoice_id
    )g on b.invoice_id=g.invoice_id and a.customer_vat_status='da'
    where b.invoice_type = 'ulazna'");

$order_number = 1;
while($row=mysql_fetch_array($result))
{    
  $date_traffic = date('d-m-Y',strtotime($row['date_traffic']));
  $customer_name =$row['customer_name'];
  $customer_tin = $row['customer_tin'];
  $invoice_value = $row['invoice_value'];
  $invoice_value1 = $row['invoice_value1'];
  $vat = $row['vat'];
  $vat1 = $row['vat1'];
  $vat2 = $row['vat2'];

$pdf ->SetFont('DejaVu','','10');
$pdf ->SetX(4);
$pdf ->Cell(10,10,$order_number++,1,0,'C');
$pdf ->Cell(22,10,$date_traffic,1,0,'C');
$pdf ->Cell(27,10,iconv('utf-8','cp1250',$customer_name),1,0,'C');
$pdf ->Cell(20,10,$customer_tin,1,0,'C');
$pdf ->Cell(37,10,$invoice_value1,1,0,'C');
$pdf ->cell(37,10,$invoice_value,1,0,'C');
$pdf ->cell(43,10,$vat,1,0,'C');
$pdf ->cell(45,10,$vat2,1,0,'C');
$pdf ->cell(47,10,$vat1,1,1,'C');

}

$pdf ->output(); 

?>