
$(document).ready(function()
{
$(".edit_tr").click(function()
{
var ID=$(this).attr('id');
$("#customer_name_"+ID).hide();
$("#customer_address_"+ID).hide();
$("#customer_city_"+ID).hide();
$("#customer_zip_code_"+ID).hide();
$("#customer_tin_"+ID).hide();
$("#customer_account_"+ID).hide();
$("#customer_phone_number_"+ID).hide();
$("#customer_fax_"+ID).hide();
$("#customer_vat_status_"+ID).hide();
$("#customer_name_input_"+ID).show();
$("#customer_address_input_"+ID).show();
$("#customer_city_input_"+ID).show();
$("#customer_zip_code_input_"+ID).show();
$("#customer_tin_input_"+ID).show();
$("#customer_account_input_"+ID).show();
$("#customer_phone_number_input_"+ID).show();
$("#customer_fax_input_"+ID).show();
$("#customer_vat_status_input_"+ID).show();
}).change(function()
{
var ID=$(this).attr('id');
var customer_name=$("#customer_name_input_"+ID).val();
var customer_address=$("#customer_address_input_"+ID).val();
var customer_city=$("#customer_city_input_"+ID).val();
var customer_zip_code=$("#customer_zip_code_input_"+ID).val();
var customer_tin=$("#customer_tin_input_"+ID).val();
var customer_account=$("#customer_account_input_"+ID).val();
var customer_phone_number=$("#customer_phone_number_input_"+ID).val();
var customer_fax=$("#customer_fax_input_"+ID).val();
var customer_vat_status=$("#customer_vat_status_input_"+ID).val();
var dataString = 'customer_id='+ ID +'&customer_name='+customer_name+'&customer_address='+customer_address+'&customer_city='+customer_city
+'&customer_zip_code='+customer_zip_code+'&customer_tin='+customer_tin+
'&customer_account='+customer_account+'&customer_phone_number='+customer_phone_number+'&customer_fax='+customer_fax+'&customer_vat_status='+customer_vat_status;


if(customer_name.length>0&& customer_address.length>0&& customer_city.length>0&& customer_zip_code.length>0&& customer_tin.length>0&&
 customer_account.length>0&& customer_phone_number.length>0&& customer_fax.length>0&& customer_vat_status.length>0)
{

$.ajax({
type: "POST",
url: "customer_update.php",
data: dataString,
cache: false,
success: function(html)
{
$("#customer_name_"+ID).html(customer_name);
$("#customer_address_"+ID).html(customer_address);
$("#customer_city_"+ID).html(customer_city);
$("#customer_zip_code_"+ID).html(customer_zip_code);
$("#customer_tin_"+ID).html(customer_tin);
$("#customer_account_"+ID).html(customer_account);
$("#customer_phone_number_"+ID).html(customer_phone_number);
$("#customer_fax_"+ID).html(customer_fax);
$("#customer_vat_status_"+ID).html(customer_vat_status);
}
});
}
else
{
alert('Unesite podatak.');
}

});

// Edit input box click action
$(".editbox").mouseup(function() 
{
return false
});

// Outside click action
$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();
});

});

 