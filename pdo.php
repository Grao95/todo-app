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

  
  