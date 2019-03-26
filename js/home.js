/*
* author : joao
* data : 25/02/2019
* classe : HOME JS
*/


$(document).ready(function(){

    var URL_CLIENTE = "cliente.html";
    var URL_STATUS_RASTREIO = "status.html";

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


    //LOGIN
    $("#btnLogin").click(function(){

        var cnpj  = $("#loginCnpj").val(); 
        var senha = $("#loginSenha").val();
        var data  = {
            "cnpj":cnpj,
            "senha":senha
        }

        //AJAX PARA FAZER AUTENTICAÇÃO E REDIRECIONAR PARA PÁGINA DO CLIENTE
        $.post("./api/cliente/Auth.php", data ,function(){
            toastr.success("Login realizado com sucesso","Transportadora FG-360");
            window.location = URL_CLIENTE ;
        }).fail(function(){
            toastr.error("CNPJ ou senha inválidos!","Transportadora FG-360");
        });

    });

    $("#btn_rastreio").on("click",function(){

        if($("#txtCod").val() != ""){
            var cod = $("#txtCod").val();

             //redireciona para pagina de status
            window.location = URL_STATUS_RASTREIO+"?cod="+cod;
        }else{
            toastr.error("Insira o ID de rastreio","Transportadora FG-360")
        }
    });

  

});

//EMAIL 

//AJAX REQUEST 
function sendEmail(body){
    
    $.post( "./helper/PHPMailer/src/MailHome.php",body ,function( data ) {
        toastr.success("Email enviado com sucesso!","Transportadora FG-360");
    });

}

function wait2Seconds(){
    setInterval(function(){

    },4300);
}




