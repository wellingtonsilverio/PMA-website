<?php
include 'admin/class/banco.class.php';

$objConn = new Connection();

$selectInformacoes = $objConn->selectQuery("SELECT * FROM `informacoes`", array());
foreach($selectInformacoes as $informacoes){
	$$informacoes["nome"] = $informacoes["conteudo"];
}
?>
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="pt-br" > <![endif]-->
<html class="no-js" lang="pt-br" >
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $titulo; ?></title>
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/foundation.css">
		<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
		<link rel="stylesheet" href="css/app.css">
		<script src="js/vendor/modernizr.js"></script>
	</head>
	<body>

		<!-- SLIDER http://kenwheeler.github.io/slick/ -->
		<section class="full-row slide hide">
			<div class="single-item">
				<?php
				$selectSlide = $objConn->selectQuery("SELECT * FROM `slide` ORDER BY `id` DESC", array());
				foreach($selectSlide as $slide){
					echo 	'<div>
								<a href="'.$slide["link"].'"><img src="admin/slide/'.$slide["imagem"].'" title="'.$slide["titulo"].'" /></a>
							</div>';
				}
				?>
			</div>
		</section>
		<!-- SLIDER end -->

		<section class="row">
			<?php
			$selectNoticias1 = $objConn->selectQuery("SELECT * FROM `noticias` ORDER BY `id` DESC LIMIT 0,1", array());
			foreach($selectNoticias1 as $noticia1){
				$categoria = $objConn->selectQuery("SELECT * FROM `categorias` WHERE `id` = '".$noticia1["categoria"]."'", array());
				echo 	'<div class="small-6 columns">
							<div class="row">
								<div class="destaque" style="background-image: url(admin/noticias/'.$noticia1["imagem"].');">
									<div>
										'.$categoria[0]["titulo"].'
									</div>
									<p>
										'.$noticia1["titulo"].'
									</p>
								</div>
							</div>
						</div>';
			}
			?>
			<?php
			$selectNoticias2 = $objConn->selectQuery("SELECT * FROM `noticias` ORDER BY `id` DESC LIMIT 1,2", array());
			foreach($selectNoticias2 as $noticia2){
				$categoria = $objConn->selectQuery("SELECT * FROM `categorias` WHERE `id` = '".$noticia2["categoria"]."'", array());
				echo 	'<div class="small-3 columns">
							<div class="row">
								<div class="destaque" style="background-image: url(admin/noticias/'.$noticia2["imagem"].');">
									<div>
										'.$categoria[0]["titulo"].'
									</div>
									<p>
										'.$noticia2["titulo"].'
									</p>
								</div>
							</div>
						</div>';
			}
			?>
			
			<?php
			$selectNoticias = $objConn->selectQuery("SELECT * FROM `noticias` ORDER BY `id` DESC LIMIT 3,15", array());
			foreach($selectNoticias as $noticia){
				$categoria = $objConn->selectQuery("SELECT * FROM `categorias` WHERE `id` = '".$noticia["categoria"]."'", array());
				echo 	'<div class="small-4 columns">
							<div class="row noticia">
								<div class="categoria">
									'.$categoria[0]["titulo"].' $midia
								</div>
								<img src="admin/noticias/'.$noticia["imagem"].'" /><div class="small-8 columns right"><h5 class="subheader">'.$noticia["titulo"].'</h5></div>
							</div>
						</div>';
			}
			?>
			<div class="small-4 columns">
				
			</div>

		</section>

		<!-- GALLERY -->
		<section class="full-row sec-secondary">
			<div class="row">
				<div class="small-8 columns">
					<ul class="small-block-grid-2">
						<?php
						$selectImagem = $objConn->selectQuery("SELECT * FROM `imagem` ORDER BY `id` DESC LIMIT 0,6", array());
						foreach($selectImagem as $imagem){
							echo '<li><img src="admin/image/'.$imagem["imagem"].'" title="Imagem: '.$imagem["titulo"].'" /><small>'.$imagem["titulo"].'</small></li>';
						}
						?>
					</ul>
				</div>
				<div class="small-4 columns">
					<div class="row">
						<div class="small-12 columns">
							<form>
								<input type="text" />
							</form>
						</div>
						<div class="small-12 columns">
							<h1>Categorias</h1>
						</div>
						<?php
						$selectCategoria = $objConn->selectQuery("SELECT * FROM `categorias` LIMIT 0,15", array());
						foreach($selectCategoria as $categoria){
							echo 	'<div class="small-12 columns">
										<img /><small>'.$categoria["titulo"].'</small>
									</div>';
						}
						?>
					</div>
				</div>
			</div>
		</section>
		<!-- GALLERY end -->

		<!-- FOOTER -->
		<section class="full-row footer">
			<div class="row">
				<div class="small-5 columns">
					<h3><?php echo $nome; ?></h1>
					<p>
						<?php echo $sobre; ?>
					</p>
				</div>
				<div class="small-7 columns">
					<div class="row">
						<div class="small-4 columns">
							<div class="icon"></div>
							<h3>$mais</h2> <p></p>
						</div>
						<div class="small-4 columns">
							<div class="icon"></div>
							<h3>$fale</h2> <p></p>
						</div>
						<div class="small-4 columns">
							<div class="icon"></div>
							<h3>$recebanovidades</h2> <p></p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="small-8 columns">
					<ul class="no-bullet">
						<li>
							<strong><?php echo $nome; ?></strong>
						</li>
						<li class="street-address">
							<?php echo $endereco; ?>
						</li>
						<li class="locality">
							<?php echo $cidade; ?>
						</li>
						<li>
							<span class="state"><?php echo $estado; ?></span>, <span class="zip"><?php echo $codigopostal; ?></span>
						</li>
						<li>
							<span class="state"><?php echo $tel1; ?></span>: <span class="zip"><?php echo $telnum1; ?></span>
						</li>
						<li>
							<span class="state"><?php echo $tel2; ?></span>: <span class="zip"><?php echo $telnum2; ?></span>
						</li>
						<li>
							<span class="state"><?php echo $tel3; ?></span>: <span class="zip"><?php echo $telnum3; ?></span>
						</li>
						<li class="email">
							<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
						</li>
					</ul>
				</div>
				<div class="small-4 columns">
					<img src="img/logo.png" title="<?php echo $nome; ?>" />
				</div>
			</div>
		</section>
		<!-- FOOTER end -->

		<script src="js/vendor/jquery.js"></script>
		<script src="js/foundation.min.js"></script>
		<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="slick/slick.js"></script>
		<script type="text/javascript" src="js/scripts.js"></script>
	</body>
</html>