<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Mod_Ingrediente extends CI_Model {
    
        // Constructor
        public function __construct()
        {
            parent::__construct();
            $this->db->initialize();
        }

        // Obtiene el listado de ingredientes
        public function Listado($pagina)
        {
            $this->db->select('
                *,
                (
                    select
                        count(pi_id_ingrediente)
                    from
                        platillos_ingredientes
                    where
                    pi_id_ingrediente = in_id                 
                ) as totalPlatillos
            ');
            $this->db->limit(PAGINACION_REGISTROS_POR_PAGINA, $pagina);
            $query = $this->db->get("ingredientes");
    
            if ($query->num_rows() > 0) 
            {
                // var_dump($query->result_array());
                return $query->result_array();
            }    

            return false;
        }

        // Obtiene la información de un ingrediente
        public function Obtener($id)
        {
            $this->db->select('
                *,
                (
                    select
                        count(pi_id_ingrediente)
                    from
                        platillos_ingredientes
                    where
                    pi_id_ingrediente = in_id                 
                ) as totalPlatillos
            ');

            $response = 
                $this->db
                    ->from('usuarios')
                    ->where("in_id = $id")
                    ->get('ingredientes');
    
            return ($response->num_rows() > 0) ? $response->row(0) : false;
        }

        // Obtiene el total de registros de ingredientes
        public function Total()
        {
            return $this->db->count_all("ingredientes");
        }

        // ELimina un ingrediente
        public function Eliminar($id)
        {
            $response = array(
                'message' => 'No se pudo eliminar el ingrediente',
                'done' => false
            );

            $ingrediente = $this->Obtener($id);
            if ($ingrediente){
                if ($ingrediente->totalPlatillos == 0){
                    $this->db->where('in_id', $id);
                    $this->db->delete('ingredientes');

                    $response['message'] = 'Se eliminó el ingrediente';
                    $response['done'] = true;
                }else
                    $response['message'] .= ' debido a que está siendo utilizado para la preparación de platillos';
            }else
                $response['message'] = ' No existe el ingrediente que intenta eliminar';
            
            return $response;
        }

        // Guarda un ingrediente
        public function Guardar()
        {
            $response = array(
                'done' => false,
                'message' => 'Llene todos los campos solicitados'
            );

            $values = $this->input->post();
            // var_dump($values);
            
            if($this->Existe($values['in_id'], $values['in_nombre'], $values['in_unidad'])){
                $response['message'] = 'Ya existe un ingrediente con los datos que indicó';
                return $response;
            }

            if($values['in_id'] == 0){
                $this->db->insert('ingredientes', $values);
            }else{
                $this->db->where('in_id', $values['in_id']);
                $this->db->update('ingredientes', $values);
            }

            $response['message'] = 'Se guardó la información del ingrediente';
            $response['done'] = true;

            return $response;
        }
    
        // Verifica si existe un ingrediente 
        public function Existe($id, $nombre, $unidad)
        {
            $existe = 
                (
                    $this->db
                        ->where("in_nombre='".strtoupper($nombre)."' and in_unidad = '".strtoupper($unidad)."' and in_id <> '".$id."'")
                        ->get("ingredientes")->num_rows() > 0
                );

            return $existe;                
        }

    }
    
    /* End of file Mod_Ingrediente.php */
    