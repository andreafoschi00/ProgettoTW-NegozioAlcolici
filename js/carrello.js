$(document).ready(function(){
    stringa = $("#totalPrice").text().split(": ")[1];
    prezzo = parseFloat(stringa.replace("€", ""))
    $("#totalPrice").text("Prezzo totale: " + prezzo.toFixed(2) + "€");
    if(prezzo == 0) {
        $("#totalPrice").hide();
        $("#ordina").hide();
    }

    $("li p").each(function(e) {
        stringaProdotto = $(this).text().split(": ")[1];
        prezzoProdotto = parseFloat(stringaProdotto.replace("€", ""));
        $(this).text("Prezzo: " + prezzoProdotto.toFixed(2) + "€");
    });
});