$(document).ready(function() {

    $("#limpar").click(function(event) {
        event.preventDefault();
        document.form_cadastro.reset();
    });

    $("#cadastrar").click(function(event) {
        event.preventDefault();
        $("#form_cadastro").submit();
    });

    $("#form_cadastro").submit(function() {
        $("#envies").show('slow');
        $.post(URLBASE + 'gerar/salvar', $(this).serialize(), function(data) {
            $("#envies").hide("slow");
            if (data.ok == "OK") {
                alert("CRUD generated!");
                //document.form_cadastro.reset();
            } else if (data.ok == "NOPE") {
                alert('Something is not right...');
            }
        }, 'json');
        
        return false;
    });
});