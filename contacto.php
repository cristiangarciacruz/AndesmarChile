<?php
header('Content-Type: text/html; charset=UTF-8');
require_once ('libs/php-mailer/class.phpmailer.php');
require_once ('libs/php-mailer/class.pop3.php');
require_once ('libs/php-mailer/class.smtp.php');

error_reporting(0);

if (isset($_POST)) {
	$mensaje = '<strong>Nombre y Apellido:</strong> '.$_POST['nombre'].', '.$_POST['apellido'].'<br>';
	$mensaje .= '<strong>Email:</strong> '.$_POST['email'].'<br> <strong>Pais:</strong> '.$_POST['pais'].'<br>';
	$mensaje .= '<strong>Teléfono:</strong> '.$_POST['telefono'].' <br><strong>Celular:</strong> '.$_POST['celular'].'<br>';
	$mensaje .= '<strong>Motivo:</strong> '.$_POST['motivo'].'<br>';
	$mensaje .= '<p>'.$_POST['mensaje'].'</p>';

	$mail = new PHPMailer(true);

	/*$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';

	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; //587;
	$mail->SMTPSecure = 'ssl'; //'tls';
	$mail->SMTPAuth = true;

	$mail->Username = 'ticketonlinecomar@gmail.com';
	$mail->Password = 'MiradaVacuna';*/

	$mail->setFrom($_POST['email'], $_POST['nombre']);
	$mail->addReplyTo($_POST['email'], $_POST['nombre']);

	//email de soporte
	$mail->addAddress("info@brazilbus.com");
	//Set the subject line
	$mail->Subject = 'BrazilBus: '.$_POST['motivo'];

	$mail->msgHTML($mensaje);
	$mail->send();

	header('Location: respuesta.html');
}else{
	echo "error.-";
}
