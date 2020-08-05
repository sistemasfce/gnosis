<?php

class co_eventos
{
    
    function get_eventos_cuadro($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT evt_eventos.*,
                    resolucion || '/' || resolucion_anio || ' ' || negocio.resoluciones_tipos.descripcion as resolucion_desc,
                    substring(evt_eventos.titulo from 1 for 100) descripcion_corta,
                    evt_tipos.descripcion as tipo_desc,
                    evt_modalidades.descripcion as modalidad_desc,
                    negocio.mug_localidades.nombre as localidad_desc,
                    evt_estados.descripcion as estado_desc
		FROM evt_eventos LEFT OUTER JOIN evt_tipos ON evt_eventos.tipo = evt_tipos.tipo
                LEFT OUTER JOIN negocio.resoluciones_tipos ON evt_eventos.resolucion_tipo = negocio.resoluciones_tipos.resolucion_tipo
                LEFT OUTER JOIN evt_estados ON evt_eventos.estado = evt_estados.estado
                LEFT OUTER JOIN evt_modalidades ON evt_eventos.modalidad = evt_modalidades.modalidad
                LEFT OUTER JOIN negocio.mug_localidades ON evt_eventos.localidad = negocio.mug_localidades.localidad
		WHERE $where
                ORDER BY fecha_inicio DESC
        ";
	return toba::db()->consultar($sql);
    }    
    
    function get_eventos($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT evt_eventos.*,
                    resolucion || '/' || resolucion_anio || ' ' || negocio.resoluciones_tipos.descripcion as resolucion_desc,
                    substring(evt_eventos.titulo from 1 for 100) descripcion_corta,
                    evt_tipos.descripcion as tipo_desc,
                    evt_modalidades.descripcion as modalidad_desc,
                    negocio.mug_localidades.nombre as localidad_desc,
                    evt_estados.descripcion as estado_desc,
                    evt_organizadores.descripcion as organizador_desc,
                    evt_organizadores2.descripcion as otorgado_por_desc,
                    (SELECT COUNT (*) as cant_insc FROM ins_inscripciones WHERE ins_inscripciones.evento = evt_eventos.evento) as cant_pre,
                    (SELECT COUNT (*) as cant_insc FROM ins_inscripciones WHERE ins_inscripciones.estado = 2 AND ins_inscripciones.evento = evt_eventos.evento) as cant_inscriptos,
                    (SELECT COUNT (*) as cant_insc FROM ins_inscripciones WHERE ins_inscripciones.certifico_asistencia = 'S' AND ins_inscripciones.evento = evt_eventos.evento) as cant_asistentes
		FROM evt_eventos LEFT OUTER JOIN evt_tipos ON evt_eventos.tipo = evt_tipos.tipo
                LEFT OUTER JOIN negocio.resoluciones_tipos ON evt_eventos.resolucion_tipo = negocio.resoluciones_tipos.resolucion_tipo
                LEFT OUTER JOIN evt_estados ON evt_eventos.estado = evt_estados.estado
                LEFT OUTER JOIN evt_modalidades ON evt_eventos.modalidad = evt_modalidades.modalidad
                LEFT OUTER JOIN evt_organizadores ON evt_eventos.organizador = evt_organizadores.organizador
                LEFT OUTER JOIN evt_organizadores as evt_organizadores2 ON evt_eventos.otorgado_por = evt_organizadores2.organizador
                LEFT OUTER JOIN negocio.mug_localidades ON evt_eventos.localidad = negocio.mug_localidades.localidad
		WHERE $where
                ORDER BY fecha_inicio DESC
        ";
	return toba::db()->consultar($sql);
    }
    
    function get_eventos_info($id)
    {
        $sql = "SELECT evt_eventos.*,
                    resolucion || '/' || resolucion_anio || ' ' || negocio.resoluciones_tipos.descripcion as resolucion_desc,
                    substring(evt_eventos.titulo from 1 for 100) descripcion_corta,
                    evt_tipos.descripcion as tipo_desc,
                    evt_modalidades.descripcion as modalidad_desc,
                    negocio.mug_localidades.nombre as localidad_desc,
                    evt_organizadores.descripcion as organizador_desc,
                    evt_estados.descripcion as estado_desc
		FROM evt_eventos LEFT OUTER JOIN evt_tipos ON evt_eventos.tipo = evt_tipos.tipo
                LEFT OUTER JOIN negocio.resoluciones_tipos ON evt_eventos.resolucion_tipo = negocio.resoluciones_tipos.resolucion_tipo
                LEFT OUTER JOIN evt_estados ON evt_eventos.estado = evt_estados.estado
                LEFT OUTER JOIN evt_modalidades ON evt_eventos.modalidad = evt_modalidades.modalidad
                LEFT OUTER JOIN negocio.mug_localidades ON evt_eventos.localidad = negocio.mug_localidades.localidad
                LEFT OUTER JOIN evt_organizadores ON evt_eventos.organizador = evt_organizadores.organizador
		WHERE evento = $id
                ORDER BY fecha_inicio DESC
        ";
	return toba::db()->consultar_fila($sql);
    }    
    
    function get_eventos_cuestionarios($where=null)
    {
        if (!isset($where)) $where = '1=1';
        $sql = "SELECT evento,
                evt_eventos.titulo,
                (SELECT COUNT (*) as cant_insc FROM ins_inscripciones WHERE ins_inscripciones.estado = 2 AND ins_inscripciones.evento = evt_eventos.evento) as cant_inscriptos,
                (SELECT COUNT (*) as cant_resp FROM ins_cuestionarios_respuestas WHERE evento = evt_eventos.evento) as cant_respuestas
		FROM evt_eventos 
		WHERE $where
                ORDER BY fecha_inicio DESC
        ";
	return toba::db()->consultar($sql);        
    }
    
    function get_respuestas_cuestionarios($id)
    {
         $sql = "SELECT *
                FROM ins_cuestionarios_respuestas
                WHERE evento = $id
        ";
	return toba::db()->consultar($sql); 
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
        $sql = "SELECT evt_eventos.*,
                    resolucion || '/' || resolucion_anio || ' ' || negocio.resoluciones_tipos.descripcion as resolucion_desc,
                    substring(evt_eventos.titulo from 1 for 100) descripcion_corta,
                    evt_tipos.descripcion as tipo_desc,
                    evt_modalidades.descripcion as modalidad_desc,
                    negocio.mug_localidades.nombre as localidad_desc,
                    evt_estados.descripcion as estado_desc,
                    ins_estados.descripcion as rol,
                    'Inscripciones a eventos' as condicion
                FROM ins_inscripciones LEFT OUTER JOIN evt_eventos ON ins_inscripciones.evento = evt_eventos.evento
                LEFT OUTER JOIN evt_tipos ON evt_eventos.tipo = evt_tipos.tipo
                LEFT OUTER JOIN negocio.resoluciones_tipos ON evt_eventos.resolucion_tipo = negocio.resoluciones_tipos.resolucion_tipo
                LEFT OUTER JOIN evt_estados ON evt_eventos.estado = evt_estados.estado
                LEFT OUTER JOIN evt_modalidades ON evt_eventos.modalidad = evt_modalidades.modalidad
                LEFT OUTER JOIN negocio.mug_localidades ON evt_eventos.localidad = negocio.mug_localidades.localidad
                LEFT OUTER JOIN ins_estados ON ins_inscripciones.estado = ins_estados.estado
                WHERE persona = $persona
                    
                UNION
                
               SELECT evt_eventos.*,
                    resolucion || '/' || resolucion_anio || ' ' || negocio.resoluciones_tipos.descripcion as resolucion_desc,
                    substring(evt_eventos.titulo from 1 for 100) descripcion_corta,
                    evt_tipos.descripcion as tipo_desc,
                    evt_modalidades.descripcion as modalidad_desc,
                    negocio.mug_localidades.nombre as localidad_desc,
                    evt_estados.descripcion as estado_desc,
                    evt_roles.descripcion as rol,
                    'Participaciones en eventos' as condicion
                FROM evt_eventos_disertantes LEFT OUTER JOIN evt_eventos ON evt_eventos_disertantes.evento = evt_eventos.evento
                LEFT OUTER JOIN evt_tipos ON evt_eventos.tipo = evt_tipos.tipo
                LEFT OUTER JOIN negocio.resoluciones_tipos ON evt_eventos.resolucion_tipo = negocio.resoluciones_tipos.resolucion_tipo
                LEFT OUTER JOIN evt_estados ON evt_eventos.estado = evt_estados.estado
                LEFT OUTER JOIN evt_modalidades ON evt_eventos.modalidad = evt_modalidades.modalidad
                LEFT OUTER JOIN negocio.mug_localidades ON evt_eventos.localidad = negocio.mug_localidades.localidad
                LEFT OUTER JOIN evt_roles ON evt_eventos_disertantes.rol = evt_roles.rol
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
        $sql = "SELECT evt_roles.descripcion as rol_desc,
                        COALESCE(apellido || ', ' || nombres,apellido) as nombre_completo
                FROM evt_eventos_disertantes LEFT OUTER JOIN evt_roles ON evt_eventos_disertantes.rol = evt_roles.rol
                LEFT OUTER JOIN negocio.personas ON evt_eventos_disertantes.persona = negocio.personas.persona
                WHERE evento = $id 
        ";
	return toba::db()->consultar($sql);       
    }     
}