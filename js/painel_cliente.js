/*
* author : joao
* data : 25/02/2019
* classe : PAINEL CLIENTE JS
*/

const URL_CREATE_CLIENTE_API = './api/cliente/CreateCliente.php';
const URL_EMAIL_CADASTRO = './helper/PHPMailer/src/MailCadastro.php';
const URL_EMAIL_CADASTRO_PESSOA_JURIDICA = './helper/PHPMailer/src/MailCadastroPessoaJurica.php';


$(document).ready(function(){

    //RESETA O FORM
    $("#rdo_fisica")[0].checked = false;
    $("#rdo_juridica")[0].checked = false;
    $("#formPainelCliente").trigger("reset");

    setPessoaJuridicaForm();
    var isJuridica = false;

    $("#formPainelCliente").submit(function(event){
        event.preventDefault();
    });


    $("#rdo_fisica").click(function(){
        setPessoaFisicaForm();
        isJuridica = false;
    });

    $("#rdo_juridica").click(function(){
        setPessoaJuridicaForm();
        isJuridica = true;
    });

    //EVENTO DO BOTÃO DE ENVIAR
    $("#btnCadastrar").click(function(event){

        if(!validate(isJuridica)){
            toastr.error("Preencha todos campos","Transportadora FG-360");
            return ;
        }


        if(!checkPassword()){
            toastr.error("As Senhas não são compatíveis","Transportadora FG-360");
            return ;
        }

        //PEGAR VALORES
        var values = {};
        $("#formPainelCliente input").each(function(){
            if($(this).attr("type") != 'submit'){

                values[$(this).attr("id")]=$(this).val();
            }
        });

        $.post(URL_CREATE_CLIENTE_API,values,function(data){

          
                toastr.success("Salvo com sucesso","Transportadora FG-360");
                var email = $("#email").val();
                var nome = isJuridica ? $("#razaoSocial").val() : $("#nome").val();
                var juridica = isJuridica;
                var doc = isJuridica ? $("#cnpj").val() : $("#cpf").val();
                var senha = $("#senha").val();

                var json = {
                    "email":email,
                    "nome":nome,
                    "juridica":juridica,
                    "doc":doc,
                    "senha":senha 
                }

                var URL_EMAIL_CURRENT = isJuridica ? URL_EMAIL_CADASTRO_PESSOA_JURIDICA : URL_EMAIL_CADASTRO;
                $.post(URL_EMAIL_CURRENT,json,function(data){
                    setTimeout(function(){location.reload()},3000);
               
                    
                });
           
                
            

        });
    });

});


function setPessoaJuridicaForm(){

    //DOC
    $("#divCpf").addClass("d-none");
    $("#divCnpj").removeClass("d-none");

    //NOME
    $("#divNome").addClass("d-none");
    $("#divRazaoSocial").removeClass("d-none");


}

function setPessoaFisicaForm(){
     //DOC
     $("#divCnpj").addClass("d-none");
     $("#divCpf").removeClass("d-none");
 
     //NOME
     $("#divRazaoSocial").addClass("d-none");
     $("#divNome").removeClass("d-none");
 
}

function validarFields(){

    $("#formPainelCliente").on("input", function(){

        var input = $(this);

        var value = input.val();

        if(!value){
            input.css("border: 1px solid red;");            
        }else{
            input.css("border: none;");
        }
    });
}


function salvarCliente(salvo){
     //PEGAR VALORES
     var values = {};
     $("#formPainelCliente input").each(function(){
         if($(this).attr("type") != 'submit'){

             values[$(this).attr("id")]=$(this).val();
         }
     });

     $.post(URL_CREATE_CLIENTE_API,values,function(data){

         if(data == 1){
             toastr.success("Salvo com sucesso","Transportadora FG-360");
             salvo(data);
            
         }

     });
}

function checkPassword(){
    if($("#senha").val() == $("#confirmaSenha").val()){
        return true;
    }

    return false;
}

function validate(isJuridica){

    var fieldsFisica = ["cpf","nome","telefone","celular","email","senha","confirmaSenha"];
    var fieldsJurica = ["cnpj","razaoSocial","telefone","celular","email","senha","confirmaSenha"];

    var fields ;

    if(isJuridica){
        fields = fieldsJurica ;
    }else{
        fields = fieldsFisica ;
    }

    for (var i = 0; i < fields.length ; i++){

        if($("#"+fields[i]).val() == ""){
            
            return false;
        }
    }

    return true;
}