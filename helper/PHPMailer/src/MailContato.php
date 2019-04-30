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

$nome = "";
$doc = "";
$email = "";
$celular = "";
$tel = "";
$msg = "";


$assunto = $_POST['assunto'];
$area = $_POST['area'];

if($_POST['flag'] == 'fisica'){
	$nome =  $_POST['nome'];
	$doc =  $_POST['cpf'];
	$email =  $_POST['email'];
	$celular =  $_POST['celular'];
	$tel =  $_POST['tel'];
	$msg =  $_POST['msg'];
	 
}else{
	$nome =  $_POST['razaoSocial'];
	$doc =  $_POST['cnpj'];
	$email =  $_POST['email'];
	$celular =  $_POST['celular'];
	$tel =  $_POST['telComercial'];
	$msg =  $_POST['msg'];
}

$cidade = $_POST['cidade'];
$estado = $_POST['estado'];

$mail = new PHPMailer(null);  


$body = "<!doctype html>
  <head>
    <!-- Meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='author' content='lrgp'>
    <meta name='description' content='Transportadora FG 360: O destino certo para o seu produto'>
    <meta name='keywords' content='Transportadora, transporte, produtos, serviços'>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <!-- Font-Awesome-->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' integrity='sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr' crossorigin='anonymous'>
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet'>
    <!-- CSS -->
    <link rel='stylesheet' href='http://www.transportadora-gf360.000webhostapp.com/css/style.css'>
    <!-- TOASTR -->
    <link rel='stylesheet' href='./toastr/build/toastr.css'>

    <!-- CSS E-mail marketing -->
    <style>
        .email-marketing{
            max-width: 500px;
            margin: 0 auto;
        }

        .email-header .email-header-logo{
            max-width: 180px;
        }

        .email-header .btn-custom-email{
            background-color: #fab432;
            color: #fff;
            font-size: .8rem;
            border-radius: 0;
            text-transform: uppercase;
            font-weight: 700;
        }

        .email-body-top .email-body-top-title{
            font-size: .8rem;
        }

        .email-body-top .email-body-top-text{
            font-size: .8rem;
        }

        .email-login{
            background-color: #f7f7f7;
            padding: 25px 0;
        }

        .email-login .email-login-dados{
            font-size: .9rem;
        }

        .email-body-bottom .email-body-bottom-title{
            font-size: .8rem;
            text-align: center;
        }

        .email-body-bottom .email-body-bottom-text{
            font-size: .7rem;
            font-weight: 700;
            text-align: center;
            margin: 0;
        }

        .email-body-bottom .email-body-bottom-contato{
            font-size: .7rem;
            text-align: center;
            margin: 0;
        }
    </style>

    <title>FG360 - Email Cadastro</title>
  </head>
  <body class='email-marketing'>

    <section class='email-header'>
        <div class='container'>
            <div class='row'>
                <div class='col-6'>
                    <img src='http://transportadora-gf360.000webhostapp.com/imgs/logotipo.png' class='email-header-logo' alt=''>
                </div>
                <div class='col-6 d-flex align-items-center'>
                    <a href='http://transportadora-gf360.000webhostapp.com/' class='btn btn-custom-email'>Acessar sou cliente</a>
                </div>
            </div>
        </div>
    </section>


    <section class='email-login'>
        <div class='container-fluid'>
            <p class='email-login-dados'><b>&Aacute;rea:</b> ".$area."</p>
			<p class='email-login-dados'><b>MENSAGEM:</b> ".$msg."</p>
            <p class='email-login-dados'><b>NOME:</b> ".$nome."</p>
			<p class='email-login-dados'><b>EMAIL:</b>".$email."</p>
            <p class='email-login-dados'><b>TELEFONE:</b>".$tel."</p>
            <p class='email-login-dados'><b>CELULAR:</b>".$celular."</p>
            <p class='email-login-dados'><b>CIDADE:</b>".$cidade."</p>
            <p class='email-login-dados'><b>ESTADO:</b>".$estado."</p>
        </div>
    </section>

    <section class='email-body-bottom mt-3 mb-3'>
        <div class='container'>
            <h2 class='email-body-bottom-title mb-3'>Clique no bot&atildeo 'Acessar sou cliente para ser direcionado para nosso site</h2>
            <p class='email-body-bottom-text'>Ficou alguma d&uacutevida?</p>
            <p class='email-body-bottom-contato'>Entre em contato: contato@fg360transportes.com.br</p>
            <p class='email-body-bottom-contato'>(12) 3655-3099 ou (12) 9 8275-0506</p>
        </div>
    </section>

    <footer class='footer'>
        <ul>
            <li>
                <a href='https://www.facebook.com/FG-360-Transportes-571421250024615/' class='footer-link'>
                    <span class='sr-only'>Facebook</span>
                    <img class='footer-img' src='http://transportadora-gf360.000webhostapp.com/imgs/social/facebook_icon.png' alt='Facebook'>
                </a>
            </li>
            <li>
                <a href='https://www.instagram.com/fg360transportes' class='footer-link'>
                    <span class='sr-only'>Instagram</span>
                    <img class='footer-img' src='http://transportadora-gf360.000webhostapp.com/imgs/social/instagram_icon.png' alt='Instagram'>
                </a>
            </li>
        </ul>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>-->
    <script src='./js/dist/jquery-3.3.1.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
    <script src='./toastr/toastr.js'></script>
    <script src='js/home.js'></script>
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
	$mail->Port = 80;                                    // TCP port to connect to
                                // TCP port to connect to

	//Recipients
	$mail->setFrom('contato@fg360transportes.com.br', 'FG-360');
	$mail->addAddress($email, $nome);     // Add a recipient
	//Content
                                    // Set email format to HTML
    $emailCC = 'contato@fg360transportes.com.br'; 
    $mail->AddCC($emailCC);
    $mail->Subject = $assunto." - ".$area;
    $mail->CharSet = 'UTF-8';
    $mail->IsHTML(true); 
    $mail->Body  = "<html><body style='max-width: 500px; margin: 0 auto;'> <section style='max-width: 180px;'> <div class='container'> <div class='row'><div class='col-6 d-flex align-items-center' style='background-color: #fab432; color: #fff; font-size: .8rem; border-radius: 0; text-transform: uppercase; font-weight: 700;float:right'> <a href='https://fg360transportes.com.br/' class='btn btn-custom-email' style='    text-decoration: none;    display: inline-block; color:#fff'>Acessar sou cliente</a> </div>  <div class='col-6'> <img src='https://fg360transportes.com.br/imgs/logotipo.png' class='email-header-logo' alt=''> </div> </div> </div> </section> <section style='background-color:#d1d1d1; padding:10px 50px;'> <div class='container-fluid' style='background-color:gainsboro; padding:2px'> <p class='email-login-dados'><b>MENSAGEM:</b> ".$msg."</p> <p class='email-login-dados'><b>NOME:</b> ".$nome."</p> <p class='email-login-dados'><b>EMAIL:</b>".$email."</p> <p class='email-login-dados'><b>TELEFONE:</b>".$tel."</p>  
        <p class='email-login-dados'><b>CELULAR:</b>".$celular."</p>
            <p class='email-login-dados'><b>CIDADE:</b>".$cidade."</p>
            <p class='email-login-dados'><b>ESTADO:</b>".$estado."</p></div> </section> <section class='email-body-bottom mt-3 mb-3'><div class='container'> <h2 class='email-body-bottom-title mb-3' style='font-size: .8rem;text-align: center;'>Clique no bot&atilde;o Acessar sou cliente para ser direcionado para nosso site</h2> <center><p class='email-body-bottom-text'>Ficou alguma d&uacute;vida?</p> <p class='email-body-bottom-contato'>Entre em contato: contato@fg360transportes.com.br</p> <p class='email-body-bottom-contato'>(12) 3655-3099 ou (12) 9 8275-0506</p> </center></div> </section>".
            " <footer style='background-color:#000; color: #fff; padding: 2rem;'><ul style='padding:0; list-style:none;  flex-direction:row;justify-content:center;background-color:#000;text-align: center;'> <li style='display:inline;'>".
            "<span class='sr-only' style='color:#000;'>Fa</span><a href='https://www.facebook.com/FG-360-Transportes-571421250024615/' class='footer-link'><img class='footer-img' style='width:auto;height:auto;' src='https://fg360transportes.com.br/imgs/social/facebook_icon.png' alt=''></a> </li> <li style='display:inline;'><span class='sr-only' style='color:#000;'>Instagram</span><a href='https://www.instagram.com/fg360transportes' class='footer-link'><img style='width:auto;height:auto;' class='footer-img' src='https://fg360transportes.com.br/imgs/social/instagram_icon.png' alt=''></a></li></ul></footer></body> </html>";
	$mail->send();
	

	if($mail->isError()){
		echo "error";
	}
	echo "true";
}catch(\PHPMailer\PHPMailer\Exception $e){
	echo $e;
}
 

?>
