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


$origem = $_POST["origem"];
$destino = $_POST["destino"];
$km = $_POST["km"];
$peso = $_POST["peso"];
$quantidade = $_POST["quantidade"];
$tipo = $_POST["tipoMaterial"];
$nome = $_POST["nomeSolicitante"];
$telefone = $_POST["telefone"];
$email = $_POST["email"];
$pallet = $_POST['pallet'];
$tipoVeiculo = $_POST['tipoVeiculo'];
$obs = $_POST['obs'];

$statusPallet;
if($pallet == "Sim"){
    $statusPallet = "Sim";
}else{
    $statusPallet = "N&atilde;o";
}



$body = "
<html lang='pt-br'>

<style>

#li_footer{margin-left:20%'}
@media only screen and (max-width: 500px) {
    #li_footer{
        margin-left:15%;
    }
</style>

<body class='email-marketing' style='width: 100%; max-width: 960px;margin: 0 auto;'>
<section class='email-header'>
<div class='container'>
    <div class='row'>
        <div class='col-6'>
            <img src='https://fg360transportes.com.br/imgs/logotipo.png' class='email-header-logo' alt='' style='max-width: 180px;' href='https://fg360transportes.com.br/'>
        </div>
        <br/>
        <div class='col-6 d-flex align-items-center' style='background-color: #fab432; color: #fff; font-size: .8rem; border-radius: 0; text-transform: uppercase; font-weight: 700;width:20%;'> 
             <a href='https://fg360transportes.com.br/' class='btn btn-custom-email' style='    text-decoration: none;    display: inline-block; color:#fff;padding-left:16px'>Acessar sou cliente</a> 
        </div>
    </div>
</div>
</section>
 
    
    <section class='email-body-top mt-5'><div class='container'>
            <h1 class='email-body-top-title' style='color:black;'>Ol&aacute;, <b>$nome</b> sua cota&ccedil;&atilde;o foi cadastrada em nosso site.</h1>
            
        </div>
    </section><section class='email-login' style='padding: 25px 0;color:black;'><div class='container-fluid'>
            <p class='email-login-dados' style='font-size: .9rem;color:black;'><b>Origem:</b>$origem</p>
            <p class='email-login-dados' style='font-size: .9rem;color:black;'><b>Destino:</b>$destino</p>
            <p class='email-login-dados' style='font-size: .9rem;color:black;'><b>Km:</b>$km</p>
            <p class='email-login-dados' style='font-size: .9rem;color:black;'><b>Peso:</b>$peso</p>
            <p class='email-login-dados' style='font-size: .9rem;color:black;'><b>Quantidade:</b>$quantidade</p>
            <p class='email-login-dados' style='font-size: .9rem;color:black;'><b>Tipo:</b>$tipo</p>
            <p class='email-login-dados' style='font-size: .9rem;color:black;'><b>Pallet:</b>$statusPallet</p>
            <p class='email-login-dados' style='font-size: .9rem;color:black;'><b>Tipo de Veiculo:</b>$tipoVeiculo</p>
            <p class='email-login-dados' style='font-size: .9rem;color:black;'><b>Telefone:</b>$telefone</p>
            <p class='email-login-dados' style='font-size: .9rem;color:black;'><b>Email:</b>$email</p>
            <p class='email-login-dados' style='font-size: .9rem;color:black;'><b>Observa&ccedil;&atilde;o:</b>$obs</p>
         
        </div>
    </section><section class='email-body-bottom mt-3 mb-3'><div class='container'>
            
            <p class='email-body-bottom-text' style='font-size: .7rem;
            font-weight: 700;
            text-align: center;
            margin: 0;color:black;'>Ficou alguma d&uacute;vida?</p>
            <p class='email-body-bottom-contato' style='font-size: .7rem;
            text-align: center;
            margin: 0; color:black;'>Entre em contato: contato@fg360transportes.com.br</p>
            <p class='email-body-bottom-contato' style='font-size: .7rem;
            text-align: center;margin: 0;color:black;'>(12) 3655-3099 ou (12) 9 8275-0506</p>
        </div>
    </section> <footer class='footer'  style='background-color:white; color: #fff; padding: 2rem;'>
    <center>
    <ul style='padding:0; list-style:none;  flex-direction:row;justify-content:center;background-color:white;text-align: center;  '>
       
    <li style='display:inline;'>
            <a style='text-decoration:none;background-color: transparent;' href='https://www.facebook.com/FG-360-Transportes-571421250024615/' class='footer-link'>
                <span class='sr-only' style='color:white;'>Fa</span>
                <img class='footer-img' src='https://fg360transportes.com.br/imgs/social/facebook_icon_black.png' alt='Facebook'></a>
        </li>
        <li style='display:inline;'>
            <a style='text-decoration:none;background-color: transparent;' href='https://www.instagram.com/fg360transportes' class='footer-link'>
                <span class='sr-only' style='color:white;'>Instagram</span>
                <img class='footer-img' src='https://fg360transportes.com.br/imgs/social/instagram_icon_black.png' alt='Instagram'></a>
        </li>
    </ul>
    </center>
</footer>
</body>
</html>";

try{
	//Server settings
    //$mail->SMTPDebug = 2;  
                                   // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtpout.secureserver.net';  				  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'contato@fg360transportes.com.br';          // SMTP username
	$mail->Password = 'contato.30';                    // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 80;                                 // TCP port to connect to

	//Recipients
	$mail->setFrom('contato@fg360transportes.com.br', 'FG-360');
	$mail->addAddress($email);     // Add a recipient
	//Content
                                    // Set email format to HTML
    $mail->AddCC('contato@fg360transportes.com.br');
    $mail->Subject = "Cotação Cliente";
    $mail->CharSet = 'UTF-8';
    $mail->IsHTML(true); 
    $mail->Body = $body;
    $mail->send();
	

	if($mail->isError()){
		echo "error";
	}
	echo "true";
}catch(\PHPMailer\PHPMailer\Exception $e){
	echo $e;
}
 

?>
