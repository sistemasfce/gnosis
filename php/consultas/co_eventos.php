<?php
 
class co_eventos
{

    function get_eventos($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT evt_eventos.*,
                    resolucion || '/' || resolucion_anio || ' ' || evt_resoluciones_tipos.descripcion as resolucion_desc,
                    substring(evt_eventos.descripcion from 1 for 100) descripcion_corta,
                    evt_tipos.descripcion as tipo_desc,
                    evt_estados.descripcion as estado_desc
		FROM evt_eventos LEFT OUTER JOIN evt_tipos ON evt_eventos.tipo = evt_tipos.tipo
                LEFT OUTER JOIN evt_resoluciones_tipos ON evt_eventos.resolucion_tipo = evt_resoluciones_tipos.resolucion_tipo
                LEFT OUTER JOIN evt_estados ON evt_eventos.estado = evt_estados.estado
		WHERE $where
                ORDER BY fecha_inicio DESC
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

    function get_asistencia_inscripcion($inscripcion, $encuentro)
    {
        $sql = "SELECT asistencia
                FROM ins_asistencias
                WHERE inscripcion = $inscripcion AND encuentro = $encuentro
        ";
	return toba::db()->consultar_fila($sql);       
    }    
}