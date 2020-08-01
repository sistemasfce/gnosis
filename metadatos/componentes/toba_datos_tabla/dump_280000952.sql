------------------------------------------------------------
--[280000952]--  DT - ins_inscripciones 
------------------------------------------------------------

------------------------------------------------------------
-- apex_objeto
------------------------------------------------------------

--- INICIO Grupo de desarrollo 280
INSERT INTO apex_objeto (proyecto, objeto, anterior, identificador, reflexivo, clase_proyecto, clase, punto_montaje, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion, posicion_botonera) VALUES (
	'gnosis', --proyecto
	'280000952', --objeto
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
	'DT - ins_inscripciones', --nombre
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
	'2020-07-10 22:19:16', --creacion
	NULL  --posicion_botonera
);
--- FIN Grupo de desarrollo 280

------------------------------------------------------------
-- apex_objeto_db_registros
------------------------------------------------------------
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, punto_montaje, ap, ap_clase, ap_archivo, tabla, tabla_ext, alias, modificar_claves, fuente_datos_proyecto, fuente_datos, permite_actualizacion_automatica, esquema, esquema_ext) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	NULL, --max_registros
	NULL, --min_registros
	'280000005', --punto_montaje
	'1', --ap
	NULL, --ap_clase
	NULL, --ap_archivo
	'ins_inscripciones', --tabla
	NULL, --tabla_ext
	NULL, --alias
	'0', --modificar_claves
	'gnosis', --fuente_datos_proyecto
	'gnosis', --fuente_datos
	'1', --permite_actualizacion_automatica
	'gnosis', --esquema
	'negocio'  --esquema_ext
);

------------------------------------------------------------
-- apex_objeto_db_registros_col
------------------------------------------------------------

--- INICIO Grupo de desarrollo 280
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001260', --col_id
	'inscripcion', --columna
	'E', --tipo
	'1', --pk
	'ins_inscripciones_inscripcion_seq', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	'0', --externa
	'ins_inscripciones'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001261', --col_id
	'persona', --columna
	'E', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ins_inscripciones'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001262', --col_id
	'evento', --columna
	'E', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ins_inscripciones'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001263', --col_id
	'fecha_inscripcion', --columna
	'F', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ins_inscripciones'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001264', --col_id
	'estado', --columna
	'E', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ins_inscripciones'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001265', --col_id
	'certifico_asistencia', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'1', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ins_inscripciones'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001266', --col_id
	'certifico_aprobacion', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'1', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ins_inscripciones'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001267', --col_id
	'pago', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'1', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ins_inscripciones'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001270', --col_id
	'nota', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'200', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ins_inscripciones'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001317', --col_id
	'documento', --columna
	'C', --tipo
	'0', --pk
	NULL, --secuencia
	'10', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'1', --externa
	NULL  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001318', --col_id
	'nombre_completo', --columna
	'C', --tipo
	'0', --pk
	NULL, --secuencia
	'100', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'1', --externa
	NULL  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001319', --col_id
	'mail', --columna
	'C', --tipo
	'0', --pk
	NULL, --secuencia
	'50', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'1', --externa
	NULL  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001320', --col_id
	'estado_desc', --columna
	'C', --tipo
	'0', --pk
	NULL, --secuencia
	'50', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'1', --externa
	NULL  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001321', --col_id
	'como_se_entero', --columna
	'E', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ins_inscripciones'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001322', --col_id
	'titulo_evento', --columna
	'C', --tipo
	'0', --pk
	NULL, --secuencia
	'500', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'1', --externa
	NULL  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001351', --col_id
	'debe_cuestionario', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'1', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'ins_inscripciones'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280001424', --col_id
	'evento_estado', --columna
	'E', --tipo
	'0', --pk
	NULL, --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'1', --externa
	NULL  --tabla
);
--- FIN Grupo de desarrollo 280

------------------------------------------------------------
-- apex_objeto_db_registros_ext
------------------------------------------------------------

--- INICIO Grupo de desarrollo 280
INSERT INTO apex_objeto_db_registros_ext (objeto_proyecto, objeto, externa_id, tipo, sincro_continua, metodo, clase, include, punto_montaje, sql, dato_estricto, carga_dt, carga_consulta_php, permite_carga_masiva, metodo_masivo) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000031', --externa_id
	'dao', --tipo
	'1', --sincro_continua
	'get_documento', --metodo
	NULL, --clase
	NULL, --include
	'280000005', --punto_montaje
	NULL, --sql
	'0', --dato_estricto
	NULL, --carga_dt
	'280000037', --carga_consulta_php
	'0', --permite_carga_masiva
	NULL  --metodo_masivo
);
INSERT INTO apex_objeto_db_registros_ext (objeto_proyecto, objeto, externa_id, tipo, sincro_continua, metodo, clase, include, punto_montaje, sql, dato_estricto, carga_dt, carga_consulta_php, permite_carga_masiva, metodo_masivo) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000032', --externa_id
	'sql', --tipo
	'1', --sincro_continua
	'get_mail', --metodo
	NULL, --clase
	NULL, --include
	'280000005', --punto_montaje
	'SELECT email as mail FROM negocio.personas WHERE persona = %persona%;', --sql
	'0', --dato_estricto
	NULL, --carga_dt
	NULL, --carga_consulta_php
	'0', --permite_carga_masiva
	NULL  --metodo_masivo
);
INSERT INTO apex_objeto_db_registros_ext (objeto_proyecto, objeto, externa_id, tipo, sincro_continua, metodo, clase, include, punto_montaje, sql, dato_estricto, carga_dt, carga_consulta_php, permite_carga_masiva, metodo_masivo) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000033', --externa_id
	'dao', --tipo
	'1', --sincro_continua
	'get_nombre_completo', --metodo
	NULL, --clase
	NULL, --include
	'280000005', --punto_montaje
	NULL, --sql
	'0', --dato_estricto
	NULL, --carga_dt
	'280000037', --carga_consulta_php
	'0', --permite_carga_masiva
	NULL  --metodo_masivo
);
INSERT INTO apex_objeto_db_registros_ext (objeto_proyecto, objeto, externa_id, tipo, sincro_continua, metodo, clase, include, punto_montaje, sql, dato_estricto, carga_dt, carga_consulta_php, permite_carga_masiva, metodo_masivo) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000034', --externa_id
	'sql', --tipo
	'1', --sincro_continua
	NULL, --metodo
	NULL, --clase
	NULL, --include
	'280000005', --punto_montaje
	'SELECT descripcion as estado_desc FROM ins_estados WHERE estado = %estado%;', --sql
	'0', --dato_estricto
	NULL, --carga_dt
	NULL, --carga_consulta_php
	'0', --permite_carga_masiva
	NULL  --metodo_masivo
);
INSERT INTO apex_objeto_db_registros_ext (objeto_proyecto, objeto, externa_id, tipo, sincro_continua, metodo, clase, include, punto_montaje, sql, dato_estricto, carga_dt, carga_consulta_php, permite_carga_masiva, metodo_masivo) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000035', --externa_id
	'sql', --tipo
	'1', --sincro_continua
	NULL, --metodo
	NULL, --clase
	NULL, --include
	'280000005', --punto_montaje
	'SELECT titulo as titulo_evento FROM evt_eventos WHERE evento = %evento%;', --sql
	'0', --dato_estricto
	NULL, --carga_dt
	NULL, --carga_consulta_php
	'0', --permite_carga_masiva
	NULL  --metodo_masivo
);
INSERT INTO apex_objeto_db_registros_ext (objeto_proyecto, objeto, externa_id, tipo, sincro_continua, metodo, clase, include, punto_montaje, sql, dato_estricto, carga_dt, carga_consulta_php, permite_carga_masiva, metodo_masivo) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000042', --externa_id
	'sql', --tipo
	'1', --sincro_continua
	NULL, --metodo
	NULL, --clase
	NULL, --include
	'280000005', --punto_montaje
	'SELECT estado as evento_estado FROM evt_eventos WHERE evento = %evento%;', --sql
	'0', --dato_estricto
	NULL, --carga_dt
	NULL, --carga_consulta_php
	'0', --permite_carga_masiva
	NULL  --metodo_masivo
);
--- FIN Grupo de desarrollo 280

------------------------------------------------------------
-- apex_objeto_db_registros_ext_col
------------------------------------------------------------
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000031', --externa_id
	'280001261', --col_id
	'0'  --es_resultado
);
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000031', --externa_id
	'280001317', --col_id
	'1'  --es_resultado
);
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000032', --externa_id
	'280001261', --col_id
	'0'  --es_resultado
);
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000032', --externa_id
	'280001319', --col_id
	'1'  --es_resultado
);
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000033', --externa_id
	'280001261', --col_id
	'0'  --es_resultado
);
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000033', --externa_id
	'280001318', --col_id
	'1'  --es_resultado
);
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000034', --externa_id
	'280001264', --col_id
	'0'  --es_resultado
);
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000034', --externa_id
	'280001320', --col_id
	'1'  --es_resultado
);
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000035', --externa_id
	'280001262', --col_id
	'0'  --es_resultado
);
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000035', --externa_id
	'280001322', --col_id
	'1'  --es_resultado
);
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000042', --externa_id
	'280001262', --col_id
	'0'  --es_resultado
);
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'gnosis', --objeto_proyecto
	'280000952', --objeto
	'280000042', --externa_id
	'280001424', --col_id
	'1'  --es_resultado
);
