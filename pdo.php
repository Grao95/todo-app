<?php
require_once("./users.php");

$host= "localhost";
$users="root";
$password = "";
$dbname = "todo_app";

$dsn = "mysql:host=$host;dbname=$dbname";

try {
$pdo= new PDO($dsn, $users, $password);
} catch(Exception $e) {
echo "exception message:" . $e->getMessage();
}
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $pdo->query("SELECT * FROM users");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  
// if(isset($_POST["name"]) && isset($_POST["password"])){
//     $sql= "INSERT INTO users (name, password, user_id) VALUE (:name, :password, :user_id)";


//     $stmt= $pdo->prepare($sql);

//     $stmt->execute([
//         ":name" => $_POST["name"],
//         ":password" => $_POST["password"],
//         ":user_id" => MYSQLI_AUTO_INCREMENT_FLAG
//     ]);
// }

