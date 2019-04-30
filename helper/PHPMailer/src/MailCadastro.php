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

$email =  $_POST['email'];

//$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
$mail = new PHPMailer(null);  


$nome = $_POST["nome"];
$senha = $_POST["senha"];
$doc = $_POST["doc"];
$juridica = $_POST["juridica"];



$tipo = ($juridica == "true") ? "CNPJ" : "CPF";



$body = "
<html lang='pt-br'>
<body class='email-marketing' style='width: 100%; max-width: 960px;margin: 0 auto;'>
 
    <section class='email-header'><div class='container'>
            <div class='row'>
                <div class='col-6'>
                    <img src='https://fg360transportes.com.br/imgs/logotipo.png' class='email-header-logo' alt='' style='max-width: 180px;' href='https://fg360transportes.com.br/'>
</div>
<div class='col-6 d-flex align-items-center' style='background-color: #fab432; color: #fff; font-size: .8rem; border-radius: 0; text-transform: uppercase; font-weight: 700;width:50%;'> 
                    <a href='https://fg360transportes.com.br/' class='btn btn-custom-email' style='text-decoration: none;display: inline-block; color:#fff;padding-left:16px'>Acessar sou cliente</a> </div> 
                </div>
            </div>
        </div>
    </section><section class='email-body-top mt-5'><div class='container'>
            <h1 class='email-body-top-title' style='font-size: .8rem;color:#000;'>Ol&aacute;, <b>$nome</b> sua empresa foi cadastrada em nosso site.</h1>
            <p class='email-body-top-text' style='font-size: .8rem;color:#000;'>Agora voc&ecirc; pode acessar suas faturas, CTE's e solicitar segunda via de boletos.</p>
        </div>
    </section><section class='email-login' style='background-color: #f7f7f7;
            padding: 25px 0;'><div class='container-fluid'>
            <p class='email-login-dados' style='font-size: .9rem;color:#000;'><b>$tipo:</b>$doc</p>
            <p class='email-login-dados' style='font-size: .9rem;color:#000;'><b>Senha:</b> $senha</p>
        </div>
    </section><section class='email-body-bottom mt-3 mb-3'><div class='container'>
            <h2 class='email-body-bottom-title mb-3' style='font-size: .8rem;
            text-align: center;color:#000;'>Clique no bot&atilde;o 'Acessar sou cliente' para ser direcionado para nosso site</h2>
            <p class='email-body-bottom-text' style='font-size: .7rem;
            font-weight: 700;
            text-align: center;
            margin: 0;color:#000;'>Ficou alguma d&uacute;vida?</p>
            <p class='email-body-bottom-contato' style='font-size: .7rem;
            text-align: center;
            margin: 0;color:#000;'>Entre em contato: contato@fg360transportes.com.br</p>
            <p class='email-body-bottom-contato' style='font-size: .7rem;
            text-align: center;
            margin: 0;color:#000;'>(12) 3655-3099 ou (12) 9 8275-0506</p>
        </div>
    </section><footer class='footer' style='background-color:#000; color: #fff; padding: 2rem;'>
    <ul style='margin:0; padding:0; list-style:none;flex-direction:row;justify-content:center;background-color:#000;text-align: center;'>
            <li style='display:inline;'>
                <a style='text-decoration:none;background-color: transparent;' href='https://www.facebook.com/FG-360-Transportes-571421250024615/' class='footer-link'>
                    <span class='sr-only' style='color:#000;'>Fa</span><img class='footer-img' src='https://fg360transportes.com.br/imgs/social/facebook_icon.png' alt='Facebook'></a>
            </li>
            <li style='display:inline;'>
                <a style='text-decoration:none;background-color: transparent;' href='https://www.instagram.com/fg360transportes' class='footer-link'>
                    <span class='sr-only' style='color:#000;'>Inst</span>
                    <img class='footer-img' src='https://fg360transportes.com.br/imgs/social/instagram_icon.png' alt='Instagram'></a>
            </li>
        </ul></footer>
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
    $mail->Port = 80;                                // TCP port to connect to
                          // TCP port to connect to

	//Recipients
	$mail->setFrom('contato@fg360transportes.com.br', 'FG-360');
	$mail->addAddress($email);     // Add a recipient
	//Content
                                    // Set email format to HTML
    $mail->AddCC('contato@fg360transportes.com.br');
    $mail->Subject = "Cadastro Cliente";
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
