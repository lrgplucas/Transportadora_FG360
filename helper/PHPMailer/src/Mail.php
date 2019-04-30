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

require_once './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';

  
class Mail {
    
    
    
    static function send ( $body , $tel , $cel ,$subject , $email ,$name,$assunto ){

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
                        // background-image: url('cid:img');
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
                    
                      
                        
                        <p style='color:black;'>".$body."</p>
                        <p style='color:black;'>Nome: ".$name."</p>
                        <p style='color:black;'>Telefone: ".$tel."</p>
                        <p style='color:black;'>Email: ".$email."</p>
                      
                    
                        <footer>
                 
                            <p style='font-weight:bold;'>Para maiores informa&ccedil;&otilde;es</p>
                            <p>contato@hostel78.com.br | (11) 2692-5322</p>
                        
                     
                        
                    </footer>
                    
                    
                    </center>            
                    </div>
                    
                    <!--================ CORPO FIM =================-->
                    
                        
                        <!--================ Footer Início =================-->
                   
                    <!--================ Footer Fim =================-->

                    <!-- Optional JavaScript -->
                    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                    <script src='www.hostel78.com.br/node_modules/jquery/dist/jquery.js'></script>
                    <script src='www.hostel78.com.br/node_modules/popper.js/dist/umd/popper.js'></script>
                    <script src='www.hostel78.com.br/node_modules/bootstrap/dist/js/bootstrap.js'></script>
                    
                </body>
                </html>";
        //$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
         $mail = new PHPMailer(null);  
        try{
            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'email-ssl.com.br';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'contato@hostel78.com.br';                 // SMTP username
            $mail->Password = 'Hostel78@mail';                           // SMTP password
           // $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->AddCC($email);
            //Recipients
            $mail->setFrom('contato@hostel78.com.br', 'Hostel78');
            $mail->addAddress('contato@hostel78.com.br', $name);     // Add a recipient
            
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $assunto." - Hostel78";
            $mail->Body    = $body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            
            if($mail->isError()){
                return false;
            }
            return true;
        }catch(\PHPMailer\PHPMailer\Exception $e){
            return false;
        }
    }
    
    
    
    
}

?>
