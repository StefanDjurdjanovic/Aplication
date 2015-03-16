
$(document).ready(function()
{
$(".edit_tr").click(function()
{
var ID=$(this).attr('id');
$("#name_"+ID).hide();
$("#description_"+ID).hide();
$("#address_"+ID).hide();
$("#city_"+ID).hide();
$("#zip_code_"+ID).hide();
$("#tin_"+ID).hide();
$("#activity_code_"+ID).hide();
$("#registration_number_"+ID).hide();
$("#account_"+ID).hide();
$("#phone_number_"+ID).hide();
$("#fax_"+ID).hide();
$("#email_"+ID).hide();
$("#comment_"+ID).hide();
$("#name_input_"+ID).show();
$("#description_input_"+ID).show();
$("#address_input_"+ID).show();
$("#city_input_"+ID).show();
$("#zip_code_input_"+ID).show();
$("#tin_input_"+ID).show();
$("#activity_code_input_"+ID).show();
$("#registration_number_input_"+ID).show();
$("#account_input_"+ID).show();
$("#phone_number_input_"+ID).show();
$("#fax_input_"+ID).show();
$("#email_input_"+ID).show();
$("#comment_input_"+ID).show();
}).change(function()
{
var ID=$(this).attr('id');
var name=$("#name_input_"+ID).val();
var description=$("#description_input_"+ID).val();
var address=$("#address_input_"+ID).val();
var city=$("#city_input_"+ID).val();
var zip_code=$("#zip_code_input_"+ID).val();
var tin=$("#tin_input_"+ID).val();
var activity_code=$("#activity_code_input_"+ID).val();
var registration_number=$("#registration_number_input_"+ID).val();
var account=$("#account_input_"+ID).val();
var phone_number=$("#phone_number_input_"+ID).val();
var fax=$("#fax_input_"+ID).val();
var email=$("#email_input_"+ID).val();
var comment=$("#comment_input_"+ID).val();
var dataString = 'company_id='+ ID +'&name='+name+'&description='+description+'&address='+address+'&city='+city
+'&zip_code='+zip_code+'&tin='+tin +'&activity_code='+activity_code+'&registration_number='+registration_number
+'&account='+account+'&phone_number='+phone_number+'&fax='+fax+'&email='+email+'&comment='+comment;
//$("#company_name_"+ID).html('<img src="package_settings.png" />'); // Loading image

if(name.length>0&& description.length>0&& address.length>0&& city.length>0&& zip_code.length>0&& tin.length>0&& 
	activity_code.length>0&& registration_number.length>0&& account.length>0&& phone_number.length>0&& fax.length>0&& 
	email.length>0&& comment.length>0)
{

$.ajax({
type: "POST",
url: "my_company_update.php",
data: dataString,
cache: false,
success: function(html)
{
$("#name_"+ID).html(name);
$("#description_"+ID).html(description);
$("#address_"+ID).html(address);
$("#city_"+ID).html(city);
$("#zip_code_"+ID).html(zip_code);
$("#tin_"+ID).html(tin);
$("#activity_code_"+ID).html(activity_code);
$("#registration_number_"+ID).html(registration_number);
$("#account_"+ID).html(account);
$("#phone_number_"+ID).html(phone_number);
$("#fax_"+ID).html(fax);
$("#email_"+ID).html(email);
$("#comment_"+ID).html(comment);
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

 