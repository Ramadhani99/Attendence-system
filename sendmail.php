<?php
//require_once("../includes/initialize.php");
$from="rsadiki99@gmail.com";
$to_name="Ramadhani";
$subject="mail Test ".strftime("%T", time());
$message="hellow";
$message=wordwrap($message,70);
$to="sadikramadhani@yahoo.com";
$from_name="Khamisi";
$header="FROM: {$from}";

ini_set("SMTP","localhost");
   ini_set("smtp_port","25");
   ini_set("sendmail_from","rsadiki99@gmail.com");
   ini_set("sendmail_path", "C:\wamp\bin\sendmail.exe -t");
 $result=mail($to, $subject, $message,$header);
  echo $result ?  "sent" :  "error"; 

// $mail=new PHPMailer();
// $mail->IsMAIL();
// //  $mail->IsSMTP();                           // telling the class to use SMTP
// //  $mail->SMTPAuth   = true;                  // enable SMTP authentication
// //  $mail->Host       = "mail.gmail.com"; // set the SMTP server
// // $mail->Port       = 26;                    // set the SMTP port
// //  $mail->Username   = "rsadiki99@gmail.com"; // SMTP account username
// //  $mail->Password   = "0717023787";        // SMTP account password

// $mail->FromName=$from_name;
// $mail->From=$from;
// $mail->addAddress($to);
// $mail->Subject=$subject;
// $mail->Body=$message;
// $mail->Sender=$from;
// //$mail->SetFrom("rsadiki99@gmail.com","my name", 0);
// $result=$mail->Send();
//  echo $result ?  "sent" :  "error". $mail->ErrorInfo; 
  echo "Ramadhani"

?>