<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/
  ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="script_invoice.js"></script>
  <script language="JavaScript" src="validate.js"></script>
  <!-- Skripta za prelazak u novi red koristeci enter -->
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
    <!-- Naslov stranice i dugmad za prelazak na iste -->
    <h1>Stranica za unos faktura</h1>
    <div class="navbar navbar-default navbar-static-top" role="navigation" >
    <a href="first_page.php"><button type="button" class="btn btn-primary" >Početna strana</button></a>
    <a href="customer.php"><button type="button" class="btn btn-primary">Unos kupaca i izrada faktura</button></a>
      <a href="statement.php"><button type="button" class="btn btn-primary">Unos izvoda</button></a>
      <a href="card_customers.php"><button type="button" class="btn btn-primary">Kartice kupaca</button></a>
      <a href="card_supplier.php"><button type="button" class="btn btn-primary">Kartice dobavljaca</button></a>
      <a href="book_invoice_in.php"><button type="button" class="btn btn-primary">Knjiga ulaznih faktura</button></a>
      <a href="book_invoice_out.php"><button type="button" class="btn btn-primary">Knjiga izlaznih faktura</button></a>
      <a href="my_company.php"><button type="button" class="btn btn-primary" >Podešavanje naloga</button></a>
      <a href="invoice.php?action=logout"><img src="pictures\logout.png" class="invoice_logout" /></a>
    </div>
    <!-- Dugme za unos fakture -->
<img src="pictures/addButton.png" data-toggle="modal" data-target=".bs-example-modal-lg">Unos fakture 
<!-- Dugme za pregled podataka firme -->
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Podaci firme
</button>
<!-- Forma za prikaz podataka firme -->
<div class="collapse" id="collapseExample">
  <div class="well">
      <?php 
      $query = "SELECT * FROM customer where customer_id=$customer_id";
      $result = mysql_query($query);
      $rows = array();
      while($row = mysql_fetch_assoc($result)) {
        $rows[] = array(
            'customer_id' => htmlspecialchars($row['customer_id']),
            'customer_name' => htmlspecialchars($row['customer_name']),
            'customer_address' => htmlspecialchars($row['customer_address']),
            'customer_city'  => htmlspecialchars($row['customer_city']),
            'customer_zip_code'   => htmlspecialchars($row['customer_zip_code']),
            'customer_tin'    => htmlspecialchars($row['customer_tin']),
            'customer_account'    => htmlspecialchars($row['customer_account']),
            'customer_phone_number'    => htmlspecialchars($row['customer_phone_number']),
            'customer_vat_status'    => htmlspecialchars($row['customer_vat_status']),
            );
            ?>

            <p>Ime firme:  <?php echo $row['customer_name']; ?></p>
            <p>Adresa firme:  <?php echo $row['customer_address']; ?></p>
            <p>Grad:  <?php echo $row['customer_city']; ?></p>
            <p>Poštanski broj:  <?php echo $row['customer_zip_code']; ?></p>
            <p>PIB firme:  <?php echo $row['customer_tin']; ?></p>
            <p>Tekuci racun:  <?php echo $row['customer_account']; ?></p>
            <p>Broj telefona:  <?php echo $row['customer_phone_number']; ?></p>
            <p>U sistemu PDV-a:  <?php echo $row['customer_vat_status']; ?></p>

            <?php } ?>
        </div>
    </div>
    <!-- Kraj forme za prikaz podataka firme -->
    <!-- Pocetak forme za unos firme -->
    <div class="modal fade bs-example-modal-lg" id="#my_modal" tabindex="-1" role"dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <form class="form-horizontal" id="myForm"  method="post" name="invoiceadd" action="<?php echo $action; ?>" onSubmit="return validateInvoiceAdd();">
            <h2>Unos fakture</h2>
            <input type="hidden" name="customer_id" value="<?php echo $row['customer_id']; ?>" >
            <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id']; ?>" >
            <div class="form-group">
                <label class="col-sm-4 control-label" for="number">Unesite broj fakture:</label>
                <input type="text" name="number" value="<?php  echo $row['number']; ?>" placeholder="Broj fakture" >
            </div> 
            <div class="form-group">
                <label class="col-sm-4 control-label" for="date_traffic">Unesite datum izdavanja:</label>
                <input type="date" name="date_traffic" value="<?php  echo $row['date_traffic']; ?>" placeholder="Datum izdavanja">
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="place_traffic">Unesite mesto izdavanja:</label>
                <input type="text" name="place_traffic" value="<?php echo $row['place_traffic']; ?>" placeholder="Mesto izdavanja">
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="date_turnover">Unesite datum prometa:</label>
                <input type="date" name="date_turnover" value="<?php echo $row['date_turnover']; ?>" placeholder="Datum prometa">
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="place_turnover">Unesite mesto prometa:</label>
                <input type="text" name="place_turnover" value="<?php echo $row['place_turnover']; ?>" placeholder="Mesto prometa">
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="date_payment">Unesite rok plaćanja:</label>
                <input type="text" name="date_payment" value="<?php echo $row['date_payment']; ?>" placeholder="Rok plaćanja">
            </div>
            
            <div class="form-group">
                <label class="col-sm-4 control-label" for="payment_method">Unesite nacin plaćanja:</label>
                <input type="text" name="payment_method" value="<?php echo $row['payment_method']; ?>" placeholder="Način plaćanja">
            </div>
            <div>
                <label class="col-sm-4 control-label" for="invoice_type">Izaberite vrstu fakture:</label>
                <select name="invoice_type">
                    <option>izlazna</option>
                    <option>ulazana</option>
                </select>
            </div>
            <input type="submit" value="snimi" >
        </form>
    </div>
</div>
</div>
<!-- Kraj forme za unos firme -->
<!-- Pocetak tabele za prikaz firmi -->
<table class="table table-striped table-hover" id="tabledata">
    <tr data-toggle="modal"  data-target="#orderModal">
        <th>Ulaz</th>
        <th>Broj fakture</th>
        <th>Datum izdavanja</th>
        <th>Mesto izdavanja</th>
        <th>Datum prometa</th>
        <th>Mesto prometa</th>
        <th>Rok plaćanja</th>
        <th>Nacin plaćanja</th>
        <th>Vrsta fakture</th>
    </tr>
    <?php
    include('connection.php');
    $customer_id = $_GET['customer_id'];
    $sql=mysql_query("select * from invoice where customer_id=$customer_id");
    while($row=mysql_fetch_array($sql))
    {
        $invoice_id = $row['invoice_id'];
        $number = $row['number'];
        $date_traffic =$row['date_traffic'];
        $place_traffic = $row['place_traffic'];
        $date_turnover = $row['date_turnover'];
        $place_turnover = $row['place_turnover'];
        $date_payment = $row['date_payment'];
        $payment_method = $row['payment_method'];
        $invoice_type = $row['invoice_type'];
        ?>
        <tr id="<?php echo $invoice_id; ?>" class="edit_tr">

            <td>
                <span><a href="invoice_item.php?customer_id=<?php echo $row['customer_id']; ?>&invoice_id=<?php echo $row['invoice_id']; ?>">#</a></span /&gt;
                 
            </td>

            <td class="edit_td">
                <span id="number_<?php echo $invoice_id; ?>" class="text"><?php echo $number;  ?></span>
                <input type="text" value="<?php echo $number; ?>" class="editbox" id="number_input_<?php echo $invoice_id; ?>" /&gt;
            </td>

            <td class="edit_td">
                <span id="date_traffic_<?php echo $invoice_id; ?>" class="text"><?php echo date('d-m-Y',strtotime($date_traffic));  ?></span>
                <input type="date" value="<?php echo $date_traffic; ?>" class="editbox" id="date_traffic_input_<?php echo $invoice_id; ?>" /&gt;
            </td>

            <td class="edit_td">
                <span id="place_traffic_<?php echo $invoice_id; ?>" class="text"><?php echo $place_traffic; ?></span>
                <input type="text" value="<?php echo $place_traffic; ?>" class="editbox" id="place_traffic_input_<?php echo $invoice_id; ?>" /&gt;
            </td>

            <td class="edit_td">
                <span id="date_turnover_<?php echo $invoice_id; ?>" class="text"><?php echo date('d-m-Y',strtotime($date_turnover));  ?></span>
                <input type="date" value="<?php echo $date_turnover; ?>" class="editbox" id="date_turnover_input_<?php echo $invoice_id; ?>" /&gt;
            </td>

            <td class="edit_td">
                <span id="place_turnover_<?php echo $invoice_id; ?>" class="text"><?php echo $place_turnover; ?></span>
                <input type="text" value="<?php echo $place_turnover; ?>" class="editbox" id="place_turnover_input_<?php echo $invoice_id; ?>" /&gt;
            </td>

            <td class="edit_td">
                <span id="date_payment_<?php echo $invoice_id; ?>" class="text"><?php echo $date_payment; ?></span>
                <input type="text" value="<?php echo $date_payment; ?>" class="editbox" id="date_payment_input_<?php echo $invoice_id; ?>" /&gt;
            </td>

            <td class="edit_td">
                <span id="payment_method_<?php echo $invoice_id; ?>" class="text"><?php echo $payment_method; ?></span> 
                <input type="text" value="<?php echo $payment_method; ?>" class="editbox" id="payment_method_input_<?php echo $invoice_id; ?>"/&gt;
            </td>
            <td class="edit_td">
                 <span id="invoice_type_<?php echo $invoice_id; ?>" class="text"><?php echo $invoice_type; ?></span>
                 <input type="text" value="<?php echo $invoice_type; ?>" class="editbox" id="invoice_type_input_<?php echo $invoice_id; ?>"/>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<!-- Kraj tabele za prikaz faktue -->
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