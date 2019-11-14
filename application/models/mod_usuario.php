<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Mod_Usuario extends CI_Model {
    
        // Constructor
        public function __construct()
        {
            parent::__construct();

            $this->db->initialize();
        }

        // Valida que exista un usuario con los datos de inicio de sesión indicados
        public function IniciarSesion($correoElectronico, $clave)
        {            			
            $response = 
                $this->db
                    ->select('*')
                    ->from('usuarios')
                    ->where("us_correo_electronico = '".$correoElectronico."'")
                    ->where("us_clave = '".$clave."'")
                    ->get();

            return ($response->num_rows() > 0) ? $response->row(0) : false;
        }
        
    
    }
    
    /* End of file Mod_Usuario.php */
    