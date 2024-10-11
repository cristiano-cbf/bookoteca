<?php

  class Favorite {

    public $id;
    public $users_id;
    public $book_id;

  }

  interface FavoriteDAOInterface {

    public function buildFavorite($data);
    public function addFavorite($userId, $bookId);
    public function removeFavorite($userId, $bookId);
    public function isFavorite($userId, $bookId);
    public function getUserFavorites($userId);

  }