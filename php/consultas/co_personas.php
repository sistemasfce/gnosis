<?php
 
class co_personas
{
    function get_documento($id)
    {
        $sql = "SELECT documento FROM tmp_personas WHERE persona = $id";
        return toba::db()->consultar_fila($sql);  
    }
    
    function get_nombre_completo($id)
    {
        $sql = "SELECT COALESCE(apellido || ', ' || nombres,apellido) as nombre_completo FROM tmp_personas WHERE persona = $id";
        return toba::db()->consultar_fila($sql);  
    }

    function get_mail($id)
    {
        $sql = "SELECT mail FROM tmp_personas WHERE persona = $id";
        return toba::db()->consultar_fila($sql);  
    }    
}