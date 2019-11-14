<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Platillo extends MY_Controller {
    
        
        public function __construct()
        {
            parent::__construct();
            
            $this->ValidarInicioSesion();
            $this->load->library('pagination');
            $this->load->model('mod_platillo');
        }
        

        // Muetsra el listado de ingredientes
        public function index()
        {
            $pagina = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $params['response'] = $this->session->flashdata('response');

            $params['registros'] = $this->mod_platillo->Listado($pagina);
            $params['totalRegistros'] = $this->mod_platillo->Total();
            if($params['registros']){                
                $config = $this->ConfigurarPaginacion(
                    base_url().'Platillo/Index',
                    $params['totalRegistros']
                );
                $this->pagination->initialize($config);
                $params["links"] = $this->pagination->create_links();
            }

            $this->load->view('Shared/header');
                $this->load->view('Platillo/Listado', $params);
            $this->load->view('Shared/footer');
        }

        // ELimina un ingrediente
        public function Eliminar($id)
        {
            $this->session->set_flashdata(
                'response', $this->mod_platillo->Eliminar($id)
            );

            redirect('Platillo/Index', 'refresh');
        }

        // Muetsra el formulario para crear op modificar un ingrediente
        public function Formulario($id = 0)
        {
            $params['response'] = $this->session->flashdata('response');
            $params['platillo'] = $this->mod_platillo->Obtener($id);
            if(!$params['platillo']){
                $params['platillo'] =  new stdClass();
                $params['platillo']->pa_id = 0;
                $params['platillo']->pa_nombre = '';
                $params['platillo']->pa_descripcion = '';
                $params['platillo']->pa_precio = '';
                $params['platillo']->pa_id_tipo_comida = '';
            }

            $this->load->view('Shared/header');
                $this->load->view('Platillo/Formulario', $params);
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
                $this->input->post('pa_nombre')
                &&
                $this->input->post('pa_descripcion')
                &&
                $this->input->post('pa_precio')
                &&
                $this->input->post('pa_id_tipo_comida')
            ){
                $response = $this->mod_platillo->Guardar();
            }

            $this->session->set_flashdata('response', $response);
            redirect('Ingrediente/Index','refresh');
        }
    
    }
    
    /* End of file Ingrediente.php */