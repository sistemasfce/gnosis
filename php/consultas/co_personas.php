<?php
 
class co_personas
{
    function get_documento($id)
    {
        $sql = "SELECT documento FROM negocio.personas WHERE persona = $id";
        return toba::db()->consultar_fila($sql);  
    }
    
    function get_id($doc)
    {
        $sql = "SELECT persona FROM negocio.personas WHERE documento = '$doc'";
        return toba::db()->consultar_fila($sql);  
    }    
    
    function get_nombre_completo($id)
    {
        $sql = "SELECT COALESCE(apellido || ', ' || nombres,apellido) as nombre_completo FROM negocio.personas WHERE persona = $id";
        return toba::db()->consultar_fila($sql);  
    }

    function get_mail($id)
    {
        $sql = "SELECT email FROM negocio.personas WHERE persona = $id";
        return toba::db()->consultar_fila($sql);  
    } 
    
    function get_datos_persona($id)
    {
        $sql = "SELECT *,
                COALESCE(apellido || ', ' || nombres,apellido) as nombre_completo
                FROM negocio.personas WHERE persona = $id";
        return toba::db()->consultar_fila($sql);  
    }     
    
    function get_nombre_completo_inscripcion($id)
    {
        $sql = "SELECT *,
                COALESCE(apellido || ', ' || nombres,apellido) as nombre_completo
                FROM negocio.personas LEFT OUTER JOIN ins_inscripciones ON negocio.personas.persona = ins_inscripciones.persona
                WHERE ins_inscripciones.inscripcion = $id";
        return toba::db()->consultar_fila($sql);  
    }     
    
    function get_personas($where='1=1')
    {
        $sql = "SELECT *,
                COALESCE(apellido || ', ' || nombres,apellido) as nombre_completo FROM negocio.personas,
                date_part('year',age(fecha_nac)) as edad
                WHERE $where ORDER BY nombre_completo";
        return toba::db()->consultar($sql);
    }    
    
    function get_personas_listado($where='1=1')
    {
        $sql = "SELECT persona, email, documento,
                COALESCE(apellido || ', ' || nombres,apellido) as nombre_completo FROM negocio.personas,
                date_part('year',age(fecha_nac)) as edad
                WHERE $where ORDER BY nombre_completo";
        return toba::db()->consultar($sql);
    }    
}
