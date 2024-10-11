<?php

require_once("../models/Message.php");
require_once("../dao/UserDAO.php");
require_once("../../config/globals.php");
require_once("../../config/db.php");

$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();

if(!empty($flassMessage["msg"])) {
  // Limpar a mensagem
  $message->clearMessage();
}

$userDao = new UserDAO($conn, $BASE_URL);
$userData = $userDao->verifyToken(false);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookoteca</title>
  <link rel="short icon" href="<?= $BASE_URL ?>../../public/img/bookoteca.ico" />
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css" integrity="sha512-drnvWxqfgcU6sLzAJttJv7LKdjWn0nxWCSbEAtxJ/YYaZMyoNLovG7lPqZRdhgL1gAUfa+V7tbin8y+2llC1cw==" crossorigin="anonymous" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <!-- CSS do projeto -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>../../public/css/styles.css">
</head>
<body>
<header>
  <nav id="main-navbar" class="navbar navbar-expand-lg">
    <a href="<?= $BASE_URL ?>" class="navbar-brand">
      <span id="bookoteca-title">BOOKOTECA</span>
      <img src="<?= $BASE_URL ?>../../public/img/logo.svg" alt="Bookoteca" id="logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav">
        <?php if($userData): ?>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>newbook.php" class="nav-link">
              <i class="far fa-plus-square"></i> Adicionar Livro
            </a>
          </li>
          
          <!-- Botão Lista de Usuários que aparece apenas se o status do usuário for igual a 2 -->
          <?php if ($userData->status == 2): ?>
          <li class="nav-item user-list-item">
            <a href="<?= $BASE_URL ?>users.php" class="nav-link">
              <i class="fas fa-users"></i> Lista de Usuários
            </a>
          </li>
          <?php endif; ?>

          <li class="nav-item">
            <a href="<?= $BASE_URL ?>dashboard.php" class="nav-link">Meus Livros</a>
          </li>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>favorites.php" class="nav-link">Favoritos</a>
          </li>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>editprofile.php" class="nav-link bold">
              <?= $userData->name ?>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>../controller/logout.php" class="nav-link">Sair</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>auth.php" class="nav-link">Entrar / Cadastrar</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>

  <!-- Lista de Gêneros -->
</header>

<?php if(!empty($flassMessage["msg"])): ?>
  <div class="msg-container">
    <p class="msg <?= $flassMessage["type"] ?>"><?= $flassMessage["msg"] ?></p>
  </div>
<?php endif; ?>
