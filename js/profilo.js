$(document).ready(function(){
    $("td.prezzoTotale").each(function() {
        prezzo = parseFloat($(this).text().replace("€", ""));
        $(this).text(prezzo.toFixed(2) + "€");
    });

    $("li.toRead-0").each(function() {
        $(this).addClass("fw-bold");
    });

    $("a.toRead-1").hide();
});