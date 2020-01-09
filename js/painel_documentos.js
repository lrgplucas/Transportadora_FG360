

const URL_GET_CLIENTE_API = './api/cliente/GetCliente.php';
const URL_CREATE = './api/doc/CreateDoc.php';
const URL_GET_DOC_BY_CLI = './api/doc/GetDocByCliente.php';
const URL_GET_DOC_BY_ID_CLI = './api/doc/GetDocByClienteAndId.php';
const URL_GET_DOC_BY_ID = './api/doc/GetDocById.php';
const URL_DELETE_DOC = './api/doc/DeleteDoc.php';
const SITE = "Transportadora FG-360";
const URL_EMAIL_CADASTRO = './helper/PHPMailer/src/MailDocs.php';


var data = new FormData();

toastr.options = {
    "maxOpened":1,
    "autoDismiss":true
};

$(document).ready(function(){

    //LIMPA OS CHECKS DE NOVO OU DOC EXISTENTE
    resetInicialForm();

    var file , fileName;
    var flagNovo = null;
 
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

    $("#rdo_fatura").click(function(){
        setModeFatura();
    });
    $("#rdo_cte").click(function(){
        setModeNonFatura();
    });
    $("#rdo_2via").click(function(){
        setModeFatura();
    });


    $("#divTipo input[type=radio]").click(function(){

        if(!flagNovo){
            var tipo = $("#divTipo input[type=radio]:checked").val();
            var cliente = $("#cliente").children("option:selected").val();

            $("#faturas").empty();

            $.get(URL_GET_DOC_BY_ID_CLI,{"id":cliente,"tipo":tipo},function(data){
                var json = JSON.parse(data);
                $("#faturas").empty();
                for(item in json){

                    var dataTemp = new Date(json[item].vencimento);
                    dataTemp.setDate(dataTemp.getDate()+1); 

                    var row = '<div class="row"><div class="col-3">'+
                    '<label for="rdo_attFaturas" class="radio"><input id="rdo_attFaturas"  onclick="getInfoDoc(this)" type="radio" name="attFaturas" value="'+json[item].id+'">'+(json[item].vencimento == null?"SEM VENC.":dataAtualFormatada(dataTemp)) +'</label>'+
                    '</div><div class="col-3 text-center"><p>'+json[item].descricao+'</p></div>'+
                    '<div class="col-4"><p class="d-inline-block pr-5">R$ '+(json[item].valor == "" ? 0 : json[item].valor )+'</p><a class="attFaturas-link" href='+json[item].arquivoPath+' download><i class="far fa-file-alt"></i> </a>'+
                    '</div><div class="col-2"><input type="button" class="btn btn-custom text-center" style="padding:0 0 0 0 ;border-radius:0;" onclick="deletarDoc('+json[item].id+')" value="excluir" /></div></div>';
                    $("#faturas").append(row);
                }
            }).fail(function(){

            });


        }
    })

    $("#cliente").change(function(){
        event.stopPropagation();
        
        if(!flagNovo){
            var cliente = $("#cliente").children("option:selected").val();

            $.get(URL_GET_DOC_BY_CLI,{"id_cli":cliente},function(data){

                var json = JSON.parse(data);

               
                $("#faturas").empty();
                for(item in json){

                    var dataTemp = new Date(json[item].vencimento);
                    dataTemp.setDate(dataTemp.getDate()+1); 

                    var row = '<div class="row"><div class="col-3">'+
                    '<label for="rdo_attFaturas" class="radio"><input id="rdo_attFaturas"  onclick="getInfoDoc(this)" type="radio" name="attFaturas" value="'+json[item].id+'">'+(json[item].vencimento == null?"SEM VENC.":dataAtualFormatada(dataTemp)) +'</label>'+
                    '</div><div class="col-3 text-center"><p>'+json[item].descricao+'</p></div>'+
                    '<div class="col-4"><p class="d-inline-block pr-5">R$ '+(json[item].valor == "" ? 0 : json[item].valor )+'</p><a class="attFaturas-link" href='+json[item].arquivoPath+' download><i class="far fa-file-alt"></i> </a>'+
                    '</div><div class="col-2"><input type="button" class="btn btn-custom text-center" style="padding:0 0 0 0 ;border-radius:0;" onclick="deletarDoc('+json[item].id+')" value="excluir" /></div></div>';
                    $("#faturas").append(row);
                }
            }).fail(function(){
                toastr.warning("Nenhuma fatura cadastrada!",SITE);
            });
        }


    });

    getClientes();

    
   

    $("#btnSalvar").click(function(event){
        $("#btnSalvar")[0].disabled = true;
        //VERIFICAÇÃO
        if(!validate(flagNovo)){
            $("#btnSalvar")[0].disabled = false;
            return ;
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
                $("#faturas").empty();
                for(item in json){
                    var dataTemp = new Date(json[item].vencimento);
                    dataTemp.setDate(dataTemp.getDate()+1); 

                    var row = '<div class="row"><div class="col-3">'+
                    '<label for="rdo_attFaturas" class="radio"><input id="rdo_attFaturas"  onclick="getInfoDoc(this)" type="radio" name="attFaturas" value="'+json[item].id+'">'+(json[item].vencimento == null?"SEM VENC.":dataAtualFormatada(dataTemp)) +'</label>'+
                    '</div><div class="col-3 text-center"><p>'+json[item].descricao+'</p></div>'+
                    '<div class="col-4"><p class="d-inline-block pr-5">R$ '+(json[item].valor == "" ? 0 : json[item].valor )+'</p><a class="attFaturas-link" href='+json[item].arquivoPath+' download><i class="far fa-file-alt"></i> </a>'+
                    '</div><div class="col-2"><input type="button" class="btn btn-custom text-center" style="padding:0 0 0 0 ;border-radius:0;" onclick="deletarDoc('+json[item].id+')" value="excluir" /></div></div>';
                    $("#faturas").append(row);
                }
            }).fail(function(){
                toastr.warning("Nenhuma fatura cadastrada!",SITE);
                $("#btnSalvar")[0].disabled = false;
            });
        }

        var cliente =  $("#cliente").children("option:selected").val();
        var tipo = $("#divTipo > input:checked").val();
        var vencimento = $("#vencimento").val();
        var status = $("#status").val();
        var valor = $("#valor").val();
        var msg = toastr.info("Aguarde o upload do arquivo","Transportadora FG-360",{timeOut:1000000});

        sendFile(function(data){
            dataUpload = data;
           if($("#fileUp").val() == ""){
                //em casos de não novo upload
                dataUpload = $("#path").text();
           }
            var json = {
                "cliente":cliente,
                "tipo":tipo,
                "path":dataUpload,
                "status":status,
                "valor":valor,
                "vencimento":vencimento
            }

            var email = {
                "cliente":cliente,
                "anexo": dataUpload
            }

            $.post(URL_CREATE ,json ,function(){
                toastr.clear();
                $("body").on("click","a#close-toastr",function(){
                    $(this).closest(".toast").remove();
                });

                if(flagNovo){
                    toastr.success("Cadastrado com sucesso","Transportadora FG-360");

                    $.post(URL_EMAIL_CADASTRO,email,function(data){
                        return ;
                     });
                }
                $("#btnSalvar")[0].disabled = false;
                
                setTimeout(function(){resetInicialForm()},1500); 
            }).fail(function(){
                if(flagNovo){
                  toastr.error("Erro ao cadastrar!","Transportadora FG-360");
                }
                $("#btnSalvar")[0].disabled = false;

               
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

    var fullDate = year+'-'+'0'+mounth+'-'+day;

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

function deletarDoc(id){

    $.get(URL_DELETE_DOC,{"id":id},function(data){
        toastr.success("Excluido com sucesso",SITE);

        $("#faturas").empty();
        $.get(URL_GET_DOC_BY_CLI,{"id_cli":cliente},function(data){

            var json = JSON.parse(data);

            for(item in json){

                var dataTemp = new Date(json[item].vencimento);
                dataTemp.setDate(dataTemp.getDate()+1);        

                var row = '<div class="row"><div class="col-3">'+
                    '<label for="rdo_attFaturas" class="radio"><input id="rdo_attFaturas"  onclick="getInfoDoc(this)" type="radio" name="attFaturas" value="'+json[item].id+'">'+(json[item].vencimento == null?"SEM VENC.":dataAtualFormatada(dataTemp)) +'</label>'+
                    '</div><div class="col-3 text-center"><p>'+json[item].descricao+'</p></div>'+
                    '<div class="col-4"><p class="d-inline-block pr-5">R$ '+(json[item].valor == "" ? 0 : json[item].valor )+'</p><a class="attFaturas-link" href='+json[item].arquivoPath+' download><i class="far fa-file-alt"></i> </a>'+
                    '</div><div class="col-2"><input type="button" class="btn btn-custom text-center"  style="padding:0 0 0 0 ; border-radius:0;" onclick="deletarDoc('+json[item].id+')" value="excluir" /></div></div>';
                    $("#faturas").append(row);
            }
        }).fail(function(){
            //toastr.warning("Nenhuma fatura cadastrada!",SITE);
        });
    });
}

function resetInicialForm(){

    $("#rdo_2via")[0].checked = false;
    $("#rdo_cte")[0].checked = false;
    $("#rdo_fatura")[0].checked = false;
    $("#rdo_attDoc")[0].checked = false;
    $("#rdo_novoDoc")[0].checked = false;
    clearFields();
}

function validate(isNovo){
    var isFatura = $("#rdo_fatura")[0].checked;
    if(isNovo == null){
        toastr.warning("Selecione o tipo de operação",SITE);
        return false;
    }

    if(isNovo){

        //TIPO DOC
        if($("#divTipo > input:checked").val() == null){
            toastr.warning("Selecione o tipo de documento",SITE);
            return false;
        }

         //CLIENTE
        if( $("#cliente").children("option:selected").val() == null){
            toastr.warning("Selecione o cliente",SITE);
            return false;
        }

        //DOC
        if( $("#fileUp").val() == ""){
            toastr.warning("Nescessário fazer upload do arquivo",SITE);
            return false;
        }

        //NOVO E FATURA
        if(isFatura){

            var fields = ["vencimento","status","valor"];
        
            for(var i = 0; i< fields.length;i++){

                if($("#"+fields[i]).val() == ""){
                    toastr.warning("Para o tipo de documento fatura todos os campos são obrigatórios.",SITE);
                    return false;    
                }
            }

        }
       
    }else{

        //CLIENTE
        if( $("#cliente").children("option:selected").val() == null){
            toastr.warning("Selecione o cliente",SITE);
            return false;
        }

        //TIPO
        if($("#divTipo > input:checked").val() == null){
            toastr.warning("Selecione o tipo de documento",SITE);
            return false;
        }

        //DOC NA LISTA
        if ($("#faturas input[type=radio]:checked").val() == null){
            toastr.warning("Selecione o documento",SITE);
            return false;
        }

        //NOVO E FATURA
        if(isFatura){
            var fields = ["vencimento","status","valor"];
        
            for(var i = 0; i< fields.length;i++){

                if($("#"+fields[i]).val() == ""){
                    toastr.warning("Para o tipo de documento fatura todos os campos são obrigatórios.",SITE);
                    return false;    
                }
            }
        }

        
    }

    return true;
}

function getInfoDoc( it){

    var idDoc = it["value"];
    promiseDocId(idDoc);

}

function promiseDocId(id){

    var promise = new Promise(function(resolve,reject){

        $.get(URL_GET_DOC_BY_ID,{"id":id},function(data){
            resolve(data);
        }).fail(function(){
            reject(data);
        });
    });


    promise.then(function(data){
        json = JSON.parse(data);

        for(item in json){
            $("#vencimento").val(json[item].vencimento);
            $("#status").val(json[item].status);
            $("#valor").val(json[item].valor);
            $('#path').text(json[item].arquivoPath);
        }
    });
}

function setModeNonFatura(){
    resetValues();
  //  $("#vencimento")[0].disabled = true;
    $("#status")[0].disabled = true;
    $("#valor")[0].disabled = true;
}



function setModeFatura(){
    //resetValues();
 //   $("#vencimento")[0].disabled = false;
    $("#status")[0].disabled = false;
    $("#valor")[0].disabled = false;   
}

function resetValues(){

    $("#vencimento").val("");
    $("#status").val("0");
    $("#valor").val("");
}

function dataAtualFormatada(data){
    var dia  = data.getDate().toString(),
    diaF = (dia.length == 1) ? '0'+dia : dia,
    mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
    mesF = (mes.length == 1) ? '0'+mes : mes,
    anoF = data.getFullYear();
    return diaF+"/"+mesF+"/"+anoF;
 }


