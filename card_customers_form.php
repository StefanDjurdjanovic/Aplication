<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Pocetna strana</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script language="JavaScript" src="validate.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/
  ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="script_firma.js"></script>
  <!-- Pocetak skripte za prelazak u novi red koristeci enter -->
  <script type="text/javascript">
    $(document).ready(function(){
      $('#myForm input').keydown(function(e){
       if(e.keyCode==13){       

                if($(':input:eq(' + ($(':input').index(this) + 1) + ')').attr('type')=='submit'){
                 return true;
               }

               $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();

               return false;
             }

           });
    });
  </script>
  <!-- Kraj skripte za prelazak u novi red koristeci enter -->
</head>
<body>
<!-- Naslov stranice i dugmad za prelazak na izte -->
  <h1>Stranica za pregled kartica kupaca</h1>
  <div class="navbar navbar-default navbar-static-top" role="navigation" >
  <a href="index.php"><button type="button" class="btn btn-primary" >Početna strana</button></a>
    <a href="customer.php"><button type="button" class="btn btn-primary" >Unos kupaca i izrada faktura</button></a>
    <a href="statement.php"><button type="button" class="btn btn-primary" >Unos izvoda</button></a>
    <a href="card_supplier.php"><button type="button" class="btn btn-primary">Kartice dobavljača</button></a>
    <a href="book_invoices_in.php"><button type="button" class="btn btn-primary" >Knjiga ulaznih faktura</button></a>
    <a href="book_invoices_out.php"><button type="button" class="btn btn-primary">Knjiga izlaznih faktura</button></a>
    <a href="my_company.php"><button type="button" class="btn btn-primary" >Podečavanje naloga</button></a>
   
  </div>
  <div class="print_customers">
      <?php if (isset($_GET['company'])) { ?>
    <a href="print_card_customers.php?company=<?php echo $_GET['company']; ?>&date1=<?php echo $_GET['date1']; ?>&date2=<?php echo $_GET['date2']; ?>">
    <img src="pictures/printer.png">
    <p class="print_customers_text">Štampanje kartice</p></a>
    <?php } ?>
    </div>
  <!-- Forma za pretragu podataka potrebnih za kartice kupaca -->
  <form  action="card_customers.php" name="card_customersadd" onsubmit="return validateCardCustomersAdd();">
    <h2><?php if(isset($_GET['company'])){echo $company= $_GET['company'];}
      else{$company = '';} ?></h2>
      <label >Unesite ime firme:</label>
      <select name="company" id="company">
        <?php 
        include ('connection.php');
        $sql2 = mysql_query("SELECT customer_name FROM customer");
        while ($row = mysql_fetch_array($sql2)){?>
        <option value="<?php echo $row['customer_name'];?>"><?php echo $row['customer_name']; ?>  </option>;
        <?php } ?>
      </select>
      <label >Unesite datum:</label>
      <input type="date" name="date1" id="date1">
      <label >Unesite datum:</label>
      <input type="date" name="date2" id="date2">
      <input type="submit" value="snimi" >

  </form>

  <!-- Kraj forme za pretragu podataka potrebnih za kartice kupaca -->
  <!-- Pocetak tabele za prikaz podataka u kartici kupaca -->
    <table class="table table-striped table-hover" id="tabledata" border="1">
    <!-- Listam izvode u kartici kupaca -->
      <tr data-toggle="modal"  data-target="#orderModal">
        <th>Naziv firme</th>
        <th>Broj fakture</th>
        <th>Broj izvoda</th>
        <th>Datum izdavanja</th>
        <th>Duguje</th>
        <th>Potrazuje</th>
        <th>Saldo</th> 
      </tr>
      <?php
      $customer_id = '';
      $statement_value = '';
      $debit1 = 0;
      $debit2 = 0;
      if (isset($_GET['company'] )) {
       $company = $_GET['company'];
       $date1 = $_GET['date1'];
       $date2 = $_GET['date2'];
     }else{
     $company='';
     $date1='';
     $date2='';
     $total_value = 0;
   }
   $sql=mysql_query("SELECT * from statement where company_name='$company'
     and statement_date BETWEEN '$date1' and '$date2' order by statement_date");

   while($row=mysql_fetch_array($sql))
   {       
    $company_name = $row['company_name'];
    $statement_number = $row['statement_number'];
    $statement_date = $row['statement_date'];
    $statement_value = $row['statement_value'];
    $debit2 += $row['statement_value'];
    ?>
    <tr>
      <td><span  class="text"><?php echo $company_name;  ?></span></td>
      <td></td>
      <td><span  class="text">Izvod br. <?php echo $statement_number; ?></span></td>
      <td><span ><?php echo date('d-m-Y',strtotime($statement_date));  ?></span></td>
      <td></td>
      <td><span  class="text"><?php echo $statement_value;  ?></span></td>
      <td><?php echo $debit2; ?></td>
    </tr>
    <!-- Kraj listanja izvoda u kartici kupaca -->
    <!-- Listam fakture u kartici kupaca i racunam ukupne vrednosti -->
    <tr>
    <?php } ?>
    <?php
    // Uptit za prikaz podataka iz baze podataka potrebnih za kartice kupaca
    $sql=mysql_query("SELECT a.customer_id,a.customer_name,b.number,b.date_traffic,b.invoice_id,c.total_value from customer a 
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
    )c on b.invoice_id=c.invoice_id where a.customer_name='$company' and b.invoice_type='izlazna' and date_traffic BETWEEN '$date1' and '$date2'  order by date_traffic
    ");

    while($row=mysql_fetch_array($sql))
    {       
      $customer_id = $row['customer_id'];
      $invoice_id = $row['invoice_id'];
      $number = $row['number'];
      $date_traffic =$row['date_traffic'];
      $customer_name = $row['customer_name'];
      $total_value = $row['total_value'];
      $debit1 += $row['total_value'];
      ?>
      <td>
        <span><?php echo $customer_name;  ?></span>
      </td>
      <td>
        <span>Faktura br. <?php echo $number; ?></span>
      </td>
      <td></td>
      <td>
        <span><?php echo date('d-m-Y',strtotime($date_traffic)); ?></span>
      </td>
      <td>
        <span><?php echo $total_value; ?></span>
      </td>
      <td></td>
      <td><?php  echo  $debit1 - $debit2; ?></td>
    </tr>
    <?php } ?>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <!-- Automatski prikazuje potatke o dugovanju u kartici kupaca -->
    <td><?php $debit = 0;
     $sql=mysql_query("SELECT a.customer_id,a.customer_name,b.number,b.date_traffic,b.invoice_id,c.total_value from customer a 
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
    )c on b.invoice_id=c.invoice_id where a.customer_name='$company' and b.invoice_type='izlazna' and date_traffic BETWEEN '$date1' and '$date2'  order by date_traffic
    ");
      $rows = array();
      while($row = mysql_fetch_assoc($sql))
        {$rows[] = array('total_value' => htmlspecialchars($row['total_value']),);
      $debit += $row['total_value'];}?>
      <p>Ukupno duguje:  <?php echo $debit; ?></p>
    </td>
    <!-- Automatski prikazuje podatke o potrazivanju u kartici kupaca -->
    <td><?php $claimed = 0;
      $query = "SELECT * FROM statement where company_name='$company' and statement_date BETWEEN '$date1' and '$date2' ";
      $result = mysql_query($query);
      $rows = array();
      while($row = mysql_fetch_assoc($result))
        {$rows[] = array('statement_value' => htmlspecialchars($row['statement_value']),);
      $claimed += $row['statement_value'];}?>
      <p>Ukupno potrazuje:  <?php echo $claimed; ?></p>
    </td>
    <!-- Automatski racuna saldo u kartici kupaca -->
    <td>Ukupan saldo: <?php echo $debit - $claimed; ?></td>
  </tr>
  <!-- Kraj listanja faktura i racunanja ukupnih vrednosti -->
</table>
<!-- Kraj tabele za prikaz podataka u kartici kupaca -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script data-require="jquery@2.0.3" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script data-require="bootstrap@2.3.2" data-semver="2.3.2" src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script data-require="knockout@2.3.0" data-semver="2.3.0" src="http://knockoutjs.com/downloads/knockout-2.3.0.js"></script>
<script data-require="toastr@1.3.0" data-semver="1.3.0" src="//www.johnpapa.net/scripts/toastr.min.js"></script>
<script src="editor.js"></script>
</body>
</html>