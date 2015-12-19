<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modepaiement extends CI_Controller {

	function __construct()
	{
		parent::__construct();
  
		
	}

 public function index()
 {

$data = array(
'title'=>"bienvenue",
'content'=>'article/modepaiement',

	);
$this->load->view('template/content',$data);
 }
 


}
