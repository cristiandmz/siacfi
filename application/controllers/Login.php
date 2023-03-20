<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Usuario_model");		
		$this->load->library('session');
	}

	public function index()
	{				
		if($this->session->userdata("login"))
		{	
			redirect(base_url()."Dashboard");
		}
		else{
			$this->load->view('login/login');	
		}		
	}

	
	public function login()
	{			
		$usuario = $this->input->post("usuario");
		$contrasenia = $this->input->post("contrasenia");
		$contrasenia = md5($contrasenia);
		// var_dump($contrasenia);exit();
		$res = $this->Usuario_model->login($usuario, $contrasenia);
		if (!$res) {
			redirect(base_url());
		}
		else{
			$data = array(				
				'usuario' => $res->usuario,
				'rol'=>$res->rol_id,
				'persona_id'=>$res->persona_id,				
				'imgUser'=>$res->img,
				'login' => TRUE
			);
			$this->session->set_userdata($data);
			redirect(base_url()."Dashboard");		
			//$this->load->view('welcome_message');	
		}
	}


	public function logout()
	{
		$this->session->sess_destroy();		
		redirect(base_url());
	}

}

