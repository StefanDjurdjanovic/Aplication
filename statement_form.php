
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script language="JavaScript" src="validate.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <!-- Pocetak skripte za prelazak u novi red koristeci enter -->
  <script type='text/javascript'>
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
  <!-- Krak skripte za prelazak u novi red koristeci enter -->
</head>
<!-- Naslov stranoce i dugmad za prelazak na iste -->
<body>
<h1>Stranica za unos izvoda</h1>

  <div class="navbar navbar-default navbar-static-top" role="navigation" >
  <a href="first_page.php"><button type="button" class="btn btn-primary" >Početna strana</button></a>
    <a href="customer.php"><button type="button" class="btn btn-primary">Unos kupaca i izrada faktura</button></a>
    <a href="card_customers.php"><button type="button" class="btn btn-primary">Kartice kupaca</button></a>
    <a href="card_supplier.php"><button type="button" class="btn btn-primary">Kartice dobavljača</button></a>
    <a href="book_invoices_in.php"><button type="button" class="btn btn-primary">Knjiga ulaznih faktura</button></a>
    <a href="book_invoices_out.php"><button type="button" class="btn btn-primary">Knjiga izlaznih faktura</button></a>
    <a href="my_company.php"><button type="button" class="btn btn-primary" >Podešavanje naloga</button></a>
    <a href="invoice.php?action=logout"><img src="pictures/logout.png"  class="statement_logout"/></a>
  </div>
  <!-- Dugme za unos izvoda -->
  <img src="pictures/addButton.png" data-toggle="modal" data-target=".bs-example-modal-lg">Unos izvoda 
  <!-- Forma za unos izvoda -->
  <div class="modal fade bs-example-modal-lg" id="#my_modal" tabindex="-1" role"dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <form class="form-horizontal" id="myForm" name="statementadd" method="post" onSubmit="return validateStatementAdd();" action="<?php
      echo $action;
      ?>">
      <h2>Unos izvoda</h2>
      <div class="form-group">
        <input type="hidden" name="statement_id" value="<?php
        echo $row['statement_id'];
        ?>" >
        <label class="col-sm-4 control-label" for="statement_number">Unesite broj izvoda:</label>
        <input type="text" class="enter" name="statement_number" value="<?php
        echo $row['statement_number'];
        ?>" placeholder="Broj izvoda" />
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label" for="company_name">Unesite naziv firme:</label>
        <select name="company_name" id="company_name">
          <?php
          $sql = mysql_query("SELECT customer_name FROM customer");
          while ($row = mysql_fetch_array($sql)) {
            ?>
            <option value=""><?php echo $row['customer_name']; ?></option>
              <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="bank_name">Unesite naziv banke:</label>
          <input type="text" class="enter" name="bank_name" value="<?php
          echo $row['bank_name'];
          ?>" placeholder="Naziv banke"/>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label" for="statement_date">Unesite datum izvoda:</label>
          <input type="date" class="enter" name="statement_date" value="<?php
          echo $row['statement_date'];
          ?>" placeholder="Datum izvoda"/>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="payment">Izaberite uplata/isplata:</label>
          <select value="<?php $row['payment']; ?>" name="payment">
            <option>uplata</option>
            <option>isplata</option>
          </select>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="statement_value">Iznos:</label>
          <input type="text" class="enter" name="statement_value" value="<?php
          echo $row['statement_value'];
          ?>" placeholder="Iznos izvoda"/>
        </div>
        <input type="submit" value="snimi" />
      </form>
    </div>
  </div>
</div>
<!-- Kraj forme za unos izvoda -->
<!-- Tabela za prikaz izvoda -->
<table class="table table-striped table-hover" id="tabledata">
  <tr data-toggle="modal"  data-target="#orderModal">
    <th>Broj izvoda</th>
    <th>Naziv firme</th>
    <th>Naziv banke</th>
    <th>Datum izvoda</th>
    <th>Iznos </th>
    <th>Uplata/isplata</th>
    <th>Brisanje</th>
  </tr>
  <?php
  include('connection.php');
  $sql = mysql_query("select * from statement ");
  while ($row = mysql_fetch_array($sql)) {
    $statement_number  = $row['statement_number'];
    $company_name  = $row['company_name'];
    $bank_name  = $row['bank_name'];
    $statement_date = $row['statement_date'];
    $statement_value = $row['statement_value'];
    $payment = $row['payment'];
    ?>
    <tr>
        <td >
        <span  class="text"><?php
          echo $statement_number;
          ?></a></span>
        </td>

        <td>
          <span  class="text"><?php
            echo $company_name;
            ?></span>
          </td>

          <td>
            <span  class="text"><?php
              echo $bank_name;
              ?></span>
            </td>

            <td>
              <span  class="text"><?php
                echo date('d-m-Y', strtotime($row['statement_date']));
                ?></span>
              </td>

              <td>
                <span  class="text"><?php
                  echo $statement_value;
                  ?></span>
                </td>

                <td>
                <span  class="text"><?php
                  echo $payment;
                  ?></span>
                </td>

                <td><a href="statement.php?action=delete&statement_id=<?php
                  echo $row['statement_id'];
                  ?>" >Izbriši</a></td>
                </tr>
                <?php
              }
              ?>

            </table>
            <!-- Kraj tabele za unos izvoda -->


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