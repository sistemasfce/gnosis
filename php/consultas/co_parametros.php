<?php
 
class co_parametros
{

    function get_instituciones($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM evt_instituciones
		WHERE $where
        ";
	return toba::db()->consultar($sql);
    }

    function get_tipos_eventos($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM evt_tipos
		WHERE $where
        ";
	return toba::db()->consultar($sql);
    }   
    
    function get_organizadores($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM evt_organizadores
		WHERE $where
        ";
	return toba::db()->consultar($sql);
    }       
}
    