/*
* author : joao
* data : 11/03/2019
* classe : CLIENTE JS
*/
const URL_USU_GET = "./api/cliente/GetClienteByMail.php";
const URL_LOGOUT = "./api/cliente/Logout.php";
const URL_CHECK_USU = "./api/cliente/checkUsu.php";
const URL_HOME = "index.html";

//PREENCHE INFORMAÇÕES DO USUÁRIO LOGADO 
new Vue({
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
  })

$(document).ready(function(){

    setInterval(checkUsu(), 3000);

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

function checkUsu(){
    $.get(URL_CHECK_USU,function(){
       
    }).fail(function(){
        toastr.error("Usuário nção autorizado!","Transportadora FG-360");
        window.location = URL_HOME ;
    });

}