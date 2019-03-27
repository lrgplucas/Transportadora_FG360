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


    //PREENCHE O COMBO DOS ESTADOS
    getEstados();

    $("#estado").change(function(){
        //var length = $('#Cidade > option').length;
        //if(length < 2){
            var id = $("#estado").val();
            getCidadePorEstado(id);

        //}
        
       
    });

    //ENVIO DO EMAIL
    $("#btnEnviar").click(function(){

        //DADOS
        var email = $("#email").val();
        var cpf = $("#cpf").val();
        var cnpj = $("#cnpj").val();
        var nome = $("#nome").val();
        var razao = $("#razaosocial").val();
        var tel = $("#telefone").val();
        var telComercial = $("#telcomercial").val();
        var celular = $("#telcelular").val();
        var msg = $("#msg").val();

        //alert(email+"-"+cpf+"-"+cnpj+"-"+nome+"-"+razao+"-"+tel+"-"+telComercial+"-"+celular+"-"+msg);


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