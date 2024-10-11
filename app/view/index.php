<?php

require_once("templates/header.php");
require_once("../dao/BookDAO.php");

$bookDao = new BookDAO($conn, $BASE_URL);

// quantidade de livros por página
$limit = 8;

// pagina atual via GET
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$latestBooks = $bookDao->getBooksByPage($limit, $offset);

// Busque o total de livros para calcular o número de páginas
$totalBooks = $bookDao->getTotalBooks();
$totalPages = ceil($totalBooks / $limit);

?>
<div id="main-container" class="container-fluid">
    <div class="row">
    <div class="col-md-3">
        <?php require_once("templates/sidebar.php");  ?>
</div>
        <!-- Conteúdo principal -->
        <div class="col-md-9">
            <h2 class="section-title">Todos os livros</h2>
            <p class="section-description">Confira todos os livros cadastrados na Bookoteca</p>
            <div class="books-container">
                <?php foreach($latestBooks as $book): ?>
                  
                    <?php require("templates/book_card.php"); ?>
                <?php endforeach; ?>
                <?php if(count($latestBooks) === 0): ?>
                    <p class="empty-list">Ainda não há livros cadastrados!</p>
                <?php endif; ?>
            </div>

            <!-- Paginação -->
            <nav aria-label="Paginação">
                <ul class="pagination">
                    <!-- página anterior -->
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1; ?>">Anterior</a>
                        </li>
                    <?php endif; ?>

                    <!-- página -->
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- próxima página -->
                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1; ?>">Próxima</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>
