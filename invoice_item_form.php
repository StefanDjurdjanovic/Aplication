<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script language="JavaScript" src="validate.js"></script>
  <script type='text/javascript'>
  //skripta za prelazak u novi red koristeci enter
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
    });//kraj skripte za prelazak u novi red koristeci enter
</script>
<script type="text/javascript"><!--
    function updatesum() {
        document.form.vrednost.value = (document.form.obimUsluga.value -0) + (document.form.cena.value -0);
    }
    //--></script>
</head>
<body>
    <!--Naslov stranoce i dugmad za prelazak na iste -->
    <h1>Stranica za unos proizvoda</h1>
    <div class="navbar navbar-default navbar-static-top" role="navigation" >
    <a href="index.php"><button type="button" class="btn btn-primary" >Početna strana</button></a>
      <a href="customer.php"><button type="button" class="btn btn-primary">Unos kupaca i izrada faktura</button></a>
      <a href="statement.php"><button type="button" class="btn btn-primary">Unos izvoda</button></a>
      <a href="card_customers.php"><button type="button" class="btn btn-primary">Kartice kupaca</button></a>
      <a href="card_supplier.php"><button type="button" class="btn btn-primary">Kartice dobaavljača</button></a>
      <a href="book_invoices_in.php"><button type="button" class="btn btn-primary">Knjiga ulaznih faktura</button></a>
      <a href="book_invoices_out.php"><button type="button" class="btn btn-primary">Knjiga izlaznih faktura</button></a>
      <a href="my_company.php"><button type="button" class="btn btn-primary" >Podešavanje naloga</button></a>
  </div>
<!-- Dugme za unos proizvoda-->
  <img src="pictures/addButton.png" data-toggle="modal" data-target=".bs-example-modal-lg">Unos proizvoda
  <a href="print_invoice.php?customer_id=<?php echo $_GET['customer_id']; ?>&invoice_id=<?php echo $_GET['invoice_id']; ?>"><img src="pictures/printer.png"></a>
  <!-- Dugme za pregled podataka firme i fakture--> 
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">

    Podaci firme i fakture
</button>
<div class="collapse" id="collapseExample">
  <div class="well">
  <!--Pocetak tabele sa podacima o firmi i fakturi -->
      <table>

          <!-- Prikaz podataka iz baze podataka za firmu-->
      <tr><td><h3>Podaci o firmi</h3></td></tr>
          <tr>
              <?php 
  
              $query1 = "SELECT * FROM customer INNER JOIN invoice WHERE customer.customer_id=invoice.customer_id AND invoice.invoice_id=$invoice_id ";
              $result = mysql_query($query1);
              $rows = array();
              while($row = mysql_fetch_assoc($result)) {
                $rows[] = array(
                    'customer_id' => htmlspecialchars($row['customer_id']),
                    'customer_name' => htmlspecialchars($row['customer_name']),
                    'customer_address' => htmlspecialchars($row['customer_address']),
                    'customer_city' => htmlspecialchars($row['customer_city']),
                    'customer_zip_code' => htmlspecialchars($row['customer_zip_code']),
                    'customer_tin'  => htmlspecialchars($row['customer_tin']),
                    'customer_account'   => htmlspecialchars($row['customer_account']),
                    'customer_phone_number'    => htmlspecialchars($row['customer_phone_number']),
                    'customer_vat_status'    => htmlspecialchars($row['customer_vat_status']),
                    );
                    ?>

                    <td><strong> Ime firme:</strong>  <?php echo $row['customer_name']; ?></td>
                    <td><strong>Adresa firme:</strong>  <?php echo $row['customer_address']; ?></td>
                    <td><strong>Grad:</strong>  <?php echo $row['customer_city']; ?></td>
                    <td><strong>Poštanski broj:</strong>  <?php echo $row['customer_zip_code']; ?></td>
                    <td><strong>PIB firme:</strong>  <?php echo $row['customer_tin']; ?></td>
                    <td><strong>Tekuci racun:</strong>  <?php echo $row['customer_account']; ?></td>
                    <td><strong>Broj telefona:</strong>  <?php echo $row['customer_phone_number']; ?></td>
                    <td><strong>U sistemu PDV-a:</strong>  <?php echo $row['customer_vat_status']; ?></td>

                    <?php } ?>
                </tr>
                <!-- Kraj prikaza podataka iz baze podataka za firmu-->
                <!--Prikaz podataka iz baze podataka za fakturu -->
                <tr><td><h3>Podaci o fakturi</h3></td></tr>
                <tr>
                    <?php 

                    $query = "SELECT * FROM invoice where invoice_id=$invoice_id";
                    $result = mysql_query($query);
                    $fakturas = array();
                    while($faktura = mysql_fetch_assoc($result)) {
                        $fakturas[] = array( 
                            'invoice_id' => htmlspecialchars($faktura['invoice_id']),
                            'number' => htmlspecialchars($faktura['number']),
                            'date_traffic' => htmlspecialchars($faktura['date_traffic']),
                            'place_traffic' => htmlspecialchars($faktura['place_traffic']),
                            'date_turnover'  => htmlspecialchars($faktura['date_turnover']),
                            'place_turnover'  => htmlspecialchars($faktura['place_turnover']),
                            'date_payment'   => htmlspecialchars($faktura['date_payment']),
                            'payment_method' => htmlspecialchars($faktura['payment_method']),
                            'invoice_type' => htmlspecialchars($faktura['invoice_type']),

                            );


                            ?>

                            <td><strong>Broj fakture: </strong> <?php echo $faktura['number']; ?></td>
                            <td><strong>Datum izdavanja:</strong>  <?php echo date('d-m-Y',strtotime($faktura['date_traffic'])); ?></td>
                            <td><strong>Mesto izdavanja:</strong>  <?php echo $faktura['place_traffic']; ?></td>
                            <td><strong>Datum prometa:</strong>  <?php echo date('d-m-Y',strtotime($faktura['date_turnover'])); ?></td>
                            <td><strong>Mesto prometa:</strong>  <?php echo $faktura['place_turnover']; ?></td>
                            <td><strong>Rok placanja:</strong>  <?php echo $faktura['date_payment']; ?> DANA</td>
                            <td><strong>Nacin placanja:</strong>  <?php echo $faktura['payment_method']; ?></td>
                            <td><strong>Vrsta fakture:</strong>  <?php echo $faktura['invoice_type']; ?></td>


                            <?php } ?>
                            <!--Kraj prikaza podataka iz baze podataka za fakturu -->
                        </tr></table>
                    </div>
                </div>
                <!--Kraj tabele za prikaz podataka o firmi i fakturi -->
                <!--Pocetak forme za unos proizvoda u bazu podataka -->

                <?php
               $invoice_id = $_GET['invoice_id'];
            $sql=mysql_query("select count(service_type) service_type from invoice_item where invoice_id=$invoice_id");

            while($row=mysql_fetch_array($sql)){
                                 
            
                        
                        $service_type = $row['service_type'];}
                 if ($service_type > 13){ ?>
                    <div class="alert alert-danger" role="alert">
                    Na fakturi ne može stati više proizvoda, molimo ostatak štampajte da sledećoj fakturi!
                    </div>
              <?php  } else{?>
                <div class="modal fade bs-example-modal-lg" id="#my_modal" tabindex="-1" role"dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                 <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                      <form class="form-horizontal" id="myForm" name="invoiceitemadd" method="post" action="<?php echo $action; ?>" onSubmit="return validateInvoice_itemAdd();">
                        <h2>Unos proizvoda</h2>

                        <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id']; ?>" >
                        <input type="hidden" name="invoice_item_id" value="<?php echo $row['invoice_item_id']; ?>" >
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="service_type">Unesite vrstu usluga:</label>
                            <input type="text" class="enter" name="service_type" value="<?php  echo $row['service_type']; ?>" placeholder="vrsta usluga" >
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="service_range">Unesite kolicinu:</label>
                            <input type="text" class="enter" name="service_range" value="<?php  echo $row['service_range']; ?>"  placeholder="kolicina">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="price">Unesite cenu:</label>
                            <input type="text" class="enter" name="price" value="<?php echo $row['price']; ?>" placeholder="cena">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="vat">Unesite procenat PDV-a:</label>
                            <input type="text" class="enter" name="vat" value="<?php echo $row['vat']; ?>" placeholder="PDV procenat">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="rebate">Unesite procenat rabat-a:</label>
                            <input type="text" class="enter" name="rebate" value="<?php echo $row['rebate']; ?>" placeholder="Unesite procenat rabat-a">
                        </div>

                        <input type="submit" value="snimi" >

                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
        <!--Kraj forme za unos proizvoda u bazu podataka -->

        <!--Pocetak tabele za prikaz podataka iz baze podataka o proizvodu -->
        <table class="table table-striped table-hover" id="tabledata" border="1">
            <tr data-toggle="modal"  data-target="#orderModal">
                <th>Redni broj</th>
                <th>Vrsta usluga</th>
                <th>Obim usluga(kom)</th>
                <th>cena</th>
                <th>Vrednost robe</th>
                <th>PDV</th>
                <th>Vrednost sa PDV-om</th>
                <th>Rabat</th>
                <th>Ukupna vrednost</th>
                <th>Brisanje</th>

            </tr>
            <?php

            include('connection.php');
            $order_number = 1;
            $invoice_id = $_GET['invoice_id'];
            $sql=mysql_query("select * from invoice_item where invoice_id=$invoice_id");

            while($row=mysql_fetch_array($sql))
                {    $invoice_item_id = $row['invoice_item_id'];
            $service_type = $row['service_type'];
            $service_range =$row['service_range'];
            $price = $row['price'];
            $value = $row['value'];
            $vat = $row['vat'];
            $vat_value = $row['vat_value'];
            $rebate = $row['rebate'];
            $total_value = $row['total_value'];                     
            ?>
            <tr>

                <td >
                    <span  class="text"><?php  echo $order_number++; ?></a></span>
                </td>
                
                <td>
                    <span  class="text"><?php echo $service_type;  ?></span>
                </td>

                <td>
                    <span  class="text"><?php echo $service_range; ?></span>
                </td>

                <td>
                    <span  class="text"><?php echo $price; ?></span>
                </td>

                <td>
                    <span  class="text"><?php echo $value; ?></span>
                </td>

                <td>
                    <span  class="text"><?php echo $vat; ?></span>
                </td>

                <td>
                    <span  class="text"><?php echo $vat_value; ?></span>
                </td>

                <td>
                    <span  class="text"><?php echo $rebate; ?></span>
                </td>

                <td>
                    <span  class="text"><?php echo $total_value; ?></span> 
                </td>
                <td><a href="invoice_item.php?action=delete&customer_id=<?php echo $row['customer_id']; ?>&invoice_id=<?php echo $row['invoice_id']; ?>&invoice_item_id=
                <?php echo $row['invoice_item_id']; ?>" >Izbri&scaron;i</a></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
                <!--Automatski prikazuje vrednost proizvoda unetih za datu fakturu -->
                <td><?php $total_value_product = 0;
                    $query = "SELECT * FROM invoice_item where invoice_id=$invoice_id ";
                    $result = mysql_query($query); $rows = array();while($row = mysql_fetch_assoc($result)) {
                    $rows[] = array('value' => htmlspecialchars($row['value']),);
                    $total_value_product += $row['value'];}?>
                    <p>Ukupno:  <?php echo $total_value_product; ?></p>
                </td>
                <!--Automatski prikazuje vrednost pdv-a za datu fakturu -->
                <td><?php  $total_vat = 0;
                    $query = "SELECT * FROM invoice_item where invoice_id=$invoice_id ";
                    $result = mysql_query($query); $rows = array();while($row = mysql_fetch_assoc($result)) {
                    $rows[] = array('vat' => htmlspecialchars($row['vat']),);
                    $total_value_product += $row['vat'];}?>
                    <p>Ukupno:  <?php echo $total_vat; ?></p>
                </td>
                <!--Automatski prikazuje vrednost sa pdv-om za datu fakturu -->
                <td><?php $total_vat_value = 0;
                    $query = "SELECT * FROM invoice_item where invoice_id=$invoice_id ";
                    $result = mysql_query($query); $rows = array();while($row = mysql_fetch_assoc($result)) {
                    $rows[] = array('vat_value' => htmlspecialchars($row['vat_value']),);
                    $total_vat_value += $row['vat_value'];}?>
                    <p>Ukupno:  <?php echo $total_vat_value; ?></p>
                </td>
                <!--Automatski prikazuje vrednost rabata za datu fakturu -->
                <td><?php $total_rebate = 0;
                    $query = "SELECT * FROM invoice_item where invoice_id=$invoice_id ";
                    $result = mysql_query($query); $rows = array();while($row = mysql_fetch_assoc($result)) {
                    $rows[] = array('rebate' => htmlspecialchars($row['rebate']),);
                    $total_rebate += $row['rebate'];}?>
                    <p>Ukupno:  <?php echo $total_rebate; ?></p>
                </td>
                <!--Automatski prikazuje ukupnu vrednost zajedno sa rabatom za datu fakturu -->
                <td><?php 
                    $total_value_all = 0;
                    $query = "SELECT * FROM invoice_item where invoice_id=$invoice_id ";
                    $result = mysql_query($query); $rows = array();while($row = mysql_fetch_assoc($result)){
                    $rows[] = array('total_value' => htmlspecialchars($row['total_value']),);
                    $total_value_all += $row['total_value'];}?>
                    <p>Ukupno:  <?php echo $total_value_all; ?></p><?php  ?>
                </td>   
                </tr>
                    </table>
                    <!--Kraj tabele za prikaz podataka iz baze podataka o proizvodu -->


                <script src="js/bootstrap.min.js"></script>
                <script data-require="jquery@2.0.3" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
                <script data-require="bootstrap@2.3.2" data-semver="2.3.2" src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
                <script data-require="knockout@2.3.0" data-semver="2.3.0" src="http://knockoutjs.com/downloads/knockout-2.3.0.js"></script>
                <script data-require="toastr@1.3.0" data-semver="1.3.0" src="//www.johnpapa.net/scripts/toastr.min.js"></script>
                </body>
                </html>