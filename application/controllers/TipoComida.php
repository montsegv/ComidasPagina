<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class TipoComida extends MY_Controller {
    

        public function __construct()
        {
            parent::__construct();
            
            $this->ValidarInicioSesion();
            $this->load->library('pagination');
            $this->load->model('mod_tipocomida');
        }

        // Muestra el listado de tipos de comida
        public function Listado()
        {
            $pagina = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $params['response'] = $this->session->flashdata('response');

            $this->carabiner->js(array(
                array('/plugins/confirm/jquery-confirm.min.js'),
                array('/views/tiposcomida/listado.js')
            ));

            $this->carabiner->css(array(
                array('/plugins/confirm/jquery-confirm.min.css')
            ));

            $params['registros'] = $this->mod_tipocomida->Listado($pagina);
            $params['totalRegistros'] = $this->mod_tipocomida->Total();
            if($params['registros']){                
                $config = $this->ConfigurarPaginacion(
                    base_url().'TipoComida/Listado',
                    $params['totalRegistros']
                );
                $this->pagination->initialize($config);
                $params["links"] = $this->pagination->create_links();
            }

            $this->load->view('Shared/header');
                $this->load->view('TipoComida/Listado', $params);
            $this->load->view('Shared/footer');
        }

         // ELimina un ingrediente
         public function Eliminar($id)
         {
             $this->session->set_flashdata(
                 'response', $this->mod_tipocomida->Eliminar($id)
             );
 
             redirect('TipoComida/Listado', 'refresh');
         }
 
         // Muetsra el formulario para crear op modificar un ingrediente
         public function Formulario($id = 0)
         {
             $params['response'] = $this->session->flashdata('response');
             $params['tipo'] = $this->mod_tipocomida->Obtener($id);
             if(!$params['tipo']){
                 $params['tipo'] =  new stdClass();
                 $params['tipo']->ti_id = 0;
                 $params['tipo']->ti_tipo_comida = '';
             }
 
             $this->load->view('Shared/header');
                 $this->load->view('TipoComida/Formulario', $params);
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
                 $this->input->post('ti_tipo_comida')
             ){
                 $response = $this->mod_tipocomida->Guardar();
             }
 
             $this->session->set_flashdata('response', $response);
            redirect('TipoComida/Listado','refresh');
         }
    
    }
    
    /* End of file Comida.php */
    