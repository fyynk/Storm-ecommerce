<?php
session_start();


require_once 'config/cfg.php';

$id = $_GET['id'];
$user = new Usuario();
$cart = new Carrinho();
$lib = new Biblioteca();

$user->loadById($id);
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$mail->CharSet = "UTF-8";

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'SMTP.office365.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'prjstorm@hotmail.com';                     // SMTP username
    $mail->Password   = 'tccinfonet123';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('prjstorm@hotmail.com', 'Storm');
    $mail->addAddress($user->getEmail());     // Add a recipient
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    $mail->AddEmbeddedImage('images/favicon.png', 'logo');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('images/jogos/2.jpg', 'celeste.jpg');    // Optional name

    // Content

    $initBody = "<style type='text/css'>
            .teste {
                background-color: blue;
                width: 100%;
                height: 300px;
            }
        </style> 
        
        <div>
            <img src='cid:logo'></img>
            <p>Olá ".$user->getNome().", foi feita uma compra no site dos seguintes jogos:</p>
            ";
            $finalBody = "";
    $result = $cart->selectItemCart($id);
        foreach ($result as $key => $itens) {
            $initBody .= "Jogo: ". $itens['nm_jogo']. "<br>". "Valor: R$". number_format($itens['vl_jogo'], ',', '.') . "<br>";
        }
        $finalBody .= '</div>';
        $body = $initBody . $finalBody;

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Aqui é um teste html';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    $lib->insertLib($id);
    header('location: compraEfetuada.php?i='. $id);
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}