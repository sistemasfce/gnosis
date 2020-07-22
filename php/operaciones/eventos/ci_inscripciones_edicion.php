<?php

require_once(toba::proyecto()->get_path_php().'/comunes.php');

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
    //---- Configuraciones --------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__inscripciones()
    {    
        $datos = $this->tabla('evt_eventos')->get();
        if ($datos['estado'] == comunes::evt_en_insc) {
                $this->pantalla()->tab('certificados')->ocultar();
                $this->pantalla()->tab('asistencia')->ocultar();
        }        
    }
 
    function conf__pre_inscripciones()
    {    
        $datos = $this->tabla('evt_eventos')->get();
        if ($datos['estado'] == comunes::evt_en_insc) {
                $this->pantalla()->tab('certificados')->ocultar();
                $this->pantalla()->tab('asistencia')->ocultar();
        }        
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
            $persona['estado'] = comunes::ins_aceptado;
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
        $curso = $this->tabla('evt_eventos')->get();
        $mail_destino = toba::consulta_php('co_personas')->get_mail($datos['persona']);

        // si el estado es aceptado mando el mail
        if($datos['estado'] == comunes::ins_aceptado) {
            $asunto = $curso['mail_asunto'];
            $cuerpo_mail = '<p>'.$curso['mail_cuerpo'].'</p>';
            $this->enviar_mail($mail_destino['mail'], $asunto, $cuerpo_mail);
        }
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
        $curso = $this->tabla('evt_eventos')->get();
        $mail_destino = toba::consulta_php('co_personas')->get_mail($datos['persona']);

        // si el estado es aceptado mando el mail
        if($datos['estado'] == comunes::ins_aceptado) {
            $asunto = $curso['mail_asunto'];
            $cuerpo_mail = '<p>'.$curso['mail_cuerpo'].'</p>';
            $this->enviar_mail($mail_destino['mail'], $asunto, $cuerpo_mail);
        }
        $this->evt__form_pre_inscrip__cancelar();
    }

    //-------------------------------------------------------------------------
    function evt__form_pre_inscrip__cancelar()
    {
        $this->relacion()->tabla('ins_inscripciones')->resetear_cursor();
    }    

    //-----------------------------------------------------------------------------------
    //---- form_pre_inscripciones_imp ---------------------------------------------------
    //-----------------------------------------------------------------------------------

    function evt__form_pre_inscrip_imp__importar($datos)
    {
        $preins = toba::consulta_php('co_eventos')->get_inscripciones_evento($datos['evento']);
        $curso_actual = $this->relacion()->tabla('evt_eventos')->get();

        foreach($preins as $pr) {
            $pr['evento'] = $curso_actual['evento'];
            $pr['fecha_inscripcion'] = date('Y-m-d');
            $pr['estado'] = comunes::ins_pendiente;
            $pr['inscripcion'] = null;
            $this->relacion()->tabla('ins_inscripciones')->nueva_fila($pr);
        }
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
                $i['mail'] = $dp['mail'];
                $datos[$indice] = $i;
                $indice++;
            }
        }
        $ordenados = rs_ordenar_por_columna($datos, 'nombre_completo');
        $cuadro->set_datos($ordenados);
    }    
    
    //-----------------------------------------------------------------------------------
    //---- form_ml_certificados ---------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_ml_certificados(gnosis_ei_formulario_ml $form_ml)
    {    
        $datos = $this->tabla('ins_inscripciones')->get_filas();
        $aux = array();
        foreach ($datos as $d) {
            if ($d['estado'] == comunes::ins_aceptado) {
                $d['fecha_inscripcion'] = $this->cambiarFormatoFecha($d['fecha_inscripcion']);
                $aux[] = $d;
            }
        }
        $ordenados = rs_ordenar_por_columna($aux, 'nombre_completo');
        $form_ml->set_datos($ordenados);
    }

    //-------------------------------------------------------------------------
    //-------------------------------------------------------------------------
    function evt__form_ml_certificados__modificacion($datos)
    {
        $this->tabla('ins_inscripciones')->procesar_filas($datos);
    }

    //-----------------------------------------------------------------------------------
    //---- cuadro_encuentros ------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__cuadro_encuentros(gnosis_ei_cuadro $cuadro)
    {
        $datos = $this->relacion()->tabla('evt_eventos_encuentros')->get_filas();
        $cuadro->set_datos($datos);
    }
    
    function evt__cuadro_encuentros__seleccion($seleccion)
    {
        $this->tabla('evt_eventos_encuentros')->set_cursor($seleccion);
    }
 
    //-----------------------------------------------------------------------------------
    //---- form_ml_certificados ---------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_ml_asistencia(gnosis_ei_formulario_ml $form_ml)
    {    
        $datos = $this->tabla('ins_asistencias')->get_filas();
        $ordenados = rs_ordenar_por_columna($datos, 'nombre_completo');
        $form_ml->set_datos($ordenados);
    }

    //-------------------------------------------------------------------------
    //-------------------------------------------------------------------------
    function evt__form_ml_asistencia__modificacion($datos)
    {
        $this->tabla('ins_asistencias')->procesar_filas($datos);
    }

    function evt__form_ml_asistencia__agregar($datos)
    {
        if ($this->tabla('evt_eventos_encuentros')->hay_cursor()) {
            $encuentro =$this->tabla('evt_eventos_encuentros')->get();
            $ins = $this->tabla('ins_inscripciones')->get_filas();
            $asistencia = $this->tabla('ins_asistencias')->get_filas();
            $cargado = 0;
            foreach($ins as $per) {
                // me fijo si fue cargado previamente
                foreach($asistencia as $asis) {
                    if ($per['inscripcion'] == $asis['inscripcion']) {
                        $cargado = 1;
                    }
                }
                if ($cargado == 1) {
                    $cargado = 0;
                    continue;
                }
                // solo cargo a los aceptados
                if($per['estado'] != comunes::ins_aceptado) {
                    continue;
                }
                $aux['inscripcion'] = $per['inscripcion'];
                $this->relacion()->tabla('ins_asistencias')->nueva_fila($per);
            }
        }
    }    
    
    //-------------------------------------------------------------------------
    //-------------------------------------------------------------------------
    function evt__mail_certificado()
    {
        $datos = $this->tabla('ins_inscripciones')->get_filas();

        $asunto = "Sistema Gnosis - Certificado";
        $cuerpo_mail = '<p>'."Ya se encuentra disponible el certificado: '". $datos[0]['titulo_evento'] ."'.
                            Para ver el certificado ingrese a GNOSIS y en la opción 'Eventos realizados',
                            seleccionando el evento correspondiente puede descargar el certificado luego de completar 
                            un cuestionario. 
                            Gracias por utilizar el sistema GNOSIS - Facultad de Ciencias Económicas UNPSJB 
                            ".'</p>';
        foreach($datos as $da) {
            if ($da['certifico_asistencia'] == 'S' || $da['certifico_aprobacion'] == 'S') {
                $this->enviar_mail($da['mail'], $asunto, $cuerpo_mail);
            }
        }
        toba::notificacion()->agregar("Los E-Mails se enviaron correctamente","info");
    }    
    
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------    
    function enviar_mail($mail_destino, $asunto, $cuerpo_mail)
    {
        try {
            $mail = new toba_mail($mail_destino, $asunto, $cuerpo_mail);
            $mail->set_html(true);
            #$mail->enviar();
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
  
    function cambiarFormatoFecha($fecha)
    {
        list($anio,$mes,$dia)=explode("-",$fecha);
        return $dia."-".$mes."-".$anio;
    } 
        
    //-----------------------------------------------------------------------------------
    //---- Eventos ----------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function vista_impresion($salida)
    {
        $datos = $this->tabla('evt_eventos')->get();
        $salida->mensaje("<DIV ALIGN=center><font size=4><b>Generacion de certificados</b></font></DIV>");
        $salida->mensaje("<font size=3>Evento: ". $datos['titulo']."</font>");
        $salida->mensaje("<font size=3>Dictado entre: ". $this->cambiarFormatoFecha($datos['fecha_inicio']). " y ". $this->cambiarFormatoFecha($datos['fecha_fin'])."</font>");
        $salida->mensaje("<font size=3>Asistentes: </font>");

        $datosCertificados = $this->tabla('ins_inscripciones')->get_filas();

        $salida->mensaje("<TABLE BORDER=2 CELLSPACING=1 WIDTH=550><TR>");
        $salida->mensaje("<TD><b>Nombre</b></TD> <TD><b>Fecha de inscripcion</b></TD><TD><b>Asistencia</b></TD><TD><b>Aprobacion</b></TD>");
        foreach ($datosCertificados as $d) {
            if ($d['estado'] == comunes::ins_aceptado) {
                $nombre = $d['nombre_completo'];
                $asistencia = $d['certifico_asistencia'] ? "SI" : " NO";
                $aprobacion = $d['certifico_aprobacion'] ? "SI" : " NO";
                $fecha = $this->cambiarFormatoFecha($d['fecha_inscripcion']);
                $salida->mensaje("</TR><TR>
                                <TD>$nombre</TD> 
                                <TD>$fecha</TD>
                                <TD>$asistencia</TD>
                                <TD>$aprobacion</TD>
                                </TR>");
            }
        }
    }

    //-------------------------------------------------------------------------
    //-------------------------------------------------------------------------
    function vista_pdf(toba_vista_pdf $salida) 
    {
        $datos = $this->tabla('evt_eventos')->get();
        $inscriptos = $this->tabla('ins_inscripciones')->get_filas();
        $datosInscriptos = rs_ordenar_por_columna($inscriptos, 'nombre_completo');

        $salida->set_papel_tamanio('a4');
        $salida->set_papel_orientacion('portrait');
        $salida->set_nombre_archivo("planilla.pdf");
        $salida->inicializar();

        $salida->texto('<b>PLANILLA DE INSCRIPTOS</b>', 18, array( 'justification' => 'center'));
        $salida->texto('<b>Evento: '. $datos['descripcion']. '</b>',18, array('justification' => 'center'));
        $salida->salto_linea();

        $fecha = $this->cambiarFormatoFecha(date('Y-m-d'));
        $salida->texto("Fecha: ". $fecha,12);

        $tabla['datos_tabla'] = $datosInscriptos;
        $tabla['titulo_tabla'] = 'Inscriptos';
        $tabla['titulos_columnas'] = array('nombre_completo' => 'APELLIDO Y NOMBRES','firma' => 'FIRMA');

        $opciones = array(
                    'titleFontSize' => 14,
                    'rowGap' => 10,
                    'colGap' => 1,
                    'width' => 500,
                    'titleFontSize' => 14,
                );

        $salida->tabla($tabla, true, 12, $opciones);
    }
}    