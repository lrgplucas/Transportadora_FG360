const URL_GET_CLIENTE_API = './api/cliente/GetCliente.php';
const URL_GET_BY_CLIENTE = './api/entrega/GetAllByCliente.php';
const URL_GET_BY_ENTREGA = './api/mov/GetByEntrega.php';
const URL_GET_BY_ENTREGA_ID = './api/entrega/GetById.php';
const URL_CREATE_MOV = './api/mov/CreateMov.php';
const URL_EMAIL_CADASTRO = './helper/PHPMailer/src/MailRastreamento.php';
var isEntregue = false;
var data = new FormData();

$(document).ready(function (){
    
    getClientes();

    var clienteSelected;

    //
    $("#divEntregue").hide();


    $("#fileUp").on("change",function(){
        file = document.getElementById("fileUp").files[0];
        fileName =  $('#fileUp').val().replace(/C:\\fakepath\\/i, '');
        data.append("filename", fileName);
        data.append("file", file); 
  
    });

    $("#status").on("change",function(){
        
        if($("#status").children("option:selected").val() == "Entregue"){
            $("#divEntregue").show();
            isEntregue = true;
        }else{
            $("#divEntregue").hide();
        }
    });

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
        var previsao = document.getElementById("previsaoEntrega").value;
        var motorista = $("#motorista").val();
        var veiculo = $("#veiculo").val();
        var status = $("#status").children("option:selected").val();
        var nomeEntrega , rg;


        if(isEntregue){

            if($("#rg").val() == ""){
                toastr.warning("Preencha o RG !","Transportadora FG-360");
                return ;
            }

            if($("#nomeEntrega").val() == ""){
                toastr.warning("Preencha o Nome do destinatário!","Transportadora FG-360");
                return ;
            }

            nomeEntrega = $("#nomeEntrega").val();
            rg = $("#rg").val();
        }

        if(!isEntregue){
            var json = {
                "cliente":cliente,
                "codRastreio":codRastreio,
                "previsao":previsao,
                "motorista":motorista,
                "veiculo":veiculo,
                "status":status,
                "docEntrega":""
            }
         }else{
            var json = {
                "cliente":cliente,
                "codRastreio":codRastreio,
                "previsao":previsao,
                "motorista":motorista,
                "veiculo":veiculo,
                "status":status,
                "rg":rg,
                "nomeEntrega":nomeEntrega,
                "docEntrega":""
            }
         }


         //upload de entrega
        if(isEntregue){
        
            sendFile(function (data){
                //alert(data);
                json.docEntrega = data;
                $.post(URL_CREATE_MOV,json,function(){
                    toastr.success("Cadastrado com sucesso","Transportadora FG-360");
                    var id =  $("#idRastreamento").children("option:selected").text();
                    var codRastreio2 = $("#idRastreamento").children("option:selected").text();
        
                    if(!isEntregue){
                        var email = {
                            "cliente":cliente,
                            "id":id,
                            "previsao":previsao,
                            "motorista":motorista,
                            "veiculo":veiculo,
                            "status":status,
                            "codRastreio":codRastreio2
                        }
                    }else{
                        var email = {
                            "cliente":cliente,
                            "id":id,
                            "previsao":previsao,
                            "motorista":motorista,
                            "veiculo":veiculo,
                            "status":status,
                            "codRastreio":codRastreio2,
                            "rg":rg,
                            "nomeEntrega":nomeEntrega,
                            "anexo": data
                        }
                    }
        
                   
        
                    $.post(URL_EMAIL_CADASTRO,email,function(data){
                       return ;
                    });
                }).fail(function(){
                    toastr.error("Erro ao cadastrar!","Transportadora FG-360");
                    return ;
                });
            });
        }else{

            $.post(URL_CREATE_MOV,json,function(){
                toastr.success("Cadastrado com sucesso","Transportadora FG-360");
                var id =  $("#idRastreamento").children("option:selected").text();
                var codRastreio2 = $("#idRastreamento").children("option:selected").text();

                if(!isEntregue){
                    var email = {
                        "cliente":cliente,
                        "id":id,
                        "previsao":previsao,
                        "motorista":motorista,
                        "veiculo":veiculo,
                        "status":status,
                        "codRastreio":codRastreio2
                    }
                }else{
                    var email = {
                        "cliente":cliente,
                        "id":id,
                        "previsao":previsao,
                        "motorista":motorista,
                        "veiculo":veiculo,
                        "status":status,
                        "codRastreio":codRastreio2,
                        "rg":rg,
                        "nomeEntrega":nomeEntrega
                    }
                }

            

                $.post(URL_EMAIL_CADASTRO,email,function(data){
                
                });
            }).fail(function(){
                toastr.error("Erro ao cadastrar!","Transportadora FG-360");
            });
        }





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

function sendFile(returnData){
    jQuery.ajax({
        url: './upload_term_entrega.php',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            returnData(data);
        }
    });
}


