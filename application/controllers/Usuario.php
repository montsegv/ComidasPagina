<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends MY_Controller {

    // Constructor
    public function __construct()
    {
        parent::__construct();
    }
    
    // Inicio de sesión
    public function Index()
    {
        $data = array(
            'response' => $this->session->flashdata('response')
        );

        $this->load->view('Usuario/IniciarSesion', $data);
    }

    // Verifica los datos de inicio de sesión
    public function IniciarSesion()
    {
        if (
            $this->input->post('correo')
            &&
            $this->input->post('clave')
        ){
            $this->load->model('mod_usuario');
            
            $usuario = $this->mod_usuario->IniciarSesion($this->input->post('correo'), $this->input->post('clave'));
            if($usuario){

                $this->session->set_userdata(
                    'user', 
                    array(
                        'id' => $usuario->us_id,
                        'correo' => $usuario->us_correo_electronico,
                        'nombre' => $usuario->us_nombre
                    )
                );

                redirect('Usuario/Panel', 'redirect');
            }          
        }
        $this->session->set_flashdata('response', array('message' => 'El correo electrónico y/o contraseña es/son incorrecto(s)'));
       
        redirect('Usuario/Index', 'refresh');
    }

    // Cierra la sesión actual
    public function CerrarSesion()
    {
        session_destroy();

		redirect('Usuario/Index', 'refresh');
    }

    // Muestra la pantalla de panel
    public function Panel()
    {       
        $this->ValidarInicioSesion();
        
        $this->load->view('Shared/header');
            $this->load->view('Usuario/Panel');
        $this->load->view('Shared/footer');
    }

}

/* End of file Usuario.php */
