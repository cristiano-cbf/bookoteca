<?php
require_once("templates/header.php");

require_once("../models/Users.php");
require_once("../dao/UserDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);

$userData = $userDao->verifyToken(true);
?>

<div id="main-container" class="container-fluid">
    <div class=" new-book-container">
        <h1 class="page-title">Adicionar Livro</h1>
        <form action="<?= $BASE_URL ?>../controller/book_process.php" id="add-book-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Título:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do seu livro">
                    </div>
                    <div class="form-group">
                        <label for="image">Imagem:</label>
                        <input type="file" class="form-control-file" name="image" id="image">
                    </div>
                    <div class="form-group">
                        <label for="author">Autor(a):</label>
                        <input type="text" class="form-control" id="author" name="author" placeholder="Digite o nome do(a) autor(a)">
                    </div>
                    <div class="form-group">
                        <label for="genre">Gênero:</label>
                        <select name="genre" id="genre" class="form-control">
                            <option value="">Selecione</option>
                            <option value="Aventura">Aventura</option>
                            <option value="Autoajuda">Autoajuda</option>
                            <option value="Biografia">Biografia</option>
                            <option value="Ciência">Ciência</option>
                            <option value="Contos">Contos</option>
                            <option value="Fantasia">Fantasia</option>
                            <option value="Ficção Científica">Ficção Científica</option>
                            <option value="Filosofia">Filosofia</option>
                            <option value="História">História</option>
                            <option value="Infantil">Infantil</option>
                            <option value="Mistério">Mistério</option>
                            <option value="Negócios">Negócios</option>
                            <option value="Poesia">Poesia</option>
                            <option value="Religião">Religião</option>
                            <option value="Romance">Romance</option>
                            <option value="Suspense">Suspense</option>
                            <option value="Tecnologia">Tecnologia</option>
                            <option value="Terror">Terror</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="release_date">Data de Lançamento:</label>
                        <input type="date" class="form-control" id="release_date" name="release_date" placeholder="Selecione a data de lançamento">
                    </div>
                    <div class="form-group">
                        <label for="summary">Resumo:</label>
                        <textarea name="summary" id="summary" rows="5" class="form-control" placeholder="Descreva o livro..."></textarea>
                    </div>
                    <input type="submit" class="btn card-btn" value="Adicionar livro">
                </div>
            </div>
        </form>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>
