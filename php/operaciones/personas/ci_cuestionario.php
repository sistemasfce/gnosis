<?php
class ci_cuestionario extends gnosis_ci
{
	protected $s__id_persona;
	protected $s__id_curso;
	protected $s__datos;
	protected $s__modificacion = false;
	
	//-------------------------------------------------------------------------
	function relacion()
	{
		try {
			return $this->controlador->dep('relacion');
		} catch (toba_error $e) {
			return $this->controlador()->controlador->dep('relacion');
		}
	}
	//-------------------------------------------------------------------------
	function tabla($id)
	{
		try {
			return $this->controlador->dep('relacion')->tabla($id);    
		} catch (toba_error $e) {
			return $this->controlador()->controlador->dep('relacion')->tabla($id); 
		}
	}
	
	//-------------------------------------------------------------------------
	function conf() {
		
		//$parametros = toba::memoria()->get_parametros();
		//$datos['id_persona'] = $parametros['id_persona'];
		//$datos['id_curso'] = $parametros['id_curso'];
		
		
		try {
			$this->controlador()->pantalla()->tab('personas_edicion')->ocultar();
			$this->controlador()->pantalla()->tab('personas_cursos_as')->ocultar();
			$this->controlador()->pantalla()->tab('personas_cursos_dic')->ocultar();
		} catch (exception $e) {
			
		}
		
		
		$datos['id_persona'] = toba::memoria()->get_dato('id_persona');
		$datos['id_curso'] = toba::memoria()->get_dato('id_curso');
	
		$this->tabla('cuestionario')->set($datos);
		
		$this->s__datos = toba::consulta_php('consultas')->get_cuestionario($datos);
		if ($this->s__datos != null) {
			$this->s__modificacion = true;
			$this->tabla('cuestionario')->set($this->s__datos[0]);
		} else {
			
		}
	}
	
	//-------------------------------------------------------------------------
	function get_id_persona() {
		
		return $this->s__id_persona;
	}
	
	//-------------------------------------------------------------------------
	function get_id_curso() {
		
		return $this->s__id_curso;
	}
	
	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__procesar()
	{
		$id_fila = toba::memoria()->get_dato('fila');
		$datos['cuestionario'] = true;
		$this->controlador()->controlador->dep('relacion')->tabla('personas_cursos')->modificar_fila($id_fila, $datos);
		$this->controlador()->controlador->dep('relacion')->tabla('personas_cursos')->sincronizar();
		$this->controlador()->controlador->dep('relacion')->tabla('cuestionario')->sincronizar();
        try {
            $this->controlador()->set_pantalla('personas_cursos_as');
        } catch (exception $a) {
            $this->controlador()->set_pantalla('pant_inicial');
        }
	}

	//-------------------------------------------------------------------------
	function evt__cancelar()
	{
		$this->tabla('cuestionario')->resetear();
		try {
			$this->controlador()->set_pantalla('personas_cursos_as');
		} catch (exception $a) {
			$this->controlador()->set_pantalla('pant_inicial');
		}
	}

	//-----------------------------------------------------------------------------------
	//---- form_cuestionario ------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_cuestionario(gnosis_ei_formulario $form)
	{
		$datos = $this->tabla('cuestionario')->get();
		$form->set_datos($datos);
	}

	function evt__form_cuestionario__modificacion($datos)
	{
		$this->tabla('cuestionario')->set($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_cuestionario_2 ----------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_cuestionario_2(gnosis_ei_formulario $form)
	{
		$datos = $this->tabla('cuestionario')->get();
		$form->set_datos($datos);
	}

	function evt__form_cuestionario_2__modificacion($datos)
	{
		$this->tabla('cuestionario')->set($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_cuestionario_3 ----------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_cuestionario_3(gnosis_ei_formulario $form)
	{
		$datos = $this->tabla('cuestionario')->get();
		$form->set_datos($datos);
	}

	function evt__form_cuestionario_3__modificacion($datos)
	{
		$this->tabla('cuestionario')->set($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_cuestionario_4 ----------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_cuestionario_4(gnosis_ei_formulario $form)
	{
		$datos = $this->tabla('cuestionario')->get();
		$form->set_datos($datos);
	}

	function evt__form_cuestionario_4__modificacion($datos)
	{
		$this->tabla('cuestionario')->set($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_cuestionario_5 ----------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_cuestionario_5(gnosis_ei_formulario $form)
	{
		if ($this->s__modificacion == true) {
			$this->evento('procesar')->desactivar();
		}
		$datos = $this->tabla('cuestionario')->get();
		$form->set_datos($datos);
	}

	function evt__form_cuestionario_5__modificacion($datos)
	{
		$this->tabla('cuestionario')->set($datos);
	}
}
?>