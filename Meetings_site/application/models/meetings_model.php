<?php
class Meetings_model extends CI_Model {





//-----------------------------------VARIABLES-----------------------------------------------------------------
				
			public $reg_form_validation = array(
					array(
						 'field'   => 'reg_email', 
						 'label'   => 'Email', 
						 'rules'   => 'required|valid_email|trim|is_unique[users.u_email]'
					  ),
					array(
						 'field'   => 'reg_pass', 
						 'label'   => 'Password', 
						 'rules'   => 'required'
					  ),
					array(
						 'field'   => 'reg_pass_confirm', 
						 'label'   => 'Password Confirmation', 
						 'rules'   => 'required|matches[reg_pass]'
					  ),   
					array(
						 'field'   => 'reg_fname', 
						 'label'   => 'Firstname', 
						 'rules'   => 'required'
					  ),
					array(
						 'field'   => 'reg_sname', 
						 'label'   => 'Second name', 
						 'rules'   => 'required'
					  ),
					/*
					array(
						 'field'   => 'reg_contact', 
						 'label'   => 'Contact', 
						 'rules'   => 'required'
					  ),
					 */
            );// end variable registration form validation


			public $newmeet_form_validation = array(
				array(
						 'field'   => 'meeting_summary', 
						 'label'   => 'Summary', 
						 'rules'   => 'required'
					  ),
				array(
						 'field'   => 'meeting_location', 
						 'label'   => 'Location', 
						 'rules'   => 'required'
					  ),
				array(
						 'field'   => 'meeting_startdate', 
						 'label'   => 'StartDate', 
						 'rules'   => 'required'
					  ),
				array(
						 'field'   => 'meeting_enddate', 
						 'label'   => 'EndDate', 
						 'rules'   => 'required'
					  ),
				array(
						 'field'   => 'meeting_description', 
						 'label'   => 'Description', 
						 'rules'   => 'required'
					  ),


			);// end variable new meeting form validation





			public $updateprofile_form_validation = array(

					array(
						 'field'   => 'profile_fname', 
						 'label'   => 'First name', 
						 'rules'   => 'required'
					  ),
					array(
						 'field'   => 'profile_sname', 
						 'label'   => 'Second name', 
						 'rules'   => 'required'
					  )

            );// end variable update profile form validation

		
		
		
			public $requestpass_form_validation = array(
				array(
						 'field'   => 'request_email', 
						 'label'   => 'Email', 
						 'rules'   => 'required|valid_email|trim'
				)
			);
			//end requestpass form validation
		
			
			public $updatetpass_form_validation = array(
				array(
						 'field'   => 'updatepass_pass', 
						 'label'   => 'Password', 
						 'rules'   => 'required'
				),
				array(
						 'field'   => 'updatepass_pass_confirm', 
						 'label'   => 'Password', 
						 'rules'   => 'required|matches[updatepass_pass]'
				)
			);
		
		
		
		
		
		
		
		
		
		


				
//-------------------------------FUNCTIONS------------------------------------------------------------

				
			public function createAccountInDB($user, $fileName=null){
					$object=array();
					$object=array(
							'u_email'		=>	$user['reg_email'],
							'u_password'	=>	md5($user['reg_pass']),							
							'u_firstname'	=>	$user['reg_fname'],
							'u_lastname' 	=>	$user['reg_sname'],
							'u_contact'		=>	$user['reg_contact'],
							'u_avatar'		=>	$fileName
					);
					/*
					if(isset($user['avatar_format'])){
						$object['u_avatar']=$user['avatar_format'];
					}
					*/
					$object=$this->removeEmptyRowsFromSingleArray($object);

					$this->db->insert('users', $object);

			} //end create account in DB


			public function checkUserInDB($user, $password){

					//find user in DB by sended login and email
					$this->db->select('*');
					$this->db->from('users');
					$this->db->where('u_email', $user);
					$this->db->where('u_password', md5($password));
					$query = $this->db->get();						

					if($query ->num_rows() ==1){
						// If there is a user, then create session data
						$row = $query->row();
						$data = array(
							'validated'		=> 	true,
							'u_id'	=>	$row->u_id,
							'u_firstname'	=>	$row->u_firstname,
						);

						$this->session->set_userdata($data);
						return true;
					}

			} //end check user in DB



			public function createMeetingInDB($meeting, $owner, $fileName=null){

					//change date format before inserting in DB
					/*
					$datearray=explode("/", $meeting['meeting_date']);
					$year=$datearray[2];
					$month=$datearray[0];
					$day=$datearray[1];
					$dateformat=$year."-".$month."-".$day." ".$meeting['meeting_time'];
					*/
					//$this->print_arr($meeting);
					
					$object=array(
								'm_owner'	=>	$owner,
								'm_summary'	=>	$meeting['meeting_summary'],
								'm_location'=>	$meeting['meeting_location'],
								'm_startdate'	=>	$meeting['meeting_startdate'],
								'm_enddate'	=>	$meeting['meeting_enddate'],
								'm_desc'	=>	$meeting['meeting_description'],
								'm_avatar'	=>	$fileName
					);

					$object=$this->removeEmptyRowsFromSingleArray($object);
					$this->db->insert('meetings', $object);
					
			} //end create meeting in DB




			public function selectUsersFromDB($userID){
					$this->db->select('u.*');
					$this->db->from('users u');
					$this->db->where('u.u_id', $userID);
					$query = $this->db->get()->result_array();
					$result=$query[0];
					return $result;
				
			} // end select users function




			public function updateProfileInDB($userdata, $fileName=null, $userID){
					$object = array(
				        	'u_firstname'	=>	$userdata['profile_fname'],
				        	'u_lastname	'	=>	$userdata['profile_sname'],
				        	'u_contact'		=>	$userdata['profile_contact']
				        	

            		);
					if($fileName!=null){
						$object['u_avatar']=$fileName;
					}
					
					$this->db->where('u_id', $userID);
					$this->db->update('users', $object);



			} //end update profile function





			public function meetingsFilter($data){
						//$this->print_arr($data);
						//$data=$this->removeEmptyRowsFromSingleArray($data);

						//create LIKE and EQUAL arrays
						$like_array=array();

						$like_array['m.m_summary']=$data['meeting_summary'];
						$like_array['m.m_location']=$data['meeting_location'];
						$like_array['m.m_desc']=$data['meeting_description'];

						$equal_array=array();
						$equal_array['m.m_owner']=$data['organizer_ID'];

						//date fields
						$startfrom=$data['meeting_startdate_from'];
						$startto=$data['meeting_startdate_to'];
						$endfrom=$data['meeting_enddate_from'];
						$endto=$data['meeting_enddate_to'];
						
						//remove emty rows
						$like_array=$this->removeEmptyRowsFromSingleArray($like_array);
						$equal_array=$this->removeEmptyRowsFromSingleArray($equal_array);

					

						$this->db->select('
										m.m_id,
										m.m_summary AS summary,
										m.m_location AS location,
										m.m_desc AS description,
										m.m_startdate,
										m.m_enddate,
										m.m_owner,
										m.m_avatar,
										u.u_firstname AS firstname,
										u.u_lastname AS lastname
						');
						$this->db->from('meetings m');
						$this->db->join('users u', 'u.u_id = m.m_owner', 'left');

						
						//conditions WHERE, LIKE
						
						if(!empty($equal_array)){
							$this->db->where($equal_array);
						}
						
						if(!empty($like_array)){
							$this->db->like($like_array);
						}
						
						//conditions > and <
						if($startfrom!=""){
							$this->db->where('m.m_startdate >=', $startfrom); 
						}
						if($startto!=""){
							$this->db->where('m.m_startdate <=', $startto); 
						}
						if($endfrom!=""){
							$this->db->where('m.m_enddate >=', $endfrom); 
						}
						if($endto!=""){
							$this->db->where('m.m_enddate <=', $endto); 
						}
						
						
						
						
						$this->db->order_by('m.m_startdate', 'asc');

						$result=$this->db->get()->result_array();
						return $result;
					
			} //end meetingsFilter


			public function participatedMeetings($userID){
					$this->db->select('
									m.m_id,
									m.m_summary AS summary,
									m.m_avatar,
									m.m_location as location,
									m.m_startdate,
									m.m_enddate,
									u.u_id,
									u.u_firstname AS firstname,
									u.u_lastname AS lastname					
					');
					$this->db->from('participants p');
					$this->db->join('meetings m', 'm.m_id=p.p_meeting', 'left');
					$this->db->join('users u', 'u.u_id=p.p_participant', 'left');
					$this->db->where('p.p_participant', $userID);
				
					$result=$this->db->get()->result_array();
					return $result;
				
			} // end participated meetings
				
				
			public function ownedMeetings($userID){
					$this->db->select('
									m.m_id,
									m.m_summary AS summary,
									m.m_avatar,
									m.m_location as location,
									m.m_startdate,
									m.m_enddate,
									u.u_firstname AS firstname,
									u.u_lastname AS lastname
					');
					$this->db->from('meetings m');
					$this->db->join('users u', 'u.u_id = m.m_owner', 'left');
					$this->db->where('m.m_owner', $userID);
				
					$result=$this->db->get()->result_array();
					return $result;
				
			} // end owned meetings
				
				
				
				
				
				
				

			public function getLastMeetings(){
					$this->db->select('
										m.m_id,
										m.m_summary AS summary,
										m.m_location AS location,
										m.m_desc AS description,
										m.m_startdate,
										m.m_enddate,
										m.m_owner,
										m.m_avatar,
										u.u_firstname AS firstname,
										u.u_lastname AS lastname
						');
					$this->db->from('meetings m');
					$this->db->join('users u', 'u.u_id = m.m_owner', 'left');
					$this->db->order_by("m.m_id", "desc"); 
					$this->db->limit(3);
					$result=$this->db->get()->result_array();

					return $result;

			} //end get last meetings
				
				
				
				
				
				
				
			public function quickMeetingsFilter($data){
					
					
					$this->db->select('
										m.m_id,
										m.m_summary AS summary,
										m.m_location AS location,
										m.m_desc AS description,
										m.m_startdate,
										m.m_enddate,
										m.m_owner,
										m.m_avatar,
										u.u_firstname AS firstname,
										u.u_lastname AS lastname
					');
					$this->db->from('meetings m');
					$this->db->join('users u', 'u.u_id = m.m_owner', 'left');
					$this->db->like('m.m_summary', $data);
					$result=$this->db->get()->result_array();
					return $result;
		
				
			} //end quick filter
				
				
				
				
				
				
				


			public function returnMeetingDetails($meetingID){
					
					$this->db->select('
									m.*, 
									u.u_lastname, 
									u.u_firstname
					');
					$this->db->from('meetings m');
					$this->db->join('users u', 'u.u_id = m.m_owner', 'left');
					$this->db->where('m_id', $meetingID);
					
					$query = $this->db->get()->result_array();
					$result="";
					if(isset($query[0])){
						$result=$query[0];
					}
					return $result;
									
			} //end function return meeting details



			public function updateEntryInSession($sessionarray, $entry, $newvalue){
					$sessionarray[$entry]=$newvalue;
			}


			public function removeEmptyRowsFromSingleArray($arr=array()){
					$result=array();
					foreach ($arr as $key=>$value) {
						if($value !=""){
							$result[$key]=$value;
						}
					}
					return $result;

			} //end function remove array rows





			public function ReturnUsers($userString){

					$this->db->select('
									u.u_id,
									u.u_firstname,
									u.u_lastname
					');
					$this->db->from('users u');		
					$this->db->like('u_firstname', $userString);
					$this->db->or_like('u_lastname', $userString); 
					//return $result = $this->db->get()->result_array();
					return $this->db->get()->result_array();
					

			} // end returnusers function



			public function checkParticipation($meetingID, $userID){
					$this->db->select('p.p_id');
					$this->db->from('participants p');
					$this->db->where('p.p_meeting', $meetingID);
					$this->db->where('p.p_participant', $userID);
					$query=$this->db->get();
					if ($query->num_rows() > 0){
						$result=true;
					}
					else{
						$result=false;
					}
					return $result;
				
			}// end check user participation


			public function addParticipation($meetingID, $userID){
					$object=array(
						'p_meeting'		=>	$meetingID,
						'p_participant'	=>	$userID
					);
					$this->db->insert('participants', $object);
					

			} // end function addParticipation


			public function removeParticipation($meetingID, $userID){

					$this->db->where('p_meeting', $meetingID);
					$this->db->where('p_participant', $userID);
					$this->db->delete('participants');

			} //end function remove participation




			public function createArrayForUploadedFile($oldName, $folderName){
				
					$config=array();

					$config['upload_path'] = './'.$folderName;
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '30000';
					$config['max_width']  = '2000';
					$config['max_height']  = '2000';
					$config['overwrite']=true;
					$config['file_name']=time()+rand(1,100);
					//$config['encrypt_name']=true;
					
					return $config;

			} //end function create array for uploaded file


			function dimensionHandler($picture, $divW, $divH){
					$result=array();
					$info = getimagesize($picture);
					return $picture;
					
					
			} //end dimension handler



			public function createArrayForResize($path, $image, $width, $height){
				$config=array();
				//$dimensions=$this->dimensionHandler($image, $width, $height);
				$config['image_library'] = 'gd2'; 
				$config['source_image']='./'.$path.'/'.$image;
				//$config['new_image'] = ';
				//$config['create_thumb'] = TRUE; 
				$config['maintain_ratio'] = TRUE; 
				$config['width'] = $width;
				$config['height'] = $height;
				/*
				$config['max_width']  = '3000';
				$config['max_height']  = '3000';
				$config['max_size']  = '50000';
				*/
				
				
				return $config;
				

			} //end resize image function
			
			
			public function UpdateRegistrationInDB($data){
					//$data['registerValue'] should be boolean

					$result['updated']=false;
					$object=array(
						'p_registered'	=> $data['registerValue']
					);
					$this->db->where('p_meeting', $data['meetingID']);
					$this->db->where('p_participant', $data['userID']);
					$this->db->update('participants', $object);
					if($this->db->affected_rows()==1){
						$result['updated']=true;
					}
					$result['aff_rows']=$this->db->affected_rows();
					return $result;
					
					
			} //end register participation
			



			
			public function checkRegistration($userID, $meetingID){
					$this->db->select('p.p_id');
					$this->db->from('participants p');
					$this->db->where('p.p_meeting', $meetingID);
					$this->db->where('p.p_participant', $userID);
					$this->db->where('p.p_registered', '1');

					$query=$this->db->get();
					if ($query->num_rows() > 0){
						$result=true;
					}
					else{
						$result=false;
					}
					return $result;
				
				
			}// end check registration

			
			public function returnParticipants($meetingID){
				$result=array();
				$this->db->select('
								p.*,
								u.u_lastname, 
								u.u_firstname,
								u.u_email
				');
				$this->db->from('participants p');
				$this->db->join("users u", "u.u_id=p.p_participant");
				$this->db->where('p.p_meeting', $meetingID);
				$query=$this->db->get();
				if ($query->num_rows() > 0){
					$result=$query->result_array();
				}
				return $result;
			}
			
			
			public function updateMeetingInDB($data, $meetingID, $fileName){
				$object = array(
						'm_summary'		=>	$data['meeting_summary'],
						'm_location'	=>	$data['meeting_location'],
						'm_startdate'	=>	$data['meeting_startdate'],
						'm_enddate'		=>	$data['meeting_enddate'],
						'm_desc'		=>	$data['meeting_description']
				);
				
				if($fileName!=null){
						$object['m_avatar']=$fileName;
				}
				
				$this->db->where('m_id', $meetingID);
				$this->db->update('meetings', $object); 
				
			} //update meeting
			
			
			
			public function checkEmail($email){
				$result=array();
				$result["found"]=false;
				
				$this->db->select('u.*');
				$this->db->from('users u');
				$this->db->where('u.u_email', $email);
				$query = $this->db->get();
				if ($query->num_rows() > 0){
					$userInfo=$query->result_array();
					$result["found"]=true;
					$result["userInfo"]=$userInfo[0];
				}			
				return $result;
			}
			//end check user email function
			
			
			
			public function updateUserPassInDB($cryptedUserID, $data){
				$this->load->model('code_model');
				$userID=$this->code_model->decrypt($cryptedUserID);
				$object = array(
						'u_password'	=>	md5($data['updatepass_pass'])
				);
				$this->db->where('u_id', $userID);
				$this->db->update('users', $object); 			
			}
			//end update password in DB
			
			
			
			
			public function print_arr($arr){
					echo "<pre>";
					print_r($arr);
					echo "</pre>";

			} //end function print_arr
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			


} //end class