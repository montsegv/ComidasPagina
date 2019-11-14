<?php

    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Mod_TipoComida extends CI_Model {
    
          // Constructor
          public function __construct()
          {
              parent::__construct();
              $this->db->initialize();
          }
  
          // Obtiene el listado de tipos de comidas
          public function Listado($pagina)
          {
              $this->db->select('
                  *,
                  (
                      select
                          count(pa_id)
                      from
                          platillos
                      where
                        ti_id = pa_id_tipo_comida               
                  ) as totalPlatillos
              ');
              $this->db
                ->limit(PAGINACION_REGISTROS_POR_PAGINA, $pagina)
                ->order_by('ti_tipo_comida');
              $query = $this->db->get("tipos_comidas");
      
              if ($query->num_rows() > 0) 
              {
                  // var_dump($query->result_array());
                  return $query->result_array();
              }    
  
              return false;
          }
  
          // Obtiene la información de un tipo de comida
          public function Obtener($id)
          {
              $this->db->select('
                    *,
                    (
                        select
                            count(pa_id)
                        from
                            platillos
                        where
                            ti_id = pa_id_tipo_comida               
                    ) as totalPlatillos
              ');
  
              $response = 
                  $this->db
                      ->where("ti_id = $id")
                      ->get('tipos_comidas');
      
              return ($response->num_rows() > 0) ? $response->row(0) : false;
          }
  
          // Obtiene el total de tipos de comidas
          public function Total()
          {
              return $this->db->count_all("tipos_comidas");
          }
  
          // ELimina un tipo de comida
          public function Eliminar($id)
          {
              $response = array(
                  'message' => 'No se pudo eliminar el tipo de comida',
                  'done' => false
              );
  
              $tipos = $this->Obtener($id);
              if ($tipos){
                  if ($tipos->totalPlatillos == 0){
                      $this->db->where('ti_id', $id);
                      $this->db->delete('tipos_comidas');
  
                      $response['message'] = 'Se eliminó el tipo de comida';
                      $response['done'] = true;
                  }else
                      $response['message'] .= ' debido a que está siendo utilizado por un platillo';
              }else
                  $response['message'] = ' No existe el tipo de comida que intenta eliminar';
              
              return $response;
          }
  
          // Guarda un tipo
          public function Guardar()
          {
              $response = array(
                  'done' => false,
                  'message' => 'Llene todos los campos solicitados'
              );
  
              $values = $this->input->post();
              // var_dump($values);
              
              if($this->Existe($values['ti_id'], $values['ti_tipo_comida'])){
                  $response['message'] = 'Ya existe un tipo de comida con los datos que indicó';
                  return $response;
              }

              $values['ti_tipo_comida'] = strtoupper($values['ti_tipo_comida']);
  
              if($values['ti_id'] == 0){
                  $this->db->insert('tipos_comidas', $values);
              }else{
                  $this->db->where('ti_id', $values['ti_id']);
                  $this->db->update('tipos_comidas', $values);
              }
  
              $response['message'] = 'Se guardó la información del tipo de comida';
              $response['done'] = true;
  
              return $response;
          }
      
          // Verifica si existe un tipo 
          public function Existe($id, $nombre)
          {
              $existe = 
                  (
                      $this->db
                          ->where("ti_tipo_comida='".strtoupper($nombre)."' and ti_id <> '".$id."'")
                          ->get("tipos_comidas")->num_rows() > 0
                  );
  
              return $existe;                
          }
    
    }
    
    /* End of file Mod_Comida.php */
    