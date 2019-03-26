/*
* author : joao
* data : 22/03/2019
* classe : RASTREAR JS
*/

var URL_STATUS = "status.html";

$(document).ready(function(){

    // AÇÃO DO BORTÃO DE RASTREAR
    $("#btnRastrear").click(function (){

        if($("#txtCod").val() != ""){
            var cod = $("#txtCod").val();

            //redireciona para pagina de status
            window.location = URL_STATUS+"?cod="+cod;
        }else{
            toastr.error("Insira o ID de rastreio","Transportadora FG-360")
        }
        
    });

   
  

});

function sendAjaxRastreio(){

}






