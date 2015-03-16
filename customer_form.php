<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Pocetna strana</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/
  ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="script_customer.js"></script>
  <script language="JavaScript" src="validate.js"></script>
  <!-- Pocetak skripte za prelazak u novi red koristeci enter -->
  <script type="text/javascript">
    $(document).ready(function(){
      $('#myForm input').keydown(function(e){
       if(e.keyCode==13){       

                if($(':input:eq(' + ($(':input').index(this) + 1) + ')').attr('type')=='submit'){// check for submit button and submit form on enter press
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
  <h1>Stranica za unos firmi</h1>
  <div class="navbar navbar-default navbar-static-top" role="navigation" >
  <a href="index.php"><button type="button" class="btn btn-primary" >Početna strana</button></a>
    <a href="statement.php"><button type="button" class="btn btn-primary">Unos izvoda</button></a>
    <a href="card_customers.php"><button type="button" class="btn btn-primary">Kartice kupaca</button></a>
    <a href="card_supplier.php"><button type="button" class="btn btn-primary">Kartice dobavljaca</button></a>
    <a href="book_invoices_in.php"><button type="button" class="btn btn-primary">Knjiga ulaznih faktura</button></a>
    <a href="book_invoices_out.php"><button type="button" class="btn btn-primary">Knjiga izlaznih faktura</button></a>
    <a href="my_company.php"><button type="button" class="btn btn-primary" >Podešavanje naloga</button></a>
  </div>
  <!-- Forma za unos firme -->
  <img src="pictures/addButton.png" data-toggle="modal" data-target=".bs-example-modal-lg">Unos firme
  <div class="modal fade bs-example-modal-lg" id="#my_modal" tabindex="-1" role"dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <form class="form-horizontal" id="myForm" name="customeradd" method="post" action="<?php echo $action; ?>" onSubmit="return validateCustomerAdd();">
        <h2>Unos firme</h2>
        <input type="hidden" name="customer_id" value="<?php echo $row['customer_id']; ?>" >
        <div class="form-group">
          <label class="col-sm-4 control-label" for="customer_name">Unesite ime firme:</label>
          <input type="text" name="customer_name" value="<?php  echo $row['customer_name']; ?>" placeholder="Ime firme" >
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="customer_address">Unesite adresu firme:</label>
          <input type="text" name="customer_address" value="<?php  echo $row['customer_address']; ?>" placeholder="Adresa firme">
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="customer_city">Unesite naziv grada:</label>
          <input type="text" name="customer_city" value="<?php  echo $row['customer_city']; ?>" placeholder="Naziv grada" >
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="customer_zip_code">Unesite poštanski broj:</label>
          <input type="text" name="customer_zip_code" value="<?php  echo $row['customer_zip_code']; ?>" placeholder="Poštanski broj" >
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="customer_tin">Unesite PIB firme:</label>
          <input type="text" name="customer_tin" value="<?php echo $row['customer_tin']; ?>" placeholder="PIB firme">
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="customer_account">Unesite broj tekućeg računa:</label>
          <input type="text" name="customer_account" value="<?php echo $row['customer_account']; ?>" placeholder="Broj tekuceg racuna">
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="customer_phone_number">Unesite broj telefona:</label>
          <input type="text" name="customer_phone_number" value="<?php echo $row['customer_phone_number']; ?>" placeholder="Broj telefona">
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="customer_fax">Unesite broj fax-a:</label>
          <input type="text" name="customer_fax" value="<?php echo $row['customer_fax']; ?>" placeholder="Broj fax-a">
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="customer_vat_status">Da li je firma u sistemu PDV-a?:</label>
          <select value="<?php $row['customer_vat_status']; ?>" name=" customer_vat_status">
            <option>da</option>
            <option>ne</option>
          </select>
        </div>

        <input type="submit" value="snimi" >

      </form>
    </div>
  </div>
</div>
</div>
<!-- Kraj forme za unos firme -->
<!-- Pocetak tabele za prikaz firmi -->
<table class="table table-striped table-hover" id="tabledata">
  <tr data-toggle="modal" data-id="<?php echo $row['name']; ?>" data-target="#orderModal">
    <th>Ulaz</th>
    <th>Ime Firme</th>
    <th>Adresa Firme</th>
    <th>Grad</th>
    <th>Poštanski broj</th>
    <th>PIB Firme</th>
    <th>Tek Rač Firme</th>
    <th>Br Tel Firme</th>
    <th>Br Fax-a</th>
    <th>U sistemu PDV-a</th>

  </tr>
  <?php
  include('connection.php');
  $sql=mysql_query("select * from customer");
  while($row=mysql_fetch_array($sql))
  {
    $customer_id=$row['customer_id'];
    $customer_name=$row['customer_name'];
    $customer_address=$row['customer_address'];
    $customer_city=$row['customer_city'];
    $customer_zip_code=$row['customer_zip_code'];
    $customer_tin=$row['customer_tin'];
    $customer_account=$row['customer_account'];
    $customer_phone_number=$row['customer_phone_number'];
    $customer_fax = $row['customer_fax'];
    $customer_vat_status = $row['customer_vat_status'];
    
    ?>
    <tr id="<?php echo $customer_id; ?>" class="edit_tr">

      <td>
        <span  class="text"><a href="invoice.php?customer_id=<?php echo $row['customer_id']; ?>">#</a></span /&gt;
      </td>

      <td class="edit_td">
        <span id="customer_name_<?php echo $customer_id; ?>" class="text"><?php echo $customer_name; ?></span>
        <input type="text" value="<?php echo $customer_name; ?>" class="editbox" id="customer_name_input_<?php echo $customer_id; ?>" /&gt;
      </td>

      <td class="edit_td">
        <span id="customer_address_<?php echo $customer_id; ?>" class="text"><?php echo $customer_address; ?></span>
        <input type="text" value="<?php echo $customer_address; ?>" class="editbox" id="customer_address_input_<?php echo $customer_id; ?>" /&gt;
      </td>

      <td class="edit_td">
        <span id="customer_city_<?php echo $customer_id; ?>" class="text"><?php echo $customer_city; ?></span>
        <input type="text" value="<?php echo $customer_city; ?>" class="editbox" id="customer_city_input_<?php echo $customer_id; ?>" /&gt;
      </td>

      <td class="edit_td">
        <span id="customer_zip_code_<?php echo $customer_id; ?>" class="text"><?php echo $customer_zip_code; ?></span>
        <input type="text" value="<?php echo $customer_zip_code; ?>" class="editbox" id="customer_zip_code_input_<?php echo $customer_id; ?>" /&gt;
      </td>

      <td class="edit_td">
        <span id="customer_tin_<?php echo $customer_id; ?>" class="text"><?php echo $customer_tin; ?></span>
        <input type="text" value="<?php echo $customer_tin; ?>" class="editbox" id="customer_tin_input_<?php echo $customer_id; ?>" /&gt;
      </td>

      <td class="edit_td">
        <span id="customer_account_<?php echo $customer_id; ?>" class="text"><?php echo $customer_account; ?></span>
        <input type="text" value="<?php echo $customer_account; ?>" class="editbox" id="customer_account_input_<?php echo $customer_id; ?>" /&gt;
      </td>

      <td class="edit_td">
        <span id="customer_phone_number_<?php echo $customer_id; ?>" class="text"><?php echo $customer_phone_number; ?></span> 
        <input type="text" value="<?php echo $customer_phone_number; ?>" class="editbox" id="customer_phone_number_input_<?php echo $customer_id; ?>"/>
      </td>
      <td class="edit_td">
        <span id="customer_fax_<?php echo $customer_id; ?>" class="text"><?php echo $customer_fax; ?></span> 
        <input type="text" value="<?php echo $customer_fax; ?>" class="editbox" id="customer_fax_input_<?php echo $customer_id; ?>"/>
      </td>
      <td class="edit_td">
        <span id="customer_vat_status_<?php echo $customer_id; ?>" class="text"><?php echo $customer_vat_status; ?></span> 
        <input type="text" value="<?php echo $customer_vat_status; ?>" class="editbox" id="customer_vat_status_input_<?php echo $customer_id; ?>"/>
      </td>
      
    </tr>
    <?php
  }
  ?>
</table>
<!-- Kraj tabele za prikaz firmi -->



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