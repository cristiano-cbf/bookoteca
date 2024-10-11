<?php

require_once("../models/Favorites.php");
require_once("../models/Message.php");

require_once("UserDAO.php");

class FavoriteDAO implements FavoriteDAOInterface {

    private $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function buildFavorite($data) {
        $favorite = new Favorite();
        $favorite->id = $data['id'];
        $favorite->user_id = $data['user_id'];
        $favorite->book_id = $data['book_id'];

        return $favorite;
    }

    public function addFavorite($userId, $bookId) {
        $query = "INSERT INTO favorites (user_id, book_id) VALUES (:user_id, :book_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":book_id", $bookId);

        $stmt->execute();
    }

    public function removeFavorite($userId, $bookId) {
        $query = "DELETE FROM favorites WHERE user_id = :user_id AND book_id = :book_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":book_id", $bookId);

        $stmt->execute();
    }

    public function isFavorite($userId, $bookId) {
        $query = "SELECT * FROM favorites WHERE user_id = :user_id AND book_id = :book_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":book_id", $bookId);

        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function getUserFavorites($userId) {
        $query = "SELECT book_id FROM favorites WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $userId);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
