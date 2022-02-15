$(document).ready(function() {
    const quantitàDisponibile = parseInt($("#quantita").text().split(": ")[1]);
    const prezzo = parseFloat($("#prezzo").text().split(": ")[1]);
    $("#prezzo").text("Prezzo: " + prezzo.toFixed(2) + "€");

    switch(true) {
        case quantitàDisponibile==0:
            $("#quantita").css("color", "red");
        break;
        case quantitàDisponibile>0 && quantitàDisponibile<10:
            $("#quantita").css("color", "orange");
        break;
        default:
            $("#quantita").css("color", "green");
    }

    $("#quantità").focusout(function(){
        const quantitàSelezionata = $("#quantità").val();
        $("#prezzo").text("Prezzo: "+(prezzo*quantitàSelezionata).toFixed(2)+"€");
        const id = parseInt($("#titleid").text().split(": ")[1]);
        $("#id-buffer").val(id);
    });

    $("#quantità").keypress(function(evt) {
        evt.preventDefault();
    });   

    if($("#presente").val() == "true") {
        $("#aggiunta").prop("disabled", true);
        $("#quantità").prop("disabled", true);
        $(".toast").toast("show");
    }
});