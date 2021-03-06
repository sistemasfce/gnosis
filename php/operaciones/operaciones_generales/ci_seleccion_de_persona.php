<?php
class ci_seleccion_de_persona extends gnosis_ci
{
    protected $s__filtro;
    protected $s__datos;

    function get_datos($filtro)
    {
        return toba::consulta_php('co_operaciones_generales')->get_listado_personas($filtro);
    }
	
   //---- cuadro de Localidades ---------------------------------------------------------

    function conf__cuadro(toba_ei_cuadro $cuadro)
    {
        $cuadro->desactivar_modo_clave_segura();
        if (isset($this->s__filtro)) {
            $where = $this->dep('filtro')->get_sql_where();
            $datos = $this->get_datos($where);
            $cuadro->set_datos($datos);
        }
    }

    //---- formulario de localidades ----------------------------------------------------

    function conf__filtro(gnosis_ei_filtro $filtro)
    {
        if (isset($this->s__datos)) {
            $filtro->set_datos($this->s__datos);
        }        
    }

    function evt__filtro__filtrar($datos)
    {
        if (isset($datos)) {
            $this->s__filtro = $datos;
        } else {
            unset($this->s__datos);
            $this->s__filtro = "";
        }
    }

    function evt__filtro__cancelar()
    {
        unset($this->s__datos);
        unset($this->s__filtro);
    }
}
?>