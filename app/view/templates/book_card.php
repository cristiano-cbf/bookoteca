<?php 

require_once("../dao/FavoriteDAO.php");
$favoriteDao = new FavoriteDAO($conn);

// Verifica se o livro tem uma imagem definida, caso contrário, usa uma imagem padrão
if (empty($book['image'])) {
  $book['image'] = "book_cover.jpg";
}

// Verifica se o usuário está logado
$userLoggedIn = isset($userData) && !empty($userData);

// Verifica se o livro está favoritado pelo usuário (caso o usuário esteja logado)
$isFavorite = false;
if ($userLoggedIn) {
  $isFavorite = $favoriteDao->isFavorite($userData->id, $book['id']);
}

$releaseDate = date('d/m/Y', strtotime($book['release_date']));

?>
<div class="card book-card">
  <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?>../../public/img/cover/<?= $book['image'] ?>')"></div>
  <div class="card-body">

    <div class="card-header">
      <p class="card-date"><?= $releaseDate; ?></p> 
      
      <div class="card-favorite">
        <?php if ($userLoggedIn): ?>
          <form method="POST" action="<?= $BASE_URL ?>../controller/favorite_process.php">
            <input type="hidden" name="book_id" value="<?= $book['id']; ?>">
            <input type="hidden" name="type" value="toggle_favorite">
            
            <!-- Ícone de estrela para favoritar/desfavoritar -->
            <button type="submit" class="favorite-btn">
              <i class="fas <?= $isFavorite ? 'fa-star favorited star-icon' : 'fa-star not-favorited star-icon'; ?>"></i>
            </button>
          </form>
        <?php else: ?>
          <!-- Exibe ícone de estrela com contorno desabilitado quando o usuário não está logado -->
          <i class="fas fa-star not-favorited star-icon" title="Faça login para favoritar"></i>
        <?php endif; ?>
      </div>
    </div>

    <h5 class="card-title">
      <a href="<?= $BASE_URL ?>book.php?id=<?= $book['id'] ?>"><?= $book['title'] ?></a>
    </h5>
    <p><?= $book['author'] ?></p>
    <a href="<?= $BASE_URL ?>book.php?id=<?= $book['id'] ?>" class="btn btn-primary rate-btn">Saiba mais</a>
  </div>
</div>
