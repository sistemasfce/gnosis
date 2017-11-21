<?php
/**
 * Esta clase fue y será generada automáticamente. NO EDITAR A MANO.
 * @ignore
 */
class gnosis_autoload 
{
	static function existe_clase($nombre)
	{
		return isset(self::$clases[$nombre]);
	}

	static function cargar($nombre)
	{
		if (self::existe_clase($nombre)) { 
			 require_once(dirname(__FILE__) .'/'. self::$clases[$nombre]); 
		}
	}

	static protected $clases = array(
		'gnosis_ci' => 'extension_toba/componentes/gnosis_ci.php',
		'gnosis_cn' => 'extension_toba/componentes/gnosis_cn.php',
		'gnosis_datos_relacion' => 'extension_toba/componentes/gnosis_datos_relacion.php',
		'gnosis_datos_tabla' => 'extension_toba/componentes/gnosis_datos_tabla.php',
		'gnosis_ei_arbol' => 'extension_toba/componentes/gnosis_ei_arbol.php',
		'gnosis_ei_archivos' => 'extension_toba/componentes/gnosis_ei_archivos.php',
		'gnosis_ei_calendario' => 'extension_toba/componentes/gnosis_ei_calendario.php',
		'gnosis_ei_codigo' => 'extension_toba/componentes/gnosis_ei_codigo.php',
		'gnosis_ei_cuadro' => 'extension_toba/componentes/gnosis_ei_cuadro.php',
		'gnosis_ei_esquema' => 'extension_toba/componentes/gnosis_ei_esquema.php',
		'gnosis_ei_filtro' => 'extension_toba/componentes/gnosis_ei_filtro.php',
		'gnosis_ei_firma' => 'extension_toba/componentes/gnosis_ei_firma.php',
		'gnosis_ei_formulario' => 'extension_toba/componentes/gnosis_ei_formulario.php',
		'gnosis_ei_formulario_ml' => 'extension_toba/componentes/gnosis_ei_formulario_ml.php',
		'gnosis_ei_grafico' => 'extension_toba/componentes/gnosis_ei_grafico.php',
		'gnosis_ei_mapa' => 'extension_toba/componentes/gnosis_ei_mapa.php',
		'gnosis_servicio_web' => 'extension_toba/componentes/gnosis_servicio_web.php',
		'gnosis_comando' => 'extension_toba/gnosis_comando.php',
		'gnosis_modelo' => 'extension_toba/gnosis_modelo.php',
	);
}
?>