<?php
class ci_personas_edicion extends gnosis_ci
{
    //-------------------------------------------------------------------------
    function relacion()
    {
        return $this->controlador->dep('relacion');
    }

    //-------------------------------------------------------------------------
    function tabla($id)
    {
        return $this->controlador->dep('relacion')->tabla($id);    
    }
    
    //-----------------------------------------------------------------------------------
    //---- Configuraciones --------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__personas_eventos_as()
    {   
        if (!$this->relacion()->tabla('ins_inscripciones')->hay_cursor()) {
            $this->pantalla('personas_eventos_as')->eliminar_dep('cuestionario');
        } 
    }    
    
    //-----------------------------------------------------------------------------------
    //---- cuadro_eventos_as ------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__cuadro_eventos_as(gnosis_ei_cuadro $cuadro)
    {
        $datos = $this->relacion()->tabla('ins_inscripciones')->get_filas();
        toba::memoria()->set_dato('evento',$datos);
        $cuadro->set_datos($datos);
    }

    //-----------------------------------------------------------------------------------
    function evt__cuadro_eventos_as__cuestionario($seleccion)
    {
        toba::memoria()->set_dato('fila',$seleccion);
        $this->relacion()->tabla('ins_inscripciones')->set_cursor($seleccion);
        $this->pantalla('personas_eventos_as')->agregar_dep('cuestionario');
    }   
    
    function conf_evt__cuadro_eventos_as__cuestionario(toba_evento_usuario $evento, $fila)
    {
        $datos = toba::memoria()->get_dato('evento');
        if ($datos[$fila]['debe_cuestionario'] == 'N') {
            $evento->desactivar(); 
        }
        else {
            $evento->activar();  
        }  
    }  
    
    function conf_evt__cuadro_eventos_as__certificado(toba_evento_usuario $evento, $fila)
    {
        $datos = toba::memoria()->get_dato('evento');
        if ($datos[$fila]['debe_cuestionario'] == 'S') {
            $evento->desactivar(); 
        }
        else {
            $evento->activar();  
        }  
    }   
    //-----------------------------------------------------------------------------------
    //---- cuadro_eventos_dic -----------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__cuadro_eventos_dic(gnosis_ei_cuadro $cuadro)
    {
        $datos = $this->relacion()->tabla('evt_eventos_disertantes')->get_filas();
        $cuadro->set_datos($datos);
    }

    function evt__cuadro_eventos_dic__seleccion($seleccion)
    {
        $this->relacion()->tabla('evt_eventos_disertantes')->set_cursor($seleccion);
    }    
}