<?php

  require_once("../../config/globals.php");
  require_once("../../config/db.php");
  require_once("../models/Book.php");
  require_once("../models/Message.php");
  require_once("../dao/UserDAO.php");
  require_once("../dao/BookDAO.php");

  $message = new Message($BASE_URL);
  $userDao = new UserDAO($conn, $BASE_URL);
  $bookDao = new BookDAO($conn, $BASE_URL);

  $type = filter_input(INPUT_POST, "type");

  $userData = $userDao->verifyToken();

  if($type === "create") {

    $title = filter_input(INPUT_POST, "title");
    $author = filter_input(INPUT_POST, "author");
    $genre = filter_input(INPUT_POST, "genre");
    $release_date = filter_input(INPUT_POST, "release_date");
    $summary = filter_input(INPUT_POST, "summary");

    $book = new Book();

    if(!empty($title) && !empty($author) && !empty($release_date)) {

      $book->title = $title;
      $book->author = $author;
      $book->genre = $genre;
      $book->release_date = $release_date;
      $book->summary = $summary;
      $book->users_id = $userData->id;

      // Upload de imagem do livro
      if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

        $image = $_FILES["image"];
        $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
        $jpgArray = ["image/jpeg", "image/jpg"];

        // Checando tipo da imagem
        if(in_array($image["type"], $imageTypes)) {

          // Checa se imagem é jpg
          if(in_array($image["type"], $jpgArray)) {
            $imageFile = imagecreatefromjpeg($image["tmp_name"]);
          } else {
            $imageFile = imagecreatefrompng($image["tmp_name"]);
          }

          // Gerando o nome da imagem
          $imageName = $book->imageGenerateName();

          imagejpeg($imageFile, "../../public/img/cover/" . $imageName, 100);

          $book->image = $imageName;

        } else {

          $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");

        }

      }

      $bookDao->create($book);

    } else {

      $message->setMessage("Você precisa adicionar pelo menos: título, descrição e categoria!", "error", "back");

    }

  } else if($type === "delete") {

    // Recebe os dados do form
    $id = filter_input(INPUT_POST, "id");

    $book = $bookDao->findById($id);

    if($book) {

      // Verificar se o livro é do usuário
      if($book->users_id === $userData->id) {

        $bookDao->destroy($book->id);

      } else {

        $message->setMessage("Informações inválidas!", "error", "../view/index.php");

      }

    } else {

      $message->setMessage("Informações inválidas!", "error", "index.php");

    }

  } else if($type === "update") { 

    $title = filter_input(INPUT_POST, "title");
    $author = filter_input(INPUT_POST, "author");
    $genre = filter_input(INPUT_POST, "genre");
    $release_date = filter_input(INPUT_POST, "release_date");
    $summary = filter_input(INPUT_POST, "summary");
    $id = filter_input(INPUT_POST, "id");

    $bookData = $bookDao->findById($id);

    if($bookData) {

      // Verificar se o livro é do usuário
      if($bookData->users_id === $userData->id) {

        if(!empty($title) && !empty($author) && !empty($release_date)) {

          $bookData->title = $title;
          $bookData->author = $author;
          $bookData->genre = $genre;
          $bookData->release_date = $release_date;
          $bookData->summary = $summary;

          // Upload de imagem do livro
          if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            // Checando tipo da imagem
            if(in_array($image["type"], $imageTypes)) {

              // Checa se imagem é jpg
              if(in_array($image["type"], $jpgArray)) {
                $imageFile = imagecreatefromjpeg($image["tmp_name"]);
              } else {
                $imageFile = imagecreatefrompng($image["tmp_name"]);
              }

              // Gerando o nome da imagem
              $book = new Book();

              $imageName = $book->imageGenerateName();

              imagejpeg($imageFile, "../../public/img/cover/" . $imageName, 100);

              $bookData->image = $imageName;

            } else {

              $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");

            }

          }

          $bookDao->update($bookData);

        } else {

          $message->setMessage("Você precisa adicionar pelo menos: título, descrição e categoria!", "error", "back");

        }

      } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");

      }

    } else {

      $message->setMessage("Informações inválidas!", "error", "index.php");

    }
  
  } else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }