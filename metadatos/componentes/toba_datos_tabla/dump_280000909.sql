------------------------------------------------------------
--[280000909]--  DT - resoluciones_tipos 
------------------------------------------------------------

------------------------------------------------------------
-- apex_objeto
------------------------------------------------------------

--- INICIO Grupo de desarrollo 280
INSERT INTO apex_objeto (proyecto, objeto, anterior, identificador, reflexivo, clase_proyecto, clase, punto_montaje, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion, posicion_botonera) VALUES (
	'gnosis', --proyecto
	'280000909', --objeto
	NULL, --anterior
	NULL, --identificador
	NULL, --reflexivo
	'toba', --clase_proyecto
	'toba_datos_tabla', --clase
	'280000005', --punto_montaje
	NULL, --subclase
	NULL, --subclase_archivo
	NULL, --objeto_categoria_proyecto
	NULL, --objeto_categoria
	'DT - resoluciones_tipos', --nombre
	NULL, --titulo
	NULL, --colapsable
	NULL, --descripcion
	'gnosis', --fuente_datos_proyecto
	'gnosis', --fuente_datos
	NULL, --solicitud_registrar
	NULL, --solicitud_obj_obs_tipo
	NULL, --solicitud_obj_observacion
	NULL, --parametro_a
	NULL, --parametro_b
	NULL, --parametro_c
	NULL, --parametro_d
	NULL, --parametro_e
	NULL, --parametro_f
	NULL, --usuario
	'2020-07-08 19:29:18', --creacion
	NULL  --posicion_botonera
);
--- FIN Grupo de desarrollo 280

------------------------------------------------------------
-- apex_objeto_db_registros
------------------------------------------------------------
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, punto_montaje, ap, ap_clase, ap_archivo, tabla, tabla_ext, alias, modificar_claves, fuente_datos_proyecto, fuente_datos, permite_actualizacion_automatica, esquema, esquema_ext) VALUES (
	'gnosis', --objeto_proyecto
	'280000909', --objeto
	NULL, --max_registros
	NULL, --min_registros
	'280000005', --punto_montaje
	'1', --ap
	NULL, --ap_clase
	NULL, --ap_archivo
	'resoluciones_tipos', --tabla
	NULL, --tabla_ext
	NULL, --alias
	'0', --modificar_claves
	'gnosis', --fuente_datos_proyecto
	'gnosis', --fuente_datos
	'1', --permite_actualizacion_automatica
	'negocio', --esquema
	'negocio'  --esquema_ext
);

------------------------------------------------------------
-- apex_objeto_db_registros_col
------------------------------------------------------------

--- INICIO Grupo de desarrollo 280
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000909', --objeto
	'280001360', --col_id
	'resolucion_tipo', --columna
	'E', --tipo
	'1', --pk
	'resoluciones_tipos_resolucion_tipo_seq', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	NULL, --externa
	'resoluciones_tipos'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000909', --objeto
	'280001361', --col_id
	'descripcion', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'20', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'resoluciones_tipos'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000909', --objeto
	'280001362', --col_id
	'activo', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'1', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'resoluciones_tipos'  --tabla
);
--- FIN Grupo de desarrollo 280
