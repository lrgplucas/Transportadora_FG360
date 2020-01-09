/**
 * Author : Joao
 * Pagina : página de cotação
 * Data   : 14/04/2019
 */

 //IMPORTS

$(document).ready(function(){



    //TIRA O SUBMIT DO FORM
    $("#formSender").submit(function(event){
        event.preventDefault();
    });

    $("#km").focus(function(){

        CalculaDistancia();
    });


    $("#btnEnviar").click(function(){
    
         //PEGAR VALORES
         var values = {};
         $("#formSender input").each(function(){
             if($(this).attr("type") != 'submit'){
 
                 values[$(this).attr("id")]=$(this).val();
             }
         });

        $.post(URL_MAIL_COTACAO,values,function(data){
            toastr.success("Enviado com sucesso","Transportadora FG-360");
        }).fail(function(){
            toastr.success("Enviado com sucesso","Transportadora FG-360");
        });

        setInterval(function(){},2000);
        location.reload();
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