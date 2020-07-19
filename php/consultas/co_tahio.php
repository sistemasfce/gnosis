<?php
 
class co_tahio
{
    function get_personas($where='1=1')
    {
        $sql = "SELECT *, 
			personas.apellido || ', ' || personas.nombres as nombre_completo,
			date_part('year',age(fecha_nac)) as edad, 
			(SELECT descripcion FROM perfiles_estados WHERE 
                        	perfiles_estados.perfil_estado = personas.estado_docente) as estado_docente_desc,
			(SELECT descripcion FROM perfiles_estados WHERE 
                                perfiles_estados.perfil_estado = personas.estado_nodocente) as estado_nodocente_desc,
                        (SELECT descripcion FROM perfiles_estados WHERE 
                                perfiles_estados.perfil_estado = personas.estado_externo) as estado_externo_desc
		FROM personas
		WHERE $where
		ORDER BY apellido, nombres
        ";
	return toba::db('tahio')->consultar($sql);
    }
}