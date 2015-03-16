function validateCustomerAdd() {
     if (document.customeradd.customer_name.value == "") {
         alert("Polje 'Ime firme' je obavezno!");
         return false;
     }
     
     if (document.customeradd.customer_address.value == "") {
         alert("Polje 'Adresa firme' je obavezno!");
         return false;
     }
     if (document.customeradd.customer_city.value == "") {
         alert("Polje 'Grad' je obavezno!");
         return false;
     }
     if (document.customeradd.customer_zip_code.value == "") {
         alert("Polje 'Poštanski broj' je obavezno!");
         return false;
     }
     if (document.customeradd.customer_tin.value == "") {
         alert("Polje 'Pib firme' je obavezno!");
         return false;
     }
     if (document.customeradd.customer_account.value == "") {
         alert("Polje 'tekući račun firme' je obavezno!");
         return false;
     }
     if (document.customeradd.customer_phone_number.value == "") {
         alert("Polje 'Broj telefona firme' je obavezno!");
         return false;
     }
     if (document.customeradd.customer_fax.value == "") {
         alert("Polje 'Fax firme' je obavezno!");
         return false;
     }
    
    return true;
}
function validateInvoiceAdd(){
    if (document.invoiceadd.number.value == "") {
         alert("Polje 'Broj fakture' je obavezno!");
         return false;
     }
     if (document.invoiceadd.date_traffic.value == "") {
         alert("Polje 'Datum izdavanja' je obavezno!");
         return false;
     }
     if (document.invoiceadd.place_traffic.value == "") {
         alert("Polje 'Mesto izdavanja' je obavezno!");
         return false;
     }
     if (document.invoiceadd.date_turnover.value == "") {
         alert("Polje 'Datum prometa' je obavezno!");
         return false;
     }
     if (document.invoiceadd.place_turnover.value == "") {
         alert("Polje 'Mesto prometa' je obavezno!");
         return false;
     }
     if (document.invoiceadd.date_payment.value == "") {
         alert("Polje 'Rok plaćanja' je obavezno!");
         return false;
     }
     if (document.invoiceadd.payment_method.value == "") {
         alert("Polje 'Način plaćanja' je obavezno!");
         return false;
     }

    return true;
}
function validateInvoice_itemAdd(){
    if (document.invoiceitemadd.service_type.value == "") {
         alert("Polje 'Vrsta usluga' je obavezno!");
         return false;
     }
      if (document.invoiceitemadd.service_range.value == "") {
         alert("Polje 'Količina' je obavezno!");
         return false;
     }
      if (document.invoiceitemadd.price.value == "") {
         alert("Polje 'Cena' je obavezno!");
         return false;
     }
      if (document.invoiceitemadd.vat.value == "") {
         alert("Polje 'PDV' je obavezno!");
         return false;
     }
      if (document.invoiceitemadd.rebate.value == "") {
         alert("Polje 'Rabat' je obavezno!");
         return false;
     }
     return true;
}
function validateStatementAdd(){
    if(document.statementadd.statement_number.value == ""){
        alert("Polje 'Broj izvoda' je obavezno!");
        return false;
    }
    if(document.statementadd.bank_name.value == ""){
        alert("Polje 'Naziv banke' je obavezno!");
        return false;
    }
    if(document.statementadd.statement_date.value == ""){
        alert("Polje 'Datum izvoda' je obavezno!");
        return false;
    }
    if(document.statementadd.statement_value.value == ""){
        alert("Polje 'Vrednost izvoda' je obavezno!");
        return false;
    }
    return true;
}
function validateCardCustomersAdd(){
    if(document.card_customersadd.date1.value == ""){
        alert("Polje 'Datum u polju 1' je obavezno!");
        return false;
    }
    if(document.card_customersadd.date2.value == ""){
        alert("Polje 'Datum u polju 2' je obavezno!");
        return false;
    }
    return true;
}
function validateCardSupplierAdd(){
    if(document.card_supplieradd.date1.value == ""){
        alert("Polje 'Datum u polju 1' je obavezno!");
        return false;
    }
    if(document.card_supplieradd.date2.value == ""){
        alert("Polje 'Datum u polju 2' je obavezno!");
        return false;
    }
    return true;
}