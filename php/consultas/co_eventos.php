<?php
 
class co_eventos
{

    function get_eventos($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM evt_eventos
		WHERE $where
        ";
	return toba::db()->consultar($sql);
    }
}