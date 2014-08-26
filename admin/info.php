<!--
					Navegabilidade
					Mensagem
					Opcoes
					Conteudo
					 -->
				<div style="padding: 5px;"></div>
				<ul class="breadcrumbs">
					<li>
						<a href="painel.php">Home</a>
						<li class="unavailable"><a href="#">Editar</a></li>
						<li class="current"><a href="painel.php">Informações</a></li>
					</li>
				</ul>
				<h1>Editar Informações</h1>
				<p>Modifique cada um, para atualização diretamente no website.</p>
				<?php
				$selectInformacoes = $objConn ->selectQuery("SELECT * FROM `informacoes`", array());
				foreach ($selectInformacoes as $informacoes) {
					echo 	'<form method="POST" style="margin:0;">
						      <div class="row collapse">
						      	<label>'.$informacoes["nome"].'</label><input type="hidden" name="infoNom" id="infoNom" value="'.$informacoes["nome"].'" />
						        	<div class="small-9 columns">
						          		<input type="text" name="infoCon" id="infoCon" value="'.$informacoes["conteudo"].'" />
						        	</div>
						        <div class="small-3 columns">
						      	<input type="submit" class="button postfix" value="Modificar" />
						      </div></div>
						      </form>';
				}
				?>