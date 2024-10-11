<?php

require_once("../../config/globals.php");
require_once("../../config/db.php");
require_once("../models/Message.php");
require_once("../dao/UserDAO.php");
require_once("../dao/BookDAO.php");
require_once("../dao/FavoriteDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$bookDao = new BookDAO($conn, $BASE_URL);
$favoriteDao = new FavoriteDAO($conn);

// Recebendo o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgatando dados do usuário
$userData = $userDao->verifyToken();

if ($type === "toggle_favorite") {

    // Recebendo os dados do post
    $bookId = filter_input(INPUT_POST, "book_id", FILTER_VALIDATE_INT);
    $userId = $userData->id;

    // Validando se o livro existe
    $bookData = $bookDao->findById($bookId);

    if ($bookData) {

        // Verifica se o livro já está favoritado
        if ($favoriteDao->isFavorite($userId, $bookId)) {
            // Remove dos favoritos
            $favoriteDao->removeFavorite($userId, $bookId);
            $message->setMessage("Livro removido dos favoritos!", "success", "back");
        } else {
            // Adiciona aos favoritos
            $favoriteDao->addFavorite($userId, $bookId);
            $message->setMessage("Livro adicionado aos favoritos!", "success", "back");
        }

    } else {
        $message->setMessage("Livro inválido!", "error", "index.php");
    }

} else {
    $message->setMessage("Ação inválida!", "error", "index.php");
}

