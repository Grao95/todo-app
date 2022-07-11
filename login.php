<?php
session_start();
require_once("./pdo.php");

$message = false;

if (isset($_SESSION['error'])) {
  echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
  unset($_SESSION['error']);
}

if(isset($_POST["cancel"])){
  header("Location: ./index.php");
  return;
}

$pass = isset($_POST["password"]) ? $_POST["password"] : '';
$name = isset($_POST["name"]) ? $_POST["name"] : '';
    
if ((isset($_POST["name"]) && strlen($_POST["name"])>0) | (isset($_POST["password"]) && strlen($_POST["password"])>0)) {
$user= "SELECT * FROM users WHERE name= $n AND password= $pw";
$n= $_POST["name"];
$pw= $_POST["password"];
  if($pass === $pw && $name === $n){
    $u= "SELECT users FROM tasks WHERE tasks.user_id = users.user_id";
    header("Location: ./app.php?name=" . urlencode($_POST["name"]));
  }
  elseif($name === $n && $pass !== $pw){
    $message = "mot de passe incorrect";
  }
  elseif($name !== $n && $pass === $pw){
    $message = "nom d'utilisateur incorrect";
  }
  else{
    $message = "utilisateur non reconnu";
  }
}
elseif((isset($_POST["name"]) && strlen($_POST["name"])<=0) && (isset($_POST["password"]) && strlen($_POST["password"])<=0)){
  $message = "Le nom d'utilisateur et le mot de passe sont requis";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="./styles.css">

</head>
<body class="bg-gray-50">
  <?php
  if(!empty($_POST["password"])){
    echo "Le mot de passe n'est pas vide <br>";
  }

  if(isset($_POST["password"])){
    echo "Le mot de passe est défini <br>";
  }

  ?>
    <div class="container w-11/12 max-w-6xl mx-auto py-4">
        <form method="POST" class="w-11/12 max-w-xl bg-white rounded shadow-md my-12 mx-auto py-8 px-10">
            <h4 class="text-2xl capitalize font-bold mb-5">connectez-vous</h4>
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
            <input type="submit" name="login" class="cursor-pointer text-white bg-blue-500 border-transparent rounded tracking-widest px-3 py-1.5 shadow capitalize inline-block transition-all duration-300 hover:bg-blue-700 hover:shadow-md w-full" value="se connecter">
            <a href="./index.php" class="text-blue-500 transition-all duration-300 hover:text-blue-700 underline capitalize inline-block mt-4 text-center" style="display:inherit">annuler</a>
        </form>
    </div>
</body>
</html>
