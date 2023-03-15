$(document).ready(function () {
    $('#step-2').hide();
    $('#step-3').hide();
    $('#step-4').hide();
    $('#step-5').hide();
    $('#step-6').hide();

    $('#sim-1').click(function () {
        $('#step-1').hide();
        $('#step-2').show();
    });

    $('#sim-2').click(function () {
        $('#step-2').hide();
        $('#step-3').show();
    });

    $('#nao-2').click(function () {
        $.ajax({
            type: "POST", url: 'apis/carrega_pratos.php', data: {
                json: $("#lista").val(), caracteristica: $("#categoria").val()
            }, dataType: 'json', success: function (response) {
                if (response.selecionado == null) {
                    $('#step-2').hide();
                    $('#step-5').show();
                    $("#categoria").val(null)
                    return
                }
                $(".caracteristica").each(function () {
                    $(this).text(response.caracteristica)
                })
                $(".nome").each(function () {
                    $(this).text(response.selecionado.nome)
                });
                $("#nome").val(response.selecionado.nome)
                $("#lista").val(JSON.stringify(response.pratos));
                $("#categoria").val(response.caracteristica);
            }, error: function (xhr, status, error) {
                alert("Erro ao carregar prato, contrate o desenvolvedor para ele corrigir")
            }
        });
    });

    $('#sim-3').click(function () {
        $("#prato-similar").text($("#palpite").text())
        $('#step-3').hide();
        $('#step-4').show();
    });

    $('#nao-3').click(function () {
        $.ajax({
            type: "POST", url: 'apis/carrega_pratos.php',
            data: {
                json: $("#lista").val(),
                nome: $("#nome").val(),
                caracteristica: $("#categoria").val()
            }, dataType: 'json', success: function (response) {
                if (response.selecionado == null) {
                    $('#step-3').hide();
                    $('#step-5').show();
                    return
                }
                $(".nome").each(function () {
                    $(this).text(response.selecionado.nome)
                })
                $("#nome").val(response.selecionado.nome)
                $("#lista").val(JSON.stringify(response.pratos));
            }, error: function (xhr, status, error) {
                alert("Erro ao carregar prato, contrate o desenvolvedor para ele corrigir")
            }
        });
    });

    $('#sim-4').click(function () {
        $('#step-4').hide();
        $('#step-1').show();
    });

    $('#sim-5').click(function () {
        $(".novo-prato").text($("#prato").val());
        $("#nome").text($("#prato").val());
        $('#step-5').hide();
        $('#step-6').show();
    });

    $('#nao-5').click(function () {
        location.reload();
    });

    $('#sim-6').click(function () {
        $.ajax({
            type: "POST", url: 'apis/salvar_prato.php', data: {
                nome: $("#prato").val(),
                similar: $("#categoria").val(),
                caracteristica: $("#nova-caracteristica").val()
            }, dataType: 'json', success: function (response) {
                location.reload();
            }, error: function (xhr, status, error) {
                alert("Erro ao salvar, contrate o desenvolvedor para ele corrigir")
            }
        });
    });
});