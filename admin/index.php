<?php
session_start();
include 'class/banco.class.php';

$objConn = new Connection();

$selectInformacoes = $objConn->selectQuery("SELECT * FROM `informacoes`", array());
foreach($selectInformacoes as $informacoes){
	$$informacoes["nome"] = $informacoes["conteudo"];
}

if(isset($_SESSION['email'])){
	header("Location: painel.php");
}
?>
<?php
$redirectUri = urlencode('http://www.partidodomeioambiente.org.br/admin');
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['code'])){
 
  // Informe o seu App ID abaixo
  $appId = '335800829903605';
 
  // Digite o App Secret do seu aplicativo abaixo:
  $appSecret = '8642b71283ab7309aff7802c317b4496';
 
  // Url informada no campo "Site URL"
 
  // Obtém o código da query string
  $code = $_GET['code'];
 
  // Monta a url para obter o token de acesso e assim obter os dados do usuário
  $token_url = "https://graph.facebook.com/oauth/access_token?"
  . "client_id=" . $appId . "&redirect_uri=" . $redirectUri
  . "&client_secret=" . $appSecret . "&code=" . $code;
 
  //pega os dados
  $response = @file_get_contents($token_url);
  if($response){
    $params = null;
    parse_str($response, $params);
    if(isset($params['access_token']) && $params['access_token']){
      $graph_url = "https://graph.facebook.com/me?access_token="
      . $params['access_token'];
      $user = json_decode(file_get_contents($graph_url));
 
    // nesse IF verificamos se veio os dados corretamente
      if(isset($user->email) && $user->email){
 
    /*
    *Apartir daqui, você já tem acesso aos dados usuario, podendo armazená-los
    *em sessão, cookie ou já pode inserir em seu banco de dados para efetuar
    *autenticação.
    *No meu caso, solicitei todos os dados abaixo e guardei em sessões.
    */
 
        $_SESSION['email'] = $user->email;
        $_SESSION['nome'] = $user->name;
        $_SESSION['uid_facebook'] = $user->id;
        $_SESSION['link_facebook'] = $user->link;
		header("Location: index.php");
      }
    }else{
      echo "Erro de conexão com Facebook";
      exit(0);
    }
 
  }else{
    echo "Erro de conexão com Facebook";
    exit(0);
  }
}else if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['error'])){
  echo 'Permissão não concedida';
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
	<body class="bgAdmin">
		<div class="paineldelogin">
			<h3>Por favor, entre</h3>
			<div>
				<a href="https://www.facebook.com/dialog/oauth?client_id=335800829903605&redirect_uri=<?php echo $redirectUri; ?>&scope=email"><img src="../img/facebook.png" style="width: 100%; max-width: 300px;" /></a>
			</div>
		</div>
		
		<script src="../js/vendor/jquery.js"></script>
		<script src="../js/foundation.min.js"></script>
		<script>
			$(document).foundation();
		</script>
	</body>
</html>