<?php

require_once(toba::proyecto()->get_path_php().'/comunes.php');

class ci_front extends gnosis_ci
{
    protected $s__filtro;
    
    function ini()
    {
        toba::solicitud()->set_autocomplete(false);    //Evita que el browser quiera guardar la clave de usuario
    }
    
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
    
    //-------------------------------------------------------------------------
    function relacionToba()
    {
        return $this->controlador->dep('relacion_toba');
    }

    //-------------------------------------------------------------------------
    function tablaToba($id)
    {
        return $this->controlador->dep('relacion_toba')->tabla($id);    
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

    function conf__eventos_as()
    {   
        if (!$this->relacion()->tabla('ins_inscripciones')->hay_cursor()) {
            $this->pantalla('personas_eventos_as')->eliminar_dep('cuestionario');
        } 
    } 
    
    //-----------------------------------------------------------------------------------
    //---- cuadro -----------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__cuadro(gnosis_ei_cuadro $cuadro)
    {   
        $where = "evt_eventos.estado in (". comunes::evt_en_insc .",".comunes::evt_en_curso.")";
        //$where .= " AND (ins_fecha_inicio < now() or ins_fecha_inicio is null) AND (ins_fecha_fin > now() or ins_fecha_fin is null)";
        $datos = toba::consulta_php('co_eventos')->get_eventos($where);
        $cuadro->set_datos($datos);
    }
    
    function evt__cuadro__seleccion($seleccion)
    {
        $usuario = toba::memoria()->get_dato('usuario');
        if ($usuario == 'admin') {
            if (isset($this->s__filtro)) {
                toba::memoria()->set_dato('evento_seleccionado',$seleccion['evento']);
                $this->set_pantalla('inscripcion');
            }  else {
                toba::notificacion()->agregar("Te olvidaste de filtrar la persona!","info");
            } 
        } else {
            toba::memoria()->set_dato('evento_seleccionado',$seleccion['evento']);
            $this->set_pantalla('inscripcion');
        }
    } 

    //-----------------------------------------------------------------------------------
    //---- form -------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    
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

    function conf__form_perfil(gnosis_ei_formulario $form)
    {
        if ($this->relacion()->esta_cargada()) {
            $datos = $this->tabla('personas')->get();
            $this->s__claveAnterior = $datos['clave'];
            $form->set_datos($datos);
        } 
    } 
    
    function evt__form_perfil__modificacion($datos)
    {
        $claveUsuario = $datos['clave'];
        if ($this->s__claveAnterior != $claveUsuario) {
            $clave_enc = encriptar_con_sal($claveUsuario, 'sha256');
            $datos['clave'] = $clave_enc;
            // actualizar tambien la clave en tabla toba
            toba::consulta_php('co_toba_usuarios')->actualizar_clave($datos['documento'],$clave_enc);
        }

        $this->tabla('personas')->set($datos);
        $buscoUsuario = toba::consulta_php('co_toba_usuarios')->busca_usuario($datos['documento']);
        // si la persona es nueva, no esta en tabla toba usuarios
        if (!isset($buscoUsuario['usuario'])) {
            $datosUser['usuario'] = $datos['documento'];
            $datosUser['nombre'] = $datos['apellido'] . ' ' .$datos['nombres'];
            $datosUser['clave'] = $datos['clave'];
            $datosUser['email'] = $datos['email'];
            $datosUser['autentificacion'] = 'sha256';
            $datosUser['bloqueado'] = 0;

            $datosPro['proyecto'] = 'gnosis';
            $datosPro['usuario'] = $datos['documento'];
            $datosPro['usuario_grupo_acc'] = 'usuario';
            $this->tablaToba('basica')->set($datosUser);
            $this->tablaToba('proyecto')->nueva_fila($datosPro);
        } 
    }     
    
    function conf__form_inscripcion(gnosis_ei_formulario $form)
    {
        $persona = toba::memoria()->get_dato('persona'); 
        $evento = toba::memoria()->get_dato('evento_seleccionado');
        $datos = toba::consulta_php('co_eventos')->get_eventos_info($evento);
        $datos['fecha_inicio'] = $this->cambiarFormatoFechaHora($datos['fecha_inicio']);
        $datos['fecha_fin'] = $this->cambiarFormatoFechaHora($datos['fecha_fin']);
        $datos['fecha_inicio_ins'] = $this->cambiarFormatoFechaHora($datos['fecha_inicio_ins']);
        $datos['fecha_fin_ins'] = $this->cambiarFormatoFechaHora($datos['fecha_fin_ins']);
        
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
    //---- cuadro_eventos_as ------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__cuadro_eventos_as(gnosis_ei_cuadro $cuadro)
    {
        $datos = $this->relacion()->tabla('ins_inscripciones')->get_filas();
        $aux = [];
        foreach ($datos as $dat) {
            if ($dat['estado'] == 3) {
                continue;
            }
            $aux[] = $dat;
        }
        toba::memoria()->set_dato('evento',$aux);
        $cuadro->set_datos($aux);
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
        if ($datos[$fila]['debe_cuestionario'] == 'S' and $datos[$fila]['estado'] == comunes::ins_aceptado and $datos[$fila]['evento_estado'] == comunes::evt_finalizado) {
            $evento->activar(); 
        }
        else {
            $evento->desactivar();
        }  
    }
    
    function conf_evt__cuadro_eventos_as__certificado(toba_evento_usuario $evento, $fila)
    {
        $perfil = toba::usuario()->get_perfiles_funcionales();
        $datos = toba::memoria()->get_dato('evento');        
        if ($perfil[0] == 'admin') {
            if ($datos[$fila]['certifico_asistencia'] == 'N' and $datos[$fila]['certifico_aprobacion'] == 'N') {
                $evento->desactivar(); 
                return;
            }   
            $evento->activar();  
            return;
        }
        if ($datos[$fila]['debe_cuestionario'] == 'S') {
            $evento->desactivar(); 
            return;
        }
        if ($datos[$fila]['certifico_asistencia'] == 'N' and $datos[$fila]['certifico_aprobacion'] == 'N') {
            $evento->desactivar(); 
            return;
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
        toba::memoria()->set_dato('evento',$datos);
        $cuadro->set_datos($datos);
    }   
    
    function conf_evt__cuadro_eventos_dic__certificado(toba_evento_usuario $evento, $fila)
    {
        $perfil = toba::usuario()->get_perfiles_funcionales();
        if ($perfil[0] == 'admin') {
            $evento->activar();  
            return;
        }
        
        $datos = toba::memoria()->get_dato('evento');
        if ($datos[$fila]['certifica'] == 'N') {
            $evento->desactivar(); 
        }
        else {
            $evento->activar();  
        }  
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
    
    function evt__guardar($datos)
    {
        $this->dep('relacion')->sincronizar();
        $this->dep('relacion')->resetear();
        $this->set_pantalla('inicio');          
    }    

    function evt__cancelar($datos)
    {
        $this->set_pantalla('inicio');          
    } 

    //-----------------------------------------------------------------------------------
    
    function cambiarFormatoFecha($fecha){
        list($anio,$mes,$dia)=explode("-",$fecha);
        return $dia."-".$mes."-".$anio;
    }  
    
    function cambiarFormatoFechaHora($valor){
        list($fecha, $hora)=explode(" ",$valor);
        list($anio,$mes,$dia)=explode("-",$fecha);
        return $dia."-".$mes."-".$anio. " ".$hora;
    }      
    
    function reemplaza($palabra,$cadena,$reemplazo)
    {
        $pos = strpos($cadena, $palabra);
        if ($pos !== false) {
            $inicio = substr($cadena, 0, $pos);                   
            $fin = substr($cadena, strlen($palabra)+$pos);
            $texto = $inicio . $reemplazo . $fin;
            return $texto;
        } else
            return $cadena;
    }
    
    //-----------------------------------------------------------------------------------
    
    function vista_jasperreports(toba_vista_jasperreports $report) 
    {
        $report->set_nombre_archivo('certificado.pdf');
        $path_toba = toba::proyecto()->get_path().'/exportaciones/jasper/';
        $path = $path_toba.'certificadoGnosis.jasper';
	$report->set_path_reporte($path);

        // obtengo los datos que vienen por parametro del php del cuadro
        $parametros = toba::memoria()->get_parametro('datos');        
        list($tipo,$fila)=explode(",",$parametros);
        
        $persona = toba::memoria()->get_dato('persona');
        $nombre = toba::consulta_php('co_personas')->get_nombre_completo($persona);
        $documento = toba::consulta_php('co_personas')->get_documento($persona);
        $datos_tabla = toba::memoria()->get_dato('evento');
        $id_evento = $datos_tabla[$fila]['evento'];
        $certificado = toba::consulta_php('co_certificados')->get_certificado_evento($id_evento);
        $datos_evento = toba::consulta_php('co_eventos')->get_eventos_info($id_evento);

        if ($tipo == 'asistente') {
            if ($datos_tabla[$fila]['certifico_aprobacion'] == 'S') {
                $cadena = $certificado['texto_aprobacion'];
                $cadena = $this->reemplaza('%calificacion%',$cadena,'');
            }
            else {
                $cadena = $certificado['texto_asistencia'];
            }  
        // es disertante    
        } else {
            $cadena = $certificado['texto_disertante'];
            $cadena = $this->reemplaza('%rol%',$cadena,$datos_tabla[$fila]['rol_desc']);
        }
        $cadena = $this->reemplaza('%evento%',$cadena,$datos_tabla[$fila]['titulo_evento']);
        $cadena = $this->reemplaza('%fecha_inicio%',$cadena,$this->cambiarFormatoFecha($datos_evento['fecha_inicio']));
        $cadena = $this->reemplaza('%fecha_fin%',$cadena,$this->cambiarFormatoFecha($datos_evento['fecha_fin']));
        $cadena = $this->reemplaza('%duracion%',$cadena,$datos_evento['duracion']);
        $cadena = $this->reemplaza('%localidad%',$cadena,$datos_evento['localidad_desc']);
        $cadena = $this->reemplaza('%organizador%',$cadena,$datos_evento['organizador_desc']); 
        $cadena = $this->reemplaza('%resolucion%',$cadena,$datos_evento['resolucion_desc']);
        $texto = $cadena;

        $report->set_parametro('texto','S',$texto);
        $report->set_parametro('nombre','S',$nombre['nombre_completo']);
        $report->set_parametro('documento','S',$documento['documento']);
        
        if(isset($certificado['firma1_path']))
            $report->set_parametro('firma1','S',$certificado['firma1_path']);
        if(isset($certificado['firma2_path']))
            $report->set_parametro('firma2','S',$certificado['firma2_path']);
        if(isset($certificado['firma3_path']))
            $report->set_parametro('firma3','S',$certificado['firma3_path']);
        if(isset($certificado['firma4_path']))
            $report->set_parametro('firma4','S',$certificado['firma4_path']);
                
        $report->completar_con_datos();				
    }    
}