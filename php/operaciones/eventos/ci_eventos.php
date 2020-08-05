<?php

class ci_eventos extends gnosis_ci
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

    function evt__agregar()
    {
        $this->set_pantalla('edicion');
    }

    function evt__cancelar()
    {
        $this->dep('relacion')->resetear();
        $this->set_pantalla('seleccion');
    }

    function evt__eliminar()
    {
        try {
            $this->dep('relacion')->eliminar_todo();
            $this->set_pantalla('seleccion');
        } catch (toba_error $e) {
            toba::notificacion()->agregar('No es posible eliminar el registro.');
        }
    }

    function evt__guardar()
    {
        try {
            $this->dep('relacion')->sincronizar();
            $this->dep('relacion')->resetear();
        } catch (toba_error $e) {
            $this->informar_msg('Error al dar de alta el evento - '. $e->get_mensaje());
            return;
        }  

        $this->set_pantalla('seleccion');
    }
}
?>