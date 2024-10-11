<!-- Sidebar -->
<aside class="col-md-2 sidebar" id="book-sidebar">
    <h3 class="sidebar-heading">BUSCAR LIVROS</h3>
    <!-- Formulário de busca por título -->
    <form action="<?= $BASE_URL ?>search.php" method="GET" id="search-title-form" class="search-form">
        <input type="text" name="q" id="search-title" class="form-control search-input" placeholder="Buscar por TÍTULO" aria-label="Search">
        <button class="btn search-btn" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>

    <!-- Formulário de busca por autor -->
    <form action="<?= $BASE_URL ?>search_author.php" method="GET" id="search-author-form" class="search-form">
        <input type="text" name="q" id="search-author" class="form-control search-input" placeholder="Buscar por AUTOR" aria-label="Search">
        <button class="btn search-btn" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>

    
    <div class="genres-container">
    <h3 class="sidebar-heading">GÊNEROS:</h3>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Aventura" class="genre-item">Aventura</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Autoajuda" class="genre-item">Autoajuda</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Biografia" class="genre-item">Biografia</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Ciência" class="genre-item">Ciência</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Contos" class="genre-item">Contos</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Fantasia" class="genre-item">Fantasia</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Ficção Científica" class="genre-item">Ficção Científica</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Filosofia" class="genre-item">Filosofia</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=História" class="genre-item">História</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Infantil" class="genre-item">Infantil</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Mistério" class="genre-item">Mistério</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Negócios" class="genre-item">Negócios</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Poesia" class="genre-item">Poesia</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Religião" class="genre-item">Religião</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Romance" class="genre-item">Romance</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Suspense" class="genre-item">Suspense</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Tecnologia" class="genre-item">Tecnologia</a>
        <a href="<?= $BASE_URL ?>search_genre.php?q=Terror" class="genre-item">Terror</a>
    </div>
</aside>
