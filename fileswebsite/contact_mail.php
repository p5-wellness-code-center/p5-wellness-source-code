<?php  
$mailto = 'info@p5wellness.com' ;
$subject = "Enquiry Form" ;
$email_is_required = 1;
$name_is_required = 1;
$phoneno_is_required = 1;
$comments_is_required = 1;
$uself = 0;
$forcelf = 0;
$use_envsender = 0;
$use_sendmailfrom = 0;
$use_webmaster_email_for_from = 0;
$use_utf8 = 1;


// -------------------- END OF CONFIGURABLE SECTION ---------------

define( 'MAX_LINE_LENGTH', 998 );
$headersep = $uself ? "\n" : "\r\n" ;
$content_nl = $forcelf ? "\n" : (defined('PHP_EOL') ? PHP_EOL : "\n") ;
$content_type = $use_utf8 ? 'Content-Type: text/plain; charset="utf-8"' : 'Content-Type: text/plain; charset="iso-8859-1"' ;

$envsender = "-f$mailto" ;
$fullname = isset($_POST['fullname']) ? $_POST['fullname'] : $_POST['name'] ;
$email = $_POST['email'] ;
$phone=$_POST['phone'];
$comments = $_POST['message'] ;
$http_referrer = getenv( "HTTP_REFERER" );


 
if (empty($email)) {
	$email = $mailto ;
}
$fromemail = $use_webmaster_email_for_from ? $mailto : $email ;



$messageproper =
	"This message was sent from:" . $content_nl .
	"$http_referrer" . $content_nl .
	"------------------------------------------------------------" . $content_nl .
	
	"Name of sender: $fullname" . $content_nl .
	"Email of sender: $email" . $content_nl .
	"Phone of sender: $phone" . $content_nl .
	"------------------------- Message -------------------------" . $content_nl . $content_nl .
	wordwrap( $comments, MAX_LINE_LENGTH, $content_nl, true ) . $content_nl . $content_nl .
	"------------------------------------------------------------" . $content_nl ;

$headers =
	"From: \"$fullname\" <$mailto>" . $headersep . "Reply-To: \"$fullname\" <$mailto>" . $headersep . "X-Mailer: chfeedback.php 2.16.2" .
	$headersep . 'MIME-Version: 1.0' . $headersep . $content_type ;
	// echo $mailto;
	
$use_envsender= @mail($mailto, $subject, $messageproper, $headers );
if ($use_envsender) {
	
	print "<p class='success'>
Thank you for contacting us. We will be in touch with you very soon.</p>";
}
else {
	print "<p class='error'>Problem in Sending Mail.</p>";
}

?>