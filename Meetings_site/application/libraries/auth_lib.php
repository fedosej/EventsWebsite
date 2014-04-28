<?php


class Auth_lib{

		
	private $ci;
    
    public function __construct(){
		$this -> ci =& get_instance();
    }
	
	
	public function checkLogined(){
	
			$x = $this -> ci -> session -> userdata('logined');
			
			print_r($x);
			if($x){
				echo "Zaloginen";
			}else{
				echo "Redirect na formu logina";
				
				//redirect();
			}
			
			
	}
    
    private $redirects = array(
		'user' => 'userController',
		'teacher' => 'teacherController',
		'admin' => 'adminController'
    );
    
    public function checkAccess($allowed){
		$userStatus = 'user';
		//1. $userID = Get from cookie or session user ID
		//2. $userStatus = Get user status form DB using $userID
		if(!in_array($userStatus, $allowed)){
			echo "Nuzen redirect na: ".$this->redirects[$userStatus];
		}
	
    }




} //end class