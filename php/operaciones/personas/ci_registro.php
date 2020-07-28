<?php
class ci_registro extends gnosis_ci
{
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
    //---- Eventos ----------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function evt__procesar()
    {
        $documento = toba::memoria()->get_dato_operacion("documento");
        $asunto = "Confirmación de registro en sistema GNOSIS";
        $cuerpo_mail = '<p>'."Gracias por utilizar el sistema GNOSIS de la ".
                "facultad de Ciencias Económicas - UNPSJB.".
                "<br/><br/> su usuario es:".
                "<br/>Documento: ". $documento.'</p>';
        $mail_destino = toba::memoria()->get_dato_operacion("email");

        try {
            $this->dep('relacion')->sincronizar();
            $this->dep('relacion')->resetear();
            $this->dep('relacion_toba')->sincronizar();
            $this->dep('relacion_toba')->resetear();

        } catch (toba_error $e) {
            $this->informar_msg('Error al dar de alta usuario - el Nº de documento ya existe en la base de datos.');
            return;
        }

        $this->informar_msg("Gracias por registrarse en GNOSIS","info");
        $mail = new toba_mail($mail_destino, $asunto, $cuerpo_mail);
        $mail->set_html(true);
        #$mail->enviar();

        // vuelvo al login para que se ingrese por primera ves
        toba::vinculador()->navegar_a('gnosis','280000117');
    }

    function evt__cancelar()
    {
        toba::vinculador()->navegar_a('gnosis','280000117');
    }

    //-----------------------------------------------------------------------------------
    //---- form_registro ----------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function evt__form__modificacion($datos)
    {
        $datosUser['usuario'] = $datos['documento'];
        toba::memoria()->set_dato_operacion("documento",$datos['documento']);
        $datosUser['nombre'] = $datos['apellido'] . ' ' .$datos['nombres'];
        $clave_enc = encriptar_con_sal($datos['clave'], 'sha256');
        $datosUser['clave'] = $clave_enc;
        $datosUser['email'] = $datos['email'];
        toba::memoria()->set_dato_operacion("email",$datos['email']);
        $datosUser['autentificacion'] = 'sha256';
        $datosUser['bloqueado'] = 0;

        $datosPro['proyecto'] = 'gnosis';
        $datosPro['usuario'] = $datos['documento'];
        $datosPro['usuario_grupo_acc'] = 'usuario';

        $this->tabla('personas')->set($datos);
        $this->tablaToba('basica')->set($datosUser);
        $this->tablaToba('proyecto')->nueva_fila($datosPro);
    }    
}