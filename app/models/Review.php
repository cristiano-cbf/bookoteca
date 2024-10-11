<?php

  class Review {

    public $id;
    public $rating;
    public $review;
    public $users_id;
    public $book_id;
    public $created_at;

  }

  interface ReviewDAOInterface {

    public function buildReview($data);
    public function create(Review $review);
    public function getBooksReview($id);
    public function hasAlreadyReviewed($id, $userId);
    public function getRatings($id);
    public function getCommentCountByUserId($userId);

  }