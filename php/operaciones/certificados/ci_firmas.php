<?php

class ci_firmas extends gnosis_ci
{
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

    //-----------------------------------------------------------------------------------
    //---- cuadro -----------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__cuadro(gnosis_ei_cuadro $cuadro)
    {
        $datos = toba::consulta_php('co_certificados')->get_firmas();
        $cuadro->set_datos($datos);
    }

    function evt__cuadro__seleccion($seleccion)
    {
        $this->relacion()->cargar($seleccion);
    }

    //-----------------------------------------------------------------------------------
    //---- form -----------------------------------------------------------------------
    //-----------------------------------------------------------------------------------   
    function conf__form(gnosis_ei_formulario $form)
    {
        if ($this->relacion()->esta_cargada()) {
            $datos = $this->tabla('evt_certificados_firmas')->get();    
            
             if ($datos['firma_path'] != '') {
                // el 20 es para que corte la cadena despues del caracter, de /home/fce/firmas_gn/
                $nombre = substr($datos['firma_path'],20);
                $dir_tmp = toba::proyecto()->get_www_temp();
                exec("cp '". $datos['firma_path']. "' '" .$dir_tmp['path']."/".$nombre."'");
                $temp_archivo = toba::proyecto()->get_www_temp($nombre);
                $tamanio = round(filesize($temp_archivo['path']) / 1024);
                $datos['firma_path'] = "<a href='{$temp_archivo['url']}'target='_blank'>Descargar archivo</a>";
                $datos['firma_archivo'] = $nombre. ' - Tam.: '.$tamanio. ' KB';  
            }           
            $form->set_datos($datos);
        }
    }

    function evt__form__alta($datos)
    {
        // si esta cargada la resolucion armo el link para descarga
        if ($datos['firma_archivo'] != '') {
            $nombre_archivo = $datos['firma_archivo']['name'];
            $nombre_nuevo = 'firma_'.$datos['persona'].'.png';
            $destino = '/home/fce/firmas_gn/'.$nombre_nuevo;
            // Mover los archivos subidos al servidor del directorio temporal PHP a uno propio.
            move_uploaded_file($datos['firma_archivo']['tmp_name'], $destino); 
            $datos['firma_path'] = $destino;   
        }
        $this->tabla('evt_certificados_firmas')->set($datos);
        $this->relacion()->sincronizar();
        $this->relacion()->resetear();
    }

    function evt__form__baja()
    {
        try {
            $this->relacion()->eliminar_todo();
        } catch (toba_error $e) {
            toba::notificacion()->agregar('No es posible eliminar el registro.');
        }
        $this->relacion()->resetear();
    }

    function evt__form__modificacion($datos)
    {
        $this->tabla('evt_certificados_firmas')->set($datos);
        $this->relacion()->sincronizar();
        $this->relacion()->resetear();
    }

    function evt__form__cancelar()
    {
        $this->relacion()->resetear();
    }    
}