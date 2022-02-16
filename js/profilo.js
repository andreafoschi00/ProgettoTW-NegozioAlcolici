$(document).ready(function(){
    $("td#prezzoTotale").each(function() {
        prezzo = parseFloat($(this).text().replace("€", ""));
        $(this).text(prezzo.toFixed(2) + "€");
    });

    $("li#contNotifica-0").each(function() {
        $(this).addClass("fw-bold");
    });

    $("a#leggiNotifica-1").hide();
});