$(document).ready(function()
{
$(".edit_tr").click(function()
{
var ID=$(this).attr('id');
$("#number_"+ID).hide();
$("#date_traffic_"+ID).hide();
$("#place_traffic_"+ID).hide();
$("#date_turnover_"+ID).hide();
$("#place_turnover_"+ID).hide();
$("#date_payment_"+ID).hide();
$("#payment_method_"+ID).hide();
$("#invoice_type_"+ID).hide();
$("#number_input_"+ID).show();
$("#date_traffic_input_"+ID).show();
$("#place_traffic_input_"+ID).show();
$("#date_turnover_input_"+ID).show();
$("#place_turnover_input_"+ID).show();
$("#date_payment_input_"+ID).show();
$("#payment_method_input_"+ID).show();
$("#invoice_type_input_"+ID).show();
}).change(function()
{
var ID=$(this).attr('id');
var number=$("#number_input_"+ID).val();
var date_traffic=$("#date_traffic_input_"+ID).val();
var place_traffic=$("#place_traffic_input_"+ID).val();
var date_turnover=$("#date_turnover_input_"+ID).val();
var place_turnover=$("#place_turnover_input_"+ID).val();
var date_payment=$("#date_payment_input_"+ID).val();
var payment_method=$("#payment_method_input_"+ID).val();
var invoice_type=$("#invoice_type_input_"+ID).val();
var dataString = 'invoice_id='+ ID +'&number='+number+'&date_traffic='+date_traffic+'&place_traffic='+place_traffic+
'&date_turnover='+date_turnover+'&place_turnover='+place_turnover+'&date_payment='+date_payment+'&payment_method='+payment_method+'&invoice_type='+invoice_type;


if(number.length>0&& date_traffic.length>0&& place_traffic.length>0&& date_turnover.length>0&& place_turnover.length>0&& 
	date_payment.length>0&& payment_method.length>0&& invoice_type.length>0)
{

$.ajax({
type: "POST",
url: "invoice_update.php",
data: dataString,
cache: false,
success: function(html)
{
$("#number_"+ID).html(number);
$("#date_traffic_"+ID).html(date_traffic);
$("#place_traffic_"+ID).html(place_traffic);
$("#date_turnover_"+ID).html(date_turnover);
$("#place_turnover_"+ID).html(place_turnover);
$("#date_payment_"+ID).html(date_payment);
$("#payment_method_"+ID).html(payment_method);
$("#invoice_type_"+ID).html(invoice_type);
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

 