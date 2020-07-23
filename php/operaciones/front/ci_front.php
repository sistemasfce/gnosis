<?php

require_once(toba::proyecto()->get_path_php().'/comunes.php');

class ci_front extends gnosis_ci
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
    //---- Configuraciones --------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__inicio(toba_ei_pantalla $pantalla)
    {
        $perfil = toba::usuario()->get_perfiles_funcionales();
        if ($perfil[0] != 'admin') {
            $documento = toba::usuario()->get_id();
            $this->pantalla('inicio')->eliminar_dep('filtro');
            $persona = toba::consulta_php('co_personas')->get_id($documento);
            toba::memoria()->set_dato('usuario','user');
            toba::memoria()->set_dato('persona',$persona['persona']);
        } else {
            toba::memoria()->set_dato('usuario','admin');
        }
    }
    
    //-----------------------------------------------------------------------------------
    //---- cuadro -----------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__cuadro(gnosis_ei_cuadro $cuadro)
    {   
        $where = "evt_eventos.estado in (". comunes::evt_en_insc .")";
        $where .= " AND (ins_fecha_inicio < now() or ins_fecha_inicio is null) AND (ins_fecha_fin > now() or ins_fecha_fin is null)";
        $datos = toba::consulta_php('co_eventos')->get_eventos($where);
        $cuadro->set_datos($datos);
    }
    
    function evt__cuadro__seleccion($seleccion)
    {
        toba::memoria()->set_dato('evento_seleccionado',$seleccion['evento']);
        $this->set_pantalla('inscripcion');
    } 

    function conf__form(gnosis_ei_formulario $form)
    {
        $usuario = toba::memoria()->get_dato('usuario');
        if ($usuario == 'admin') {
            if (isset($this->s__filtro)) {
                $persona = $this->s__filtro['persona']['valor'];
                toba::memoria()->set_dato('persona',$persona);
                $nombre = toba::consulta_php('co_personas')->get_nombre_completo($persona);
                $datos['nombre_completo'] = $nombre['nombre_completo'];
            } else {
                $form->evento('perfil')->desactivar();
                $form->evento('eventos_as')->desactivar();
                $form->evento('eventos_dic')->desactivar();
                return;
            }
        } else {
            $persona = toba::memoria()->get_dato('persona');            
            $nombre = toba::consulta_php('co_personas')->get_nombre_completo($persona);
            $datos['nombre_completo'] = $nombre['nombre_completo'];
        }
        $this->relacion()->cargar(array("persona"=> $persona));
        $form->set_datos($datos);       
    }    
   
    function conf__form_inscripcion(gnosis_ei_formulario $form)
    {
        $persona = toba::memoria()->get_dato('persona'); 
        $evento = toba::memoria()->get_dato('evento_seleccionado');
        $datos = toba::consulta_php('co_eventos')->get_eventos_info($evento);
        $datos['fecha_inicio'] = $this->cambiarFormatoFecha($datos['fecha_inicio']);
        $datos['fecha_fin'] = $this->cambiarFormatoFecha($datos['fecha_fin']);
        $datos['fecha_inicio_ins'] = $this->cambiarFormatoFecha($datos['fecha_inicio_ins']);
        $datos['fecha_fin_ins'] = $this->cambiarFormatoFecha($datos['fecha_fin_ins']);
        
        $disertantes = toba::consulta_php('co_eventos')->get_disertantes_evento($evento);
        $nombres = "";
        foreach ($disertantes as $d) {
                $nombres = $nombres. $d['nombre_completo']. ': ' . $d['rol_desc'] . "\n";
        }
        $datos['disertantes'] = $nombres;
        $aranceles = toba::consulta_php('co_eventos')->get_aranceles_evento($evento);
        $nombres = "";
        foreach ($aranceles as $d) {
                $nombres = $nombres. $d['arancel_desc']. ': ' . $d['monto'] . "\n";
        }
        if ($nombres == '')
            $nombres = 'Gratuito';
        $datos['arancel'] = $nombres;
        
        $form->set_datos($datos);
        
        $existe = toba::consulta_php('co_eventos')->get_persona_inscripta($persona, $evento);
        if ($existe == 1) {
            $this->evento('confirmar')->desactivar();
            toba::notificacion()->agregar('El pedido de pre-inscripcion ya fue realizado');
        } else {
            $this->evento('confirmar')->activar();
        }
        
        $cant_inscriptos = toba::consulta_php('co_eventos')->get_cant_inscriptos_total($evento);
        if ($datos['cupo'] != '' and $datos['cupo'] <= $cant_inscriptos['cant']) {
            $this->evento('confirmar')->desactivar();
            toba::notificacion()->agregar("Se superó el cupo de inscripción al evento","info");
        }        
        
    }   
    
    function evt__form_inscripcion__modificacion($datos)
    {
        $evento = toba::memoria()->get_dato('evento_seleccionado');
        $ins['evento'] = $evento;
        $persona = toba::memoria()->get_dato('persona'); 
        $ins['persona'] = $persona;
        $ins['fecha_inscripcion'] = $this->cambiarFormatoFecha(date("Y-m-d"));
        $ins['estado'] = $datos['ins_estado'];
        $ins['como_se_entero'] = $datos['como_se_entero'];
        
        $this->relacion()->tabla('ins_inscripciones')->nueva_fila($ins);
    }   

   //-----------------------------------------------------------------------------------
    //---- Configuraciones --------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__eventos_as()
    {   
        if (!$this->relacion()->tabla('ins_inscripciones')->hay_cursor()) {
            $this->pantalla('personas_eventos_as')->eliminar_dep('cuestionario');
        } 
    }    
    
    //-----------------------------------------------------------------------------------
    //---- cuadro_eventos_as ------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__cuadro_eventos_as(gnosis_ei_cuadro $cuadro)
    {
        $datos = $this->relacion()->tabla('ins_inscripciones')->get_filas();
        toba::memoria()->set_dato('evento',$datos);
        $cuadro->set_datos($datos);
    }

    //-----------------------------------------------------------------------------------
    function evt__cuadro_eventos_as__cuestionario($seleccion)
    {
        toba::memoria()->set_dato('fila',$seleccion);
        $this->relacion()->tabla('ins_inscripciones')->set_cursor($seleccion);
        $this->pantalla('personas_eventos_as')->agregar_dep('cuestionario');
    }   
    
    function conf_evt__cuadro_eventos_as__cuestionario(toba_evento_usuario $evento, $fila)
    {
        $datos = toba::memoria()->get_dato('evento');
        if ($datos[$fila]['debe_cuestionario'] == 'N') {
            $evento->desactivar(); 
        }
        else {
            $evento->activar();  
        }  
    }  
    
    function conf_evt__cuadro_eventos_as__certificado(toba_evento_usuario $evento, $fila)
    {
        $datos = toba::memoria()->get_dato('evento');
        if ($datos[$fila]['debe_cuestionario'] == 'S') {
            $evento->desactivar(); 
        }
        else {
            $evento->activar();  
        }  
    }   
    //-----------------------------------------------------------------------------------
    //---- cuadro_eventos_dic -----------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__cuadro_eventos_dic(gnosis_ei_cuadro $cuadro)
    {
        $datos = $this->relacion()->tabla('evt_eventos_disertantes')->get_filas();
        $cuadro->set_datos($datos);
    }

    function evt__cuadro_eventos_dic__seleccion($seleccion)
    {
        $this->relacion()->tabla('evt_eventos_disertantes')->set_cursor($seleccion);
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

    function evt__form__perfil($datos)
    {
        $this->set_pantalla('perfil');
    }

    function evt__form__eventos_as()
    {
        $this->set_pantalla('eventos_as');
    }

    function evt__form__eventos_dic()
    {
        $this->set_pantalla('eventos_dic');
    }
        
    function evt__confirmar($datos)
    {
        $this->dep('relacion')->sincronizar();
        $this->dep('relacion')->resetear();
        $this->set_pantalla('inicio');          
    }     

    function evt__cancelar($datos)
    {
        $this->set_pantalla('inicio');          
    } 
    
    function cambiarFormatoFecha($fecha){
        list($anio,$mes,$dia)=explode("-",$fecha);
        return $dia."-".$mes."-".$anio;
    }     
}