<?php
require_once('sygescol2022/includes/PHPMailerByEndeos/config.php');
$mail->ClearAllRecipients();

$mail->AddAddress("verificacionsoportesygescol@gmail.com");
$mail->IsHTML(true);
$mail->Subject= "Correo de prueba";
$msg = "<h2>Contenido mensaje HTML:</h2>
<p>Contenido</p>
<p>Más Contenido...</p>
";
$mail->Body = $msg;
if($mail->Send()){
    echo "Enviado con exito";
}else{
    echo "Error";
}
// $to = "dzapata@imaginacolombia.com";
// $subject = "Correo de prueba php";
// $message = "Este es un envío de email con PHP";
 
// mail($to, $subject, $message);

?>