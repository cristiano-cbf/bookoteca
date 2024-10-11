<?php

    require_once("../models/Users.php");

    $userModel = new User();

    $fullName = $userModel->getFullName($review->user);

    // Checar se o livro tem imagem
    if($review->user->image == "") {
      $review->user->image = "user.png";
    }

?>
<div class="col-md-12 review">
  <div class="row">
    <div class="col-md-1">
      <div class="profile-image-container review-image" style="background-image: url('<?= $BASE_URL ?>../../public/img/users/<?= $review->user->image ?>')"></div>
    </div>
    <div class="col-md-9 author-details-container">
      <h4 class="author-name">
        <a href="<?= $BASE_URL ?>profile.php?id=<?= $review->user->id ?>"><?= $fullName ?></a>
      </h4>
      <p class="review-date">Postado em: <?= date('d/m/Y', strtotime($review->created_at)) ?></p>

      <p><i class="fas fa-star"></i> <?= $review->rating ?></p>
    </div>
    <div class="col-md-12">
      <p class="comment-title">Comentário:</p>
      <p><?= $review->review ?></p>
    </div>
  </div>
</div>