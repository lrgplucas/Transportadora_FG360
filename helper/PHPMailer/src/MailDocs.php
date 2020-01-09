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

require_once __DIR__.'/../../../controller/ClienteController.php'; //CONTROLLER
require_once __DIR__.'/../../../controller/EntregaController.php'; //CONTROLLER


$cliente =  $_POST['cliente'];
$result = ClienteController::getClienteById($cliente);
$email = $result->getEmail();
$nome = $result->getNome();
$cnpj = $result->getCnpj();
$cpf = $result->getCpf();
$senha = $result->getSenha();

$tipo = ($cnpj != "" || $cnpj != null) ? "CNPJ" : "CPF";
$doc = ($cnpj != "" || $cnpj != null) ? $cnpj : $cpf;



$body = "
<html lang='pt-br'>
<body class='email-marketing' style='width: 100%; max-width: 960px;margin: 0 auto;'>
 
    <section class='email-header'><div class='container'>
            <div class='row'>
                <div class='col-6'>
                    <img src='https://fg360transportes.com.br/imgs/logotipo.png' class='email-header-logo' alt='' style='max-width: 180px;' href='https://fg360transportes.com.br/'>
</div>
<div class='col-6 d-flex align-items-center' style='background-color: #fab432; color: #fff; font-size: .8rem; border-radius: 0; text-transform: uppercase; font-weight: 700;width:20%;'> 
                    <a href='https://fg360transportes.com.br/' class='btn btn-custom-email' style='text-decoration: none;display: inline-block; color:#fff;padding-left:16px'>Acessar sou cliente</a> </div> 
                </div>
            </div>
        </div>
    </section><section class='email-body-top mt-5'><div class='container'>
            <h1 class='email-body-top-title' style='color:#000;'>Ol&aacute;, <b>$nome</b> você tem um novo documento disponível para download.</h1>
            <p class='email-body-top-text' style='font-size: .8rem;color:#000;'>Agora voc&ecirc; pode baixá-lo ou consultá-lo diretamente em nosso site.</p>
        </div>
    </section><section class='email-login' style='
            padding: 25px 0;'><div class='container-fluid'>
            <p class='email-login-dados' style='font-size: .9rem;color:#000;'><b>$tipo:</b>$doc</p>
            <p class='email-login-dados' style='font-size: .9rem;color:#000;'><b>Senha:</b> $senha</p>
        </div>
    </section><section class='email-body-bottom mt-3 mb-3'><div class='container'>
            
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
    </section><footer class='footer' style='background-color:white; color: #fff; padding: 2rem;'>
    <ul style='margin:0; padding:0; list-style:none;flex-direction:row;justify-content:center;text-align: center;'>
            <li style='display:inline;'>
                <a style='text-decoration:none;background-color: transparent;' href='https://www.facebook.com/FG-360-Transportes-571421250024615/' class='footer-link'>
                    <span class='sr-only' style='color:white;'>Fa</span><img class='footer-img' src='https://fg360transportes.com.br/imgs/social/facebook_icon_black.png' alt='Facebook'></a>
            </li>
            <li style='display:inline;'>
                <a style='text-decoration:none;background-color: transparent;' href='https://www.instagram.com/fg360transportes' class='footer-link'>
                    <span class='sr-only' style='color:white;'>Inst</span>
                    <img class='footer-img' src='https://fg360transportes.com.br/imgs/social/instagram_icon_black.png' alt='Instagram'></a>
            </li>
        </ul></footer>
</body>
</html>";

$mail = new PHPMailer();  
try{
    //Server settings
   
    $mail->SMTPDebug = 2;  
    $mail->isSMTP();  
    $mail->Host = 'smtpout.secureserver.net';  				  
    $mail->SMTPAuth = true;                              
    $mail->Username = 'contato@fg360transportes.com.br';         
    $mail->Password = 'contato.30';                    
    $mail->SMTPSecure = 'tls';                            
    $mail->Port = 80;                                    
	$mail->setFrom('contato@fg360transportes.com.br', 'FG-360');
	$mail->addAddress($email);     
    $mail->Subject = "DOCUMENTO DISPONÍVEL PARA DOWNLOAD";
    $mail->AddCC('contato@fg360transportes.com.br');
    $mail->CharSet = 'UTF-8';
    $mail->IsHTML(true); 
    $mail->Body = $body;

    //ANEXO
    if(isset($_POST['anexo'])){
        $dir_files = "../../../";
        //$file = substr($_POST['anexo'],18,strlen($_POST['anexo']));
        $file = $_POST['anexo'];
        //$file_name = $_FILES['anexo']['name'];
        //$file_tmp = $_FILES['image']['tmp_name'];
        //move_uploaded_file($file_tmp,$dir_files."/".$file_name);
        $mail->AddAttachment($dir_files.$file);
        echo $_POST['anexo'];
    }

    $mail->send();
	

	if($mail->isError()){
		echo "error";
	}
	echo "true";
}catch(\PHPMailer\PHPMailer\Exception $e){
	echo $e;
}


function formatData($data){
    $result = date("d-m-Y", strtotime($data) );


    return $result;
}
 

?>
