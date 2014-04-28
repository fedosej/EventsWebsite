<?php
class Display {

	private $CI;

	public function __construct(){
		$this -> CI =& get_instance();
	}

	public function show($filename, $data=array()){
		//$data['filename']=$filename;
		$this->CI->load->view('common_views/01 preheader', $data);
		$this->CI->load->view('common_views/02 header', $data);
		$this->CI->load->view('pages/'.$filename, $data);
		$this->CI->load->view('common_views/03 footer', $data);
	}

}