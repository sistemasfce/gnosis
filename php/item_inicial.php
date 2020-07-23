<?php
	echo '<div class="logo">';
	echo toba_recurso::imagen_proyecto('logo_grande.png', true);
	echo '</div>';
        
        $perfil = toba::usuario()->get_perfiles_funcionales();
	if ($perfil[0] == "usuario") {
		toba::vinculador()->navegar_a("gnosis","280000284");
		return;
	}
	
?>