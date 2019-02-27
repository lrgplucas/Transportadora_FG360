/*
* author : joao
* data : 25/02/2019
* classe : Entrega API GET ALL
*/


$(document).ready(function(){

    //ADD LISTENERS

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

       //ENVIAR EMAIL
       sendEmail(jsonEmail);
    });

});

//EMAIL 

//AJAX REQUEST 
function sendEmail(body){
    
    $.post( "./helper/PHPMailer/src/MailHome.php",body ,function( data ) {
        toastr.success("Email enviado com sucesso!","Transportadora FG-360");
    });

}




