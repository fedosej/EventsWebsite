<?php
class Qr_controller extends CI_Controller {


		public function __construct(){
			parent:: __construct();
		}



		
		public function linkGenerator($stringcoded){
			$this->load->model('meetings_model');
			$this->load->model('code_model');
			
			$stringdecoded=$this->code_model->decrypt($stringcoded);
			$umArray=explode("/", $stringdecoded);
			$userID=$umArray[0];
			$meetingID=$umArray[1];
			
			//check if QR code is valid
			$participated=$this->meetings_model->checkParticipation($meetingID, $userID);
			if($participated==false){
				redirect(base_url('meetings/invalidQR'));
			}
			else{
				$data=array(
						'user'			=>	$this->meetings_model->selectUsersFromDB($userID),
						'meeting'		=>	$this->meetings_model->returnMeetingDetails($meetingID),
						'registered'	=> 	$this->meetings_model->checkRegistration($userID, $meetingID)
				);

				if(isset($this->session->userdata['u_id'])){
					//$this->load->view('pages/user_and_meeting', $data);
					$this->load-> library('display');
					$this->display->show('user_and_meeting', $data);
				}

				else{
					//save last visited page
					$this->session->set_userdata('last_page', current_url());
					//and redirect to login
					redirect(base_url('meetings/login'));
				}
			}
			
		}
		


		

		
		
		
		
		



} //end class