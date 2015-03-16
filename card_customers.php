<?php



require_once('connection.php');


//Pocetak ispitivanja izgleda

if(isset($_GET['view']))
{
  $view = $_GET['view'];
}
else {
  $view = '';
}

switch($view) {

  case 'edit':
  editInvoiceView();
  break;

  case 'list':
  default:
  listInvoiceView();
  break;
}

//Kraj ispitivanja izgleda
//Pocetak funkcija izgleda  
function listInvoiceView() {
       // Potrebno zbog podataka iz tabele kupac
  $query1 = "SELECT * FROM customer  ";
  $result = mysql_query($query1);
  $rows = array();
  while($row = mysql_fetch_assoc($result)) {
    $rows[] = array(
      'customer_id' => htmlspecialchars($row['customer_id']),
      'customer_name' => htmlspecialchars($row['customer_name']),
      'customer_address' => htmlspecialchars($row['customer_address']),
      'customer_tin'  => htmlspecialchars($row['customer_tin']),
      'customer_account'   => htmlspecialchars($row['customer_account']),
      'customer_phone_number'    => htmlspecialchars($row['customer_phone_number']), 
      'customer_vat_status'    => htmlspecialchars($row['customer_vat_status']),



      );}
    
    // Potrebno zbog podataka iz tabele faktura
    $query = "SELECT * FROM invoice";
    $result = mysql_query($query);
    $rows = array();
    while($row = mysql_fetch_assoc($result)) {
      $rows[] = array(
        'customer_id' => htmlspecialchars($row['customer_id']), 
        'invoice_id' => htmlspecialchars($row['invoice_id']),
        'number' => htmlspecialchars($row['number']),
        'date_traffic' => htmlspecialchars($row['date_traffic']),
        'place_traffic' => htmlspecialchars($row['place_traffic']),
        'date_turnover'  => htmlspecialchars($row['date_turnover']),
        'place_turnover'  => htmlspecialchars($row['place_turnover']),
        'date_payment'   => htmlspecialchars($row['date_payment']),
        'payment_method' => htmlspecialchars($row['payment_method']),


        );
    }

         // Potrbno zbog podataka iz tabele proizvod
    $query = "SELECT * FROM invoice_item";
    $result = mysql_query($query);
    $rows = array();
    while($row = mysql_fetch_assoc($result)) {
      $rows[] = array(
        'invoice_id' => htmlspecialchars($row['invoice_id']), 
        'invoice_item_id' => htmlspecialchars($row['invoice_item_id']),
        'service_type' => htmlspecialchars($row['service_type']),
        'service_range' => htmlspecialchars($row['service_range']),
        'price' => htmlspecialchars($row['price']),
        'value'  => htmlspecialchars($row['value']),
        'vat'  => htmlspecialchars($row['vat']),
        'vat_value'   => htmlspecialchars($row['vat_value']),
        'rebate' => htmlspecialchars($row['rebate']),
        'total_value' => htmlspecialchars($row['total_value']),


        );
    }

        // Potrebno zbog podataka iz tabele izvod
    $query1 = "SELECT * FROM statement  ";
    $result = mysql_query($query1);
    $rows = array();
    while($row = mysql_fetch_assoc($result)) {
      $rows[] = array(
        'statement_number' => htmlspecialchars($row['statement_number']),
        'company_name' => htmlspecialchars($row['company_name']),
        'statement_date' => htmlspecialchars($row['statement_date']),
        'statement_value'  => htmlspecialchars($row['statement_value']),



        );}


    //akcije i forma
        include("card_customers_form.php");

    }



//Kraj funkcija izgleda



    ?>