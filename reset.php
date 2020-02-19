<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
//header("Content-Type: application/json");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './vendor/autoload.php';

$email = $_GET["email"];
$fullname = $_GET["fullname"];
$token = $_GET["token"];
$id = $_GET["id"];

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'emmanuel.adeojo.ibk@gmail.com';                 // SMTP username
    $mail->Password = 'LORDflex2221';                           // SMTP password
    $mail->SMTPSecure = 'SMTPS';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('emmanuel.adeojo.ibk@gmail.com', 'Tradexplorer');
    $mail->addAddress($email, $fullname);     // Add a recipient
    $mail->addReplyTo('noreply@tradexplorer.com', 'Do Not Reply');
	
	$url = 'http://tradexplora.com.ng/auth/password/token/'.$id.'/'.$token;

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Tradexplorer Reset Password';
    $mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Tradexplorer Password Reset</title>
        <meta name="viewport" content="width=device-width" />
        <link rel="icon" href="https://raw.githubusercontent.com/adeojoemmanuel/tdxserver/master/logo.png" type="image/img">
       <style type="text/css">
            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                body[yahoo] .buttonwrapper { background-color: transparent !important; }
                body[yahoo] .button { padding: 0 !important; }
                body[yahoo] .button a { background-color: #4caf50; padding: 15px 25px !important; }
            }

            @media only screen and (min-device-width: 601px) {
                .content { width: 600px !important; }
                .col387 { width: 387px !important; }
            }
			
			a.link1{
			  color:#382F2E;
			}
			a.link2{
			  font-size:16px;
			  text-decoration:none;
			  color:#ffffff;
			}
        </style>
    </head>
    <body bgcolor="#34495E" style="margin: 0; padding: 0;" yahoo="fix">
        <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
        <![endif]-->
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
            
            <tr>
                <td align="center" bgcolor="#f9f9f9" style="color: #ffffff; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold;">
                    <img src="https://raw.githubusercontent.com/adeojoemmanuel/tdxserver/master/logo.png" alt="" data-default="placeholder" style="width:100px; height:100px">
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#f9f9f9" style="color: #555555; font-family: Arial, sans-serif; font-size: 20px;  border-bottom: 1px solid #f6f6f6;">
                    <b>Forgot your password? Lets get you a new one!</b>
					<p style="font-size:14px;">
						To reset your password, Click on the button below:
						<br>
					</p>
					<table bgcolor="#4caf50" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
						<tr>
                            <td align="center" height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;" class="button">
                                <a target="_blank" href="' . $url . '" class="link2" style="color: #ffffff !important;">Reset Your Password</a>
                            </td>
                        </tr>
					 </table>
                </td>
            </tr>
			
            <tr>
                <td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 10px 20px; font-family: Arial, sans-serif; border-bottom: 1px solid #f6f6f6;">
					<p>
						If you have any Trouble doing so, please email us at help@tradexplorer.com or call our team on 234 81 4984 8925.<br>
						Thank you for choosing Tradexplorer
					</p> 
                </td>
            </tr>
			
            <tr>
                <td align="center" bgcolor="#f9f9f9" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
                    <b>Tradexplorer </b><br/>NO 9, 5th avenue. &bull;  Gwarimpa Abuja &bull; +234 814 9848 925  |  +234 814 9848 925 
                </td>
            </tr>			
            
        </table>
        <!--[if (gte mso 9)|(IE)]>
                </td>
            </tr>
        </table>
        <![endif]-->
    </body>
</html>';
   /*  $mail->AltBody = 'Thanks for joining Tailorgang! Please confirm that your email address is correct to continue. Visit the link https://tailorgang.io/welcome/index/'.$user.'/'.$token.' to get started.'; */
    $mail->send();
    echo 1;
} catch (Exception $e) {
    echo json_encode(array("error" => true, "message" => 'Message could not be sent.', "error" => $mail->ErrorInfo, "data" => $data));
}

?>
