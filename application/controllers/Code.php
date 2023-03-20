<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Code extends CI_Controller {

	public function index()
	{
		//I'm just using rand() function for data example
		$temp = rand(10000, 99999);
		$this->set_barcode('RYNV-947-3-00001');
	}
	
	private function set_barcode($code)
	{
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		//Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
	   

	   $file = Zend_Barcode::draw('code39', 'image', array('text' => $code), array());
	   $code = time().$code;
	   $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/AF/barcode/';
	   $name='10';
	   $store_image = imagepng($file,$SERVERFILEPATH.$name.".png");
	   //return $code.'.png';
	   redirect(base_url());
	}
	
}