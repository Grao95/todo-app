<?php
session_start();
require_once("./pdo.php");

// $stmt = $pdo->prepare("SELECT name, user_id FROM users WHERE name= :name, user_id= :user_id");
// $stmt->execute([
//     ":user_id" => $_POST["user_id"],
//     ":name" => $_POST["name"]
// ]);
$rows = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST["modifiée"]) && isset($_POST["modifiée"])>0 && isset($_POST['task'])){
    $sql= "UPDATE tasks SET title = :title";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([
        ":task_id" => $_POST["task_id"],
        ":title" => $_POST["title"],
        ":user_id" => $_POST["user_id"]
    ]);
    $_SESSION["success"]= "tâche modifiée";
    header("Location: app.php");
    return;
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
    // if (!isset($_GET["name"])){
    //     die("ACCÈS REFUSÉ");
    // }
    ?>
    <p>éditer une tâche</p>
    <form method="POST">
        <p>Tâche: <input type="text" name="task"></p>
        <input type="submit" value="modifiée">
        <a href="./app.php">retour</a>
    </form>
</body>
</html>