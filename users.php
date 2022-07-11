<?php
require_once("./pdo.php");

if(isset($_POST["name"]) && isset($_POST["password"])){
    $sql= "INSERT INTO users (name, password, user_id) VALUE (:name, :password, user_id)";


    $stmt= $pdo->prepare($sql);

    $stmt->execute([
        ":name" => $_POST["name"],
        ":password" => $_POST["password"],
        ":user_id" => $_POST["user_id"]
    ]);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body></body>

</html>