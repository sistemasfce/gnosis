<?php
class ci_personas_edicion extends gnosis_ci
{
    protected $s__claveAnterior;
        
    //-------------------------------------------------------------------------
    function relacion()
    {
        return $this->controlador->dep('relacion');
    }

    //-------------------------------------------------------------------------
    function tabla($id)
    {
        return $this->controlador->dep('relacion')->tabla($id);    
    }

    //-------------------------------------------------------------------------
    function relacionToba()
    {
        return $this->controlador->dep('relacion_toba');
    }

    //-------------------------------------------------------------------------
    function tablaToba($id)
    {
        return $this->controlador->dep('relacion_toba')->tabla($id);    
    }  
    
    //-----------------------------------------------------------------------------------
    //---- form -------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form(gnosis_ei_formulario $form)
    {
        if ($this->relacion()->esta_cargada()) {
            $datos = $this->tabla('personas')->get();
            $this->s__claveAnterior = $datos['clave'];
            $form->set_datos($datos);
        } 
    } 
    
    function evt__form__modificacion($datos)
    {
        $claveUsuario = $datos['clave'];
        if ($this->s__claveAnterior != $claveUsuario) {
            $clave_enc = encriptar_con_sal($claveUsuario, 'sha256');
            $datos['clave'] = $clave_enc;
            // actualizar tambien la clave en tabla toba
            toba::consulta_php('co_toba_usuarios')->actualizar_clave($datos['documento'],$clave_enc);
        }

        $this->tabla('personas')->set($datos);
        $buscoUsuario = toba::consulta_php('co_toba_usuarios')->busca_usuario($datos['documento']);
        // si la persona es nueva, no esta en tabla toba usuarios
        if (!isset($buscoUsuario['usuario'])) {
            $datosUser['usuario'] = $datos['documento'];
            $datosUser['nombre'] = $datos['apellido'] . ' ' .$datos['nombres'];
            $datosUser['clave'] = $datos['clave'];
            $datosUser['email'] = $datos['email'];
            $datosUser['autentificacion'] = 'sha256';
            $datosUser['bloqueado'] = 0;

            $datosPro['proyecto'] = 'planta';
            $datosPro['usuario'] = $datos['documento'];
            $datosPro['usuario_grupo_acc'] = 'docente';
            #$this->tablaToba('basica')->set($datosUser);
            #$this->tablaToba('proyecto')->nueva_fila($datosPro);
        } 
    }    
}