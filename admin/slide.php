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
						<li class="current"><a href="painel.php">Slide</a></li>
					</li>
				</ul>
				<h1>Editar Slide</h1>
				<p>Modifique cada um, para atualização diretamente no website.</p>
				<?php
				$selectSlide = $objConn ->selectQuery("SELECT * FROM `slide`", array());
				foreach ($selectSlide as $slide) {
					echo 	'<div class="row">
								<div class="small-12 columns">
									<img src="slide/'.$slide["imagem"].'" style="width: 100%;" />
								</div>
							</div>
							<div class="row">
								<form>
									<div class="small-9 columns">
										<div class="row collapse" style="margin-top: 8px;">
									        <div class="small-10 columns">
									          <input type="text" value="'.$slide["link"].'">
									        </div>
									        <div class="small-2 columns">
									          <input type="submit" class="button right postfix" value="Modificar" />
									        </div>
									    </div>
									</div>
									<div class="small-3 columns"><input type="submit" class="button right small" value="Excluir" /></div>
								</form>
							</div>';
				}
				?>
				