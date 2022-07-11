<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="bg-gray-50">
    <div class="container w-11/12 max-w-6x1 mx-auto py-4">
        <h1 class="text-3x1 capitalize font-bold mb-5">bienvenue dans la base de données des tâches</h1>
        <p class="mb-6">
            <a href="./register.php" class="text-blue-500 transition-all duration-300 hover:text-blue-700 underline capitalize">enregistrez-vous</a>
             / 
            <a href="./login.php" class="text-blue-500 transition-all duration-300 hover:text-blue-700 underline capitalize">connectez-vous</a>
        </p>
        <p>
            Essayez d'<a href="./app.php" class="text-blue-500 transition-all duration-300 hover:text-blue-700 underline capitalize">ajouter des données</a>
             sans vous connecter.
        </p>
    </div>
</body>
</html>