<?php

  require_once("../models/Book.php");
  require_once("../models/Message.php");
  require_once("ReviewDAO.php");

  class BookDAO implements BookDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
      $this->conn = $conn;
      $this->url = $url;
      $this->message = new Message($url);
    }

    public function buildBook($data) {

      $book = new Book();

      $book->id = $data["id"];
      $book->title = $data["title"];
      $book->author = $data["author"];
      $book->genre = $data["genre"];
      $book->release_date = $data["release_date"];
      $book->summary = $data["summary"];
      $book->image = $data["image"];      
      $book->users_id = $data["users_id"];

      // Recebe ratings do livro
      $reviewDao = new ReviewDao($this->conn, $this->url);

      $rating = $reviewDao->getRatings($book->id);

      $book->rating = $rating;

      return $book;

    }

    public function getLatestBooks() {

      $books = [];

      $stmt = $this->conn->query("SELECT * FROM books ORDER BY id DESC");

      $stmt->execute();

      if($stmt->rowCount() > 0) {

        $booksArray = $stmt->fetchAll();

        foreach($booksArray as $book) {
          $books[] = $this->buildBook($book);
        }

      }

      return $books;

    }

    public function getBooksByAuthor($author) {

      $books = [];

      $stmt = $this->conn->prepare("SELECT * FROM books WHERE author = :author ORDER BY id DESC");

      $stmt->bindParam(":author", $author);

      $stmt->execute();

      if($stmt->rowCount() > 0) {

        $booksArray = $stmt->fetchAll();

        foreach($booksArray as $book) {
          $books[] = $this->buildBook($book);
        }

      }

      return $books;

    }

    public function getBooksByUserId($id) {

      $books = [];

      $stmt = $this->conn->prepare("SELECT * FROM books
                                    WHERE users_id = :users_id");

      $stmt->bindParam(":users_id", $id);

      $stmt->execute();

      if($stmt->rowCount() > 0) {

        $booksArray = $stmt->fetchAll();

        foreach($booksArray as $book) {
          $books[] = $this->buildBook($book);
        }

      }

      return $books;

    }

    public function findById($id) {

      $book = [];

      $stmt = $this->conn->prepare("SELECT * FROM books WHERE id = :id");

      $stmt->bindParam(":id", $id);

      $stmt->execute();

      if($stmt->rowCount() > 0) {

        $bookData = $stmt->fetch();

        $book = $this->buildBook($bookData);

        return $book;

      } else {

        return false;

      }

    }

    public function findByTitle($title) {

      $books = [];

      $stmt = $this->conn->prepare("SELECT * FROM books WHERE title LIKE :title");

      $stmt->bindValue(":title", '%'.$title.'%');

      $stmt->execute();

      if($stmt->rowCount() > 0) {

        $booksArray = $stmt->fetchAll();

        foreach($booksArray as $book) {
          $books[] = $this->buildBook($book);
        }

      }

      return $books;

    }

    public function findByAuthor($author) {
      $books = [];
  
      $stmt = $this->conn->prepare("SELECT * FROM books WHERE author LIKE :author");
  
      $stmt->bindValue(":author", '%' . $author . '%');
  
      $stmt->execute();
  
      if ($stmt->rowCount() > 0) {
          $booksArray = $stmt->fetchAll();
  
          foreach ($booksArray as $book) {
              $books[] = $this->buildBook($book);
          }
      }
  
      return $books;
  }

  public function findByGenre($genre) {
    $books = [];

    $stmt = $this->conn->prepare("SELECT * FROM books WHERE genre LIKE :genre");

    $stmt->bindValue(":genre", '%' . $genre . '%');

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $booksArray = $stmt->fetchAll();

        foreach ($booksArray as $book) {
            $books[] = $this->buildBook($book);
        }
    }

    return $books;
}
  
    public function create(Book $book) {

      $stmt = $this->conn->prepare("INSERT INTO books (
        title, summary, image, author, genre, release_date, users_id
      ) VALUES (
        :title, :summary, :image, :author, :genre, :release_date, :users_id
      )");

      $stmt->bindParam(":title", $book->title);
      $stmt->bindParam(":summary", $book->summary);
      $stmt->bindParam(":author", $book->author);
      $stmt->bindParam(":genre", $book->genre);
      $stmt->bindParam(":release_date", $book->release_date);
      $stmt->bindParam(":image", $book->image);
      $stmt->bindParam(":users_id", $book->users_id);

      $stmt->execute();

      $this->message->setMessage("Livro adicionado com sucesso!", "success", "../view/index.php");

    }

    public function update(Book $book) {

      $stmt = $this->conn->prepare("UPDATE books SET
        title = :title,
        author = :author,
        genre = :genre,
        release_date = :release_date,
        summary = :summary,
        image = :image
        WHERE id = :id      
      ");

      $stmt->bindParam(":title", $book->title);
      $stmt->bindParam(":summary", $book->summary);
      $stmt->bindParam(":genre", $book->genre);
      $stmt->bindParam(":author", $book->author);
      $stmt->bindParam(":release_date", $book->release_date);
      $stmt->bindParam(":image", $book->image);
      $stmt->bindParam(":id", $book->id);

      $stmt->execute();

      $this->message->setMessage("Livro atualizado com sucesso!", "success", "../view/dashboard.php");

    }

    public function destroy($id) {

      $stmt = $this->conn->prepare("DELETE FROM books WHERE id = :id");

      $stmt->bindParam(":id", $id);

      $stmt->execute();

      $this->message->setMessage("Livro removido com sucesso!", "success", "../view/dashboard.php");

    }

public function getBooksByPage($limit, $offset) {
    $stmt = $this->conn->prepare("SELECT * FROM books LIMIT :limit OFFSET :offset");
    $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
    $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function findByAuthorWithPagination($author, $limit, $offset) {
  $books = [];

  $stmt = $this->conn->prepare("SELECT * FROM books WHERE author LIKE :author LIMIT :limit OFFSET :offset");

  $stmt->bindValue(":author", '%' . $author . '%');
  $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
  $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);

  $stmt->execute();

  if ($stmt->rowCount() > 0) {
      $booksArray = $stmt->fetchAll();

      foreach ($booksArray as $book) {
          $books[] = $this->buildBook($book);
      }
  }

  return $books;
}

public function getTotalBooksByAuthor($author) {
  $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM books
                                WHERE author LIKE :author");

  $stmt->bindValue(":author", '%' . $author . '%');

  $stmt->execute();

  return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}


public function getTotalBooks() {
    $stmt = $this->conn->query("SELECT COUNT(*) as total FROM books");
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

public function findByTitleWithPagination($title, $limit, $offset) {
  $books = [];

  $stmt = $this->conn->prepare("SELECT * FROM books
                                WHERE title LIKE :title
                                LIMIT :limit OFFSET :offset");

  $stmt->bindValue(":title", '%' . $title . '%');
  $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
  $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);

  $stmt->execute();

  if ($stmt->rowCount() > 0) {
      $booksArray = $stmt->fetchAll();

      foreach ($booksArray as $book) {
          $books[] = $this->buildBook($book);
      }
  }

  return $books;
}

public function getTotalBooksByTitle($title) {
  $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM books WHERE title LIKE :title");
  $stmt->bindValue(":title", '%' . $title . '%');
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

public function findByGenreWithPagination($genre, $limit, $offset) {
  $books = [];

  $stmt = $this->conn->prepare("SELECT * FROM books
                                WHERE genre LIKE :genre
                                LIMIT :limit OFFSET :offset");

  $stmt->bindValue(":genre", '%' . $genre . '%');
  $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
  $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);

  $stmt->execute();

  if ($stmt->rowCount() > 0) {
      $booksArray = $stmt->fetchAll();

      foreach ($booksArray as $book) {
          $books[] = $this->buildBook($book);
      }
  }

  return $books;
}

public function getTotalBooksByGenre($genre) {
  $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM books WHERE genre LIKE :genre");
  $stmt->bindValue(":genre", '%' . $genre . '%');
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}


  }