/*
* author : joao
* data : 25/02/2019
* classe : HOME JS
*/

var URL_CLIENTE = "cliente.html";
var URL_STATUS_RASTREIO = "status.html";
const URL_LOGOUT = "./api/cliente/Logout.php";

$(document).ready(function(){

    logout();


    //PARA QUE TECLANDO ENTER FAÇA LOGIN 
    $(document).keypress(function(event){


        var cnpj  = $("#loginCnpj").val(); 
        var senha = $("#loginSenha").val();

        if(cnpj != "" && senha != "" ){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == 13){
                login();
                //return;
            }
        }

        if($("#txtCod").val() != ""){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == 13){
                rastreio();
                //return;
            }
        }


    });


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

      login();

    });

    $("#btn_rastreio").on("click",function(){
        rastreio();
      
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

//Logout
function logout(){
    $.get(URL_LOGOUT,function(){

     });

}

function login (){
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
}

function rastreio(){
    if($("#txtCod").val() != ""){
        var cod = $("#txtCod").val();

         //redireciona para pagina de status
        window.location = URL_STATUS_RASTREIO+"?cod="+cod;
    }else{
        toastr.error("Insira o ID de rastreio","Transportadora FG-360")
    }
}




