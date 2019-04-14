/*
* author : joao
* data : 25/02/2019
* classe : PAINEL CLIENTE JS
*/

const URL_CREATE_CLIENTE_API = './api/cliente/CreateCliente.php';
const URL_EMAIL_CADASTRO = './helper/PHPMailer/src/mailCadastro.php';

$(document).ready(function(){

    setPessoaJuridicaForm();
    var isJuridica = false;

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
                $.post(URL_EMAIL_CADASTRO,json,function(data){
                    
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