/*
* author : joao
* data : 22/03/2019
* classe : RASTREAR JS
*/

var URL_STATUS = "status.html";

$(document).ready(function(){
    $("#txtCod").val("");

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

    //PARA QUE TECLANDO ENTER FAÇA LOGIN 
    $(document).keypress(function(event){

        if($("#txtCod").val() != ""){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == 13){
                //redireciona para pagina de status
                var cod = $("#txtCod").val();
                window.location = URL_STATUS+"?cod="+cod;
            }
        }


    });

   
  

});

function sendAjaxRastreio(){

}






