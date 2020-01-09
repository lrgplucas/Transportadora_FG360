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
        //var ptBrTime = new Date().toLocaleString("pt-BR", {timeZone: "America/Sao_Paulo"});

        //PREENCHE DADOS ENTREGA
        $("#p_produto")[0].innerHTML = "<b>Produto : </b><b>"+entrega[0].produto+"</b>";
        $("#p_id")[0].innerHTML = "<b>Cod. Rastreio : </b><b>"+entrega[0].codRastreio+"</b>";
        $("#p_tipo")[0].innerHTML = "<b>Tipo de Carga : </b><b>"+entrega[0].tipo_carga+"</b>";
        //var ptBrTime = new Date();
        dataTemp = new Date(entrega[0].dataPrevisao);
        var dataTempx = new Date();
        dataTempx.setDate(dataTemp.getDate()+1);
        ptBrTime = dataAtualFormatada(dataTempx);

        $("#p_previsao")[0].innerHTML = "<b>Previsão de Entrega : </b><b>"+ptBrTime+"</b>";
        $("#p_motorista")[0].innerHTML = "<b>Motorista : </b><b>"+entrega[0].motorista+"</b>";
        $("#p_veiculo")[0].innerHTML = "<b>Veículo : </b><b>"+entrega[0].veiculo+"</b>";
        setStatusRecebido(entrega[0].dataPrevisao);
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

      if(JSON.parse(data).cnpj == null){
        $("#p_cnpj")[0].innerHTML = "CPF/CNPJ: "+JSON.parse(data).cpf;
      }else{
        $("#p_cnpj")[0].innerHTML = "CPF/CNPJ: "+JSON.parse(data).cnpj;
      }
      
    });
}


function getMovs(id_entrega){

  
  var row2 = "";

  $.get(URL_API_MOVIMENTACOES_BY_ENTREGA,{"id":id_entrega},function(data){
    var data_temporary = JSON.parse(data);

    //DATA BR 
    var ptBrTime = new Date().toLocaleString("pt-BR", {timeZone: "America/Sao_Paulo"});

    var last = data_temporary.length - 1;
    var status = data_temporary[last].status;

    dataTemp = new Date(data_temporary[last].data);
    var dataTempx = new Date();
    dataTempx.setDate(dataTemp.getDate()+1);
    ptBrTime = dataAtualFormatada(dataTempx);

    $("#p_previsao")[0].innerHTML = "<b>Previsão de Entrega : </b><b>"+ptBrTime+"</b>";
   

    if(status == "Em Transporte"){
      $("#imgTransporte").attr("src","imgs/rastreamento/transporte_orange.png");
      $("#imgEntregue").attr("src","imgs/rastreamento/transporte_grey.png");
      $("#divLine").removeClass("section-status-line-checked");
      $("#divLine").addClass("section-status-line");
      $("#pTransporte").removeClass("section-status-text-check");
      $("#pTransporte").addClass("section-status-text-checked");
      $("#pEntregue").removeClass("section-status-text-checked");
      $("#pEntregue").addClass("section-status-text-check");
     
    }

    if(status == "Entregue"){
      $("#imgTransporte").attr("src","imgs/rastreamento/transporte_orange.png");
      $("#imgEntregue").attr("src","imgs/rastreamento/recebido_orange.png");
      $("#divLine").addClass("section-status-line-checked");
      $("#pTransporte").removeClass("section-status-text-check");
      $("#pTransporte").addClass("section-status-text-checked");
      $("#pEntregue").addClass("section-status-text-checked");
      $("#pEntregue").removeClass("section-status-text-check");
    }

    
    
    for (var i = 0 ; i < data_temporary.length;i++){
      ptBrTime = new Date(data_temporary[i].data);
      ptBrTime.setDate(ptBrTime.getDate()+1);
      var row1 = "<tr><td>"+ptBrTime.toLocaleString().substring(0,10)+"</td><td>"+data_temporary[i].status+"</td></tr>";
      $('#tbodyOne').append(
        row1
      );
    }
    
   
  });



}


function setStatusRecebido(data){
  ptBrTime = new Date(data);
  ptBrTime.setDate(ptBrTime.getDate()+1);
  var row1 = "<tr><td>"+ptBrTime.toLocaleString().substring(0,10)+"</td><td>Recebido</td></tr>";
  $('#tbodyOne').append(row1);
}

function dataAtualFormatada(data){

     var dia  = data.getDate().toString(),
      diaF = (dia.length == 1) ? '0'+dia : dia,
      mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
      mesF = (mes.length == 1) ? '0'+mes : mes,
      anoF = data.getFullYear();
  return diaF+"/"+mesF+"/"+anoF;
}






