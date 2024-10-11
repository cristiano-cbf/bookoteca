<?php
require_once("templates/header.php");

// Verifica se usuário está autenticado
require_once("../models/Book.php");
require_once("../dao/BookDAO.php");
require_once("../dao/ReviewDAO.php");
require_once("../dao/UserDAO.php"); // Adicionei a classe UserDAO

// Pegar o id do livro
$id = filter_input(INPUT_GET, "id");

$book;

$bookDao = new BookDAO($conn, $BASE_URL);
$reviewDao = new ReviewDAO($conn, $BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL); // Inicializando o UserDAO

if (empty($id)) {
    $message->setMessage("O livro não foi encontrado!", "error", "index.php");
} else {
    $book = $bookDao->findById($id);

    // Verifica se o livro existe
    if (!$book) {
        $message->setMessage("O livro não foi encontrado!", "error", "index.php");
    }
}

// Checar se o livro tem imagem
if ($book->image == "") {
    $book->image = "book_cover.jpg";
}

// Checar se o livro é do usuário
$userOwnsBook = false;

if (!empty($userData)) {
    if ($userData->id === $book->users_id) {
        $userOwnsBook = true;
    }

    // Resgatar as reviews do livro
    $alreadyReviewed = $reviewDao->hasAlreadyReviewed($id, $userData->id);
}

// Resgatar as reviews do livro
$bookReviews = $reviewDao->getBooksReview($book->id);

// Resgatar o nome do usuário que adicionou o livro
$userWhoAdded = $userDao->findById($book->users_id);


?>

<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-1 col-md-6 book-container">
            <h1 class="page-title"><?= $book->title ?></h1>
            <p class="book-details">
                <span>Autor(a): <?= $book->author ?></span>
                <span class="pipe"></span>
                <span><?= $book->genre ?></span>
                <span class="pipe"></span>
                <span><i class="fas fa-star"></i> <?= $book->rating ?></span>
            </p>
            <p><?= $book->summary ?></p>
            <p style="font-style: italic;">Livro adicionado por: <?= $userWhoAdded->name ?> <?= $userWhoAdded->lastname ?></p>
        </div>
        <div class="col-md-4">
            <div class="book-image-container" style="background-image: url('<?= $BASE_URL ?>../../public/img/cover/<?= $book->image ?>')"></div>
        </div>
        <div class="offset-md-1 col-md-10" id="reviews-container">
            <h3 id="reviews-title">Avaliações:</h3>
            <!-- Verifica se habilita a review para o usuário ou não -->
            <?php if (!empty($userData) && !$userOwnsBook && !$alreadyReviewed): ?>
            <div class="col-md-12" id="review-form-container">
                <h4>Envie sua avaliação:</h4>
                <p class="page-description">Preencha o formulário com a nota e comentário sobre o livro</p>
                <form action="<?= $BASE_URL ?>../controller/review_process.php" id="review-form" method="POST">
                    <input type="hidden" name="type" value="create">
                    <input type="hidden" name="books_id" value="<?= $book->id ?>">
                    <div class="form-group">
                        <label for="rating">Nota do livro:</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="">Selecione</option>
                            <option value="10">10</option>
                            <option value="9">9</option>
                            <option value="8">8</option>
                            <option value="7">7</option>
                            <option value="6">6</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review">Seu comentário:</label>
                        <textarea name="review" id="review" rows="3" class="form-control" placeholder="O que você achou do livro?"></textarea>
                    </div>
                    <input type="submit" class="btn card-btn" value="Enviar comentário">
                </form>
            </div>
            <?php endif; ?>
            <!-- Comentários -->
            <?php foreach ($bookReviews as $review): ?>
                <?php require("user_review.php"); ?>
            <?php endforeach; ?>
            <?php if (count($bookReviews) == 0): ?>
                <p class="empty-list">Não há comentários para este livro ainda...</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
require_once("templates/footer.php");
?>
