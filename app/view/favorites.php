<?php
  require_once("templates/header.php");

  // Verifica se o usuário está autenticado
  require_once("../models/Users.php");
  require_once("../dao/UserDAO.php");
  require_once("../dao/BookDAO.php");
  require_once("../dao/FavoriteDAO.php");

  $user = new User();
  $userDao = new UserDao($conn, $BASE_URL);
  $bookDao = new BookDAO($conn, $BASE_URL);
  $favoriteDao = new FavoriteDAO($conn, $BASE_URL);

  // Obtém os dados do usuário
  $userData = $userDao->verifyToken(true);

  // Obtém os livros favoritados pelo usuário
  $favoriteBooks = $favoriteDao->getUserFavorites($userData->id);

?>
  <div id="main-container" class="container-fluid">
    <h2 class="section-title">Meus Favoritos</h2>
    <p class="section-description">Veja os livros que você marcou como favorito e desfavorite-os se desejar.</p>

    <div class="col-md-12" id="favorites-container">

      <?php if (count($favoriteBooks) > 0): ?>
        <!-- Tabela de livros favoritados -->
        <table class="table">
          <thead>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col" class="actions-column">Ações</th>
          </thead>
          <tbody>
            <?php foreach($favoriteBooks as $favorite): ?>
              <?php
                $book = $bookDao->findById($favorite['book_id']);
              ?>
              <tr>
                <td scope="row"><?= $book->id ?></td>
                <td><a href="<?= $BASE_URL ?>book.php?id=<?= $book->id ?>" class="table-book-title"><?= $book->title ?></a></td>
                <td class="actions-column">
                  <form action="<?= $BASE_URL ?>../controller/favorite_process.php" method="POST">
                    <input type="hidden" name="type" value="toggle_favorite">
                    <input type="hidden" name="book_id" value="<?= $book->id ?>">
                    <button type="submit" class="delete-btn">
                      <i class="fas fa-heart-broken"></i> Desfavoritar
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <!-- Mensagem de ausência de favoritos -->
        <p>Você ainda não favoritou nenhum livro.</p>
        <p>Visite a <a href="<?= $BASE_URL ?>index.php">página inicial</a> para conhecer os livros disponíveis.</p>
      <?php endif; ?>
      
    </div>
  </div>

<?php
  require_once("templates/footer.php");
?>
