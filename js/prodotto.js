$(document).ready(function() {
    const oggeto = $("#quantita").text();
    const stringa = oggeto.split(": ");
    const elemento = stringa[1];
    const valore = parseInt(elemento);

    switch(true) {
        case valore==0:
            $("#quantita").css("color", "red");
        break;
        case valore>0 && valore<10:
            $("#quantita").css("color", "orange");
        break;
        default:
            $("#quantita").css("color", "green");
    }
});