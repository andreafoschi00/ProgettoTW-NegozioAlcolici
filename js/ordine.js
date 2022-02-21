$(document).ready(function(){
    $("label.prezzoProdotto").each(function(e) {
        const prezzo = parseFloat($(this).text().split(": ")[1]);
        $(this).text("Prezzo: " + prezzo.toFixed(2) + "€");
    });
});