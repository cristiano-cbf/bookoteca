<?php

  class Book {

    public $id;
    public $title;
    public $author;
    public $genre;
    public $release_date;
    public $summary;
    public $image;
    public $users_id;

    public function imageGenerateName() {
      return bin2hex(random_bytes(60)) . ".jpg";
    }

  }

  interface BookDAOInterface {
    
    public function buildBook($data);
    public function getLatestBooks();
    public function getBooksByAuthor($author);
    public function getBooksByUserId($id);
    public function findById($id);
    public function findByTitle($title);
    public function findByAuthor($author);
    public function findByGenre($genre);
    public function create(Book $book);
    public function update(Book $book);
    public function destroy($id); 
    public function getBooksByPage($limit, $offset);  
    public function findByAuthorWithPagination($author, $limit, $offset);
    public function getTotalBooksByAuthor($author);
    public function getTotalBooks();
    public function getTotalBooksByTitle($title);
    public function findByGenreWithPagination($genre, $limit, $offset);
    public function getTotalBooksByGenre($genre); 

  }