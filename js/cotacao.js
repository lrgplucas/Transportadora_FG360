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
    });
});