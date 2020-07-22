<?php
class ci_consultar_eventos extends gnosis_ci
{
    protected $s__filtro;

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
    //---- cuadro_des ------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__cuadro(gnosis_ei_cuadro $cuadro)
    {    
        $where = $this->dep('filtro')->get_sql_where();
        $datos = toba::consulta_php('co_eventos')->get_eventos($where);
        $cuadro->set_datos($datos);
    }

    //-----------------------------------------------------------------------------------
    //---- filtro -----------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__filtro(gnosis_ei_filtro $filtro)
    {
        if (isset($this->s__filtro)) {
                $filtro->set_datos($this->s__filtro);
        }
        //$filtro->columna('desde')->set_condicion_fija('entre');
    }

    function evt__filtro__filtrar($datos)
    {
        $this->s__filtro = $datos;
    }

    function evt__filtro__cancelar()
    {
        unset($this->s__filtro);
    }              
}