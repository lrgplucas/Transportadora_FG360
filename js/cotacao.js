/**
 * Author : Joao
 * Pagina : página de cotação
 * Data   : 14/04/2019
 */

 //IMPORTS

$(document).ready(function(){

    //RESETA O FORM
    $("#formSender").trigger("reset");
   // $("#km")[0].disabled = true;

    //TIRA O SUBMIT DO FORM
    $("#formSender").submit(function(event){
        event.preventDefault();
    });

    $("#peso").focus(function(){
       // CalculaDistancia();
    });

    $("#km").on("mouseenter",function(){
       // toastr.info("Quando for preencher o peso a distância será calculada entre as 2 cidades");
    });

    $("#km").on("mouseleave",function(){
        toastr.remove();
    });


    $("#btnEnviar").click(function(){

        //VALIDAÇÃO COMBO
        if($("#pallet").val() == "0"){
            toastr.warning("Todos os campos são obrigatórios");
            $("#pallet").focus();
            return;
        }

        if($("#tipoVeiculo").val() == "0"){
            toastr.warning("Todos os campos são obrigatórios");
            $("#tipoVeiculo").focus();
            return;
        }

        if ($("#formSender input:invalid").length) {
            toastr.warning("Todos os campos são obrigatórios");
            $("#tipoVeiculo").focus();
            return;
        }

        if($("#obs").val() == ""){
            toastr.warning("Todos os campos são obrigatórios");
            $("#obs").focus();
            return;
        }
    
         //PEGAR VALORES
         var values = {};
         $("#formSender input").each(function(){
             if($(this).attr("type") != 'submit'){
 
                 values[$(this).attr("id")]=$(this).val();
             }
         });

         values["obs"] = $("#obs").val();
         values['pallet'] = $('#pallet').children('option:checked').val();
         values['tipoVeiculo'] = $('#tipoVeiculo').children('option:checked').val();

        $.post(URL_MAIL_COTACAO,values,function(data){
            toastr.success("Enviado com sucesso","Transportadora FG-360");
            setTimeout(function(){location.reload()},3000);
            
        }).fail(function(){
            /*toastr.success("Enviado com sucesso","Transportadora FG-360");
            setInterval(function(){},2000);
             location.reload();*/
        });

        
    });
});


function CalculaDistancia() {

    var origem = $("#origem").val();
    var destino = $("#destino").val();
    
    var custonDistance = URL_DISTANCE+origem+'|'+destino;


    $.ajax({
        type: 'GET',
        url:custonDistance,
        dataType: 'json',
        success: function(data){
            $("#km").val(data.distance);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           // error_fn(jqXHR, textStatus, errorThrown);
        }
     });
    
  
}