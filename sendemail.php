<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
$title = "Forgot Password";
require_once "header.php";
require_once "classes/customer.php";
$email=	$_POST['inemail'];
if(empty($email)){
    header("Location:forgotpassword.php?forgotpassword=empty");
}
else if (Customer::retrieve_by_email($email)==0)
{
    header("Location:forgotpassword.php?forgotpassword=wrong");

}
else {
    $customer=Customer::retrieve_by_email($email);
    $token= md5( rand(0,1000) );
    $userid=$customer['username'];
    Customer::insert_token($userid,$token);

require 'mail/vendor/phpmailer/phpmailer/src/Exception.php';
require 'mail/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'mail/vendor/phpmailer/phpmailer/src/SMTP.php';
require 'mail/vendor/autoload.php';
$mail = new PHPMailer(true);
//$mail->SMTPDebug = 2;                   // Enable verbose debug output
$mail->isSMTP();                        // Set mailer to use SMTP
$mail->Host       = 'smtp.gmail.com';    // Specify main SMTP server
$mail->SMTPAuth   = true;               // Enable SMTP authentication
$mail->Username   = 'booktivetest@gmail.com';     // SMTP username
$mail->Password   = 'booktive123';         // SMTP password
$mail->SMTPSecure = 'tls';              // Enable TLS encryption, 'ssl' also accepted
$mail->Port       = 587;                // TCP port to connect to
$mail->setFrom('booktivetest@gmail.com', 'Booktive');           // Set sender of the mail
$mail->addAddress($email);           // Add a recipient
$mail->isHTML(true);                                  
$mail->Subject = 'Password Reset';

$url="http://localhost/final/resetpassword.php?t=$token";
$mail->Body    = '
<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Reset Password Email Template</title>
    <meta name="description" content="Reset Password Email Template.">
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;">Booktive</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                            You have requested to reset your password. It is simple, just press the button below!
                                        </p>
                                        <a href="'.$url.'"
                                            style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset
                                            Password</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>

                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>';
if ($mail->send())
{  
    echo'<div class="container"><br> <div class=" text-center alert alert-success" role="alert">
    E-mail Sent Successfully
    </div> </div>';
}
}
?>
