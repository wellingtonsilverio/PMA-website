<?php
session_start();
include 'class/banco.class.php';

$objConn = new Connection();

$selectInformacoes = $objConn ->selectQuery("SELECT * FROM `informacoes`", array());
foreach ($selectInformacoes as $informacoes) {
	$$informacoes["nome"] = $informacoes["conteudo"];
}

if(isset($_POST['infoCon'])){
	$conteudo = $_POST['infoCon'];
	$nome = $_POST['infoNom'];
	$objConn->query("UPDATE `informacoes` SET `conteudo` = ? WHERE `nome` = ?", array($conteudo, $nome));
	header("Location: painel.php");
}
?>
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="pt-br" > <![endif]-->
<html class="no-js" lang="pt-br" >
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Painel de Administração - <?php echo $titulo; ?></title>
		<link rel="stylesheet" href="../css/normalize.css">
		<link rel="stylesheet" href="../css/foundation.css">
		<link rel="stylesheet" href="../css/app.css">
		<script src="../js/vendor/modernizr.js"></script>
	</head>
	<body>

		<nav class="top-bar" data-topbar>
			<ul class="title-area">
				<li class="name">
					<h1><a href="#"><?php echo $nome; ?></a></h1>
				</li>
				<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
				<li class="toggle-topbar menu-icon">
					<a href="#"><span>Menu</span></a>
				</li>
			</ul>
			<section class="top-bar-section">
				<!-- Right Nav Section -->
				<ul class="left">
					<li class="active">
						<a href="#">Painel de Informações</a>
					</li>
					<li>
						<a href="#">Painel do Slide</a>
					</li>
					<li>
						<a href="#">Painel de Noticias</a>
					</li>
					<li>
						<a href="#">Painel de Imagem</a>
					</li>
					<li class="has-dropdown">
						<a href="#">Opções</a>
						<ul class="dropdown">
							<li>
								<a href="#">Editar Perfil</a>
								<a href="#">Entrar em contato com o Desenvolvedor</a>
							</li>
						</ul>
					</li>
				</ul>
				<!-- Left Nav Section -->
				<ul class="right">
					<li>
						<a href="#"><?php echo $_SESSION['nome']; ?>, Sair</a>
					</li>
				</ul>
			</section>
		</nav>
		
		<div class="row">
			<div class="small-3 columns">
				<!--
					Logo
					Tutoriais
					 -->
			</div>
			<div class="small-9 columns">
				<?php include('slide.php'); ?>
				
			</div>
		</div>

		<script src="../js/vendor/jquery.js"></script>
		<script src="../js/foundation.min.js"></script>
		<script>
			$(document).foundation();
		</script>
	</body>
</html>