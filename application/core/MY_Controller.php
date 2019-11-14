<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class MY_Controller extends CI_Controller {
    
        // Constructor
        public function __construct()
        {
            parent::__construct();
            
            $this->load->helper('url');
            $this->load->library('carabiner');

            $this->DefineCssResources();
            $this->DefineJsResources();       
        }

        // Define los recursos css base
        public function DefineCssResources()
        {
            $this->carabiner->css(array(
                array('/libs/bootstrap/bootstrap.min.css')
            ));
        }

        // Define los recursos js base
        public function DefineJsResources()
        {
            $this->carabiner->js(array(
                array('/libs/jquery/jquery.js'),
                array('/libs/bootstrap/bootstrap.min.js'),
                array('/libs/fontawesome/all.js')
            ));
        }
        
        // Valida que exista una sesión activa
        public function ValidarInicioSesion()
        {
           if(!$this->session->has_userdata('user')){
               redirect('Usuario','refresh');
           }
        }

        // Establece la configuración de la paginación
        public function ConfigurarPaginacion($url, $totalRegistros)
        {
            
            $config['base_url'] = $url;
            $config['total_rows'] = $totalRegistros;
            $config['per_page'] = PAGINACION_REGISTROS_POR_PAGINA;
            $config["uri_segment"] = 3;

            $config['full_tag_open'] 	= '<div class="pagging text-center"><nav><ul class="pagination">';
            $config['full_tag_close'] 	= '</ul></nav></div>';

            $config['num_tag_open'] 	= '<li class="page-item">';
            $config['num_tag_close'] 	= '</li>';

            $config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';

            $config['next_tag_open'] 	= '<li class="page-item">';
            $config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></li>';

            $config['prev_tag_open'] 	= '<li class="page-item">';
            $config['prev_tagl_close'] 	= '</li>';

            // $config['first_tag_open'] 	= '<li class="page-item">';
            // $config['first_tagl_close'] = '</li>';

            // $config['last_tag_open'] 	= '<li class="page-item">';
            // $config['last_tagl_close'] 	= '</li>';

            $config['first_link'] = false;
            $config['last_link'] = false;

            $config['attributes'] = array('class' => 'page-link');

            return $config;
        }
    
    }
    
    /* End of file MY_Controller.php */
    