<?php
 
class co_personas
{
    function get_documento($id)
    {
        $sql = "SELECT documento FROM tmp_personas WHERE persona = $id";
        return toba::db()->consultar_fila($sql);  
    }
    
    function get_id($doc)
    {
        $sql = "SELECT persona FROM tmp_personas WHERE documento = '$doc'";
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
    
    function get_datos_persona($id)
    {
        $sql = "SELECT *,
                COALESCE(apellido || ', ' || nombres,apellido) as nombre_completo
                FROM tmp_personas WHERE persona = $id";
        return toba::db()->consultar_fila($sql);  
    }     
    
    function get_nombre_completo_inscripcion($id)
    {
        $sql = "SELECT *,
                COALESCE(apellido || ', ' || nombres,apellido) as nombre_completo
                FROM tmp_personas LEFT OUTER JOIN ins_inscripciones ON tmp_personas.persona = ins_inscripciones.persona
                WHERE ins_inscripciones.inscripcion = $id";
        return toba::db()->consultar_fila($sql);  
    }     
    
    function get_personas($where='1=1')
    {
        $sql = "SELECT *,
                COALESCE(apellido || ', ' || nombres,apellido) as nombre_completo FROM tmp_personas 
                WHERE $where ORDER BY nombre_completo";
        return toba::db()->consultar($sql);
    }    
}