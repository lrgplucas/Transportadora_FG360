

const URL_GET_CLIENTE_API = './api/cliente/GetCliente.php';
const URL_CREATE = './api/doc/CreateDoc.php';
var data = new FormData();


$(document).ready(function(){
    var file ;
    var fileName;
 
    $("#fileUp").on("change",function(){
        file = document.getElementById("fileUp").files[0];
        fileName =  $('#fileUp').val().replace(/C:\\fakepath\\/i, '');
        data.append("filename", fileName);
        data.append("file", file);    
    });

    $("#rdo_attDoc").click(function(){

        
    });

    getClientes();

    $("#btnSalvar").click(function(){

        var tipoSelecionado = $("#rdo_fatura").attr("checked") ? "Fatura" : $("#rdo_cte").attr("checked") ? "CTE" : "2º Via";

        var cliente =  $("#cliente").children("option:selected").val();
        var tipo = tipoSelecionado;
        var path = "teste";
        var vencimento = getFinalDate($("#vencimento").val());
        var status = $("#status").val();
        var valor = $("#valor").val();
         
        sendFile(function(data){

            var json = {
                "cliente":cliente,
                "tipo":tipo,
                "path":data,
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
        url: './upload.php',
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
