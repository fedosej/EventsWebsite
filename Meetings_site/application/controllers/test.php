<?php

class Test extends CI_Controller{
		




		public function index(){
			
			/*
			$this->load->library('ciqrcode');
			//header("Content-Type: image/png");
			//header('Content-Type: text/html; charset=utf-8');
			$params['data'] = 'This is a text to encode become QR Code';
			$image=$this->ciqrcode->generate($params);

			echo 'this is image'.$image;
			*/
			echo base_url().'avatars/';
			//echo time();

			echo "<br>";

			echo md5('abcde');

			//http://localhost/Meetings_site/avatars/

			
			
		}


		public function testCharacters(){
			$this->load->view('draft');

		}

		public function showArray(){
			print_r($this->input->get());
		}

} //end class