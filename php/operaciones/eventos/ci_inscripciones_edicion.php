<?php

class ci_inscripciones_edicion extends gnosis_ci
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

    function conf__cuadro_pre_inscrip(gnosis_ei_cuadro $cuadro)
    {
        $datos = $this->tabla('ins_inscripciones')->get_filas();
        $aux = array();
        foreach ($datos as $i) {
            if ($i['estado_desc'] == 'Aceptado') {
                $i['imagen'] = toba_recurso::imagen_toba('tilde.gif', true);
            } else {
                if ($i['estado_desc'] == 'Rechazado') {
                    $i['imagen'] = toba_recurso::imagen_toba('error.gif', true);
                } else {
                    $i['imagen'] = toba_recurso::imagen_toba('vacio.png', true);
                }
            }
            $aux[] = $i;
        }
        $cuadro->set_datos($aux);
    }
  
    function evt__cuadro_pre_inscrip__seleccion($seleccion)
    {
        $this->relacion()->tabla('ins_inscripciones')->set_cursor($seleccion);
    }

    function evt__cuadro_pre_inscrip__marcar($datos)
    {
        toba::memoria()->set_dato_operacion('cambiar_todos',$datos);
    }

    function evt__cuadro_pre_inscrip__cambiar_todos($datos)
    {
        $datos_a_cambiar = toba::memoria()->get_dato_operacion('cambiar_todos');
        foreach ($datos_a_cambiar as $dat) {
            $this->relacion()->tabla('ins_inscripciones')->set_cursor($dat['x_dbr_clave']);
            $persona = $this->relacion()->tabla('ins_inscripciones')->get();
            $persona['apex_ei_analisis_fila'] = 'M';
            $persona['fecha_inscripcion'] = date('Y-m-d');
            $persona['estado'] = 2;
            $aux[] = $persona;
            $this->relacion()->tabla('ins_inscripciones')->resetear_cursor();
        }
        $this->relacion()->tabla('ins_inscripciones')->procesar_filas($aux);
    }   
    
    //-----------------------------------------------------------------------------------
    //---- form_pre_inscripciones -------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_pre_inscrip(gnosis_ei_formulario $form)
    {
        if ($this->relacion()->tabla('ins_inscripciones')->hay_cursor()) {
            $form->set_datos($this->relacion()->tabla('ins_inscripciones')->get());
        }
    }

    //-------------------------------------------------------------------------
    function evt__form_pre_inscrip__alta($datos)
    {
        $this->relacion()->tabla('ins_inscripciones')->nueva_fila($datos);
        #$this->enviar_mail($datos);
    }
    
    //-------------------------------------------------------------------------
    function evt__form_pre_inscrip__baja()
    {
        $this->relacion()->tabla('ins_inscripciones')->set(null);
    }

    //-------------------------------------------------------------------------
    function evt__form_pre_inscrip__modificacion($datos)
    {
        $this->relacion()->tabla('ins_inscripciones')->set($datos);
        #$this->enviar_mail($datos);
        $this->evt__form_pre_inscripciones__cancelar();
    }

    //-------------------------------------------------------------------------
    function evt__form_pre_inscrip__cancelar()
    {
        $this->relacion()->tabla('ins_inscripciones')->resetear_cursor();
    }    
    
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------    
    function enviar_mail($datos)
    {
        $curso = $this->tabla('evt_eventos')->get();
        $mail_destino = toba::consulta_php('co_personas')->get_mail($datos['persona']);

        // si el estado es aceptado mando el mail
        if($datos['estado'] == 2) {
            $asunto = $curso['mail_asunto'];
            $cuerpo_mail = '<p>'.$curso['mail_cuerpo'].'</p>';

            $mail = new toba_mail($mail_destino['mail'], $asunto, $cuerpo_mail);
            $mail->set_html(true);
            $mail->enviar();
        }
    }
    
}    