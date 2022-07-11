<?php
session_start();
require_once("pdo.php");

$message = false;

if(isset($_POST["cancel"])){
  header("Location: ./index.php");
  return;
}

$pass = isset($_POST["password"]) ? $_POST["password"] : '';
$pass2 = isset($_POST["confirmPassword"]) ? $_POST["confirmPassword"] : '';
$name = isset($_POST["name"]) ? $_POST["name"] : '';

if(isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["confirmPassword"])){
        if($_POST["name"]>=2 && $_POST["password"] === $_POST["confirmPassword"]){
      $sql= "INSERT INTO users (name, password) VALUES (:name, :password)";
    }
    
    $stmt= $pdo->prepare($sql);
  
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
  
      $stmt->execute([
      ":name" => $_POST["name"],
      ":password" => hash('md5', 'XyZzy12\*\_', $_POST["password"])
      ]);
      
       if ((isset($_POST["name"]) && strlen($_POST["name"])>0) && (isset($_POST["password"]) && strlen($_POST["password"])>0) && (isset($_POST["confirmPassword"]) && strlen($_POST["confirmPassword"])>0)) {
    header("Location: ./register.php");
    echo "utilisateur enregistrer";
    return;
} 
  }

    
if ((isset($_POST["name"]) && strlen($_POST["name"])>0) | (isset($_POST["password"]) && strlen($_POST["password"])>0) | (isset($_POST["confirmPassword"]) && strlen($_POST["confirmPassword"])>0)) {

  if($_POST["password"]>0 && $_POST["name"]>0 && $_POST["confirmPassword"]>0){
    header("Location: ./register.php?name=" . urlencode($_POST["name"]));
    return;
  }
  elseif($_POST["password"]<1 && $_POST["confirmPassword"]<1 && $_POST["name"]>0){
    $message = "mot de passe incorrect";
  }
  elseif($_POST["password"]>1 && $_POST["confirmPassword"]>1 && $_POST["name"]>0 && $_POST["password"] === $_POST["confirmPassword"]){
    $message = "Les mots de passe ne correspondent pas";
  }
  elseif($_POST["password"]>0 && $_POST["confirmPassword"]>0 && $_POST["name"]<1){
    $message = "nom d'utilisateur requis";
  }
}
elseif((isset($_POST["name"]) && strlen($_POST["name"])<=0) && (isset($_POST["password"]) && strlen($_POST["password"])<=0)){
  $message = "Un nom d'utilisateur et un mot de passe sont requis";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'enregistrer</title>
    <link rel="stylesheet" href="./styles.css">
    
</head>
<body class="bg-gray-50">
  <?php
  if(!empty($pass)){
    if(!empty($_POST["confirmPassword"])){
      if($_POST["password"] === $_POST["confirmPassword"]){
        echo "Le mot de passe correspond à celui de confirmation <br>";
        echo "Le mot de passe n'est pas vide <br>";
      }
    }
  }

  if(isset($_POST["password"])){
    echo "Le mot de passe est défini <br>";
  }

  ?>
    <div class="container w-11/12 max-w-6x1 mx-auto py-4">
        <form method="POST" class="w-11/12 max-w-x1 bg-white rounded shadow-md my-12 mx-auto py-8 px-10">
            <?php

            ?>
            <h4 class="text-2x1 capitalize font-bold mb-5">enregistrez-vous</h4>
            <?php
            if($message !== false){
              echo "<small style='color: red'>$message</small>";
            }
            ?>
            <div class="mb-4">
                <label for="name" class="block text-xs mb-2 capitalize tracking-widest">nom d'utilisateur :</label>
                <input type="text" name="name" id="name" class="w-full px-3 py-1.5 rounded bg-gray-50 border-2 border-gray-200">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-xs mb-2 capitalize tracking-widest">mot de passe :</label>
                <input type="password" name="password" id="password" class="w-full px-3 py-1.5 rounded bg-gray-50 border-2 border-gray-200">
            </div>
            <div class="mb-4">
                <label for="confirmPassword" class="block text-xs mb-2 capitalize tracking-widest">confirmer le mot de passe :</label>
                <input type="password" name="confirmPassword" id="confirmPassword" class="w-full px-3 py-1.5 rounded bg-gray-50 border-2 border-gray-200">
            </div>
            <input type="submit" name="register" class="cursor-pointer text-white bg-blue-500 border-transparent rounded tracking-widest px-3 py-1.5 shadow capitalize inline-block transition-all duration-300 hover:bg-blue-700 hover:shadow-md w-full" value="s'enregistrer">
            <a href="./index.php" class="text-blue-500 transition-all duration-300 hover:bg-blue-700 underline capitalize inline-block mt-4 text-center" style="display:inherit;">annuler</a>
        </form>
    </div>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      header("Location: ./index.php");
    }
    ?>
</body>
</html>