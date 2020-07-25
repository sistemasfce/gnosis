<?php
class ci_roles extends gnosis_ci
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
        $datos = toba::consulta_php('co_parametros')->get_roles();
        $cuadro->set_datos($datos);
    }

    function evt__cuadro__seleccion($seleccion)
    {
        $this->relacion()->cargar($seleccion);
    }

    //-----------------------------------------------------------------------------------
    //---- form -----------------------------------------------------------------------
    //-----------------------------------------------------------------------------------   
    function conf__form(gnosis_ei_formulario $form)
    {
        if ($this->relacion()->esta_cargada()) {
            $datos = $this->tabla('evt_roles')->get();            
            $form->set_datos($datos);
        }
    }


    function evt__form__alta($datos)
    {
        $this->tabla('evt_roles')->set($datos);
        $this->relacion()->sincronizar();
        $this->relacion()->resetear();
    }

    function evt__form__baja()
    {
        try {
            $this->relacion()->eliminar_todo();
        } catch (toba_error $e) {
            toba::notificacion()->agregar('No es posible eliminar el registro.');
        }
        $this->relacion()->resetear();
    }

    function evt__form__modificacion($datos)
    {
        $this->tabla('evt_roles')->set($datos);
        $this->relacion()->sincronizar();
        $this->relacion()->resetear();
    }

    function evt__form__cancelar()
    {
        $this->relacion()->resetear();
    }
}
?>