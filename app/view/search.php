<?php
require_once("templates/header.php");
require_once("../dao/BookDAO.php");

// DAO dos livros
$bookDao = new BookDAO($conn, $BASE_URL);

// Resgata busca do usuário
$q = filter_input(INPUT_GET, "q");

// Defina a quantidade de livros por página
$limit = 8;

// Verifique qual é a página atual via GET, ou defina como 1 por padrão
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Resgata os livros com base no título e com paginação
$books = $bookDao->findByTitleWithPagination($q, $limit, $offset);

// Resgata o total de livros para calcular o número de páginas
$totalBooks = $bookDao->getTotalBooksByTitle($q);
$totalPages = ceil($totalBooks / $limit);

// Converte os objetos Book em arrays
$booksArray = array_map(function($book) {
    return [
        'id' => $book->id,
        'title' => $book->title,
        'image' => $book->image,
        'rating' => $book->rating,
        'author' => $book->author, 
        'genre' => $book->genre,
        'release_date' => $book->release_date
    ];
}, $books);
?>
<div id="main-container" class="container-fluid">
    <div class="row">
    <div class="col-md-3">
        <?php require_once("templates/sidebar.php");  ?>
    </div>
    <div class="col-md-9">
        <h2 class="section-title" id="search-title">Você está buscando por: <span id="search-result"><?= $q ?></span></h2>
        <p class="section-description">Resultados de busca retornam livros com base no título da sua pesquisa.</p>
        <div class="books-container">
            <?php foreach($booksArray as $book): ?>
                <?php require("templates/book_card.php"); ?>
            <?php endforeach; ?>
            <?php if(count($booksArray) === 0): ?>
                <p class="empty-list">Não há livros para esta busca, <a href="<?= $BASE_URL ?>" class="back-link">voltar</a>.</p>
            <?php endif; ?>
        </div>

        <!-- Paginação -->
        <nav aria-label="Paginação">
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?q=<?= urlencode($q) ?>&page=<?= $page - 1; ?>">Anterior</a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : ''; ?>">
                        <a class="page-link" href="?q=<?= urlencode($q) ?>&page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?q=<?= urlencode($q) ?>&page=<?= $page + 1; ?>">Próxima</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>
<?php
require_once("templates/footer.php");
?>
