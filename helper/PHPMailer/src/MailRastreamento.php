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

//GETTING EMAIL FROM CLIENT

$result = ClienteController::getClienteById($cliente);
$email = $result->getEmail();

$id = $_POST['id'];//
$entrega = EntregaController::getAllEntregaByCodRastreio($id);
var_dump($entrega);
if(isset($_POST['produto'])){
    $produto = $_POST['produto'];//
}else{
    $produto = $entrega[0]->getProduto();//
}

if(isset($_POST['tipo'])){
    $tipo = $_POST['tipo'];//
}else{
    $tipo = $entrega[0]->getTipo_carga();//
}


$previsao = $_POST['previsao'];//
$motorista = $_POST['motorista'];//
$veiculo = $_POST['veiculo'];//
$status = $_POST['status'];//

//$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
$mail = new PHPMailer(null);  
$msgEntrega = "";
$colorTransporte = "grey";
$colorPendente = "orange";
$colorEntregue = "grey";
$lineColor= "e1e1e1";
$colorPendenteText = "e1e1e1";
$colorTransporteText = "e1e1e1";
$colorEntregueText = "e1e1e1"; 


if($status == "Em Transporte"){
    $msgEntrega = "Ol&aacute;, <b>".$result->getNome()."</b> seu produto <b>est&aacute; em Transporte</b>!";
    $colorTransporte = "orange";
    $colorTransporteText = "000";
}else if($status == "Pendente"){
    $msgEntrega = "Ol&aacute;, <b>".$result->getNome()."</b> seu produto <b>est&aacute; Pendente</b>!";
    $colorPendente = "orange";
    $colorPendenteText = "000";
}else{
    $msgEntrega = "Ol&aacute;, <b>".$result->getNome()."</b> seu produto <b>foi entregue</b>!";
    $colorTransporte = "orange";
    $colorEntregue = "orange";
    $lineColor= "fab432";
    $colorEntregueText = "000";
}


$body = "<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.0 Transitional//EN' 'http://www.w3.org/TR/REC-html40/loose.dtd'>
<html lang='pt-br'>
<head>
<!-- Meta tags --><meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
<meta name='author' content='lrgp'>
<meta name='description' content='Transportadora FG 360: O destino certo para o seu produto'>
<meta name='keywords' content='Transportadora, transporte, produtos, servi&ccedil;os'>
<!-- Bootstrap CSS --><link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
<!-- Font-Awesome--><link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' integrity='sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr' crossorigin='anonymous'>
<!-- Google Fonts --><link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet'>
<!-- CSS --><link rel='stylesheet' href='css/style.css'>
<!-- TOASTR --><title>FG360 - Email Rastreio</title>
</head>
<body class='email-marketing' style='max-width: 500px;
            margin: 0 auto;'>
  
    <section class='email-header'><div class='container'>
            <div class='row'>
                <div class='col-6'>
                    <img src='http://transportadora-gf360.000webhostapp.com/imgs/logotipo.png' class='email-header-logo' alt='' style='max-width: 180px;' href='https://fg360transportes.com.br/'>
</div>
                <div class='col-6 d-flex align-items-center'>
                    <a href='#' class='btn btn-custom-email' style='background-color: #fab432;
            color: #fff;
            font-size: .8rem;
            border-radius: 0;
            text-transform: uppercase;
            font-weight: 700;'>Acompanhar produto</a>
                </div>
            </div>
        </div>
    </section><section class='email-body-top mt-5'><div class='container'>
            <h1 class='email-body-top-title' style='font-size: .8rem;
            text-align: center;'>".$msgEntrega."</h1>
        </div>
    </section><section class='email-status-rastreio mt-3'><div class='container-fluid'>
            <div class='row email-status-dados' style='background-color: #d1d1d1;
            padding: 10px 50px;'>
                <div class='col-6 d-flex align-items-end flex-column'>
                    <p class='email-status-dados-produto ' style='font-size: .7rem;
            margin: 0;'><b>Produto:</b>".$produto."</p>
                    <p class='email-status-dados-produto' style='font-size: .7rem;
            margin: 0;'><b>ID:</b> ".$id."</p>
                    <p class='email-status-dados-produto' style='font-size: .7rem;
            margin: 0;'><b>".$tipo."</b> Direta</p>
                </div>
                <div class='col-6'>
                    <p class='email-status-dados-produto' style='font-size: .7rem;
            margin: 0;'><b>Previs&atilde;o de entrega:</b>".$previsao."</p>
                    <p class='email-status-dados-produto' style='font-size: .7rem;
            margin: 0;'><b>Motorista:</b> ".$motorista."</p>
                    <p class='email-status-dados-produto' style='font-size: .7rem;
            margin: 0;'><b>Ve&iacute;culo:</b> ".$veiculo."</p>
                </div>
            </div>
            <div class='row email-status-status' style='background-color: #f7f7f7;'>
                    <div class='col-12 d-flex flex-column align-items-center justify-content-center pt-3'>
                        <div class='row d-inline-block'>
                            <div class='col-12'>
                                <img src='http://transportadora-gf360.000webhostapp.com/imgs/rastreamento/recebido_".$colorPendente.".png' class='email-status-img' alt='' style='height: 50px;
            width: 50px;
            display: inline-block;'><div class='email-status-line-checked' style='width: 100px;
            border: 2px solid #fab432;
            margin-left: -4px;
            margin-right: -20px;
            display: inline-block;'></div>
                                <img src='http://transportadora-gf360.000webhostapp.com/imgs/rastreamento/transporte_".$colorTransporte.".png' class='email-status-img' alt='' style='height: 50px;
            width: 50px;
            display: inline-block;'><div class='email-status-line' style='width: 100px;
            border: 2px solid #".$lineColor.";
            margin-left: -4px;
            margin-right: -20px;
            display: inline-block;'></div>
                                <img src='http://transportadora-gf360.000webhostapp.com/imgs/rastreamento/entregue_".$colorEntregue.".png' class='email-status-img' alt='' style='height: 50px;
            width: 50px;
            display: inline-block;'>
</div>
                        </div>
                        <div class='row pt-3'>
                            <div class='col-4'>
                                <p class='email-status-text-checked' style='word-wrap: normal;
            font-size: .9rem;
            color: #".$colorPendenteText.";'>Produto recebido</p>
                            </div>
                            <div class='col-4'>
                                <p class='email-status-text-check text-center' style='font-size: .9rem;
            color: #".$colorTransporteText.";
            margin: 0;'>Em transporte</p>
                            </div>
                            <div class='col-4'>
                                <p class='email-status-text-check text-right' style='font-size: .9rem;
            color: #".$colorEntregueText.";
            margin: 0;'>Entregue</p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
 
    </section><section class='email-body-bottom mt-3 mb-3'><div class='container'>
            <p class='email-body-bottom-text' style='font-size: .7rem;
            font-weight: 700;
            text-align: center;
            margin: 0;'>Ficou alguma d&uacute;vida?</p>
            <p class='email-body-bottom-contato' style='font-size: .7rem;
            text-align: center;
            margin: 0;'>Entre em contato: contato@fg360transportes.com.br</p>
            <p class='email-body-bottom-contato' style='font-size: .7rem;
            text-align: center;
            margin: 0;'>(12) 3655-3099 ou (12) 9 8275-0506</p>
        </div>
    </section><footer class='footer'  style='background-color:#000; color: #fff; padding: 2rem;'><ul style='margin:0; padding:0; list-style:none; display:flex; flex-direction:row;justify-content:center;background-color:#000;margin-right:15'>
<li>
                <a href='https://www.facebook.com/FG-360-Transportes-571421250024615/' class='footer-link'>
                    <span class='sr-only'>Facebook</span>
                    <img class='footer-img' src='http://transportadora-gf360.000webhostapp.com/imgs/social/facebook_icon.png' alt='Facebook'></a>
            </li>
            <li>
                <a href='https://www.instagram.com/fg360transportes' class='footer-link'>
                    <span class='sr-only'>Instagram</span>
                    <img class='footer-img' src='http://transportadora-gf360.000webhostapp.com/imgs/social/instagram_icon.png' alt='Instagram'></a>
            </li>
        </ul></footer>
</body>
</html>
";

try{
	//Server settings
    $mail->SMTPDebug = 2;  
    $mail->isSMTP();  
    $mail->Host = 'smtpout.secureserver.net';  				  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'camila.feelix@fg360transportes.com.br';          // SMTP username
    $mail->Password = 'log.30.camila';                    // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 80;                                    // TCP port to connect to

	//Recipients
	$mail->setFrom('camila.feelix@fg360transportes.com.br', 'FG-360');
	$mail->addAddress($email);     // Add a recipient
	//Content
	                                // Set email format to HTML
    $mail->Subject = "Rastreio";
    $mail->AddCC('camila.feelix@fg360transportes.com.br');
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
