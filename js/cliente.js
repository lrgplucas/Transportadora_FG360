/*
* author : joao
* data : 11/03/2019
* classe : CLIENTE JS
*/
const URL_USU_GET = "./api/cliente/GetClienteByMail.php";


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

   // getUsuario();
    //LISTENERS




    

});

//RESPONSÁVEL POR TRAZER O USUÁRIO NA PARTE SUPERIOR DA TELA
function getUsuario(){

    $.get(URL_USU_GET,function(data){
        alert(data);
    });

}