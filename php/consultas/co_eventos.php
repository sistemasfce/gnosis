<?php

class co_eventos
{

    function get_eventos($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT evt_eventos.*,
                    resolucion || '/' || resolucion_anio || ' ' || evt_resoluciones_tipos.descripcion as resolucion_desc,
                    substring(evt_eventos.titulo from 1 for 100) descripcion_corta,
                    evt_tipos.descripcion as tipo_desc,
                    evt_modalidades.descripcion as modalidad_desc,
                    mug_localidades.nombre as localidad_desc,
                    evt_estados.descripcion as estado_desc
		FROM evt_eventos LEFT OUTER JOIN evt_tipos ON evt_eventos.tipo = evt_tipos.tipo
                LEFT OUTER JOIN evt_resoluciones_tipos ON evt_eventos.resolucion_tipo = evt_resoluciones_tipos.resolucion_tipo
                LEFT OUTER JOIN evt_estados ON evt_eventos.estado = evt_estados.estado
                LEFT OUTER JOIN evt_modalidades ON evt_eventos.modalidad = evt_modalidades.modalidad
                LEFT OUTER JOIN mug_localidades ON evt_eventos.localidad = mug_localidades.localidad
		WHERE $where
                ORDER BY fecha_inicio DESC
        ";
	return toba::db()->consultar($sql);
    }
    
    function get_eventos_info($id)
    {
        $sql = "SELECT evt_eventos.*,
                    resolucion || '/' || resolucion_anio || ' ' || evt_resoluciones_tipos.descripcion as resolucion_desc,
                    substring(evt_eventos.titulo from 1 for 100) descripcion_corta,
                    evt_tipos.descripcion as tipo_desc,
                    evt_modalidades.descripcion as modalidad_desc,
                    mug_localidades.nombre as localidad_desc,
                    evt_organizadores.descripcion as organizador_desc,
                    evt_estados.descripcion as estado_desc
		FROM evt_eventos LEFT OUTER JOIN evt_tipos ON evt_eventos.tipo = evt_tipos.tipo
                LEFT OUTER JOIN evt_resoluciones_tipos ON evt_eventos.resolucion_tipo = evt_resoluciones_tipos.resolucion_tipo
                LEFT OUTER JOIN evt_estados ON evt_eventos.estado = evt_estados.estado
                LEFT OUTER JOIN evt_modalidades ON evt_eventos.modalidad = evt_modalidades.modalidad
                LEFT OUTER JOIN mug_localidades ON evt_eventos.localidad = mug_localidades.localidad
                LEFT OUTER JOIN evt_organizadores ON evt_eventos.organizador = evt_organizadores.organizador
		WHERE evento = $id
                ORDER BY fecha_inicio DESC
        ";
	return toba::db()->consultar_fila($sql);
    }    
    
    function get_inscripciones_evento($id)
    {
        $sql = "SELECT *
                FROM ins_inscripciones
                WHERE evento = $id AND estado = 2
        ";
	return toba::db()->consultar($sql);       
    }

    function get_cant_inscriptos_total($id)
    {
        $sql = "SELECT COUNT(*) as cant
                FROM ins_inscripciones
                WHERE evento = $id AND estado in (1,2)
        ";
	return toba::db()->consultar_fila($sql);       
    }    
    
    function get_asistencia_inscripcion($inscripcion, $encuentro)
    {
        $sql = "SELECT asistencia
                FROM ins_asistencias
                WHERE inscripcion = $inscripcion AND encuentro = $encuentro
        ";
	return toba::db()->consultar_fila($sql);       
    }    
    
    function get_persona_inscripta($persona, $evento)
    {
        $sql = "SELECT persona
                FROM ins_inscripciones
                WHERE persona = $persona AND evento = $evento
        ";
	$resultado = toba::db()->consultar($sql);   
        if (!empty($resultado)) 
            return 1;   # persona ya esta inscripta
        else
            return 0;   # no inscripto
    }  
    
    function get_eventos_persona($persona)
    {
        $sql = "SELECT evento, estado, 'inscripto'
                FROM ins_inscripciones
                WHERE persona = $persona
                    
                UNION
                
                SELECT evento, rol, 'disertante'
                FROM evt_eventos_disertantes
                WHERE persona = $persona
        ";
	return toba::db()->consultar($sql);   
    }  
    
    
    function get_aranceles_evento($id)
    {
        $sql = "SELECT evt_aranceles_categorias.descripcion as arancel_desc,
                        evt_eventos_aranceles.monto
                FROM evt_eventos_aranceles LEFT OUTER JOIN evt_aranceles_categorias ON evt_eventos_aranceles.arancel_categoria = evt_aranceles_categorias.arancel_categoria
                WHERE evento = $id 
        ";
	return toba::db()->consultar($sql);       
    }   
    
    function get_disertantes_evento($id)
    {
        $sql = "SELECT par_roles.descripcion as rol_desc,
                        COALESCE(apellido || ', ' || nombres,apellido) as nombre_completo
                FROM evt_eventos_disertantes LEFT OUTER JOIN par_roles ON evt_eventos_disertantes.rol = par_roles.rol
                LEFT OUTER JOIN tmp_personas ON evt_eventos_disertantes.persona = tmp_personas.persona
                WHERE evento = $id 
        ";
	return toba::db()->consultar($sql);       
    }     
}