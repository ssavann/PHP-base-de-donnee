<?php
session_start();

if (isset($_SESSION['id'])) {
  header('Location: compte.php');
}

if (!empty($_POST)) {
  extract($_POST);
  $erreur = [];

  require_once 'include/functions.php';


  if (empty($email)) {
    $erreur['email'] = 'Adresse email manquante';
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erreur['email'] = 'Adresse email invalide';
  }
  elseif (!email_free()) {
    $erreur['email'] = 'Adresse email déjà prise';
  }

  if (empty($password)) {
    $erreur['password'] = 'Mot de passe manquant';
  }
  elseif (strlen($password) < 8) {
    $erreur['password'] = 'Le mot de passe doit faire au moins 8 caractères';
  }


  if (empty($passwordconf)) {
    $erreur['passwordconf'] = 'Confirmation du mot de passe manquant';
  }
  elseif ($passwordconf != $password) {
    $erreur['passwordconf'] = 'Confirmation du mot de passe différente';
  }

  if (!$erreur) {
    //insertion du nouveau membre en BDD

    unset($email);

    $validation = 'Inscription réussie!';
  }


}

 ?>


<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,700,300">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
     <?php include 'include/header.php'; ?>
    <div class="container">
      <h1 class="text-xs-center">Inscription</h1>
      <div class="row">
        <div class="col-xl-4 col-xl-offset-4 col-md-6 col-md-offset-3">

          <?php if (isset($erreur['email'])) : ?>
            <div class="alert alert-danger"><?= $erreur['email']  ?></div>
           <?php endif ?>
           <?php if (isset($erreur['password'])) : ?>
            <div class="alert alert-danger"><?= $erreur['password']  ?></div>
           <?php endif ?>
           <?php if (isset($erreur['passwordconf'])) : ?>
            <div class="alert alert-danger"><?= $erreur['passwordconf']  ?></div>
           <?php endif ?>
           <?php if (isset($validation)) : ?>
            <div class="alert alert-success"><?= $validation  ?></div>
           <?php endif ?>
           
          <form action="inscription.php" method="post" class="p-y-3 p-x-2" novalidate>
            <input type="email" name="email" class="form-control" placeholder="Adresse e-mail" value="<?php if(isset($email))  echo $email  ?>"> <!-- pour garder le 'email' dans la boite si on fait une erreur au lieu de retaper le email encore une fois -->
            <input type="password" name="password" class="form-control" placeholder="Mot de passe">
            <input type="password" name="passwordconf" class="form-control" placeholder="Confirmez le mot de passe">
            <input type="submit" class="btn btn-success" value="Inscription">
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
