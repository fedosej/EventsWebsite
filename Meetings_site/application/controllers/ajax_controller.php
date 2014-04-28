<?php

class Ajax_controller extends CI_Controller {

			
			//call parent class (general CI) construct and my own model
			//I dont need to call model in each function
			
			public function __construct(){
				parent::__construct(); 
				
				
			} //end __custruct



			public function getUsers(){
				$this->load->model('meetings_model');
				$userArray=$this->input->get();
				echo json_encode($this->meetings_model->ReturnUsers($userArray['term']));
				//echo json_encode($this->meetings_model->ReturnUsers($userArray['term']));
			
			} //end get users


			public function newParticipation(){
				$this->load->model('meetings_model');
				$result=array();
				$result['check_result']=false;

				$data=$this->input->get();
				
				//firstly check if user has not been participated
				//if not insert row in participant DB table
				if($this->meetings_model->checkParticipation($data['meetingID'], $data['userID'])==false){
				
					
					//insert new entry into participant DB table
					$this->meetings_model->addParticipation($data['meetingID'], $data['userID']);
					
					// check again: data shoud be inserted in DB
					if($this->meetings_model->checkParticipation($data['meetingID'], $data['userID'])==true){
						
						//generate QR Image
						$this->generateQR($data['userID'], $data['meetingID']);
						
						//send email
						$this->sendMail($data['userID'], $data['meetingID']);
						
						//remove qr image from temp directory
						$this->removeQRfileFromTemp($data['userID'], $data['meetingID']);
						
						
						$result['check_result']=true;
						//$result['image']=qrimage;
					}
				}

				echo json_encode($result);
			
			} //end function new participation



			public function cancelParticipation(){
				$this->load->model('meetings_model');
				$result=array();
				$result['check_result']=false;

				$data=$this->input->get();
				
				//firstly check if user has been participated already
				// if there yes => remove row from participants DB table
				if($this->meetings_model->checkParticipation($data['meetingID'], $data['userID'])==true){
				
				
					//remove entry from participant DB table
					$this->meetings_model->removeParticipation($data['meetingID'], $data['userID']);

					// check again: data shoud be removed from DB
					if($this->meetings_model->checkParticipation($data['meetingID'], $data['userID'])==false){
						$result['check_result']=true;
					}
				}
				echo json_encode($result);
				
			} //end function cancel participation

			
			
			
			public function generateQR($userID, $meetingID){
				$this->load->library('ciqrcode');
				$this->load->model('code_model');

				$stringcoded=$this->code_model->encrypt($userID."/".$meetingID);

				
				$link=base_url()."qr_controller/linkGenerator/".$stringcoded;
				$params['data'] = $link;
				$params['level'] = 'H';
				$params['size'] = 10;
				$params['savename'] = FCPATH.'qrimages_temp/'.$userID.'_'.$meetingID.'.png';
				$this->ciqrcode->generate($params);

			} //generateQRimage
			
			public function removeQRfileFromTemp($userID, $meetingID){
				unlink(FCPATH.'qrimages_temp/'.$userID.'_'.$meetingID.'.png');
			}
			
			
			public function registrationInMeeting(){
				$this->load->model('meetings_model');
				$data=$this->input->get();
				$result=$this->meetings_model->UpdateRegistrationInDB($data);
				echo json_encode($result);
			} //end rigistration
			




			public function sendMail($userID, $meetingID){
	
			
					$this->load->model('meetings_model');
					$this->load->library('phpmailer/phpmailer');
					$mail = new PHPMailer;
					
					$userArray=$this->meetings_model->selectUsersFromDB($userID);
					$meetingArray=$this->meetings_model->returnMeetingDetails($meetingID);


					$mail->From = 'info@eventswebsite.com';
					$mail->FromName = 'Events Website';
					$mail->addAddress($userArray['u_email']);  // Add a recipient
					$mail->addReplyTo('info@eventswebsite.com', 'Information');

					$mail->WordWrap = 50;// Set word wrap to 50 characters
					
					$mail->CharSet='UTF-8';
					
					$mail->addAttachment(FCPATH.'/qrimages_temp/'.$userID.'_'.$meetingID.'.png');    // Optional name
					$mail->isHTML(true);                                  
					// Set email format to HTML

					$mail->Subject = 'Message with QRImage';
					
					$body="<h2>Hello, ".$userArray['u_firstname']."</h2><p>This is your QR image</p>";
					$mail->Body    = $body;
					$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					if(!$mail->send()) {
					   echo 'Message could not be sent.';
					   echo 'Mailer Error: ' . $mail->ErrorInfo;
					   exit;
					}

					//echo 'Message has been sent';
			}


			
			public function meetingDetails(){
				$this->load->model('meetings_model');
				$data=$this->input->get();
				$result=$this->meetings_model->returnMeetingDetails($data['meetingID']);
				if(isset($this->session->userdata['u_id'])&&$this->session->userdata['u_id']!=""){
					$result['participated']=$this->meetings_model->checkParticipation($data['meetingID'], $this->session->userdata['u_id']);
				}
				
				echo json_encode($result);
			}
			
			
			public function viewParticipants(){
				$this->load->model('meetings_model');
				$data=$this->input->get();
				$result=$this->meetings_model->returnParticipants($data['meetingID']);
				echo json_encode($result);
			}

		




} // end class