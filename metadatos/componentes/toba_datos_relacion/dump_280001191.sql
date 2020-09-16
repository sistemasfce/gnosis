------------------------------------------------------------
--[280001191]--  fceInscripciones - relacion 
------------------------------------------------------------

------------------------------------------------------------
-- apex_objeto
------------------------------------------------------------

--- INICIO Grupo de desarrollo 280
INSERT INTO apex_objeto (proyecto, objeto, anterior, identificador, reflexivo, clase_proyecto, clase, punto_montaje, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion, posicion_botonera) VALUES (
	'gnosis', --proyecto
	'280001191', --objeto
	NULL, --anterior
	NULL, --identificador
	NULL, --reflexivo
	'toba', --clase_proyecto
	'toba_datos_relacion', --clase
	'280000005', --punto_montaje
	NULL, --subclase
	NULL, --subclase_archivo
	NULL, --objeto_categoria_proyecto
	NULL, --objeto_categoria
	'fceInscripciones - relacion', --nombre
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
	'2020-07-10 17:34:41', --creacion
	NULL  --posicion_botonera
);
--- FIN Grupo de desarrollo 280

------------------------------------------------------------
-- apex_objeto_datos_rel
------------------------------------------------------------
INSERT INTO apex_objeto_datos_rel (proyecto, objeto, debug, clave, ap, punto_montaje, ap_clase, ap_archivo, sinc_susp_constraints, sinc_orden_automatico, sinc_lock_optimista) VALUES (
	'gnosis', --proyecto
	'280001191', --objeto
	'0', --debug
	NULL, --clave
	'2', --ap
	'280000005', --punto_montaje
	NULL, --ap_clase
	NULL, --ap_archivo
	'0', --sinc_susp_constraints
	'1', --sinc_orden_automatico
	'1'  --sinc_lock_optimista
);

------------------------------------------------------------
-- apex_objeto_dependencias
------------------------------------------------------------

--- INICIO Grupo de desarrollo 280
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES (
	'gnosis', --proyecto
	'280001108', --dep_id
	'280001191', --objeto_consumidor
	'280000910', --objeto_proveedor
	'evt_eventos', --identificador
	'1', --parametros_a
	'1', --parametros_b
	NULL, --parametros_c
	NULL, --inicializar
	'1'  --orden
);
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES (
	'gnosis', --proyecto
	'280001109', --dep_id
	'280001191', --objeto_consumidor
	'280001123', --objeto_proveedor
	'evt_eventos_encuentros', --identificador
	NULL, --parametros_a
	NULL, --parametros_b
	NULL, --parametros_c
	NULL, --inicializar
	'4'  --orden
);
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES (
	'gnosis', --proyecto
	'280001110', --dep_id
	'280001191', --objeto_consumidor
	'280000954', --objeto_proveedor
	'ins_asistencias', --identificador
	NULL, --parametros_a
	NULL, --parametros_b
	NULL, --parametros_c
	NULL, --inicializar
	'3'  --orden
);
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES (
	'gnosis', --proyecto
	'280001111', --dep_id
	'280001191', --objeto_consumidor
	'280000952', --objeto_proveedor
	'ins_inscripciones', --identificador
	NULL, --parametros_a
	NULL, --parametros_b
	NULL, --parametros_c
	NULL, --inicializar
	'2'  --orden
);
--- FIN Grupo de desarrollo 280

------------------------------------------------------------
-- apex_objeto_datos_rel_asoc
------------------------------------------------------------

--- INICIO Grupo de desarrollo 280
INSERT INTO apex_objeto_datos_rel_asoc (proyecto, objeto, asoc_id, identificador, padre_proyecto, padre_objeto, padre_id, padre_clave, hijo_proyecto, hijo_objeto, hijo_id, hijo_clave, cascada, orden) VALUES (
	'gnosis', --proyecto
	'280001191', --objeto
	'280000108', --asoc_id
	NULL, --identificador
	'gnosis', --padre_proyecto
	'280000910', --padre_objeto
	'evt_eventos', --padre_id
	NULL, --padre_clave
	'gnosis', --hijo_proyecto
	'280000952', --hijo_objeto
	'ins_inscripciones', --hijo_id
	NULL, --hijo_clave
	NULL, --cascada
	'1'  --orden
);
INSERT INTO apex_objeto_datos_rel_asoc (proyecto, objeto, asoc_id, identificador, padre_proyecto, padre_objeto, padre_id, padre_clave, hijo_proyecto, hijo_objeto, hijo_id, hijo_clave, cascada, orden) VALUES (
	'gnosis', --proyecto
	'280001191', --objeto
	'280000109', --asoc_id
	NULL, --identificador
	'gnosis', --padre_proyecto
	'280000910', --padre_objeto
	'evt_eventos', --padre_id
	NULL, --padre_clave
	'gnosis', --hijo_proyecto
	'280001123', --hijo_objeto
	'evt_eventos_encuentros', --hijo_id
	NULL, --hijo_clave
	NULL, --cascada
	'2'  --orden
);
INSERT INTO apex_objeto_datos_rel_asoc (proyecto, objeto, asoc_id, identificador, padre_proyecto, padre_objeto, padre_id, padre_clave, hijo_proyecto, hijo_objeto, hijo_id, hijo_clave, cascada, orden) VALUES (
	'gnosis', --proyecto
	'280001191', --objeto
	'280000110', --asoc_id
	NULL, --identificador
	'gnosis', --padre_proyecto
	'280001123', --padre_objeto
	'evt_eventos_encuentros', --padre_id
	NULL, --padre_clave
	'gnosis', --hijo_proyecto
	'280000954', --hijo_objeto
	'ins_asistencias', --hijo_id
	NULL, --hijo_clave
	NULL, --cascada
	'3'  --orden
);
--- FIN Grupo de desarrollo 280

------------------------------------------------------------
-- apex_objeto_rel_columnas_asoc
------------------------------------------------------------
INSERT INTO apex_objeto_rel_columnas_asoc (proyecto, objeto, asoc_id, padre_objeto, padre_clave, hijo_objeto, hijo_clave) VALUES (
	'gnosis', --proyecto
	'280001191', --objeto
	'280000108', --asoc_id
	'280000910', --padre_objeto
	'280001197', --padre_clave
	'280000952', --hijo_objeto
	'280001262'  --hijo_clave
);
INSERT INTO apex_objeto_rel_columnas_asoc (proyecto, objeto, asoc_id, padre_objeto, padre_clave, hijo_objeto, hijo_clave) VALUES (
	'gnosis', --proyecto
	'280001191', --objeto
	'280000109', --asoc_id
	'280000910', --padre_objeto
	'280001197', --padre_clave
	'280001123', --hijo_objeto
	'280001311'  --hijo_clave
);
INSERT INTO apex_objeto_rel_columnas_asoc (proyecto, objeto, asoc_id, padre_objeto, padre_clave, hijo_objeto, hijo_clave) VALUES (
	'gnosis', --proyecto
	'280001191', --objeto
	'280000110', --asoc_id
	'280001123', --padre_objeto
	'280001310', --padre_clave
	'280000954', --hijo_objeto
	'280001315'  --hijo_clave
);
