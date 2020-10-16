<?php

require_once(toba::proyecto()->get_path_php().'/comunes.php');

    $evt_aceptados = comunes::evt_aceptado;
    $evn_en_insc = comunes::evt_en_insc;
    $evt_en_curso = comunes::evt_en_curso;
    $evt_finalizado = comunes::evt_finalizado;

    // si el evento esta presentado y aceptado, se pone en periodo inscripcion dependiendo de la fecha de inicio de inscripciones
    $sql = "
        UPDATE evt_eventos
        set estado = $evn_en_insc
        WHERE estado = $evt_aceptados
            AND ins_fecha_inicio::date >= current_date
        ";
    //$datos = toba::db()->consultar($sql);
    
    // si el evento esta en inscripcion y comienza pasa a estar en curso
    $sql = "
        UPDATE evt_eventos
        set estado = $evt_en_curso
        WHERE estado = $evn_en_insc
            AND current_timestamp >= fecha_inicio
        ";
    //$datos = toba::db()->consultar($sql);    
    
    // si el evento esta en curso y termina pasa a finalizado
    $sql = "
        UPDATE evt_eventos
        set estado = $evt_finalizado
        WHERE estado = $evt_en_curso
            AND current_timestamp >= fecha_fin
        ";
    //$datos = toba::db()->consultar($sql);    