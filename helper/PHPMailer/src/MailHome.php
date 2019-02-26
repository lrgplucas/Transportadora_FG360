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

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

require_once './PHPMailer.php';
require './SMTP.php';
require './Exception.php';




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
	
	<!--================ Banner FIM =================-->
	
	<!--================ CORPO Início =================-->
	<center style='position:relative;'>
	
		<h1 style='color:black;'>TEST</h1>
		
		<p style='color:black;'>Sua reserva foi cancelada</p>
		<p style='color:black;'>Seguem abaixo as informa&ccedil;&otilde;es detalhadas.</p>
	
	
	
	</center>
	
	
	
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


$nome = $_POST['nome'];
$email = $_POST['email'];
$obs = $_POST['obs'];

try{
	//Server settings
	//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'in-v3.mailjet.com';  					  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = '6885b1386296619ecf0295f1b5eefc3f';          // SMTP username
	$mail->Password = '6449208c639413de47dc582a892247a6';                    // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	//Recipients
	$mail->setFrom('j.albertino.neto@gmail.com', 'FG-360');
	$mail->addAddress($email, $nome);     // Add a recipient
	//Content
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = "SEM ASSUNTO";
	$mail->Body    = $obs;
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
