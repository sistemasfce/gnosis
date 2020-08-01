<?php

require_once(toba::proyecto()->get_path_php().'/comunes.php');

class ci_consultar_cuestionarios extends gnosis_ci
{
    //-----------------------------------------------------------------------------------
    //---- cuadro -----------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__cuadro(gnosis_ei_cuadro $cuadro)
    {
        $where = 'evt_eventos.estado = '. comunes::evt_finalizado;
        $datos = toba::consulta_php('co_eventos')->get_eventos_cuestionarios($where);
        $cuadro->set_datos($datos);
    }

        
    function evt__cuadro__seleccion($seleccion)
    {
        toba::memoria()->set_dato('evento',$seleccion['evento']);
    }
    
    function conf__cuadro_resp(gnosis_ei_cuadro $cuadro)
    {
        $evento = toba::memoria()->get_dato('evento');
        if (isset($evento)) {
            $datos = toba::consulta_php('co_eventos')->get_respuestas_cuestionarios($evento);
            $cuadro->set_datos($datos);
        }
    }    
   
    
}