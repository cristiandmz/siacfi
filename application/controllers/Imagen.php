<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Imagen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Asignacion_model");
        $this->load->library('session');
        $this->load->helper('url_helper');
        // $this->load->helper('vayes_helper');
        $this->load->library('phpqrcode/qrlib');
        $this->load->helper('url');
        //$this->load->model("rol_model");

    }

    public function index()
    {
        if ($this->session->userdata("login")) {

            redirect(base_url() . "asignacion/nuevo");
        } else {
            redirect(base_url());
        }
    }
    public function reducirImagen()
    {
      $rutaImagenOriginal = './public/assets/images/activos/630.jpg';
        # La abrimos como un recurso. Nota: uso imagecreatefromjpeg porque es una JPEG, si fuera
        # una PNG, usa imagecreatefrompng
        $imagenOriginal = imagecreatefromjpeg($rutaImagenOriginal);

        $calidad = 5; // Valor entre 0 y 100. Mayor calidad, mayor peso
        header("Content-Type: image/jpeg");
        imagejpeg($imagenOriginal, null, $calidad);           
        
    }  
    public function reducirImagenDos()
    {
      // $rutaImagenOriginal = './public/assets/images/activos/630.jpg';
      $image = new Imagick('./public/assets/images/activos/630.jpg');
      $image->cropThumbnailImage(ancho[600],alto[400]);
      $image->writeImage( './public/assets/images/activos/630.jpg' );         
        
    }
   
}
