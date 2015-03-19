<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="my_company_script.js"></script>
   <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 class="naslov">Podešavanje podataka firme korisnika aplikacije</h1>
<div class="navbar navbar-default navbar-static-top" role="navigation" >
  <a href="first_page.php"><button type="button" class="btn btn-primary" >Početna strana</button></a>
    <a href="customer.php"><button type="button" class="btn btn-primary" >Unos kupaca i izrada faktura</button></a>
    <a href="statement.php"><button type="button" class="btn btn-primary" >Unos izvoda</button></a>
    <a href="card_customers.php"><button type="button" class="btn btn-primary">Kartica kupaca</button></a>
    <a href="card_supplier.php"><button type="button" class="btn btn-primary">Kartica dobavljača</button></a>
    <a href="book_invoices_in.php"><button type="button" class="btn btn-primary" >Knjiga ulaznih faktura</button></a>
    <a href="book_invoices_out.php"><button type="button" class="btn btn-primary">Knjiga izlaznih faktura</button></a>
    <a href="my_company.php?action=logout"><img src="pictures\logout.png" class="my_company_logout" /></a>
  </div>
<table class="box">

<?php
include('connection.php');
$sql=mysql_query("SELECT * from settings");
while ($row=mysql_fetch_array($sql)) {
	$settings_id = $row['settings_id'];
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
	$comment = $row['comment'];
	?>
	
	<tr id="<?php echo $settings_id; ?>" class="edit_tr">
	
      <td class="edit_td" >
      <strong>Ime firme: </strong>
        <span id="name_<?php echo $settings_id; ?>" class="text"><?php echo $name; ?></span>
        <input type="text" value="<?php echo $name; ?>" class="editbox" id="name_input_<?php echo $settings_id; ?>" /&gt;
      </td>
      </tr>
      <tr id="<?php echo $settings_id; ?>" class="edit_tr">
      <td class="edit_td" >
      <strong>Opis firme: </strong>
        <span id="description_<?php echo $settings_id; ?>" class="text"><?php echo $description; ?></span>
        <input type="text" value="<?php echo $description; ?>" class="editbox" id="description_input_<?php echo $settings_id; ?>" /&gt;
      </td>
      </tr>
      <tr id="<?php echo $settings_id; ?>" class="edit_tr">
      <td class="edit_td" >
      <strong>Adresa: </strong>
        <span id="address_<?php echo $settings_id; ?>" class="text"><?php echo $address; ?></span>
        <input type="text" value="<?php echo $address; ?>" class="editbox" id="address_input_<?php echo $settings_id; ?>" /&gt;
      </td>
      </tr>
      <tr id="<?php echo $settings_id; ?>" class="edit_tr">
      <td class="edit_td" >
      <strong>Grad: </strong>
        <span id="city_<?php echo $settings_id; ?>" class="text"><?php echo $city; ?></span>
        <input type="text" value="<?php echo $city; ?>" class="editbox" id="city_input_<?php echo $settings_id; ?>" /&gt;
      </td>
      </tr>
      <tr id="<?php echo $settings_id; ?>" class="edit_tr">
      <td class="edit_td" >
      <strong>Poštanski broj: </strong>
        <span id="zip_code_<?php echo $settings_id; ?>" class="text"><?php echo $zip_code; ?></span> 
        <input type="text" value="<?php echo $zip_code; ?>" class="editbox" id="zip_code_input_<?php echo $settings_id; ?>" /&gt;
      </td>
      </tr>
      <tr id="<?php echo $settings_id; ?>" class="edit_tr">
      <td class="edit_td" >
      <strong>PIB: </strong>
        <span id="tin_<?php echo $settings_id; ?>" class="text"><?php echo $tin; ?></span> 
        <input type="text" value="<?php echo $tin; ?>" class="editbox" id="tin_input_<?php echo $settings_id; ?>" /&gt;
      </td>
      </tr>
      
      <tr id="<?php echo $settings_id; ?>" class="edit_tr">
      <td class="edit_td" >
      <strong>Šifra delatnosti: </strong>
        <span id="activity_code_<?php echo $settings_id; ?>" class="text"><?php echo $activity_code; ?></span>
        <input type="text" value="<?php echo $activity_code; ?>" class="editbox" id="activity_code_input_<?php echo $settings_id; ?>" /&gt;
      </td>
      </tr>
      </table>
      <table class="box1">
      <tr id="<?php echo $settings_id; ?>" class="edit_tr">
      <td class="edit_td" >
      <strong>Matični broj: </strong>
        <span id="registration_number_<?php echo $settings_id; ?>" class="text"><?php echo $registration_number; ?></span>
        <input type="text" value="<?php echo $registration_number; ?>" class="editbox" id="registration_number_input_<?php echo $settings_id; ?>" /&gt;
      </td>
      </tr>
      <tr id="<?php echo $settings_id; ?>" class="edit_tr">
      <td class="edit_td">
      <strong>Tekući račun: </strong>
        <span id="account_<?php echo $settings_id; ?>" class="text"><?php echo $account; ?></span>
        <input type="text" value="<?php echo $account; ?>" class="editbox" id="account_input_<?php echo $settings_id; ?>" /&gt;
      </td>
      </tr>
      <tr id="<?php echo $settings_id; ?>" class="edit_tr">
      <td class="edit_td" >
      <strong>Tel: </strong>
        <span id="phone_number_<?php echo $settings_id; ?>" class="text"><?php echo $phone_number; ?></span>
        <input type="text" value="<?php echo $phone_number; ?>" class="editbox" id="phone_number_input_<?php echo $settings_id; ?>" /&gt;
      </td>
      </tr>
      <tr id="<?php echo $settings_id; ?>" class="edit_tr">
      <td class="edit_td" >
      <strong>Fax: </strong>
        <span id="fax_<?php echo $settings_id; ?>" class="text"><?php echo $fax; ?></span>
        <input type="text" value="<?php echo $fax; ?>" class="editbox" id="fax_input_<?php echo $settings_id; ?>" /&gt;
      </td>
      </tr>
      <tr id="<?php echo $settings_id; ?>" class="edit_tr">
      <td class="edit_td" >
      <strong>E-mail: </strong>
        <span id="email_<?php echo $settings_id; ?>" class="text"><?php echo $email; ?></span>
        <input type="text" value="<?php echo $email; ?>" class="editbox" id="email_input_<?php echo $settings_id; ?>" /&gt;
      </td>
      </tr>
      <tr id="<?php echo $settings_id; ?>" class="edit_tr">
      <td class="edit_td" >
      <strong>Napomena: </strong>
        <span id="comment_<?php echo $settings_id; ?>" class="text"><?php echo $comment; ?></span>
        <input type="text" value="<?php echo $comment; ?>" class="editbox" id="comment_input_<?php echo $settings_id; ?>" />
      </td>
      </tr>
	<?php } ?>
</table>
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