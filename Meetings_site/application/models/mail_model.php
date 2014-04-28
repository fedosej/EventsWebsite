<?php
class Mail_model extends CI_Model {
	

	
	public function sendMailtoParticipant($data){

$this->load->model('meetings_model');
$userArray=$this->meetings_model->selectUsersFromDB($data['userID']);
$meetingArray=$this->meetings_model->returnMeetingDetails($data['meetingID']);


//define the receiver of the email
$to = $userArray['u_email'];


//define the subject of the email
$subject = 'message with image';


//create a boundary string. It must be unique
//so we use the MD5 algorithm to generate a random hash
$random_hash = md5(date('r', time()));

//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: meetings_site";

//add boundary string and mime type specification
$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";


//read the atachment file contents into a string,
//encode it with MIME base64,
//and split it into smaller chunks
$attachment = chunk_split(base64_encode(file_get_contents('css/images/092.jpg')));

//+base_url+"qr_controller/qrGenerator/"+Base64.encode(data)
//$file=
//$attachment = 







//define the body of the message.
ob_start(); //Turn on output buffering
?>
--PHP-mixed-<?php echo $random_hash; ?> 
Content-Type: multipart/alternative; boundary="PHP-alt-<?php echo $random_hash; ?>"

--PHP-alt-<?php echo $random_hash; ?> 
Content-Type: text/plain; charset="iso-8859-1"
Content-Transfer-Encoding: 7bit

Hello World!!!
This is simple text email message.

--PHP-alt-<?php echo $random_hash; ?> 
Content-Type: text/html; charset="utf-8"
Content-Transfer-Encoding: 7bit

<h2>Hello, <?=$userArray['u_firstname'] ?></h2>
<p>This is your QR image</p>

--PHP-alt-<?php echo $random_hash; ?>--

--PHP-mixed-<?php echo $random_hash; ?> 
Content-Type: image/jpeg; name="css/images/092.jpg" 
Content-Transfer-Encoding: base64 
Content-Disposition: attachment 

<?php echo $attachment; ?>
--PHP-mixed-<?php echo $random_hash; ?>--

<?php
//copy current buffer contents into $message variable and delete current output buffer
$message = ob_get_clean();
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed"
//echo $mail_sent ? "Mail sent" : "Mail failed"; 

} //end send mail to participant
	
	
	
	
	
	
	
	
	
	
} //end class