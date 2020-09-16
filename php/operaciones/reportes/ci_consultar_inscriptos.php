<?php

require_once(toba::proyecto()->get_path_php().'/comunes.php');

class ci_consultar_inscriptos extends gnosis_ci
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
    //---- cuadro -----------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__cuadro(gnosis_ei_cuadro $cuadro)
    {
        $where = $this->dep('filtro')->get_sql_where();
        $where .= " AND evt_eventos.estado in (4,5,6)";
        $datos = toba::consulta_php('co_eventos')->get_eventos_cuadro($where);
        $cuadro->set_datos($datos);
    }

    function evt__cuadro__seleccion($seleccion)
    {
        $this->relacion()->cargar($seleccion);
        $this->set_pantalla('edicion');
    }    

    //-----------------------------------------------------------------------------------
    //---- filtro -----------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__filtro(gnosis_ei_filtro $filtro)
    {
        if (isset($this->s__filtro)) {
            $filtro->set_datos($this->s__filtro);
        }
    }

    function evt__filtro__filtrar($datos)
    {
        $this->s__filtro = $datos;
    }

    function evt__filtro__cancelar()
    {
        unset($this->s__filtro);
    }  
    
    //-----------------------------------------------------------------------------------
    //---- Eventos ----------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function evt__cancelar()
    {
        $this->dep('relacion')->resetear();
        $this->set_pantalla('seleccion');
    } 
    
   //-----------------------------------------------------------------------------------
    //---- cuadro_inscripciones ---------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__cuadro_inscriptos(gnosis_ei_cuadro $cuadro)
    {
        $aux = $this->relacion()->tabla('ins_inscripciones')->get_filas();
        $datos = array();
        $indice = 0;

        foreach($aux as $i) {
            if ($i['estado'] == comunes::ins_aceptado) {
                $dp = toba::consulta_php('co_personas')->get_datos_persona($i['persona']);
                $i['localidad'] = $dp['localidad'];
                $i['mail'] = $dp['email'];
                $datos[$indice] = $i;
                $indice++;
            }
        }
        $ordenados = rs_ordenar_por_columna($datos, 'nombre_completo');
        $cuadro->set_datos($ordenados);
    }        
}
?>