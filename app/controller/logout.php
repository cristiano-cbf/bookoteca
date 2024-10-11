<?php

  require_once("../view/templates/header.php");

  if($userDao) {
    $userDao->destroyToken();
  }