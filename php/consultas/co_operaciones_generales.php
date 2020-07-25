<?php
 
class co_operaciones_generales
{
    function get_paises($pais=null, $where='')
    {   
        $filtro = 'WHERE true';
        if (!is_null($pais)) {
            $pais = toba::db()->quote($pais);
            $filtro .= " AND negocio.mug_paises.pais = $pais"; 
        }   
        if ($where) {
            $filtro .= " AND $where";
        }   
            $sql = "SELECT pais as valor,
                           nombre as descr,
                           nombre || ' - (' || pais || ')'  as descr2
                    FROM   negocio.mug_paises
                    $filtro
                    ORDER BY nombre
            ";
       return toba::db()->consultar($sql);
   }	

   /** 
     Retorna las provincias para un pais dado.
   */
   function get_provincias_pais($pais=null)
   {   
        $where = '';
        if (!is_null($pais)) {
            $pais = toba::db()->quote($pais);
            $where .= " AND negocio.mug_paises.pais = $pais";
        }
        $sql = "SELECT          negocio.mug_provincias.provincia as valor,
                                                negocio.mug_provincias.nombre as descr
                        FROM            negocio.mug_provincias,
                                                negocio.mug_paises
                        WHERE           negocio.mug_provincias.pais = negocio.mug_paises.pais
                                                $where
                        ORDER BY        negocio.mug_provincias.nombre
        ";
        return toba::db()->consultar($sql);
   }

   /**
     Retorna un listado de localidades con sus departamentos, provincias y países asociados.
   */
   function get_listado_localidades($con_CP, $filtro='')
   {
        $where = '';
        $select = '';
        $valor_cp = '';
        $from = '';

        if ($filtro != '') {
            $where .= " AND $filtro";
        }

        if ($con_CP) {
            $select = ' DISTINCT ON (negocio.mug_localidades.nombre, negocio.mug_localidades.localidad) ';
            $valor_cp = " || ':' || COALESCE(negocio.mug_cod_postales.codigo_postal, '') ";
            $from = ' LEFT OUTER JOIN negocio.mug_cod_postales ON negocio.mug_localidades.localidad = negocio.mug_cod_postales.localidad ';
        }

        $sql = "SELECT  $select
                        negocio.mug_localidades.localidad $valor_cp as localidad_valor,
                        negocio.mug_localidades.localidad,
                        negocio.mug_localidades.nombre as localidad_nombre,
                        negocio.mug_paises.pais as pais_valor,
                        negocio.mug_paises.nombre as pais_nombre,
                        negocio.mug_provincias.provincia as provincia_valor,
                        negocio.mug_provincias.nombre as provincia_nombre,
                        negocio.mug_dptos_partidos.dpto_partido as departamento_valor,
                 negocio.mug_dptos_partidos.nombre as departamento_nombre,
                 negocio.mug_localidades.nombre || ' - ' || negocio.mug_dptos_partidos.nombre || ' - ' || negocio.mug_provincias.nombre || ' - ' || negocio.mug_paises.nombre as identificador_localidad
                FROM    negocio.mug_localidades
                        $from,
                        negocio.mug_dptos_partidos,
                        negocio.mug_provincias,
                        negocio.mug_paises
                WHERE   negocio.mug_localidades.dpto_partido = negocio.mug_dptos_partidos.dpto_partido
                        AND     negocio.mug_dptos_partidos.provincia = negocio.mug_provincias.provincia
                        AND     negocio.mug_provincias.pais = negocio.mug_paises.pais
                        $where
                ORDER BY localidad_nombre
        ";
        return toba::db()->consultar($sql);
  }

  /**
    Obtiene la clave y descripción de una localidad a partir del id dado para el ef_popup de Localidad.
  */
  static function get_localidad($id=null)
  {
        if (! isset($id) || trim($id) == '') {
            return array();
        }
        $id = toba::db()->quote($id);
        $sql = "SELECT  negocio.mug_localidades.localidad as valor,
                        negocio.mug_localidades.nombre || ' - ' || negocio.mug_dptos_partidos.nombre || ' - ' || negocio.mug_provincias.nombre || ' - ' || negocio.mug_paises.nombre as descr
                FROM    negocio.mug_localidades,
                                        negocio.mug_dptos_partidos,
                                        negocio.mug_provincias,
                                        negocio.mug_paises
                WHERE   negocio.mug_localidades.dpto_partido = negocio.mug_dptos_partidos.dpto_partido AND
                                        negocio.mug_dptos_partidos.provincia = negocio.mug_provincias.provincia AND
                                        negocio.mug_provincias.pais = mug_paises.pais AND
                                        negocio.mug_localidades.localidad = $id
        ";
        $result = toba::db()->consultar($sql);
        if (!empty($result)) {
            return $result[0]['descr'];
       }
   }

    static function get_listado_personas($where='') 
    {

        $sql = "SELECT persona, 
                        COALESCE(apellido || ', ' || nombres,apellido) as nombre_completo
                FROM negocio.personas 
                WHERE $where
                ORDER BY nombre_completo";
        return toba::db()->consultar($sql);
    }


    static function get_persona($id=null) 
    {
        if (! isset($id) || trim($id) == '') {
            return array();
        }
        $id = toba::db()->quote($id);
        $sql = "SELECT persona, 
                        COALESCE(apellido || ', ' || nombres,apellido) as nombre_completo
                FROM negocio.personas 
                WHERE persona = $id
                ORDER BY nombre_completo";
        $result = toba::db()->consultar($sql);
        if (!empty($result)) {
            return $result[0]['nombre_completo'];
       }
    }    
    
}
?>
