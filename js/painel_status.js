const URL_GET_CLIENTE_API = './api/cliente/GetCliente.php';
const URL_GET_BY_CLIENTE = './api/entrega/GetAllByCliente.php';
const URL_GET_BY_ENTREGA = './api/mov/GetByEntrega.php';
const URL_GET_BY_ENTREGA_ID = './api/entrega/GetById.php';
const URL_CREATE_MOV = './api/mov/CreateMov.php';
const URL_EMAIL_CADASTRO = './helper/PHPMailer/src/MailRastreamento.php';

$(document).ready(function (){
    
    getClientes();

    var clienteSelected;

    $("#cliente").on('change',function(){
        $("#idRastreamento").empty();
        $("#idRastreamento").append("<option>Selecione ...</option>");
        $("#motorista").val("");
        $("#veiculo").val("");
        clienteSelected = $("#cliente").children("option:selected").val();
        $.get(URL_GET_BY_CLIENTE,{"cli_id":clienteSelected},function(data){
            var json = JSON.parse(data); 
            for (cliente in json ){
                $("#idRastreamento").append("<option value="+json[cliente].id+">"+json[cliente].codRastreio+"</option> ");
               
            
            }
        }).fail(function(){
            toastr.error("Nenhuma entrega cadastrada!","Transportadora FG-360");
        });

    });

    $("#idRastreamento").on("change",function(){
        entrega = $("#idRastreamento").children("option:selected").val();
        $.get(URL_GET_BY_ENTREGA,{"id":entrega},function(data){
            var json = JSON.parse(data); 
            var last = json.length - 1;
        
            if(last > -1){
                $("#motorista").val(json[last].motorista);
                $("#veiculo").val(json[last].veiculo);
            }else{
                $.get(URL_GET_BY_ENTREGA_ID,{"id":entrega},function(data){
                    var entrega = JSON.parse(data); 
                    $("#motorista").val(entrega[0].motorista);
                    $("#veiculo").val(entrega[0].veiculo);
                });
            }
        });

    });


    $("#btnSalvar").click(function(){
        var cliente = clienteSelected;
        var codRastreio = $("#idRastreamento").children("option:selected").val();
        var previsao = getFinalDate($("#previsaoEntrega").val());
        var motorista = $("#motorista").val();
        var veiculo = $("#veiculo").val();
        var status = $("#status").children("option:selected").val();

        var json = {
            "cliente":cliente,
            "codRastreio":codRastreio,
            "previsao":previsao,
            "motorista":motorista,
            "veiculo":veiculo,
            "status":status
        }

        $.post(URL_CREATE_MOV,json,function(){
            toastr.success("Cadastrado com sucesso","Transportadora FG-360");
            var id =  $("#idRastreamento").children("option:selected").text();

            var email = {
                "cliente":cliente,
                "id":id,
                "previsao":previsao,
                "motorista":motorista,
                "veiculo":veiculo,
                "status":status
            }

            $.post(URL_EMAIL_CADASTRO,email,function(data){
               
            });
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



