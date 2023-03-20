<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Pdf_test extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
      
        $this->load->library('session');
      
        
        

    }
   public function index(){
        $this->load->view('user_list');
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));
     
  }
}
