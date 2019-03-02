/*
* author : joao
* data : 25/02/2019
* classe : Entrega API GET ALL
*/


$(document).ready(function(){

    //ADD LISTENERS

    //ENVIO DO EMAIL
    $("#btnEmail").click(function(){

       //ATRIBUTOS
       var nome = $("#nome").val();
       var telefone = $("#telefone").val();
       var celular = $("#celular").val();
       var email = $("#email").val();
       var observacoes = $("#obs").val();

       var jsonEmail = {
           "nome":nome,
           "telefone":telefone,
           "celular":celular,
           "email":email,
           "obs":observacoes
       }

       var body = {
           "data":jsonEmail
       }

       sendEmail(jsonEmail);
    });

    //FIX PARA IPHONE EFEITO HOVER
    $(".time-home-card-cargo").on("touchstart",function(e){
        //$(this).fadeTo(700, 1);
    });

    $(".time-home-card-cargo").on("touchend",function(e){
        // $(this).fadeTo(1200, 0); 
    });

});

//EMAIL 

//AJAX REQUEST 
function sendEmail(body){
    
    $.post( "./helper/PHPMailer/src/MailHome.php",body ,function( data ) {
        toastr.success("Email enviado com sucesso!","Transportadora FG-360");
    });

}




