<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailController extends Controller
{
	function sendmail(){
	    //测试邮件
	    $path = base_path();
	    //$path1=$path.'\vendor\autoload.php';
	    //dd($path1);


		require $path.'\vendor\autoload.php';

		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
		    //Server settings
		    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.sohu.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'wanxiao363@sohu.com';                 // SMTP username
		    $mail->Password = '13783967126wan';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 25;                                    // TCP port to connect to

			$mail->CharSet = "utf-8"; //设置字符集编码
			
		    //Recipients
		    $mail->setFrom('wanxiao363@sohu.com', '笑哥');
		    $mail->addAddress('841513742@qq.com', '笑');     // Add a recipient
		    $mail->addAddress('1473622497@qq.com','万');  
		    $mail->addAddress('vito363@sina.com','万');  
		                 // Name is optional
		    $mail->addReplyTo('wanxiao363@sohu.com', '我');
		    $mail->addCC('cc@example.com');
		    $mail->addBCC('bcc@example.com');

		    //Attachments
		    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'test11奥';
		    $mail->Body    = '哦哦哦哦哦哦</b>';
		    $mail->AltBody = '啊啊啊啊啊啊';

		    $mail->send();
		    echo 'Message has been sent';
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}

	}

}
