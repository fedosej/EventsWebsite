<?php
class Code_model extends CI_Model {

	private $key="linkkey";

	
	
	function encrypt($data){
		return openssl_encrypt($data, 'AES-128-CBC', $this->key,0,'fgrgfvcfghtfdrfg');
	}

	function decrypt($data){
		return openssl_decrypt($data, 'AES-128-CBC', $this->key,0,'fgrgfvcfghtfdrfg');
	}


} //end class