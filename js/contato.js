/*
* author : joao
* data : 26/03/2019
* classe : CONTATO JS
*/
//URL DO EMAIL
var URL_EMAIL_CONTATO = './helper/PHPMailer/src/MailContato.php';
var URL_ESTADOS = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/';
var URL_CIDADES = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/{id}/municipios';

$(document).ready(function(){

    $("#divNome").hide();
    $("#divCpf").hide(); 
    $("#divTelefone").hide();
    $("#divRazaoSocial").removeClass("d-none");
    $("#divCnpj").removeClass("d-none");
    $("#divTelefoneComercial").removeClass("d-none");


    //PREENCHE O COMBO DOS ESTADOS
    getEstados();

    $("#rdo_juridica").click(function(){
       $("#divNome").hide();
       $("#divCpf").hide(); 
       $("#divTelefone").hide();
       $("#divRazaoSocial").removeClass("d-none");
       $("#divCnpj").removeClass("d-none");
       $("#divTelefoneComercial").removeClass("d-none");
    });

    $("#rdo_fisica").click(function(){
       $("#divNome").show();
       $("#divCpf").show();
       $("#divTelefone").show();
       $("#divRazaoSocial").addClass("d-none");
       $("#divCnpj").addClass("d-none");
       $("#divTelefoneComercial").addClass("d-none");
    });

    $("#estado").change(function(){
        //var length = $('#Cidade > option').length;
        //if(length < 2){
            var id = $("#estado").val();
            getCidadePorEstado(id);

        //}
        
       
    });

    //ENVIO DO EMAIL
    $("#btnEnviar").click(function(){

        var jsonEmail = "";
        //DADOS

        var email = $("#email").val();
        var celular = $("#telcelular").val();
        var msg = $("#msg").val();

        if(document.getElementById("rdo_juridica").checked){
            var cnpj = $("#cnpj").val();
            var razao = $("#razaosocial").val();  
            var telComercial = $("#telcomercial").val();
            jsonEmail = {
                "razaoSocial":razao,
                "cnpj":cnpj,
                "telComercial":telComercial,
                "email":email,
                "celular":celular,
                "msg":msg,
                "flag":"juridico"
            }
        }else if(document.getElementById("rdo_fisica").checked){
            var cpf = $("#cpf").val();
            var nome = $("#nome").val();
            var tel = $("#telefone").val();
            jsonEmail = {
                "nome":nome,
                "cpf":cpf,
                "tel":tel,
                "email":email,
                "celular":celular,
                "msg":msg,
                "flag":"fisica"
            }
        }
       
        
        $.post(URL_EMAIL_CONTATO,jsonEmail,function(data){
            toastr.success("Enviado!","Transportadora FG-360");
           
        });
    });

});

function getEstados (){
    $.get(URL_ESTADOS,function(data){
        //var jsonEstados = JSON.parse(data);
        for (item in data){
            $("#estado").append("<option value="+data[item].id+">"+data[item].nome+"</option> ");
        }
    });
}

function getCidadePorEstado(id){

    var ultimateUrl = URL_CIDADES.replace("{id}",id);

    $.get(ultimateUrl,function(data){

        for(item in data){
       
            $("#Cidade").append("<option value="+data[item].id+">"+data[item].nome+"</option> ");
        }

    });

}