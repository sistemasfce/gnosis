------------------------------------------------------------
--[280001134]--  DT - personas 
------------------------------------------------------------

------------------------------------------------------------
-- apex_objeto
------------------------------------------------------------

--- INICIO Grupo de desarrollo 280
INSERT INTO apex_objeto (proyecto, objeto, anterior, identificador, reflexivo, clase_proyecto, clase, punto_montaje, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion, posicion_botonera) VALUES (
	'gnosis', --proyecto
	'280001134', --objeto
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
	'DT - personas', --nombre
	NULL, --titulo
	NULL, --colapsable
	NULL, --descripcion
	'gnosis', --fuente_datos_proyecto
	'tahio', --fuente_datos
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
	'2020-07-18 23:21:24', --creacion
	NULL  --posicion_botonera
);
--- FIN Grupo de desarrollo 280

------------------------------------------------------------
-- apex_objeto_db_registros
------------------------------------------------------------
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, punto_montaje, ap, ap_clase, ap_archivo, tabla, tabla_ext, alias, modificar_claves, fuente_datos_proyecto, fuente_datos, permite_actualizacion_automatica, esquema, esquema_ext) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	NULL, --max_registros
	NULL, --min_registros
	'280000005', --punto_montaje
	'1', --ap
	NULL, --ap_clase
	NULL, --ap_archivo
	'personas', --tabla
	NULL, --tabla_ext
	NULL, --alias
	'0', --modificar_claves
	'gnosis', --fuente_datos_proyecto
	'tahio', --fuente_datos
	'1', --permite_actualizacion_automatica
	NULL, --esquema
	'negocio'  --esquema_ext
);

------------------------------------------------------------
-- apex_objeto_db_registros_col
------------------------------------------------------------

--- INICIO Grupo de desarrollo 280
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001325', --col_id
	'persona', --columna
	'E', --tipo
	'1', --pk
	'personas_persona_seq', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001326', --col_id
	'apellido', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'50', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001327', --col_id
	'nombres', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'100', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001328', --col_id
	'tipo_doc', --columna
	'E', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001329', --col_id
	'documento', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'8', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001330', --col_id
	'sexo', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'1', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001331', --col_id
	'fecha_nac', --columna
	'F', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001332', --col_id
	'direccion', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'100', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001333', --col_id
	'localidad', --columna
	'E', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001334', --col_id
	'telefono', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'25', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001335', --col_id
	'telefono_2', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'25', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001336', --col_id
	'email', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'50', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001337', --col_id
	'email_2', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'50', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001338', --col_id
	'cuil', --columna
	'E', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001339', --col_id
	'legajo', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'10', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001340', --col_id
	'fecha_ingreso', --columna
	'F', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001341', --col_id
	'cambio_clave', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'1', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001342', --col_id
	'legajo_no_doc', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'10', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001343', --col_id
	'observaciones', --columna
	'X', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001344', --col_id
	'estado_docente', --columna
	'E', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001345', --col_id
	'estado_nodocente', --columna
	'E', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001346', --col_id
	'estado_externo', --columna
	'E', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280001134', --objeto
	'280001347', --col_id
	'clave', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'128', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'personas'  --tabla
);
--- FIN Grupo de desarrollo 280
