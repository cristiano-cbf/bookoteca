<?php

  require_once("../../config/globals.php");
  require_once("../../config/db.php");
  require_once("../models/Users.php");
  require_once("../models/Message.php");
  require_once("../dao/UserDAO.php");

  $message = new Message($BASE_URL);

  $userDao = new UserDAO($conn, $BASE_URL);

  // Resgata o tipo do formulário
  $type = filter_input(INPUT_POST, "type");

  if($type === "update") {

 
    $userData = $userDao->verifyToken();

    // Receber dados do post
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $bio = filter_input(INPUT_POST, "bio");

    // Criar um novo objeto de usuário
    $user = new User();

    // Preencher os dados do usuário
    $userData->name = $name;
    $userData->lastname = $lastname;
    $userData->email = $email;
    $userData->bio = $bio;

    // Upload da imagem
if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

  $image = $_FILES["image"];
  $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
  $jpgArray = ["image/jpeg", "image/jpg"];

  // Checagem de tipo de imagem
  if(in_array($image["type"], $imageTypes)) {

    // Inicializando a variável da imagem
    $imageFile = false;

    // Checar se é jpg
    if(in_array($image["type"], $jpgArray)) {
      $imageFile = @imagecreatefromjpeg($image["tmp_name"]);
    // Checar se é png
    } else if($image["type"] === "image/png") {
      $imageFile = @imagecreatefrompng($image["tmp_name"]);
    }

    // Verifica se a imagem foi criada com sucesso
    if($imageFile) {
      $imageName = $user->imageGenerateName();
      
      // Salvar imagem no formato JPEG
      imagejpeg($imageFile, "../../public/img/users/" . $imageName, 100);

      // Atribuir o nome da imagem ao usuário
      $userData->image = $imageName;

    } else {
      $message->setMessage("Erro ao processar a imagem, tente novamente com um arquivo válido!", "error", "back");
    }

  } else {
    $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");
  }

}


    $userDao->update($userData);

  // Atualizar senha do usuário
  } else if($type === "changepassword") {

    // Receber dados do post
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Resgata dados do usuário
    $userData = $userDao->verifyToken();
    
    $id = $userData->id;

    if($password == $confirmpassword) {

      // Criar um novo objeto de usuário
      $user = new User();

      $finalPassword = $user->generatePassword($password);

      $user->password = $finalPassword;
      $user->id = $id;

      $userDao->changePassword($user);

    } else {
      $message->setMessage("As senhas não são iguais!", "error", "back");
    }

  } else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }