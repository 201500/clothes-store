<?php 
require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';
$email = $_POST['email'];
$name = $_POST['name'];
$date = $_POST['date'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$message = $_POST['message'];
//$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mail.ru';  																							// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'project_coding_lab_feedback@mail.ru'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = 'HyRappu2/IU3'; // Ваш пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров
$mail->setFrom('project_coding_lab_feedback@mail.ru'); // от кого будет уходить письмо?
$mail->addAddress('201208@astanait.edu.kz');     // Кому будет уходить письмо 
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Additional Information For Order';
$mail->Body    = 'Username: ' . $name . ' <br>
User mail:' . $email . '<br>
User number:' . $phone . '<br>
User address:' . $address . '<br>
Date the message was sent:' . $date . '<br>
User message:' . $message . '<br>';
$mail->AltBody = '';
if(!$mail->send()) {
    echo 'Error';
} else {
    header('location: index.php');
}
?>