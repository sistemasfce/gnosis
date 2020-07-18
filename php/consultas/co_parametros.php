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

    function get_estados_eventos($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM evt_estados
		WHERE $where
        ";
	return toba::db()->consultar($sql);
    } 

    function get_aranceles_categorias($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM evt_aranceles_categorias
		WHERE $where
        ";
	return toba::db()->consultar($sql);
    }    
    
    function get_roles($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM par_roles
		WHERE $where
        ";
	return toba::db()->consultar($sql);
    }     
    
    function get_areas_interes($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM dap_areas_interes
		WHERE $where
                ORDER BY descripcion
        ";
	return toba::db()->consultar($sql);
    }

    function get_estados_inscripciones($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM ins_estados
		WHERE $where
        ";
	return toba::db()->consultar($sql);
    }    
    
    function get_modalidades($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM evt_modalidades
		WHERE $where
        ";
	return toba::db()->consultar($sql);
    }     
    
    function get_resoluciones_tipos($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM evt_resoluciones_tipos
		WHERE $where
        ";
	return toba::db()->consultar($sql);
    }  
    
    function get_ciclos_lectivos($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM evt_ciclos_lectivos
		WHERE $where
        ";
	return toba::db()->consultar($sql);
    }    
    
    function get_instituciones_vinculos($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM evt_instituciones_vinculos
		WHERE $where
        ";
	return toba::db()->consultar($sql);
    }      
    
    function get_certificados($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM evt_certificados
		WHERE $where
                ORDER BY descripcion
        ";
	return toba::db()->consultar($sql);
    }     
    
    function get_certificados_firmas($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *,
                        cargo as persona_desc
		FROM evt_certificados_firmas
		WHERE $where AND activo = 'S'
                ORDER BY descripcion
        ";
	return toba::db()->consultar($sql);
    } 
    
    function get_opciones_difusion($where=null)
    {
	if (!isset($where)) $where = '1=1';
        $sql = "SELECT *
		FROM ins_opciones_difusion
		WHERE $where
        ";
	return toba::db()->consultar($sql);
    }     
}
    