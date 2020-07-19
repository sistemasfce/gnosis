<?php

class ci_eventos_edicion extends gnosis_ci
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
    //---- form -------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form(gnosis_ei_formulario $form)
    {
        if ($this->relacion()->esta_cargada()) {
            $datos = $this->tabla('evt_eventos')->get();
            
            // si esta cargada la resolucion armo el link para descarga
            if ($datos['resolucion_path'] != '') {
                // el 22 es para que corte la cadena despues del caracter 19, de /home/fce/informes_gn/
                $nombre = substr($datos['resolucion_path'],22);
                $dir_tmp = toba::proyecto()->get_www_temp();
                exec("cp '". $datos['resolucion_path']. "' '" .$dir_tmp['path']."/".$nombre."'");
                $temp_archivo = toba::proyecto()->get_www_temp($nombre);
                $tamanio = round(filesize($temp_archivo['path']) / 1024);
                $datos['resolucion_path'] = "<a href='{$temp_archivo['url']}'target='_blank'>Descargar archivo</a>";
                $datos['resolucion_archivo'] = $nombre. ' - Tam.: '.$tamanio. ' KB';  
            }
            if ($datos['proyecto_path'] != '') {
                // el 22 es para que corte la cadena despues del caracter 19, de /home/fce/informes_gn/
                $nombre = substr($datos['proyecto_path'],22);
                $dir_tmp = toba::proyecto()->get_www_temp();
                exec("cp '". $datos['proyecto_path']. "' '" .$dir_tmp['path']."/".$nombre."'");
                $temp_archivo = toba::proyecto()->get_www_temp($nombre);
                $tamanio = round(filesize($temp_archivo['path']) / 1024);
                $datos['proyecto_path'] = "<a href='{$temp_archivo['url']}'target='_blank'>Descargar archivo</a>";
                $datos['proyecto_archivo'] = $nombre. ' - Tam.: '.$tamanio. ' KB';  
            }           
            $form->set_datos($datos);
        } else {
            $form->ef('estado')->set_estado(1);
        }
    }
    
    function evt__form__modificacion($datos)
    {
        if (isset($datos['resolucion_archivo']) or isset($datos['resolucion_path'])) {
            $nombre_archivo = $datos['archivo']['name'];
            $nombre_nuevo = 'resol_'.$datos['resolucion_anio'].'_'.$datos['resolucion'].'.pdf';   
            $destino = '/home/fce/informes_gn/'.$nombre_nuevo;
            // Mover los archivos subidos al servidor del directorio temporal PHP a uno propio.
            move_uploaded_file($datos['resolucion_archivo']['tmp_name'], $destino);            
        }
        if (isset($datos['proyecto_archivo']) or isset($datos['proyecto_path'])) {
            $nombre_archivo = $datos['archivo']['name'];
            $nombre_nuevo = 'resol_'.$datos['resolucion_anio'].'_'.$datos['resolucion'].'.pdf';   
            $destino = '/home/fce/informes_gn/'.$nombre_nuevo;
            // Mover los archivos subidos al servidor del directorio temporal PHP a uno propio.
            move_uploaded_file($datos['proyecto_archivo']['tmp_name'], $destino);            
        }        
        $this->tabla('evt_eventos')->set($datos);
    }

    //-----------------------------------------------------------------------------------
    //---- form_ml_disertantes ----------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_ml_disertantes(gnosis_ei_formulario_ml $form_ml)
    {
        if ($this->relacion()->esta_cargada()) {
            $datos = $this->tabla('evt_eventos_disertantes')->get_filas();
            $form_ml->set_datos($datos);            
        }
    }

    //-----------------------------------------------------------------------------------
    function evt__form_ml_disertantes__modificacion($datos)
    {
        $this->tabla('evt_eventos_disertantes')->procesar_filas($datos);
    }

    //-----------------------------------------------------------------------------------
    //---- form_ml_instituciones --------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_ml_instituciones(gnosis_ei_formulario_ml $form_ml)
    {
        if ($this->relacion()->esta_cargada()) {
            $datos = $this->tabla('evt_eventos_instituciones')->get_filas();
            $form_ml->set_datos($datos);
        }
    }

    //-----------------------------------------------------------------------------------
    function evt__form_ml_instituciones__modificacion($datos)
    {
        $this->tabla('evt_eventos_instituciones')->procesar_filas($datos);
    }

    //-----------------------------------------------------------------------------------
    //---- form_ml_aranceles ---------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_ml_aranceles(gnosis_ei_formulario_ml $form_ml)
    {
        if ($this->relacion()->esta_cargada()) {
            $datos = $this->tabla('evt_eventos_aranceles')->get_filas();
            $form_ml->set_datos($datos);            
        }        
    }

    //-----------------------------------------------------------------------------------
    function evt__form_ml_aranceles__modificacion($datos)
    {
        $this->tabla('evt_eventos_aranceles')->procesar_filas($datos);
    }

    //-----------------------------------------------------------------------------------
    //---- form_ml_aranceles ---------------------------------------------------
    //-----------------------------------------------------------------------------------

    function conf__form_ml_encuentros(gnosis_ei_formulario_ml $form_ml)
    {
        if ($this->relacion()->esta_cargada()) {
            $datos = $this->tabla('evt_eventos_encuentros')->get_filas();
            $form_ml->set_datos($datos);            
        }        
    }

    //-----------------------------------------------------------------------------------
    function evt__form_ml_encuentros__modificacion($datos)
    {
        $this->tabla('evt_eventos_encuentros')->procesar_filas($datos);
    }    
}