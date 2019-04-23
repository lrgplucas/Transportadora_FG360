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

      //TIRA O SUBMIT DO FORM
    $("#formSender").submit(function(event){
        event.preventDefault();
    });

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
        var area = $("#area").children("option:selected").val();
        var assunto = $("#assunto").children("option:selected").val();

        if(document.getElementById("rdo_juridica").checked){
            var cnpj = $("#cnpj").val();
            var razao = $("#razaosocial").val();  
            var telComercial = $("#telcomercial").val();
            var cidade = $("#Cidade").children("option:selected").text();
            var estado = $("#estado").children("option:selected").text(); 
            jsonEmail = {
                "razaoSocial":razao,
                "cnpj":cnpj,
                "telComercial":telComercial,
                "email":email,
                "celular":celular,
                "msg":msg,
                "flag":"juridico",
                "assunto":assunto,
                "area":area,
                "cidade":cidade,
                "estado":estado
            }
        }else if(document.getElementById("rdo_fisica").checked){
            var cpf = $("#cpf").val();
            var nome = $("#nome").val();
            var tel = $("#telefone").val();
            var cidade = $("#Cidade").children("option:selected").text();
            var estado = $("#estado").children("option:selected").text(); 
            jsonEmail = {
                "nome":nome,
                "cpf":cpf,
                "tel":tel,
                "email":email,
                "celular":celular,
                "msg":msg,
                "flag":"fisica",
                "assunto":assunto,
                "area":area,
                "cidade":cidade,
                "estado":estado
            }
        }
       

        $.post(URL_EMAIL_CONTATO,jsonEmail,function(){
           
            toastr.success("Enviado!","Transportadora FG-360");
            setTimeout(function(){location.reload()},3000);
          
           
        }).fail(function(){
            toastr.success("Enviado!","Transportadora FG-360");
            setTimeout(function(){location.reload()},3000);
            
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