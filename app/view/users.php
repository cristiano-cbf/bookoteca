<?php
require_once("templates/header.php");
require_once("../models/Users.php");
require_once("../dao/UserDAO.php");
require_once("../dao/ReviewDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);
$reviewDao = new ReviewDAO($conn, $BASE_URL);

// Verifica o token do usuário
$userData = $userDao->verifyToken(true);

// Recupera todos os usuários
$allUsers = $userDao->getAllUsers(); // Método que deve ser implementado no UserDAO

?>
<div id="main-container" class="container-fluid">
    <h2 class="section-title">Usuários e Comentários</h2>
    <p class="section-description">Lista de todos os usuários e quantos comentários cada um já fez em livros.</p>
    
    <div class="col-md-12" id="users-dashboard">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Comentários</th>
                    <th scope="col">Nível</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allUsers as $user): ?>
                <tr>
                    <td scope="row"><?= $user->id ?></td>
                    <td><?= htmlspecialchars($user->name) ?></td>
                    <td><?= htmlspecialchars($user->email) ?></td>
                    <td>
                        <?php
                        // Obtém o número de comentários feitos pelo usuário
                        $commentCount = $reviewDao->getCommentCountByUserId($user->id); // Método que deve ser implementado no ReviewDAO
                        echo $commentCount;
                        ?>
                    </td>
                    <td>
                        <?php
                        // Verifica se o usuário é admin ou não
                        if ($user->status == 2) {
                            echo "Admin";
                        } else {
                            echo "Básico";
                        }
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
require_once("templates/footer.php");
?>
