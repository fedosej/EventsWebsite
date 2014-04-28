<?php
class Meetings extends CI_Controller {

			
			//call parent class (general CI) construct and my own model
			//I dont need to call model in each function
			
			public function __construct(){
				parent::__construct(); 
				$this->load-> model('meetings_model');
				
				$this->load-> library('display');
				//$this->load->library('session');
				
			}
			

			public function index(){
				
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('<span class="error">','</span>');
				
				//load view files through library DISPLAY
				//preheader, header, pagecontent and footer
				$data=$this->meetings_model->getLastMeetings();
				$dataArray['data']=$data;
				$this->display->show('00 index', $dataArray);

			} // end index


	

			
			

			public function registration(){
				//$data=array();
				if(isset($this->session->userdata['u_id'])){
					redirect(base_url('meetings'));
				}
				
				$fieldInfo = $this->input->post();
				if($fieldInfo){
					//$this->meetings_model->print_arr($fieldInfo);


					$this->load->library('form_validation');
					
					
					$this->form_validation->set_error_delimiters('<span class="error">','</span>');
					$val_rules = $this -> meetings_model -> reg_form_validation;
					$this->form_validation->set_rules($val_rules);
					

					if($this->form_validation->run()){
						//echo "OK";
						
						$fieldName='reg_avatar';
						$fileName=null;

						
						//firstly check if file has been selected
						if($_FILES[$fieldName]['error']!=4){
							//create array with data
							$config=$this->meetings_model->createArrayForUploadedFile($_FILES[$fieldName]['name']);
							
							//load library
							$this->load->library('upload', $config);
							//upload file
							$this->upload->do_upload($fieldName);
							//check uploaded file name
							$upld_file=$this->upload->data($fieldName);
							$fileName=$upld_file['file_name'];
							
							//change permissions of uploaded file
							chmod('./avatars/'.$fileName, 0777); 

							//resize
							$avatar=$this->meetings_model->createArrayForResize($filePath, $fileName, 150, 150);
							$this->load->library('image_lib', $avatar);
    						$this->image_lib->initialize($config);
							$this->image_lib->resize();
						}
						//if avatar was not selected --> put default avatar
						else{
							$fileName="noavatar.jpg";
						}

						$this->meetings_model->createAccountInDB($fieldInfo, $fileName);
						redirect(base_url('meetings/reg_success'));
											
						//$this->meetings_model->print_arr($_FILES);
						//$this->meetings_model->print_arr($fieldInfo);

					}
					
					else{
						//echo "form errors";
					}

				} //end if isset fieldinfo
				$this->display->show('registration');
				
				
			} //end registration
			


			




			
			public function login($wrongPass=false, $mailSent=null){
				if(isset($this->session->userdata['u_id'])){
					redirect(base_url('meetings'));
				}
				
				$fieldInfo = $this->input->post();
				if($fieldInfo){			
					//check logined user
					$user=$fieldInfo['login_email'];
					$password=$fieldInfo['login_pass'];
					$checkuser = $this->meetings_model->checkUserInDB($user, $password);


					if($checkuser){
						//SUCCESS LOGIN
						
						//if login from another page --> redirect to this page after login
						if(isset($this->session->userdata['last_page'])){
							$prev_page=$this->session->userdata['last_page'];
						}
						if(isset($prev_page) && $prev_page!=null){
							redirect($prev_page);
						}
						//if login from main page --> redirect to main page after login
						else{
							redirect(base_url());
						}
					}
					else{
						//WRONG EMAIL/PASS
						$wrongPass=true;
						redirect(base_url('meetings/login/'.$wrongPass));
					}

				} //end if form is submitted

				else{
					
					$loginData['wrongPass']=$wrongPass;
					$loginData['mailSent']=$mailSent;
					$this->display->show('login', $loginData);
				}
				
			} //end login function




			public function logout(){
				$this->session->sess_destroy();
				redirect(base_url('meetings'));
			
			} //end logout function



			public function updateProfile(){
				

				//select data of logged users
				
				if(!isset($this->session->userdata['u_id'])){
					redirect(base_url('meetings/login'));
				}
				else{
					$user=$this->meetings_model->selectUsersFromDB($this->session->userdata['u_id']);
					
					$fieldInfo=$this->input->post();
					if($fieldInfo){
						//echo "form was submitted";
						$this->load->library('form_validation');
						$this->form_validation->set_error_delimiters('<span class="error">','</span>');
						$val_rules = $this -> meetings_model -> updateprofile_form_validation;
						$this->form_validation->set_rules($val_rules);
						
						if($this->form_validation->run()){

							
							
							
							$fieldName='profile_avatar';
							$oldFileName=$user['u_avatar'];
							$filePath="";
							$fileName=null;
							$folderName="avatars";
						
							//check if file has been selected
							if($_FILES[$fieldName]['error']!=4){
								//create array with data
								$config=$this->meetings_model->createArrayForUploadedFile($_FILES[$fieldName]['name'], $folderName);
								
								//load library
								$this->load->library('upload', $config);
								//upload file
								$this->upload->do_upload($fieldName);

								//check uploaded file name
								$upld_file=$this->upload->data($fieldName);
								$fileName=$upld_file['file_name'];
								$filePath=base_url('avatars');
								
								//change permissions of uploaded file
								chmod('./'.$folderName.'/'.$fileName, 0777); 


								//resize
								$avatar=$this->meetings_model->createArrayForResize($folderName, $fileName, 150, 150);
								$this->load->library('image_lib', $avatar);
    							$this->image_lib->initialize($config);
								
								//$this->image_lib->resize();
								
								if (!$this->image_lib->resize()){
									echo $this->image_lib->display_errors();
								}
								
								//delete previous avatar
								if($user['u_avatar']!=null){									
									unlink('./'.$folderName.'/'.$oldFileName);
								}

								
							}


							
							$this->meetings_model->updateProfileInDB($fieldInfo, $fileName, $this->session->userdata['u_id']);
							redirect(base_url('meetings'));
														
						}
						
						else{
							echo "form errors";
						}


					} //end isset fieldinfo
					
					

					if($user['u_avatar']!=""){
						
						
					}

					

					$data['user']=$user;

					$this->display->show('profile', $data);
				} //if isset sessionID


			} // end update profile function







			public function createNewMeeting(){
				if(!isset($this->session->userdata['u_id'])){
					//save current page and redirect to login
					$this->session->set_userdata('last_page', current_url());
					redirect(base_url('meetings/login'));
				}
				else{
					$fieldInfo = $this->input->post();
					if($fieldInfo){

						$this->load->library('form_validation');
						$this->form_validation->set_error_delimiters('<span class="error">','</span>');
						$val_rules = $this -> meetings_model -> newmeet_form_validation;
						$this->form_validation->set_rules($val_rules);

						if($this->form_validation->run()){
						
							//handle selected image
							$fieldName='m_avatar';
							$fileName=null;
							$folderName='avatars_m';
							
							//check if file has been selected
							if($_FILES[$fieldName]['error']!=4){
								//create array with data
								$config=$this->meetings_model->createArrayForUploadedFile($_FILES[$fieldName]['name'], $folderName);
								
								//load library
								$this->load->library('upload', $config);
								//upload file
								$this->upload->do_upload($fieldName);
								//check uploaded file name
								$upld_file=$this->upload->data($fieldName);
								$fileName=$upld_file['file_name'];
								
								//change permissions of uploaded file
								chmod('./'.$folderName.'/'.$fileName, 0777); 

								//resize
								$avatar=$this->meetings_model->createArrayForResize($folderName, $fileName, 150, 150);
								$this->load->library('image_lib', $avatar);
								$this->image_lib->initialize($config);
								$this->image_lib->resize();
							}
							//if file was not selected --> put default meeting image
							else{
								$fileName="nophoto.jpg";
							}
							
							
							//echo "OK";
							$this->meetings_model->createMeetingInDB($fieldInfo, $this->session->userdata['u_id'], $fileName);
							redirect(base_url('meetings/create_new_meet_success'));
						}
						
						else{
							//echo "form errors";
							$formerrors=true;
						}
					}
					$this->display->show('create_meeting');
				}

			} // end create new meeting
			

			public function searchMeetings($fieldInfoGet=null){
				
				

					$fieldInfo=$this->input->post();
					
					if($fieldInfo){	
						$data=$this->meetings_model->meetingsFilter($fieldInfo);
						$firstclick=false;
						
						
					}
					else{
						$data=$this->meetings_model->getLastMeetings();
						$firstclick=true;
					}
				
				$arraytoView['data']=$data;
				$arraytoView['firstclick']=$firstclick;

				$this->display->show('list_of_meetings', $arraytoView);
			}


			
			
			public function reg_success(){
				$this->display->show('reg_success');
			} // end reg success
			
			public function create_new_meet_success(){
				$this->display->show('create_meet_success');
			} //end create new meet success
			
			
			public function invalidQR(){
				$this->display->show('invalidQR_view');
			}
			
			public function myMeetings(){
				
				if(!isset($this->session->userdata['u_id'])){
					//save current page
					$this->session->set_userdata('last_page', current_url());
					//redirect to login page
					redirect(base_url('meetings/login'));
				}
				
				$organized=$this->meetings_model->ownedMeetings($this->session->userdata['u_id']);
				$participated=$this->meetings_model->participatedMeetings($this->session->userdata['u_id']);
				$data=array(
					'organized'		=>	$organized,
					'participated'	=>	$participated
				);
				$this->display->show('my_meetings', $data);
			}

			
			
			public function showMeetingDetails($meetingID){
				$data=$this->meetings_model->returnMeetingDetails($meetingID);
				//Array transfer to view
				if(isset($data)){
					$arrayData=array(
						'data'	=>	$data
					);
				}
				
				
				//if user is logged we check participation 
				//and add participation info to Array
				
				if(isset($this->session->userdata['u_id'])){
					$participated=$this->meetings_model->checkParticipation($meetingID, $this->session->userdata['u_id']);
					$arrayData['participated']=$participated;

				}
				
				//check if meetings was ended or not
				//$today=new DateTime(date('Y-m-d'));
				//$mDate=new DateTime(date('Y-m-d', strtotime($data['m_startdate'])));
				$today=new DateTime(date("Y-m-d H:i:s"));
				$mDate=new DateTime(date("Y-m-d H:i:s", strtotime($data['m_startdate'])));
				
				$difDate=$today->diff($mDate);
				$daysToMeeting=$difDate->format('%R%a%');
				$finished=true;
				if($daysToMeeting>=1){
					$finished=false;
				}
				$arrayData['finished']=$finished;
				$arrayData['daysToMeeting']=$daysToMeeting;
				
				
				$this->display->show('meeting_details_view', $arrayData);
				

			}

			public function editMyMeeting($meetingID){
				$meetingInfo=$this->meetings_model->returnMeetingDetails($meetingID);
				$owner=$meetingInfo["m_owner"];
				
				
				if(!isset($this->session->userdata['u_id'])){
					redirect(base_url('meetings/login'));
				}
				elseif($owner==$this->session->userdata['u_id']){
					$prevData=$this->meetings_model->returnMeetingDetails($meetingID);
					$oldFileName=$prevData['m_avatar'];
					
					$fieldInfo = $this->input->post();
					if($fieldInfo){
						$prevData=array("");
						$this->load->library('form_validation');
						$this->form_validation->set_error_delimiters('<span class="error">','</span>');
						$val_rules = $this -> meetings_model -> newmeet_form_validation;
						$this->form_validation->set_rules($val_rules);

						if($this->form_validation->run()){
							//echo "OK";
							
							//handle meeting image
							$fieldName='m_avatar';
							$folderName="avatars_m";
							$filePath="";
							$fileName=null;
						
							//check if file has been selected
							if($_FILES[$fieldName]['error']!=4){
								//create array with data
								$config=$this->meetings_model->createArrayForUploadedFile($_FILES[$fieldName]['name'], $folderName);
								
								//load library
								$this->load->library('upload', $config);
								//upload file
								$this->upload->do_upload($fieldName);

								//check uploaded file name
								$upld_file=$this->upload->data($fieldName);
								$fileName=$upld_file['file_name'];
								//$filePath=base_url('avatars');
								
								//change permissions of uploaded file
								chmod('./'.$folderName.'/'.$fileName, 0777); 


								//resize
								$avatar=$this->meetings_model->createArrayForResize($folderName, $fileName, 150, 150);
								$this->load->library('image_lib', $avatar);
    							$this->image_lib->initialize($config);
								
								//$this->image_lib->resize();
								
								if (!$this->image_lib->resize()){
									echo $this->image_lib->display_errors();
								}
								
								//delete previous avatar
								if($oldFileName['m_avatar']!=null){									
									unlink('./'.$folderName.'/'.$oldFileName);
								}

								
							} //end handle meeting image
							
							
							
							
							
							
							$this->meetings_model->updateMeetingInDB($fieldInfo, $meetingID, $fileName);
							
							//if notification sending was selected
							$wantNotifications = $this->input->post('want_notifications');
							if($wantNotifications=="on"){
								$participants=$this->meetings_model->returnParticipants($meetingID);
								foreach($participants as $participant){
									$this->sendNotificationAboutMeetingUpdate($participant, $meetingID);
									//echo $wantNotifications."<br>";
									//print_r($participant);
								}
							}
							
							redirect(base_url('meetings/showMeetingDetails/'.$meetingID));
						}
						
						else{
							//echo "form errors";
							$formerrors=true;
						}
					}
					
					$dataArray=array(
						'prevData'	=> $prevData,
						'meetingID'	=> $meetingID
					);
				
					$this->display->show('update_meeting', $dataArray);
				}
				
				
			} // end edit my meeting
			
			
			public function sendNotificationAboutMeetingUpdate($participant, $meetingID){
	
			
					$this->load->model('meetings_model');
					$this->load->library('phpmailer/phpmailer');
					$mail = new PHPMailer;
					
					$mail->From = 'info@eventswebsite.com';
					$mail->FromName = 'Events Website';
					$mail->addAddress($participant['u_email']);  // Add a recipient
					$mail->addReplyTo('info@eventswebsite.com', 'Information');

					$mail->WordWrap = 50;// Set word wrap to 50 characters
					
					$mail->CharSet='UTF-8';
					
					//$mail->addAttachment(FCPATH.'/qrimages_temp/'.$userID.'_'.$meetingID.'.png');    
					
					// Optional name
					$mail->isHTML(true);                                  
					// Set email format to HTML

					$mail->Subject = 'The event you are participated was updated!';
					
					$body="<h2>Hello, ".$participant['u_firstname']."</h2><p>The event you are participated was updated!<br>Please visit event page to see updates of this event:<br>".base_url()."meetings/showMeetingDetails/".$meetingID."</p>";
					$mail->Body    = $body;
					$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					if(!$mail->send()) {
					   echo 'Message could not be sent.';
					   echo 'Mailer Error: ' . $mail->ErrorInfo;
					   exit;
					}

					//echo 'Message has been sent';
			}
			// end sendNotificationAboutMeetingUpdate
			
			

			
			
			
			public function quickSearch(){
				$data=$this->input->post();
				//$this->meetings_model->print_arr($fieldInfo);
				$result=$this->meetings_model->quickMeetingsFilter($data['keyword']);
				
				
				$arraytoView['data']=$result;
				$arraytoView['firstclick']=false;
				$this->display->show('list_of_meetings', $arraytoView);
				
				
			} //end quick search
			
			
			
			public function about(){
				$this->display->show('about_view');
			} //end about
			
			
			
			public function requestPassRecover(){
				$this->display->show('request_recover');
			} 
			//end requestPass recover
			
			
			
			public function requestPass(){
				$fieldInfo = $this->input->post();
				if($fieldInfo){
						$prevData=array("");
						$this->load->library('form_validation');
						$this->form_validation->set_error_delimiters('<span class="error">','</span>');
						$val_rules = $this -> meetings_model -> requestpass_form_validation;
						$this->form_validation->set_rules($val_rules);

						if($this->form_validation->run()){
							
							$wrongPass=0; //wrongpass always will be FALSE in this function
							
							//check if this email is registered
							$findUser=$this->meetings_model->checkEmail($fieldInfo['request_email']);
							//echo $fieldInfo['request_email'];
							//$this->meetings_model->print_arr($findUser);
							
							//if email is really registered we are sending the email
							if($findUser['found']==true){
								$sendEmailToRecover=$this->sendEmailToUpdatePass($findUser['userInfo']);
								$mailSent="true";
								
							}
							else{
								$mailSent="false";
								
							}
							redirect(base_url('meetings/login/'.$wrongPass.'/'.$mailSent));
							
						}
						
						else{
						
							//form error
							$this->requestPassRecover();

						}
				} //end if fieldinfo
			}
			//end requestPass
			
			

			
			
			
			
			public function sendEmailToUpdatePass($userInfo){
					$this->load->model('meetings_model');
					$this->load->library('phpmailer/phpmailer');
					$mail = new PHPMailer;
					
					$mail->From = 'info@eventswebsite.com';
					$mail->FromName = 'Events Website';
					$mail->addAddress($userInfo['u_email']);  // Add a recipient
					$mail->addReplyTo('info@eventswebsite.com', 'Information');

					$mail->WordWrap = 50;// Set word wrap to 50 characters
					
					$mail->CharSet='UTF-8';
					
					
					// Optional name
					$mail->isHTML(true);                                  
					// Set email format to HTML

					$mail->Subject = 'Reset your password';
					$this->load->model('code_model');
					$cryptedData=$this->code_model->encrypt($userInfo["u_id"]);
					$link=base_url("meetings/resetPassword/".$cryptedData);
					
					$body="<h2>Hello, ".$userInfo['u_firstname']."</h2><p>You or someone else requested to reset password for your account.<br>To do it please click on the link below and follow the instructions:<br>".$link."</p>";
					$mail->Body    = $body;
					$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					if(!$mail->send()) {
					   echo 'Message could not be sent.';
					   echo 'Mailer Error: ' . $mail->ErrorInfo;
					   exit;
					}

					echo 'Message has been sent';
					
					
					
			} //end sent email to update password
			
			
			public function updatePassFromProfile(){
				$userID=$this->session->userdata['u_id'];
				$this->load->model('code_model');
				$cryptedUserID=$this->code_model->encrypt($userID);
				$this->resetPassword($cryptedUserID);
			}
			//end updatePassFromProfile
			
			
			public function resetPassword($cryptedUserID){

				
				$userArr=array("user"=>$cryptedUserID);
				$fieldInfo = $this->input->post();
				
				if($fieldInfo){
					$this->load->library('form_validation');
					$this->form_validation->set_error_delimiters('<span class="error">','</span>');
					$val_rules = $this -> meetings_model -> updatetpass_form_validation;
					$this->form_validation->set_rules($val_rules);

					if($this->form_validation->run()){
						//form OK- passwords match
						$this->meetings_model->updateUserPassInDB($cryptedUserID, $fieldInfo);
						redirect(base_url('meetings/updatePassSuccess'));
					}
					else{
						//form error= passwords not match
					}
				}
				$this->display->show("reset_password", $userArr);

			}
			//end reset password
			
			
			
			
			public function updatePassSuccess(){
				$this->display->show("update_pass_success");
			}
			

			
			
			
			
			function imgHandler(){
					$picture=base_url("avatars_m/nophoto.jpg");
					$divH=150;
					$divW=150;
					
					$result=array();
					$info = getimagesize($picture);
					
					$a=$info[0];  // element of array with WIDTH parameter
					$b=$info[1];  // element of array with HEIGHT parameter
					// start our comparision (dimension changer) - calculation of coefficient K
					$k1=$divW/$a;
					$k2=$divH/$b;
					if ($k1 < $k2){
						$k=$k1;
					}
					else {
						$k=$k2;
					}
					$newwidth=$a*$k;
					$newheight=$b*$k;
					
					$result['width']=$newwidth;
					$result['height']=$newheight;
					
					$this->meetings_model->print_arr($result);
					
					
			} //end dimension handler
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			

} //end class
