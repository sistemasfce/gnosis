<?php
 
class co_certificados
{
    function get_certificados()
    {
        $sql = "SELECT * FROM evt_certificados";
        return toba::db()->consultar($sql);  
    }

    function get_firmas()
    {
        $sql = "SELECT * FROM evt_certificados_firmas 
                WHERE activo = 'S'
                ORDER BY cargo";
        return toba::db()->consultar($sql);  
    }     
}
    