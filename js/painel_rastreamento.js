/*
* author : joao
* data : 25/02/2019
* classe : PAINEL RASTREAMENTO JS
*/

const URL_GET_CLIENTE_API = './api/cliente/GetCliente.php';
const URL_CREATE_ENTREGA_API = './api/entrega/Post.php';
const URL_EMAIL_CADASTRO = './helper/PHPMailer/src/MailRastreamento.php';

$(document).ready(function(){

  getClientes();


    $("#btnCadastrar").click(function(){

        //valores
        var cliente = $("#cliente").children("option:selected").val();
        var produto = $("#produto").val();
        var id =  $("#idRastramento").val();
        var tipo = $("input:checked").val();
        var previsao = getFinalDate($("#previsaoEntrega").val());
        var data =  new Date();
        var motorista = $("#motorista").val();
        var veiculo = $("#veiculo").val();
        var status = $("#status").children("option:selected").val();

     
        var previsaoFinal = new Date(previsao);
        previsaoFinal.setDate(previsaoFinal.getDate()+1);

        var json ={
            "cliente":cliente,
            "produto":produto,
            "id_rastreio":id,
            "tipo":tipo,
            "previsao":previsao,
            "data":data,
            "motorista":motorista,
            "veiculo":veiculo,
            "status":status
        }
        
        $.post(URL_CREATE_ENTREGA_API,json,function(data){
            toastr.success("Cadastrado com sucesso","Transportadora FG-360");

            var email ={
                "cliente":cliente,
                "produto":produto,
                "id":id,
                "tipo":tipo,
                "previsao":previsao,
                "data":data,
                "motorista":motorista,
                "veiculo":veiculo,
                "status":status,
                "codRastreio":id
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



