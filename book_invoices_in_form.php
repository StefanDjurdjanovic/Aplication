<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

</head>
<body>
<!-- Naslov stranice i dugma za prelazak na iste -->
  <h1>Stranica za pregled ulaznih faktura</h1>
  <div class="navbar navbar-default navbar-static-top" role="navigation" >
  <a href="first_page.php"><button type="button" class="btn btn-primary">Početna strana</button></a>
  <a href="customer.php"><button type="button" class="btn btn-primary">Unos kupaca i izrada faktura</button></a>
    <a href="statement.php"><button type="button" class="btn btn-primary">Unos izvoda</button></a>
    <a href="card_customers.php"><button type="button" class="btn btn-primary">Kartice kupaca</button></a>
    <a href="card_supplier.php"><button type="button" class="btn btn-primary">Kartice dobavljaca</button></a>
    <a href="book_invoices_out.php"><button type="button" class="btn btn-primary">Knjiga izlaznih faktura</button></a>
    <a href="my_company.php"><button type="button" class="btn btn-primary">Podešavanje naloga</button></a>
    <a href="print_book_invoices_in.php"><img src="pictures/printer.png"></a>
    <a href="book_invoices_in.php?action=logout"><img src="pictures\logout.png" class="book_in_logout" /></a>
  </div>
  <!-- Pocetak tabele za prikaz ulaznih faktura -->
  <table class="table table-striped table-hover" id="tabledata" border="1">
    <tr data-toggle="modal"  data-target="#orderModal">
      <th>Redni broj</th>
      <th>Datum izdavanja fakture</th>
      <th>Naziv dobavljača</th>
      <th>PIB</th>
      <th>Nabavljena dobra i usluge od lica koji su obveznici PDV-a</th>
      <th>Nabavljena dobra i usluge od lica koji nisu obveznici PDV-a</th>
      <th>Nabavljena dobra i usluge čiji je promet oslobođen PDV-a</th>
      <th>IZNOS obračunatog PDV-a za izvršene nabavke po OPŠTOJ stopi (20%)</th>
      <th>IZNOS obračunatog PDV-a za izvršene nabavke po POSEBNOJ stopi (10%)</th>
    </tr>
    <?php
    include('connection.php');
    $sql=mysql_query("SELECT a.customer_id,a.customer_vat_status,a.customer_name,b.number,b.date_traffic,a.customer_tin
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
while($row=mysql_fetch_array($sql))
{    
  $date_traffic = $row['date_traffic'];
  $customer_name =$row['customer_name'];
  $customer_tin = $row['customer_tin'];
  $invoice_value = $row['invoice_value'];
  $invoice_value1 = $row['invoice_value1'];
  $vat = $row['vat'];
  $vat1 = $row['vat1'];
  $vat2 = $row['vat2'];
  ?>
  <tr>
    <td><?php echo $order_number++; ?></td>

    <td >
      <span  class="text"><?php echo date('d-m-Y',strtotime($row['date_traffic'])); ?></a></span>
    </td>

    <td>
      <span  class="text"><?php echo $customer_name;  ?></span>
    </td>

    <td>
      <span  class="text"><?php echo $customer_tin ?></span>
    </td>

    <td>
      <span  class="text"><?php echo $invoice_value; ?></span>
    </td>

    <td>
      <span  class="text"><?php echo $invoice_value1; ?></span>
    </td>
    <td>
      <span  class="text"><?php echo $vat; ?></span>
    </td>

    <td>
      <span  class="text"><?php echo $vat1; ?></span>
    </td>

    <td>
      <span  class="text"><?php echo $vat2; ?></span>
    </td>
  </tr>
  <?php } ?>
</table>
<!-- Kraj tabele za prikaz ulaznih faktura -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script data-require="jquery@2.0.3" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script data-require="bootstrap@2.3.2" data-semver="2.3.2" src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script data-require="knockout@2.3.0" data-semver="2.3.0" src="http://knockoutjs.com/downloads/knockout-2.3.0.js"></script>
<script data-require="toastr@1.3.0" data-semver="1.3.0" src="//www.johnpapa.net/scripts/toastr.min.js"></script>
</body>
</html>