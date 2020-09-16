
------------------------------------------------------------
-- apex_usuario_grupo_acc
------------------------------------------------------------
INSERT INTO apex_usuario_grupo_acc (proyecto, usuario_grupo_acc, nombre, nivel_acceso, descripcion, vencimiento, dias, hora_entrada, hora_salida, listar, permite_edicion, menu_usuario) VALUES (
	'gnosis', --proyecto
	'delegaciones', --usuario_grupo_acc
	'delegaciones', --nombre
	NULL, --nivel_acceso
	NULL, --descripcion
	NULL, --vencimiento
	NULL, --dias
	NULL, --hora_entrada
	NULL, --hora_salida
	NULL, --listar
	'0', --permite_edicion
	NULL  --menu_usuario
);

------------------------------------------------------------
-- apex_usuario_grupo_acc_item
------------------------------------------------------------

--- INICIO Grupo de desarrollo 0
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'gnosis', --proyecto
	'delegaciones', --usuario_grupo_acc
	NULL, --item_id
	'1'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'gnosis', --proyecto
	'delegaciones', --usuario_grupo_acc
	NULL, --item_id
	'2'  --item
);
--- FIN Grupo de desarrollo 0

--- INICIO Grupo de desarrollo 280
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'gnosis', --proyecto
	'delegaciones', --usuario_grupo_acc
	NULL, --item_id
	'280000221'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'gnosis', --proyecto
	'delegaciones', --usuario_grupo_acc
	NULL, --item_id
	'280000236'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'gnosis', --proyecto
	'delegaciones', --usuario_grupo_acc
	NULL, --item_id
	'280000279'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'gnosis', --proyecto
	'delegaciones', --usuario_grupo_acc
	NULL, --item_id
	'280000282'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'gnosis', --proyecto
	'delegaciones', --usuario_grupo_acc
	NULL, --item_id
	'280000283'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'gnosis', --proyecto
	'delegaciones', --usuario_grupo_acc
	NULL, --item_id
	'280000284'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'gnosis', --proyecto
	'delegaciones', --usuario_grupo_acc
	NULL, --item_id
	'280000292'  --item
);
--- FIN Grupo de desarrollo 280
