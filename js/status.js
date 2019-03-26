/*
* author : joao
* data : 22/03/2019
* classe : STATUS JS
*/

var URL_API_MOVIMENTACOES = "./api/mov/GetByCod.php";
var URL_API_MOVIMENTACOES_BY_ENTREGA = "./api/mov/GetByEntrega.php";
var URL_API_ENTREGA_BY_COD = "./api/entrega/GetByCodRastreio.php";
var URL_API_CLIENTE_BY_ID = "./api/cliente/GetClienteById.php";
var cod ,id_cliente, fail , entrega , id_entrega;



$(document).ready(function(){

    //pegando o codigo da URL
    var url_string = location.origin ;
    var url = new URL(url_string);
    cod = location.search.substring(5);

    //FIX ME - PROMISE PRA TRAZER O VALOR ASSINCRONO
    let promise = new Promise(function(success , fail) {
      $.get(URL_API_ENTREGA_BY_COD,{cod:cod}, function (data){
        var temporary  =  data; 

        if(!temporary){
          
          toastr.error("ID inválido!","Transportadora FG-360");
        }
        entrega = JSON.parse(temporary);

        
        id_cliente = entrega[0].id_cliente;
        id_entrega = entrega[0].id ;

        //DATA BR 
        var ptBrTime = new Date().toLocaleString("pt-BR", {timeZone: "America/Sao_Paulo"});

        //PREENCHE DADOS ENTREGA
        $("#p_produto")[0].innerHTML = "<b>Produto : </b><b>"+entrega[0].produto+"</b>";
        $("#p_id")[0].innerHTML = "<b>ID : </b><b>"+entrega[0].id+"</b>";
        $("#p_tipo")[0].innerHTML = "<b>Tipo de Carga : </b><b>"+entrega[0].tipo_carga+"</b>";
        ptBrTime = new Date(entrega[0].dataPrevisao);

        $("#p_previsao")[0].innerHTML = "<b>Previsão de Entrega : </b><b>"+ptBrTime.toLocaleString().substring(0,10)+"</b>";
        $("#p_motorista")[0].innerHTML = "<b>Motorista : </b><b>"+entrega[0].motorista+"</b>";
        $("#p_veiculo")[0].innerHTML = "<b>Veículo : </b><b>"+entrega[0].veiculo+"</b>";

        getMovs(id_entrega);
        getCliente(id_cliente);
     }).fail(function(){
        setFail();
     });

    });


    //PREENCHER CAMPOS 

    


});

function getCliente(id_cliente){

    $.get(URL_API_CLIENTE_BY_ID,{id:id_cliente},function(data){
      $("#p_nome")[0].innerHTML = JSON.parse(data).nome;
      $("#p_mail")[0].innerHTML = "Email: "+JSON.parse(data).email;
      $("#p_tel")[0].innerHTML  = "Telefone: "+JSON.parse(data).tel;
      $("#p_cnpj")[0].innerHTML = "CPF/CNPJ: "+JSON.parse(data).cnpj;
    });
}


function getMovs(id_entrega){

  
  var row2 = "";

  $.get(URL_API_MOVIMENTACOES_BY_ENTREGA,{id:id_entrega},function(data){
    var data_temporary = JSON.parse(data);

    //DATA BR 
    var ptBrTime = new Date().toLocaleString("pt-BR", {timeZone: "America/Sao_Paulo"});

    for (item in data_temporary){
      ptBrTime = new Date(data_temporary[item].data);
      var row1 = "<tr><td>"+ptBrTime.toLocaleString().substring(0,10)+"</td><td>"+data_temporary[item].status+"</td></tr>";
      $('#tbodyOne').append(
        row1
      );
    }
    
   
  });

}







