$(document).ready(function(){
    prezzo = $("#totalPrice").text().split(": ")[1];
    if(prezzo == "0€") {
        $("#totalPrice").hide();
        $("#ordina").hide();
    }
});