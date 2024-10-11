<?php
  require_once("templates/header.php");

  // Verifica se usuário está autenticado
  require_once("../models/Users.php");
  require_once("../dao/UserDAO.php");
  require_once("../dao/BookDAO.php");

  $user = new User();
  $userDao = new UserDao($conn, $BASE_URL);

  $userData = $userDao->verifyToken(true);

  $bookDao = new BookDAO($conn, $BASE_URL);

  $id = filter_input(INPUT_GET, "id");

  if(empty($id)) {

    $message->setMessage("O livro não foi encontrado!", "error", "index.php");

  } else {

    $book = $bookDao->findById($id);

    // Verifica se o livro existe
    if(!$book) {

      $message->setMessage("O livro não foi encontrado!", "error", "index.php");

    }

  }

  // Checar se o livro tem imagem
  if($book->image == "") {
    $book->image = "book_cover.jpg";
  }

?>
  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6 offset-md-1">
          <h1><?= $book->title ?></h1>
          <p class="page-summary">Altere os dados do livro no fomrulário abaixo:</p>
          <form id="edit-book-form" action="<?= $BASE_URL ?>../controller/book_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <input type="hidden" name="id" value="<?= $book->id ?>">
            <div class="form-group">
              <label for="title">Título:</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do seu livro" value="<?= $book->title ?>">
            </div>
            <div class="form-group">
              <label for="image">Imagem:</label>
              <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <div class="form-group">
              <label for="author">Autor(a):</label>
              <input type="text" class="form-control" id="author" name="author" placeholder="Digite a duração do livro" value="<?= $book->author ?>">
            </div>
            <div class="form-group">
    <label for="genre">Categoria:</label>
    <select name="genre" id="genre" class="form-control">
        <option value="">Selecione</option>
        <option value="Aventura" <?= $book->genre === "Aventura" ? "selected" : "" ?>>Aventura</option>
        <option value="Autoajuda" <?= $book->genre === "Autoajuda" ? "selected" : "" ?>>Autoajuda</option>
        <option value="Biografia" <?= $book->genre === "Biografia" ? "selected" : "" ?>>Biografia</option>
        <option value="Ciência" <?= $book->genre === "Ciência" ? "selected" : "" ?>>Ciência</option>
        <option value="Contos" <?= $book->genre === "Contos" ? "selected" : "" ?>>Contos</option>
        <option value="Fantasia" <?= $book->genre === "Fantasia" ? "selected" : "" ?>>Fantasia</option>
        <option value="Ficção Científica" <?= $book->genre === "Ficção Científica" ? "selected" : "" ?>>Ficção Científica</option>
        <option value="Filosofia" <?= $book->genre === "Filosofia" ? "selected" : "" ?>>Filosofia</option>
        <option value="História" <?= $book->genre === "História" ? "selected" : "" ?>>História</option>
        <option value="Infantil" <?= $book->genre === "Infantil" ? "selected" : "" ?>>Infantil</option>
        <option value="Mistério" <?= $book->genre === "Mistério" ? "selected" : "" ?>>Mistério</option>
        <option value="Negócios" <?= $book->genre === "Negócios" ? "selected" : "" ?>>Negócios</option>
        <option value="Poesia" <?= $book->genre === "Poesia" ? "selected" : "" ?>>Poesia</option>
        <option value="Religião" <?= $book->genre === "Religião" ? "selected" : "" ?>>Religião</option>
        <option value="Romance" <?= $book->genre === "Romance" ? "selected" : "" ?>>Romance</option>
        <option value="Suspense" <?= $book->genre === "Suspense" ? "selected" : "" ?>>Suspense</option>
        <option value="Tecnologia" <?= $book->genre === "Tecnologia" ? "selected" : "" ?>>Tecnologia</option>
        <option value="Terror" <?= $book->genre === "Terror" ? "selected" : "" ?>>Terror</option>
    </select>
</div>

            <div class="form-group">
              <label for="release_date">Data de Lançamento:</label>
              <input type="date" class="form-control" id="release_date" name="release_date" placeholder="Selecione a date de lançamento" value="<?= $book->release_date ?>">
            </div>

            <div class="form-group">
              <label for="summary">Resumo:</label>
              <textarea name="summary" id="summary" rows="5" class="form-control" placeholder="Descreva o livro..."><?= $book->summary ?></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Editar livro">
          </form>
        </div>
        <div class="col-md-3">
          <div class="book-image-container" style="background-image: url('http://localhost/projetos/bookoteca/public/img/cover/<?= $book->image ?>')"></div>
        </div>
      </div>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>
