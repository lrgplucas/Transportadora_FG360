<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mail
 *
 * @author joaoa
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once './PHPMailer.php';
require './SMTP.php';
require './Exception.php';

$email = $_GET["email"];
$name = $_GET["nome"];
$cafe = $_GET["cafe"] == 1 ? "incluso" : "n&atilde;o incluso";
$taxa = $_GET["taxa"] == 1 ? "incluso" : "n&atilde;o incluso";


//$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
$mail = new PHPMailer(null);  

$body = "
<!--================ Navbar Menu Fim =================-->
   <html lang='pt-br'>
  <head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='www.hostel78.com.br/node_modules/bootstrap/compiler/bootstrap.css'>
    <link rel='stylesheet' href='www.hostel78.com.br/node_modules/font-awesome/css/font-awesome.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css'>
    <!--<link rel='stylesheet' href='www.hostel78.com.br/style/css/style.css'>-->
	
	<style>
		.banner {
		  position: absolute;
		  margin: 0;
		  padding-top: 150px;
		  border: 0;
		  width: 100%;
		  height: 330px;
		 // background-image: url(www.hostel78.com.br/imgs/banner/banner_02.jpg);
		  background-size: 100%;
		  background-position: center;
		  background-repeat: no-repeat;
		  text-align: center;
		  
		}
	</style>

    <title>Hostel 78</title>
  </head>
  <body style='background-color:white;width:500px' >
    <header>
		<center>
			<img  src='www.hostel78.com.br/imgs/logoEmail.png'></img>
		</center>
    </header>
	<!--================ Banner Início =================-->
	<div style='position:relative' class='banner' >
		<img  style='width: 100%;height: 330px;' src='www.hostel78.com.br/imgs/banner/banner_02.jpg'></img>
	 </div>
	<!--================ Banner FIM =================-->
	
	<!--================ CORPO Início =================-->
	<center style='position:relative;'>
	
		<h1 style='color:black;'>CANCELAMENTO</h1>
		
		<p style='color:black;'>Sua reserva foi cancelada</p>
		<p style='color:black;'>Seguem abaixo as informa&ccedil;&otilde;es detalhadas.</p>
	
	
	
	</center>
	
	<div style='background-color:gainsboro;'>
		<div  style=''>
			<p style='color:black;font-weight:bold'>Detalhes da reserva</p>
			<p style='color:black;font-weight:bold'>Quarto ".$_GET['quarto']."</p>

			<span style='margin-left:70%;font-weight:bold' >R$ ".$_GET['preco'].",00</span>
			<span  style='margin-left:70%;font-weight:bold'>(por pessoa)</span>
			<br>
			<span style='color:black'>Caf&eacute; da manh&atilde; :".$cafe."</span>
			<br>
			<span style='color:black'>Taxa de Cancelamento :".$taxa."</span>
			<br>
			<span style='color:black'>Data de Entrada : ".$_GET['entrada']." checkin : 14h</span>
			<br>
			
			<span style='color:black'>Data de Sa&iacute;da : ".$_GET['saida']." checkout : 12h</span>
			<br>
			<span style='color:black'>H&oacute;spedes : ".$_GET['hosp']."</span>
			<br>
			<span style='color:black'>Email:".$_GET['email']."</span>
			<br>
			<span style='color:black'>Tel: ".$_GET['tel']."</span>
		</div>
		<hr style='color:black;background-color:black;'></hr>
		<span style='margin-left:70%;font-weight:bold' >Total:R$ ".$_GET['total']."</span>
		
		
	
	</div>
	
	<!--================ CORPO FIM =================-->
	
		
		<!--================ Footer Início =================-->
    <footer>
        
        <center>
			<p style='font-weight:bold;'>Para maiores informa&ccedil;&otilde;es</p>
			<p>contato@hostel78.com.br | (11) 2692-5322</p>
			<p> Rua Joaquim Nabuco ,78 Br&aacute;s - S&atilde;o Paulo - SP</p>
		
		</center>
        
    </footer>
    <!--================ Footer Fim =================-->
	
	
	
	
   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='www.hostel78.com.br/node_modules/jquery/dist/jquery.js'></script>
    <script src='www.hostel78.com.br/node_modules/popper.js/dist/umd/popper.js'></script>
    <script src='www.hostel78.com.br/node_modules/bootstrap/dist/js/bootstrap.js'></script>
    
  </body>
</html>";
try{
	//Server settings
	//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'email-ssl.com.br';  					  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'contato@hostel78.com.br';          // SMTP username
	$mail->Password = 'Hostel78@mail';                    // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	//Recipients
	$mail->setFrom('contato@hostel78.com.br', 'Hostel78');
	$mail->addAddress($email, $name);     // Add a recipient
	$emailCC = 'contato@hostel78.com.br'; 
  $mail->AddCC($emailCC);
	//Content
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = "CANCELAMENTO";
	$mail->Body    = "EMAIL TEST";
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	$mail->send();
	

	if($mail->isError()){
		echo "error";
	}
	echo "true";
}catch(\PHPMailer\PHPMailer\Exception $e){
	echo $e;
}
 

?>
