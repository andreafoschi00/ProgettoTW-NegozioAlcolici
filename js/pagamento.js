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
    $("#num-carta").prop("disabled", true);
    $("#data-carta").prop("disabled", true);
    $("#cvv-carta").prop("disabled", true);

    $("#indirizzo").change(function(){
        $("#metodo").show();
    });

    $("#metodo").change(function(){
        if($(".form-check-input#pagamento:checked").val() == "Contanti alla consegna") {
            $("#num-carta").val("");
            $("#data-carta").val("");
            $("#cvv-carta").val("");
            $("#num-carta").prop("disabled", true);
            $("#data-carta").prop("disabled", true);
            $("#cvv-carta").prop("disabled", true);
            $("#num-carta").prop("required", false);
            $("#data-carta").prop("required", false);
            $("#cvv-carta").prop("required", false);
            $("#carta").hide();
            $("#prodotti").show();
            $("#finalRow").show();
        } else {
            $("#num-carta").prop("disabled", false);
            $("#carta").show();
            $("#prodotti").hide();
            $("#num-carta").prop("required", true);
            $("#data-carta").prop("required", true);
            $("#cvv-carta").prop("required", true);
        }
    });

    $("#num-carta").focusin(function(){
        $("#data-carta").prop("disabled", false);
    });

    $("#data-carta").focusin(function(){
        $("#cvv-carta").prop("disabled", false);
    });

    $("#cvv-carta").focusin(function(){
        $("#prodotti").show();
        $("#finalRow").show();
    });
});