$(document).ready(function(){
    $("td#prezzoProdotto").each(function(e) {
        prezzo = parseFloat($(this).text().replace("€", ""));
        $(this).text(prezzo.toFixed(2) + "€");
    });

    stringa = $("#prezzoTotale").text().split(": ")[1];
    prezzo = parseFloat(stringa.replace("€", ""))
    $("#prezzoTotale").text("Prezzo totale: " + prezzo.toFixed(2) + "€");
    $("#metodo").hide();
    $("#carta").hide();
    $("#prodotti").hide();
    $("#finalRow").hide();

    $("#indirizzo").change(function(){
        $("#metodo").show();
    });

    $("#metodo").change(function(){
        if($(".form-check-input#pagamento:checked").val() == "Contanti alla consegna") {
            $("#num-carta").val("");
            $("#data-carta").val("");
            $("#cvv-carta").val("");
            $("#data-carta").prop("disabled", true);
            $("#cvv-carta").prop("disabled", true);
            $("#carta").hide();
            $("#prodotti").show();
            $("#finalRow").show();
        } else {
            $("#carta").show();
            $("#data-carta").prop("disabled", true);
            $("#cvv-carta").prop("disabled", true);
            $("#prodotti").hide();
        }
    });

    $("#num-carta").focusin(function(){
        $("#data-carta").prop("disabled", false);
    });

    $("#data-carta").focusin(function(){
        $("#cvv-carta").prop("disabled", false);
    });

    $("#cvv-carta").focusout(function(){
        $("#prodotti").show();
        $("#finalRow").show();
    });
});