<?php
require('fpdf/fpdf.php');
include('connection.php');

$company = $_GET['company'];
$date1 = $_GET['date1'];
$date2 = $_GET['date2'];


$pdf = new FPDF( 'L', 'mm', 'A4');
$pdf ->AddPage();

$pdf->AddFont('DejaVu','','DejaVuSansCondensed.php',true);
$pdf->AddFont('DejaVu-bold','','DejaVuSans-Bold.php',true);
$pdf ->SetFont("DejaVu-bold","",22);
$pdf ->Cell(0,10,iconv('utf-8','cp1250','Kartica dobavljača'),0,1,'C');
$pdf ->SetFont("DejaVu-bold","",12);
$pdf ->SetX(25);
$pdf ->Cell(20,10,'Kupac: ',0,0);
$pdf ->SetFont("DejaVu","",12);
$pdf ->Cell(40,10,iconv('utf-8','cp1250',$company),0,0,'C');
$pdf ->SetFont("DejaVu-bold","",12);
$pdf ->Cell(60,10,'Datum pretrage',0,0);
$pdf ->Cell(15,10,'Od: ',0,0);
$pdf ->SetFont("DejaVu","",12);
$pdf ->Cell(50,10,date('d-m-Y',strtotime($date1)),0,0,'C');
$pdf ->SetFont("DejaVu-bold","",12);
$pdf ->Cell(15,10,'Do: ',0,0);
$pdf ->SetFont("DejaVu","",12);
$pdf ->Cell(50,10,date('d-m-Y',strtotime($date2)),0,1,'C');

$pdf ->SetX(20);
$pdf ->Cell(35,10,'Naziv firme',1,0,'C');
$pdf ->Cell(35,10,'Broj fakture',1,0,'C');
$pdf ->Cell(35,10,'Broj izvoda',1,0,'C');
$pdf ->Cell(45,10,'Datum izdavanja',1,0,'C');
$pdf ->Cell(35,10,'Duguje',1,0,'C');
$pdf ->Cell(35,10,iconv('utf-8','cp1250','Potražuje'),1,0,'C');
$pdf ->Cell(35,10,'Saldo',1,1,'C');

$debit1 = 0;
$debit2 = 0;
$result=mysql_query("SELECT * from statement where company_name='$company'
     and statement_date BETWEEN '$date1' and '$date2' order by statement_date");
$debit1 = 0;
$debit2 = 0;
while($row=mysql_fetch_array($result))
{    
  $company_name = $row['company_name'];
    $statement_number = $row['statement_number'];
    $statement_date =date('d-m-Y',strtotime( $row['statement_date']));
    $statement_value = $row['statement_value'];
    $debit2 += $row['statement_value'];

$pdf ->SetX(20);
$pdf ->SetFont('DejaVu','','10');
$pdf ->Cell(35,10,$company_name,1,0,'C');
$pdf ->cell(35,10,'',1,0,'C');
$pdf ->Cell(35,10,'Izvod br. '.$statement_number,1,0,'C');
$pdf ->Cell(45,10,$statement_date,1,0,'C');
$pdf ->cell(35,10,'',1,0,'C');
$pdf ->Cell(35,10,$statement_value,1,0,'C');
$pdf ->cell(35,10,$debit2,1,1,'C');
}

$result=mysql_query("SELECT a.customer_id,a.customer_name,b.number,b.date_traffic,b.invoice_id,c.total_value from customer a 
    left join
    (
      select customer_id,invoice_id,number,date_traffic,invoice_type
      from invoice group by invoice_id 
    )b on a.customer_id=b.customer_id
    left join 
    (
      select invoice_id,sum(total_value) total_value
      from invoice_item
      group by invoice_id
    )c on b.invoice_id=c.invoice_id where a.customer_name='$company' and b.invoice_type='ulazna' and date_traffic BETWEEN '$date1' and '$date2'  order by date_traffic
    ");
while($row=mysql_fetch_array($result))
{    
  $customer_id = $row['customer_id'];
      $invoice_id = $row['invoice_id'];
      $number = $row['number'];
      $date_traffic =date('d-m-Y',strtotime($row['date_traffic']));
      $customer_name = $row['customer_name'];
      $total_value = $row['total_value'];
      $debit1 += $row['total_value'];

$pdf ->SetX(20);
$pdf ->SetFont('DejaVu','','10');
$pdf ->Cell(35,10,$customer_name,1,0,'C');
$pdf ->Cell(35,10,'Faktura br. '.$number,1,0,'C');
$pdf ->cell(35,10,'',1,0,'C');
$pdf ->Cell(45,10,$date_traffic,1,0,'C');
$pdf ->Cell(35,10,$total_value,1,0,'C');
$pdf ->cell(35,10,'',1,0,'C');
$pdf ->cell(35,10,$debit1-$debit2,1,1,'C');
}
$debit = 0;
$claimed = 0;
$query = "SELECT a.customer_id,a.customer_name,b.number,b.date_traffic,b.invoice_id,c.total_value from customer a 
    left join
    (
      select customer_id,invoice_id,number,date_traffic,invoice_type
      from invoice group by invoice_id 
    )b on a.customer_id=b.customer_id
    left join 
    (
      select invoice_id,sum(total_value) total_value
      from invoice_item
      group by invoice_id
    )c on b.invoice_id=c.invoice_id where a.customer_name='$company' and b.invoice_type='ulazna' and date_traffic BETWEEN '$date1' and '$date2'  order by date_traffic
    ";
      $result = mysql_query($query);
      $rows = array();
      while($row = mysql_fetch_assoc($result))
        {$rows[] = array('total_value' => htmlspecialchars($row['total_value']),);
      $debit += $row['total_value'];}

      $query = "SELECT * FROM statement where company_name='$company' and statement_date BETWEEN '$date1' and '$date2' ";
      $result = mysql_query($query);
      $rows = array();
      while($row = mysql_fetch_assoc($result))
        {$rows[] = array('statement_value' => htmlspecialchars($row['statement_value']),);
      $claimed += $row['statement_value'];}

$pdf ->SetX(170);
$pdf ->Cell(35,10,'Ukupno: '.$debit,1,0,'C');
$pdf ->Cell(35,10,'Ukupno: '.$claimed,1,0,'C');
$pdf ->Cell(35,10,'Ukupno: '.($debit - $claimed),1,1,'C');

$pdf ->output(); 
?>