<?php
class ci_cuestionario extends gnosis_ci
{
    //-------------------------------------------------------------------------
    function relacion()
    {
        #return $this->controlador->dep('relacion');
        return $this->controlador()->controlador->dep('relacion');
    }
    //-------------------------------------------------------------------------
    function tabla($id)
    {
        return $this->controlador()->controlador->dep('relacion')->tabla($id);    
    }

    //-----------------------------------------------------------------------------------
    //---- Eventos ----------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function evt__procesar()
    {
        $id_fila = toba::memoria()->get_dato('fila');
        $datos = $this->relacion()->tabla('ins_inscripciones')->get();
        $datos['debe_cuestionario'] = 'N';
        $this->tabla('ins_inscripciones')->modificar_fila($id_fila, $datos);
        $this->tabla('ins_inscripciones')->sincronizar();
        $resp = $this->tabla('ins_cuestionarios_respuestas')->get();
        $resp['persona'] = $datos['persona'];
        $resp['evento'] = $datos['evento'];
        $resp['inscripcion'] = $datos['inscripcion'];
        $this->tabla('ins_cuestionarios_respuestas')->set($resp);
        $this->tabla('ins_cuestionarios_respuestas')->sincronizar();
        
        $this->relacion()->tabla('ins_inscripciones')->resetear_cursor();
        $this->controlador()->controlador->set_pantalla('eventos_as');
    }

    //-----------------------------------------------------------------------------------
    //---- form_cuestionario ------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_cuestionario(gnosis_ei_formulario $form)
    {
        $datos = $this->tabla('ins_cuestionarios_respuestas')->get();
        $form->set_datos($datos);
    }

    function evt__form_cuestionario__modificacion($datos)
    {
        $this->tabla('ins_cuestionarios_respuestas')->set($datos);
    }

    //-----------------------------------------------------------------------------------
    //---- form_cuestionario_2 ----------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_cuestionario_2(gnosis_ei_formulario $form)
    {
        $datos = $this->tabla('ins_cuestionarios_respuestas')->get();
        $form->set_datos($datos);
    }

    function evt__form_cuestionario_2__modificacion($datos)
    {
        $this->tabla('ins_cuestionarios_respuestas')->set($datos);
    }

    //-----------------------------------------------------------------------------------
    //---- form_cuestionario_3 ----------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_cuestionario_3(gnosis_ei_formulario $form)
    {
        $datos = $this->tabla('ins_cuestionarios_respuestas')->get();
        $form->set_datos($datos);
    }

    function evt__form_cuestionario_3__modificacion($datos)
    {
        $this->tabla('ins_cuestionarios_respuestas')->set($datos);
    }

    //-----------------------------------------------------------------------------------
    //---- form_cuestionario_4 ----------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_cuestionario_4(gnosis_ei_formulario $form)
    {
        $datos = $this->tabla('ins_cuestionarios_respuestas')->get();
        $form->set_datos($datos);
    }

    function evt__form_cuestionario_4__modificacion($datos)
    {
        $this->tabla('ins_cuestionarios_respuestas')->set($datos);
    }

    //-----------------------------------------------------------------------------------
    //---- form_cuestionario_5 ----------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_cuestionario_5(gnosis_ei_formulario $form)
    {
        $datos = $this->tabla('ins_cuestionarios_respuestas')->get();
        $form->set_datos($datos);
    }

    function evt__form_cuestionario_5__modificacion($datos)
    {
        $this->tabla('ins_cuestionarios_respuestas')->set($datos);
    }
}
?>