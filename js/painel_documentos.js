
const URL_GET_CLIENTE_API = './api/cliente/GetCliente.php';
const URL_CREATE = './api/doc/CreateDoc.php';
const URL_GET_DOC_BY_CLI = './api/doc/GetDocByCliente.php';
const URL_GET_DOC_BY_ID_CLI = './api/doc/GetDocByClienteAndId.php';
const URL_GET_DOC_BY_ID = './api/doc/GetDocById.php';
const URL_DELETE_DOC = './api/doc/DeleteDoc.php';
const SITE = "Transportadora FG-360";

var data = new FormData();

$(document).ready(function(){
    var file ;
    var fileName;
    var flagNovo = true;
 
    $("#fileUp").on("change",function(){
        file = document.getElementById("fileUp").files[0];
        fileName =  $('#fileUp').val().replace(/C:\\fakepath\\/i, '');
        data.append("filename", fileName);
        data.append("file", file);    
    });

    $("#rdo_attDoc").click(function(){
        $("#faturas").removeClass("d-none");     
        flagNovo = false;
        clearFields();
    });

    $("#rdo_novoDoc").click(function(){
        $("#faturas").addClass("d-none");
        flagNovo = true;
        clearFields();
    });


    $("#divTipo input[type=radio]").click(function(){

        if(!flagNovo){
            var tipo = $("#divTipo input[type=radio]:checked").val();
            var cliente = $("#cliente").children("option:selected").val();

            $("#faturas").empty();

            $.get(URL_GET_DOC_BY_ID_CLI,{"id":cliente,"tipo":tipo},function(data){
                var json = JSON.parse(data);

                for(item in json){

                    var row = '<div class="row"><p hidden>'+json[item].id+'</p><div class="col-4"><label for="rdo_attFaturas" class="radio" ><input id="rdo_attFaturas" type="radio" name="attFaturas" value='+json[item].id+'onclick='+"alert('ok');"+' >'+json[item].vencimento+'</label></div><div class="col-4 text-center"><p>'+json[item].descricao+'</p></div><div class="col-4"><p class="d-inline-block pr-5">R$ '+json[item].valor+'</p><a class="attFaturas-link" href="#"><i class="far fa-file-alt"></i> </a></div></div>';
                    $("#faturas").append(row);
                }
            }).fail(function(){

            });


        }
    })

    $("#cliente").change(function(){

        if(!flagNovo){
            var cliente = $("#cliente").children("option:selected").val();

            $.get(URL_GET_DOC_BY_CLI,{"id_cli":cliente},function(data){

                var json = JSON.parse(data);

               

                for(item in json){

                    var row = '<div class="row"><p hidden>'+json[item].id+'</p><div class="col-4"><label for="rdo_attFaturas" class="radio" ><input id="rdo_attFaturas" type="radio" name="attFaturas" value='+json[item].id+' onclick='+"getDadosDoc();"+' >'+json[item].vencimento+'</label></div><div class="col-4 text-center"><p>'+json[item].descricao+'</p></div><div class="col-4"><p class="d-inline-block pr-5">R$ '+json[item].valor+'</p><a class="attFaturas-link" href='+json[item].arquivoPath+' download><i class="far fa-file-alt"></i> </a></div></div>';
                    $("#faturas").append(row);
                }
            }).fail(function(){
                toastr.warning("Nenhuma fatura cadadstrada!",SITE);
            });
        }


    });

    getClientes();

    
   

    $("#btnSalvar").click(function(){

        //VERIFICAÇÃO
        if( $("#fileUp").val() == ""){
            toastr.error("Nescessário fazer upload do arquivo",SITE);
            return;
        }

        if(flagNovo == false){
            
            var id_doc = $("#faturas input[type=radio]:checked").val();
            $.get(URL_DELETE_DOC,{"id":id_doc},function(data){
                toastr.success("Alterado com sucesso","Transportadora FG-360");
            }).fail(function(){
                toastr.error("Erro ao alterar!","Transportadora FG-360");
            });
            
            
            var cliente = $("#cliente").children("option:selected").val();

            $.get(URL_GET_DOC_BY_CLI,{"id_cli":cliente},function(data){

                var json = JSON.parse(data);

                for(item in json){

                    var row = '<div class="row"><div class="col-4"><label for="rdo_attFaturas" class="radio"><input id="rdo_attFaturas" type="radio" name="attFaturas" value="FaturaX">'+json[item].vencimento+'</label></div><div class="col-4 text-center"><p>'+json[item].descricao+'</p></div><div class="col-4"><p class="d-inline-block pr-5">R$ '+json[item].valor+'</p><a class="attFaturas-link" href="#"><i class="far fa-file-alt"></i> </a></div></div>';
                    $("#faturas").append(row);
                }
            }).fail(function(){
                
            });
        }

        var tipoSelecionado = $("#rdo_fatura").attr("checked") ? "Fatura" : $("#rdo_cte").attr("checked") ? "CTE" : "2Via";

        var cliente =  $("#cliente").children("option:selected").val();
        var tipo = tipoSelecionado;
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
                if(flagNovo){
                    toastr.success("Cadastrado com sucesso","Transportadora FG-360");
                }
            }).fail(function(){
                if(flagNovo){
                  toastr.error("Erro ao cadastrar!","Transportadora FG-360");
                }
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

function getFaturas(cliente){

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


function getDadosDoc(){

    var iddoc = $("#faturas input[type=radio]:checked").val();

    $.get(URL_GET_DOC_BY_ID,{"id":iddoc},function(data){

        var json = JSON.parse(data);
        for (cliente in json ){

           $("#vencimento").val(json[cliente].vencimento);
           $("#status").val(json[cliente].status);
           $("#valor").val(json[cliente].valor);

           $("#status option").each(function(){
               if($(this).val() == json[cliente].status ){
                $(this).attr("selected", "selected");
               }
           })
        }

    }).fail(function(){

    });

} 

//FUNÇOES BASICAS 

function clearFields(){
    $("#vencimento").val("");
    $("#status").val("");
    $("#valor").val("");
    $("#status").val("0");
    $("#cliente").val("0");
    $("#faturas").empty();
    $("#divTipo input[type=radio]").prop("checked",false);
    $("#fileUp").val("");
}
