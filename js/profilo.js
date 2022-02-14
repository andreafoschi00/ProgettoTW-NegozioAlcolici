$(document).ready(function(){
    $("td#prezzoTotale").each(function(e) {
        prezzo = parseFloat($(this).text().replace("€", ""));
        console.log(prezzo.toFixed(2));
        $(this).text(prezzo.toFixed(2) + "€");
    });
});