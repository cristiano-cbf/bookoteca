<?php

require_once("../models/Review.php");
require_once("../models/Message.php");
require_once("UserDAO.php");

class ReviewDao implements ReviewDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildReview($data) {
        $reviewObject = new Review();
        $reviewObject->id = $data["id"];
        $reviewObject->rating = $data["rating"];
        $reviewObject->review = $data["review"];
        $reviewObject->users_id = $data["users_id"];
        $reviewObject->books_id = $data["books_id"];
        $reviewObject->created_at = $data["created_at"];
        return $reviewObject;
    }

    public function create(Review $review) {
        $stmt = $this->conn->prepare("INSERT INTO reviews (
            rating, review, books_id, users_id
        ) VALUES (
            :rating, :review, :books_id, :users_id
        )");

        $stmt->bindParam(":rating", $review->rating);
        $stmt->bindParam(":review", $review->review);
        $stmt->bindParam(":books_id", $review->books_id);
        $stmt->bindParam(":users_id", $review->users_id);

        $stmt->execute();

        $this->message->setMessage("Crítica adicionada com sucesso!", "success", "../view/index.php");

        //$this->sendEmailNotification($review);
    }

    /*private function sendEmailNotification(Review $review) {
        $userDao = new UserDao($this->conn, $this->url);
        $bookDao = new BookDao($this->conn, $this->url);
        $bookData = $bookDao->findById($review->books_id);

        // Resgata o usuário que adicionou o livro
        $userWhoAdded = $userDao->findById($bookData->users_id);

        if ($userWhoAdded && !empty($userWhoAdded->email)) {
            $to = $userWhoAdded->email;
            $subject = "Novo comentário na sua obra: " . $bookData->title;

            $message = "Um novo comentário foi adicionado à sua obra $bookData->title no Bookoteca:                    
                    Comentário: {$review->review}<br>
                    Obrigado por compartilhar sua obra com a comunidade de leitores!<br>
                    Atenciosamente,<br>A equipe do Bookoteca<br>
            ";

            mail($to, $subject, $message, "Content-type:text/html;charset=UTF-8");
        }
    }*/

    public function getBooksReview($id) {
        $reviews = [];
        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE books_id = :books_id ORDER BY created_at DESC");
        $stmt->bindParam(":books_id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $reviewsData = $stmt->fetchAll();
            $userDao = new UserDao($this->conn, $this->url);

            foreach ($reviewsData as $review) {
                $reviewObject = $this->buildReview($review);
                $user = $userDao->findById($reviewObject->users_id);
                $reviewObject->user = $user;
                $reviews[] = $reviewObject;
            }
        }
        return $reviews;
    }


    public function hasAlreadyReviewed($id, $userId) {
        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE books_id = :books_id AND users_id = :users_id");
        $stmt->bindParam(":books_id", $id);
        $stmt->bindParam(":users_id", $userId);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }


    public function getCommentCountByUserId($userId) {
      $stmt = $this->conn->prepare("SELECT COUNT(*) AS count FROM reviews WHERE users_id = :users_id");
      $stmt->bindParam(":users_id", $userId);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result['count'];
  }

    public function getRatings($id) {
        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE books_id = :books_id");
        $stmt->bindParam(":books_id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $rating = 0;
            $reviews = $stmt->fetchAll();

            foreach ($reviews as $review) {
                $rating += $review["rating"];
            }

            $rating = $rating / count($reviews);
        } else {
            $rating = "N/A";
        }

        return $rating;
    }
}
