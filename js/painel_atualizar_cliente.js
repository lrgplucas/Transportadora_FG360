/*
* author : joao
* data : 30/04/2019
* classe : PAINEL ATUALIZAR CLIENTE JS
*/

$(document).ready(function(){

    var tipo = "";

    //RESET DO FORM DOS CAMPOS
    resetInicialForm();

    //EVENTOS NOS ELEMENTOS DA PÁGINA

    $("#senha").tooltip();
    $("#confirmaSenha").tooltip();

    $("#cliente").on("change",function(){
        var idCliente = $("#cliente").children("option:selected").val();
        
        getClientesById(idCliente , isJuridica , function(data){
            var json = JSON.parse(data);
            //CALLBACK FUNCTION PARA PREENCHER OS CAMPOS
            $("#nome").val(json.nome);
            $("#razaoSocial").val(json.nome);
            $("#cpf").val(json.cpf);
            $("#cnpj").val(json.cnpj);
            $("#email").val(json.email);
            $("#oldEmail").html(json.email);
            $("#telefone").val(json.tel);
            $("#celular").val(json.celular);
            
        });

    });

    $("#rdo_fisica").click(function(){
        resetForm();
        setPessoaFisicaForm();
        isJuridica = false;
        
        //CLIENTES
        getClientesByTipo("fisica");

        tipo = "fisica";
    });

    $("#rdo_juridica").click(function(){
        resetForm();
        setPessoaJuridicaForm();
        isJuridica = true;
        
        //CLIENTES
        getClientesByTipo("juridica");

        tipo = "juridica";
    });

    $("#btnAtualizar").click(function(){
        var isJuridica = $("#rdo_juridica")[0].checked;

        var oldEmail = $("#oldEmail").html();
        var newEmail = $("#email").val();

        if(validate(isJuridica)){

            var nome ,razaoSocial, cpf , cnpj , telefone , celular , senha , email ,id;

            razaoSocial = $("#razaoSocial").val();
            cnpj =  $("#cnpj").val();
            nome = $("#nome").val();
            cpf =  $("#cpf").val();
            id =  $("#cliente").children("option:selected").val();
            telefone = $("#telefone").val();
            celular =$("#celular").val();
            email = $("#email").val();

            if(isPasswordChanged()){

                if(isPasswordEqual()){
                    senha = $("#senha").val();
                }else{
                    toastr.warning("Senhas não coincidem",SITE);
                    return;
                }
            }else{
                senha = null;
            }
            var json = {
                "nome":nome,
                "id":id,
                "cpf":cpf,
                "cnpj":cnpj,
                "telefone":telefone,
                "celular":celular,
                "senha":senha,
                "email":email,
                "razaoSocial":razaoSocial
            };
            
            alterarCliente(json);

            //EMAIL
            if(isPasswordChanged()){
                emailCliente();
            }

        }else{
            toastr.warning("Todos os campos (exceto os campos de senha) são obrigatórios",SITE);
            return;
        }
      
    });

    $("#btnExcluir").click(function(){

        var idCliente = $("#cliente").children("option:selected").val();
        deletarCliente(idCliente);

    });


});



//TRAZ OS CLIENTES PREENCHE O SELECT
function getClientesByTipo(tipo){
    $("#cliente").empty();
    $("#cliente").append("<option val''>Selecione...</option>");
    $.get(URL_GET_CLIENTE_BY_TIPO,{"tipo":tipo},function(data){
        
        var json = JSON.parse(data);
        for (cliente in json ){
    
            $("#cliente").append("<option value="+json[cliente].id+">"+json[cliente].nome+"</option> ");
        }

        toastr.success("Clientes encontrados",SITE);
    
    }).fail(function(){
        toastr.error("Não há clientes desta categoria cadastrados",SITE);
    });
}

//FIX ME : PASSAR UMA FUNÇÃO DE CALLBACK PARA PREENCHE OS CAMPOS 
//TRAZ O CLIENTE PELO ID
function getClientesById(id , isJuridica , preencherCampos  ){

    var finalApi ;
    //SE FOR JURIDICO A API É DIFERENTE
    if(isJuridica){
        finalApi = URL_GET_CLIENTE_BY_ID_JURIDICO;
    }else{
        finalApi = URL_GET_CLIENTE_BY_ID_FISICA;
    }

    $.get(finalApi+id,function(data){
        toastr.success("Dados do cliente trazidos com sucesso",SITE);
        preencherCampos(data);
    });

}

//RESET INICIAL DOS CAMPOS
function resetInicialForm(){
    $("#rdo_fisica")[0].checked = false; 
    $("#rdo_juridica")[0].checked = false; 
    $("#formPainelCliente").trigger("reset");
}

//RESET INICIAL DOS CAMPOS
function resetForm(){
    $("#formPainelCliente").trigger("reset");
}

//MUDA OS CAMPOS PESSOA JURIDICA
function setPessoaJuridicaForm(){

    //DOC
    $("#divCpf").addClass("d-none");
    $("#divCnpj").removeClass("d-none");

    //NOME
    $("#divNome").addClass("d-none");
    $("#divRazaoSocial").removeClass("d-none");


}

//MUDA OS CAMPOS PESSOA FISICA
function setPessoaFisicaForm(){
     //DOC
     $("#divCnpj").addClass("d-none");
     $("#divCpf").removeClass("d-none");
 
     //NOME
     $("#divRazaoSocial").addClass("d-none");
     $("#divNome").removeClass("d-none");
 
}

function validate(isJuridica){
    valida = true;

    var camposPessoaFisica = ["nome","email","telefone","celular","cpf"];
    var camposPessoaJUridica = ["razaoSocial","email","telefone","celular","cnpj"];
    
    //VERIFICA SE É CLIENTE PESSOA FISICA OU JURIDICA
    if(isJuridica){

        for(var i = 0 ; i < camposPessoaJUridica.length;i++){
            if($("#"+camposPessoaJUridica[i]).val() == ""){
                return false;
            }
        }

        return true;


    }else{

        for(var i = 0 ; i < camposPessoaFisica.length;i++){
            if($("#"+camposPessoaFisica[i]).val() == ""){
                return false;
            }
        }

        return true;

    }
    return true;

}


//ALTERAR CLIENTE
function alterarCliente(json){

    $.post(URL_UPDATE_CLIENTE_BY_ID,json,function(data){
        toastr.success("Alterado com sucesso",SITE);
        setTimeout(function(){location.reload()},3000); 
    }).fail(function(data){
        toastr.error("Erro ao deletar",SITE);
    });

}

//DELETAR CLIENTE
function deletarCliente(id){

    $.get(URL_DELETE_CLIENTE_BY_ID,{"id":id},function(){
        toastr.success("Deletado com sucesso",SITE);
        setTimeout(function(){location.reload()},3000); 
    }).fail(function(){
        toastr.error("Erro ao deletar",SITE);
    });
}

//RETORNA FALSE SE A SENHA NÃO FOI ALTERADA
function isPasswordChanged(){
    var senha = $("#senha").val();
    var confirmaSenha = $("#confirmaSenha").val();
    if(senha != "" || confirmaSenha != ""){
        return true;
    }

    return false;
}

//RETORNA FALSE SE A SENHA E CONFIRMAÇÃO NÃO BATEM
function isPasswordEqual(){
    var senha = $("#senha").val();
    var confirmaSenha = $("#confirmaSenha").val();
    if(senha == confirmaSenha){
        return true;
    }

    return false;
}


function isEmailChanged(oldEmail, newEmail){
    return oldEmail != newEmail ;
}

//EMAIL DE ALETRAÇÃO DE DADOS CLIENTE
function emailCliente(){
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
    $.post(URL_EMAIL_ATUALIZACAO_CLIENTE,json,function(data){
        toastr.success("Email enviado com sucesso",SITE);
        setTimeout(function(){location.reload()},3000); 
    });
}



