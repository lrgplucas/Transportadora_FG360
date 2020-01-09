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

$id = $_POST['id'];//
$entrega = EntregaController::getAllEntregaByCodRastreio($id);

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


$previsao = formatData($_POST['previsao']);//
$motorista = $_POST['motorista'];//
$veiculo = $_POST['veiculo'];//
$status = $_POST['status'];//
$cod = $_POST['codRastreio'];
$isOrigemDestino = false;
$origem = "";
$destino = "";

if(isset($_POST['origem']) && isset( $_POST['destino'])){
    $origem = $_POST['origem'];
    $destino = $_POST['destino'];
    $isOrigemDestino = true;
}else{
    $origem = $entrega[0]->getOrigem();
    $destino = $entrega[0]->getDestino();
    $isOrigemDestino = true;
}


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
    $img = "mail_transporte.png";
}else if($status == "Pendente"){
    $msgEntrega = "Ol&aacute;, <b>".$result->getNome()."</b> seu produto <b>foi Recebido</b>!";
    $colorPendenteText = "000";
    $img = "mail_recebido.png";
}else{
    $msgEntrega = "Ol&aacute;, <b>".$result->getNome()."</b> seu produto <b>foi entregue</b>!";
    $colorTransporte = "orange";
    $colorEntregue = "orange";
    $lineColor= "fab432";
    $colorEntregueText = "000";
    $img = "mail_entregue.png";
}




$body = "<html lang='pt-br'>
<body class='email-marketing' style='width: 100%; max-width: 960px;margin: 0 auto;'>
  
    <section class='email-header'><div class='container'>
            <div class='row'>
                <div class='col-6'>
                    <img src='https://fg360transportes.com.br/imgs/logotipo.png' class='email-header-logo' alt='' style='max-width: 180px;' href='https://fg360transportes.com.br/'>
</div>
                <div class='col-6 d-flex align-items-center'  style='background-color: #fab432; color: #fff; font-size: .8rem; border-radius: 0; text-transform: uppercase; font-weight: 700;width:20%;'>
                <a href='https://fg360transportes.com.br/status.html?cod=$cod' class='btn btn-custom-email' style='    text-decoration: none;    display: inline-block; color:#fff;padding-left:16px'>Acompanhar produto</a>
                </div>
            </div>
        </div>
    </section><section class='email-body-top mt-5'><div class='container'>
            <h1 class='email-body-top-title' style='
            text-align: center;color:#000'>".$msgEntrega."</h1>
        </div>
    </section><section class='email-status-rastreio mt-3'><div class='container-fluid'>
            <div class='row email-status-dados' style='padding: 10px 50px;'>
                <div class='col-6 d-flex align-items-end flex-column'>
                    <p class='email-status-dados-produto ' style='font-size: .7rem;
            margin: 0;color:#000;' ><b>Produto:</b>".$produto."</p>
                    <p class='email-status-dados-produto' style='font-size: .7rem;
            margin: 0;color:#000;'><b>ID:</b> ".$id."</p>
                    <p class='email-status-dados-produto' style='font-size: .7rem;
            margin: 0;color:#000;'><b>".$tipo."</b> </p>
                </div>
                <div class='col-6'>
                    <p class='email-status-dados-produto' style='font-size: .7rem;
            margin: 0;color:#000;'><b>Previs&atilde;o de entrega:</b>".$previsao."</p>
                    <p class='email-status-dados-produto' style='font-size: .7rem;
            margin: 0;color:#000;'><b>Motorista:</b> ".$motorista."</p>
                    <p class='email-status-dados-produto' style='font-size: .7rem;
            margin: 0;color:#000;'><b>Ve&iacute;culo:</b> ".$veiculo."</p>
            <p class='email-status-dados-produto' style='font-size: .7rem;
            margin: 0;color:#000;'><b>Origem:</b> $origem </p>
                    <p class='email-status-dados-produto' style='font-size: .7rem;
            margin: 0;color:#000;'><b>Destino:</b> $destino</p>
                </div>
            </div>
            <div class='row email-status-status' style='background-color: #f7f7f7; '>
                    <div class='col-12 d-flex flex-column align-items-center justify-content-center pt-3' style='margin-left:17%'>
                    <img class='footer-img' src='https://fg360transportes.com.br/imgs/email_imgs/$img' style='100%'>
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
    </section>
    <footer class='footer'  style='background-color: white;color: #fff; padding: 2rem; '>
        <ul style='padding:0; list-style:none; flex-direction:row;justify-content:center;text-align: center; '>
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
    </footer>
</body>
</html>
";

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
    $mail->Subject = "ACOMPANHE SEU PRODUTO";
    $mail->AddCC('contato@fg360transportes.com.br');
    $mail->CharSet = 'UTF-8';
    $mail->IsHTML(true); 
    $mail->Body = $body;

    //ANEXO
    if(isset($_POST['anexo'])){
        $dir_files = "../../../docs_term_entrega/";
        $file = substr($_POST['anexo'],18,strlen($_POST['anexo']));
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
