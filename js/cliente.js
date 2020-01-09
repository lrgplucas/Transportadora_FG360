/*
* author : joao
* data : 11/03/2019
* classe : CLIENTE JS
*/
const URL_USU_GET = "./api/cliente/GetClienteByMail.php";
const URL_LOGOUT = "./api/cliente/Logout.php";
const URL_CHECK_USU = "./api/cliente/checkUsu.php";
const URL_GET_DEBITOS = "./api/debito/GetDebitosByCnpj.php";
const URL_HOME = "index.html";
const URL_GET_DOC_BY_CLI = './api/doc/GetDocByCliente.php';

var cliente;

//PREENCHE INFORMAÇÕES DO USUÁRIO LOGADO 
var appUsu = new Vue({
    el: '#appUsu',
    data () {
      return {
        info: null
      }
    },
    mounted () {
       axios
        .get(URL_USU_GET)
        .then(response => (this.info = response))
    }
  });

//PREENCHE A LISTA DE DOCS
var appDoc =  new Vue({
    el: '#appDebitos',
    data () {
      return {
        docs: null
      }
    },
    mounted () {
       axios
        .get(URL_GET_DEBITOS)
        .then(response => (this.docs = response))
    }
  });

$(document).ready(function(){

    setInterval(checkUsu(), 3000);

    fillDebito();

   //setFilterFeault();

    
    $.get(URL_GET_DOC_BY_CLI,{"id_cli":""},function(data){

      var json = JSON.parse(data);

     // $("#consultar").empty();
     $("#consultar").empty();
     $("#consultar").append("<option value=''>Todos</option>");


      var download;

      for(item in json){
        
        if(json[item].vencimento != null ){
          setDataOnFilter(getYearAndMouth(json[item].vencimento));
        }
        if(json[item].tipo == "Fatura" ){
      
          download = '<td><a class="cliente-content-link" href="'+json[item].arquivoPath+'" id="linkFatura" download><i class="far fa-file-alt" id="tdValor"></i><span class="pl-1">Fatura</span></a></td>';
        }

        if(json[item].tipo == "CTE"){
          download = '<td><a class="cliente-content-link" href="'+json[item].arquivoPath+'" id="linkCTE" download><i class="far fa-file-alt"></i><span class="pl-1">CTE-s</span></a></td>';

        }

        if(json[item].tipo == "2Via"){
          
          download = '<td><a class="cliente-content-link" href="'+json[item].arquivoPath+'" id="link2via" download> <i class="far fa-file-alt"></i><span class="pl-1">2º via</span></a></td>';

        }

        var dataTemp = new Date(json[item].vencimento);
        dataTemp.setDate(dataTemp.getDate()+1);
 
        var row = ' <tr><td id="tdVencimento">'+(json[item].vencimento == null ? "N/A":dataAtualFormatada(dataTemp) )+'</td><td id="tdStatus">'+(json[item].status == "0" ? "N/A" :json[item].status) +'</td><td id="tdValor">'+(json[item].valor == "" ? "N/A":json[item].valor )+'</td>'+download+'</tr>';
        $("#tBodyFaturas").append(row);
    
      }



 
    }).fail(function(){
        toastr.warning("Nenhuma fatura cadastrada!",SITE);
    });

    //carregaLista();

    $("#consultar").on("change",function(){
       carregaLista();

    });

   

});


//Logout
function logout(){
  $.get(URL_LOGOUT,function(){
    window.location = URL_HOME ;
 }).fail(function(){
     toastr.error("Erro ao deslogar!","Transportadora FG-360");
 });

  
}

function fillDebito(){
  $.post(URL_GET_DEBITOS, function(data){
   
    $("#tdVencimento").innerHtml = data[0].date_vencimento;
    $("#tdValor").innerHtml = "R$ "+data[0].valor;
    $("#linkFatura").href = data[0].fatura; 
    $("#linkCte").href = data[0].cte; 
    $("#link2via").href = data[0].boleto; 

  });
}

function checkUsu(){
    $.get(URL_CHECK_USU,function(){
       
    }).fail(function(){
        toastr.error("Usuário não autorizado!","Transportadora FG-360");
        window.location = URL_HOME ;
    });

}


function getYearAndMouth(date){

  var meses = ["JAN","FEV","MAR","ABR","MAI","JUN","JUL","AGO","SET","OUT","NOV","DEZ"];
  var dateOk = new Date(date);
  var finalMes , finalAno;

  //MES 
  var mes = dateOk.getMonth();
  finalMes = meses[mes]+"";

  //ANO
  var ano = dateOk.getFullYear();
  ano = ano +"";
  finalAno = ano.substring(2,4);

  return finalMes+"/"+finalAno

}

function carregaLista(){
  var filtro = $("#consultar").children("option:selected").text();

  if(filtro == "Todos"){
    getAllDocs();
    return ;
  }
  $("#tBodyFaturas").empty();
  /*$("#consultar").empty();
  $("#consultar").append("<option value=''>Todos</option>");*/

  $.get(URL_GET_DOC_BY_CLI,{"id_cli":""},function(data){

    var json = JSON.parse(data);

    
    for(item in json){
      
      if(json[item].vencimento != null && getYearAndMouth(json[item].vencimento) == filtro){

      
        if(json[item].tipo == "Fatura" ){

          download = '<td><a class="cliente-content-link" href="'+json[item].arquivoPath+'" id="linkFatura" download><i class="far fa-file-alt" id="tdValor"></i><span class="pl-1">Fatura</span></a></td>';
        }

        if(json[item].tipo == "CTE"){
          download = '<td><a class="cliente-content-link" href="'+json[item].arquivoPath+'" id="linkCTE" download><i class="far fa-file-alt"></i><span class="pl-1">CTE-s</span></a></td>';

        }

        if(json[item].tipo == "2Via"){
          
          download = '<td><a class="cliente-content-link" href="'+json[item].arquivoPath+'" id="link2via" download> <i class="far fa-file-alt"></i><span class="pl-1">2º via</span></a></td>';

        }

        var dataTemp = new Date(json[item].vencimento);
        dataTemp.setDate(dataTemp.getDate()+1);

        var row = ' <tr><td id="tdVencimento">'+(json[item].vencimento == null ? "N/A":dataAtualFormatada(dataTemp))+'</td><td id="tdStatus">'+(json[item].status == "0" ? "N/A" :json[item].status) +'</td><td id="tdValor">'+(json[item].valor == "" ? "N/A":json[item].valor)+'</td>'+download+'</tr>';
        $("#tBodyFaturas").append(row);
  
      }
    }
     
});
}

function dataAtualFormatada(data){
   var dia  = data.getDate().toString(),
   diaF = (dia.length == 1) ? '0'+dia : dia,
   mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
   mesF = (mes.length == 1) ? '0'+mes : mes,
   anoF = data.getFullYear();
   return diaF+"/"+mesF+"/"+anoF;
}




function getAllDocs(){
  $("#tBodyFaturas").empty();
  $("#consultar").empty();
  $("#consultar").append("<option value=''>Todos</option>");
  $.get(URL_GET_DOC_BY_CLI,{"id_cli":""},function(data){

    var json = JSON.parse(data);

    


    var download;

      for(item in json){
        
          if(json[item].vencimento != null ){
            setDataOnFilter(getYearAndMouth(json[item].vencimento));
          }
         
          if(json[item].tipo == "Fatura" ){
        
            download = '<td><a class="cliente-content-link" href="'+json[item].arquivoPath+'" id="linkFatura" download><i class="far fa-file-alt" id="tdValor"></i><span class="pl-1">Fatura</span></a></td>';
          }

          if(json[item].tipo == "CTE"){
            download = '<td><a class="cliente-content-link" href="'+json[item].arquivoPath+'" id="linkCTE" download><i class="far fa-file-alt"></i><span class="pl-1">CTE-s</span></a></td>';

          }

          if(json[item].tipo == "2Via"){
            
            download = '<td><a class="cliente-content-link" href="'+json[item].arquivoPath+'" id="link2via" download> <i class="far fa-file-alt"></i><span class="pl-1">2º via</span></a></td>';

          }

          var dataTemp = new Date(json[item].vencimento);
          dataTemp.setDate(dataTemp.getDate()+1);

          var row = ' <tr><td id="tdVencimento">'+(json[item].vencimento == null ? "N/A":dataAtualFormatada(dataTemp) )+'</td><td id="tdStatus">'+(json[item].status == "0" ? "N/A" :json[item].status) +'</td><td id="tdValor">'+(json[item].valor == "" ? "N/A":json[item].valor )+'</td>'+download+'</tr>';
          $("#tBodyFaturas").append(row);
      
      }
  });
}

function setDataOnFilter(data){

  var valid = true ;
  $("#consultar > option").each(function(){

    if($(this)[0].text == data){
      
      valid = false;
      return ;
    }
  });

  if(valid){
    $("#consultar").append("<option>"+data+"</option>");
  }
}

  


