<?php
class ci_personas_edicion extends gnosis_ci
{
    protected $s__claveAnterior;
        
    function ini()
    {
        toba::solicitud()->set_autocomplete(false);    //Evita que el browser quiera guardar la clave de usuario
    }
        
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

            $datosPro['proyecto'] = 'gnosis';
            $datosPro['usuario'] = $datos['documento'];
            $datosPro['usuario_grupo_acc'] = 'usuario';
            $this->tablaToba('basica')->set($datosUser);
            $this->tablaToba('proyecto')->nueva_fila($datosPro);
        } 
    }   
    
    function evt__claves()
    {
        try {
            $query = "SELECT documento, apellido || ', ' || nombres as nombre_completo, email, clave_anterior FROM negocio.personas WHERE id_anterior is not null LIMIT 5";
            $datos = toba::db()->consultar($query);
            foreach ($datos as $dat) {
                $query = "SELECT usuario FROM apex_usuario WHERE usuario = '" . $dat['documento'] . "'";
                $per = toba::db('toba_usuarios')->consultar_fila($query);

                if (!isset($per['usuario'])) {
                    # no esta en toba usuarios, lo debo agregar a apex_usuario y a proyecto
                    if ($dat['clave_anterior'] == '') {
                       $clave_anterior = $dat['documento'];
                    } else {
                       $clave_anterior = $dat['clave_anterior'];
                    }
                    $clave_enc = encriptar_con_sal($clave_anterior, 'sha256');
                    $query = "INSERT INTO apex_usuario (usuario, clave, nombre, email, autentificacion) VALUES ('".$dat['documento']."','".$clave_enc."','".$dat['nombre_completo']."','".$dat['email']."','sha256')";
                    toba::db('toba_usuarios')->consultar($query);
                    $query = "UPDATE negocio.personas SET clave = '".$clave_enc."' WHERE documento = '".$dat['documento']."' AND clave is null ";
                    toba::db()->consultar($query);                

                }
                $query = "SELECT usuario FROM apex_usuario_proyecto WHERE proyecto = 'gnosis' AND usuario = '" . $dat['documento'] . "'";
                $per = toba::db('toba_usuarios')->consultar_fila($query);
                if (!isset($per['usuario'])) {
                    # ya esta en usuario, solo lo agrego a proyecto
                    $query = "INSERT INTO apex_usuario_proyecto (proyecto, usuario_grupo_acc, usuario) VALUES ('gnosis','usuario','".$dat['documento']."')";
                    toba::db('toba_usuarios')->consultar($query);                    
                }

            }
        } catch (Exception $ex) {
            $this->informar_msg('Error en claves - '. $ex);
        }
 
    }
}
