

const URL_GET_CLIENTE_API = './api/cliente/GetCliente.php';
const URL_CREATE = './api/doc/CreateDoc.php';
$(document).ready(function(){

    getClientes();

    $("#btnSalvar").click(function(){

        var tipoSelecionado = $("#rdo_fatura").attr("checked") ? "Fatura" : $("#rdo_cte").attr("checked") ? "CTE" : "2º Via";

        var cliente =  $("#cliente").children("option:selected").val();
        var tipo = tipoSelecionado;
        var path = "teste";
        var vencimento = getFinalDate($("#vencimento").val());
        var status = $("#status").val();
        var valor = $("#valor").val();

        var json = {
            "cliente":cliente,
            "tipo":tipo,
            "path":path,
            "status":status,
            "valor":valor,
            "vencimento":vencimento
        }

        $.post(URL_CREATE ,json ,function(){
            toastr.success("Cadastrado com sucesso","Transportadora FG-360");
        }).fail(function(){
            toastr.error("Erro ao cadastrar!","Transportadora FG-360");
        });
    });

});



function getClientes(){
    $.get(URL_GET_CLIENTE_API,function(data){
        
        var json = JSON.parse(data);
        for (cliente in json ){
    
            $("#cliente").append("<option value="+json[cliente].id+">"+json[cliente].nome+"</option> ");
        }
    
    });
}

function getFinalDate(dateFromInput){
    var previsao = dateFromInput;
    var date = new Date(previsao);
    var day = date.getDate()+1;
    var mounth = date.getMonth()+1;
    var year = date.getFullYear();

    var fullDate = year+'-'+mounth+'-'+day;

    return fullDate
}