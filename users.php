<?php
require_once("./pdo.php");

if(isset($_POST["name"]) && isset($_POST["password"])){
    $sql= "INSERT INTO users (name, password) VALUE (:name, :password)";


    // $stmt= $pdo->prepare($sql);

    // $stmt->execute([
    //     ":name" => $_POST["name"],
    //     ":password" => $_POST["password"]
    // ]);
}

if(isset($_POST["edit"]) && isset($_POST["user_id"])){
    header("Location: ./edit.php?user_id=" . urlencode($_POST["user_id"]));
  return;
}

if(isset($_POST["delete"]) && isset($_POST["user_id"])){
    $sql= "DELETE FROM users WHERE user_id= :id";


    $stmt= $pdo->prepare($sql);

    $stmt->execute([
        ":id" => $_POST["user_id"]
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

<body>
  <?php
  echo "<table border='1'>";

  echo "</table>";
  ?>
  
</body>

</html>