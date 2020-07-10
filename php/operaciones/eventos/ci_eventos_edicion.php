<?php

class ci_eventos_edicion extends gnosis_ci
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
    //---- form -------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form(gnosis_ei_formulario $form)
    {
        if ($this->relacion()->esta_cargada()) {
            $datos = $this->tabla('evt_eventos')->get();
            $form->set_datos($datos);
        }
    }
    
    function evt__form__modificacion($datos)
    {
        $this->tabla('evt_eventos')->set($datos);
    }

    //-----------------------------------------------------------------------------------
    //---- form_ml_disertantes ----------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_ml_disertantes(gnosis_ei_formulario_ml $form_ml)
    {
        if ($this->relacion()->esta_cargada()) {
            $datos = $this->tabla('evt_eventos_disertantes')->get_filas();
            $form_ml->set_datos($datos);            
        }
    }

    //-----------------------------------------------------------------------------------
    function evt__form_ml_disertantes__modificacion($datos)
    {
        $this->tabla('evt_eventos_disertantes')->procesar_filas($datos);
    }

    //-----------------------------------------------------------------------------------
    //---- form_ml_instituciones --------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_ml_instituciones(gnosis_ei_formulario_ml $form_ml)
    {
        if ($this->relacion()->esta_cargada()) {
            $datos = $this->tabla('evt_eventos_instituciones')->get_filas();
            $form_ml->set_datos($datos);
        }
    }

    //-----------------------------------------------------------------------------------
    function evt__form_ml_instituciones__modificacion($datos)
    {
        $this->tabla('evt_eventos_instituciones')->procesar_filas($datos);
    }

    //-----------------------------------------------------------------------------------
    //---- form_ml_aranceles ---------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_ml_aranceles(gnosis_ei_formulario_ml $form_ml)
    {
        if ($this->relacion()->esta_cargada()) {
            $datos = $this->tabla('evt_eventos_aranceles')->get_filas();
            $form_ml->set_datos($datos);            
        }        
    }

    //-----------------------------------------------------------------------------------
    function evt__form_ml_aranceles__modificacion($datos)
    {
        $this->tabla('evt_eventos_aranceles')->procesar_filas($datos);
    }
}