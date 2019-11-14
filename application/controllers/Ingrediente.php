<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Ingrediente extends MY_Controller {
    
        
        public function __construct()
        {
            parent::__construct();
            
            $this->ValidarInicioSesion();
            $this->load->library('pagination');
            $this->load->model('mod_ingrediente');
        }
        

        // Muetsra el listado de ingredientes
        public function index()
        {
            $pagina = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $params['response'] = $this->session->flashdata('response');

            $params['registros'] = $this->mod_ingrediente->Listado($pagina);
            $params['totalRegistros'] = $this->mod_ingrediente->Total();
            if($params['registros']){                
                $config = $this->ConfigurarPaginacion(
                    base_url().'Ingrediente/Index',
                    $params['totalRegistros']
                );
                $this->pagination->initialize($config);
                $params["links"] = $this->pagination->create_links();
            }

            $this->load->view('Shared/header');
                $this->load->view('Ingrediente/Listado', $params);
            $this->load->view('Shared/footer');
        }

        // ELimina un ingrediente
        public function Eliminar($id)
        {
            $this->session->set_flashdata(
                'response', $this->mod_ingrediente->Eliminar($id)
            );

            redirect('Ingrediente/Index', 'refresh');
        }

        // Muetsra el formulario para crear op modificar un ingrediente
        public function Formulario($id = 0)
        {
            $params['response'] = $this->session->flashdata('response');
            $params['ingrediente'] = $this->mod_ingrediente->Obtener($id);
            if(!$params['ingrediente']){
                $params['ingrediente'] =  new stdClass();
                $params['ingrediente']->in_id = 0;
                $params['ingrediente']->in_nombre = '';
                $params['ingrediente']->in_unidad = '';
            }

            $this->load->view('Shared/header');
                $this->load->view('Ingrediente/Formulario', $params);
            $this->load->view('Shared/footer');
        }

        // Guarda la información de un ingrediente
        public function Guardar()
        {
            $response = array(
                'done' => false,
                'message' => 'Llene todos los campos solicitados'
            );

            if (
                $this->input->post('in_nombre')
                &&
                $this->input->post('in_unidad')
            ){
                $response = $this->mod_ingrediente->Guardar();
            }

            $this->session->set_flashdata('response', $response);
            redirect('Ingrediente/Index','refresh');
        }
    
    }
    
    /* End of file Ingrediente.php */
    