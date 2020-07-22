<?php
 
class co_certificados
{
    function get_certificados()
    {
        $sql = "SELECT * FROM evt_certificados
                ORDER BY descripcion";
        return toba::db()->consultar($sql);  
    }

    function get_firmas()
    {
        $sql = "SELECT *,
                (SELECT COALESCE(apellido || ', ' || nombres,apellido) FROM tmp_personas WHERE persona = evt_certificados_firmas.persona) as nombre_completo 
                FROM evt_certificados_firmas 
                ORDER BY cargo";
        return toba::db()->consultar($sql);  
    }  
    
    function get_firmas_activas()
    {
        $sql = "SELECT * FROM evt_certificados_firmas 
                WHERE activo = 'S'
                ORDER BY cargo";
        return toba::db()->consultar($sql);  
    }    
}
    