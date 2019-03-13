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

    //LISTENERS
    $("#spanLogout").click(function(){
        logout();
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
        toastr.error("Usuário nção autorizado!","Transportadora FG-360");
        window.location = URL_HOME ;
    });

}