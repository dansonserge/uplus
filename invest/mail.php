<?php
	class mail{
		function __construct()
		{
			$this->email = 'uplusrw@gmail.com';
			$this->pwd = 'uplusmprw';
		}
		function send($email, $subject, $body, $header=''){
			require_once 'mailer/PHPMailerAutoload.php';
			// $mail = new PHPMailer;
			// $mail->IsSMTP(); // enable SMTP
			// $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			// $mail->SMTPAuth = true; // authentication enabled
			// $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
			// // $mail->Host = "tls://smtp.gmail.com:465";
			// $mail->Host = "https://smtp.gmail.com";
			// $mail->Port = 465; // or 587
			// $mail->IsHTML(true);
			// $mail->Username = $this->email;
			// $mail->Password = $this->pwd;
			// $mail->SetFrom($this->email);
		 //   	$mail->addAddress($email);
			// $mail->Subject = $subject;
			// $mail->Body = $body;

			// $mail->send();

			//Create a new PHPMailer instance
			$mail = new PHPMailer;
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			//Set the hostname of the mail server
			$mail->Host = 'smtp.gmail.com';
			// use
			// $mail->Host = gethostbyname('smtp.gmail.com');
			// if your network does not support SMTP over IPv6
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;
			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = $this->email;
			//Password to use for SMTP authentication
			$mail->Password = $this->pwd;
			//Set who the message is to be sent from
			$mail->setFrom($this->email);
			//Set an alternative reply-to address
			//Set who the message is to be sent to

			//Options
			$mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);

			$mail->addAddress($email);
			//Set the subject line
			$mail->Subject = $subject;
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
			$mail->Body = $body;

			//Replace the plain text body with one created manually
			$mail->AltBody = $body;
			//Attach an image file
			// $mail->addAttachment('images/phpmailer_mini.png');
			//send the message, check for errors
			if (!$mail->send()) {
			    return array('status'=>false, 'msg'=>$mail->ErrorInfo);
			} else {
				return array('status'=>true);
			}
		}

		// function send($email, $subject, $body, $header=''){
		// 	define('_FROM_EMAIL', 'uplusrw@gmail.com');
		//  	require_once 'mailer/PHPMailerAutoload.php';

		// 	$headers  = $header.= "MIME-Version: 1.0\r\n";
		// 	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		// 	$mail = new PHPMailer;
		// 	$mail->isSMTP();
		// 	$mail->SMTPSecure = 'ssl';
		// 	$mail->SMTPAuth = false;

		// 	//Enable SMTP debugging.
		// 	$mail->SMTPDebug = 3;

		//    $mail->Host = 'tls://smtp.gmail.com:587';
		//    $mail->Port = 587;
		//    $mail->Username = 'uplusrw@gmail.com';
		//    $mail->Password = 'uplusmprw';
		//    $mail->setFrom('uplusrw@gmail.com');
		//    $mail->addAddress($email);
		//    $mail->Subject = $subject;
		//    $mail->Body = $body;
		//    $mail->addCustomHeader($headers);
		//    //send the message, check for errors
		//    if (!$mail->send()) {
		// 	   //Sending with traditional mailer
		// 	   $this->init("default"); //Initializing mail parameters SMPTP settings

		// 	   $header = "From: "._FROM_EMAIL;
		// 	   if(mail($email, $subject, $body, $headers."From:"._FROM_EMAIL)){
		// 		   return true; //Here the e-mail was sent
		// 		   }
		// 		else{
		// 			echo "ERROR: " . $mail->ErrorInfo;
		// 			return false;
		// 			}
		//    }
		//    else {
		// 	   return true;
		//    }
		// }
		function init($name = "default"){
			ini_set("SMTP", "smtp.gmail.com");
			ini_set("smtp_server", "smtp.gmail.com");
			ini_set("smtp_port ", "587");
			ini_set("smtp_ssl", "auto");
			ini_set("auth_username", "uplusrw@gmail.com");
			ini_set("auth_password", "uplusmprw");
			}

	}
	$Mail = new mail();
?>
