<?php
class cuadro_eventos_as extends gnosis_ei_cuadro
{
    /**
    * Atrapa el evento seleccion del cuadro e invoca manualmente el serviccio vista_jasperreports pasandole el hash por parámetro
    */
    function extender_objeto_js()
    {
        echo "
            {$this->objeto_js}.evt__certificado = function(params) {
            var param = 'asistente';
            location.href = vinculador.get_url(null, null, 'vista_jasperreports', {'param': param}); 
            return false;
            }
        ";
    }
}