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
                (SELECT COALESCE(apellido || ', ' || nombres,apellido) FROM negocio.personas WHERE persona = evt_certificados_firmas.persona) as nombre_completo 
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
    
    function get_certificado_evento($evento)
    {
        $sql = "SELECT evt_certificados.certificado,
                        evt_certificados.descripcion,
                        evt_certificados.texto_aprobacion,
                        evt_certificados.texto_asistencia,
                        evt_certificados.texto_disertante,
                        (SELECT firma_path FROM evt_certificados_firmas WHERE certificado_firma = evt_certificados.firma1) as firma1_path,
                        (SELECT firma_path FROM evt_certificados_firmas WHERE certificado_firma = evt_certificados.firma2) as firma2_path,
                        (SELECT firma_path FROM evt_certificados_firmas WHERE certificado_firma = evt_certificados.firma3) as firma3_path,
                        (SELECT firma_path FROM evt_certificados_firmas WHERE certificado_firma = evt_certificados.firma4) as firma4_path
                FROM evt_eventos LEFT OUTER JOIN evt_certificados ON evt_eventos.certificado = evt_certificados.certificado
                WHERE evt_eventos.evento = $evento
            ";
        return toba::db()->consultar_fila($sql);
    }
    
}
    