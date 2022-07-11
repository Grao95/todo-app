<?php
session_start();
require_once("./pdo.php");

$message = false;
// $_POST["name"]= $_GET["name"];
// $name = $_GET["name"];

if(isset($_POST["add"])){
    if(isset($_POST["add"])>0){
        $bdd= "SELECT user_id FROM users WHERE user_id=task_id";
        $sql= "INSERT INTO tasks (title, user_id) VALUES (:title, :user_id)";
        // INSERT INTO `tasks` (`task_id`, `title`, `user_id`) VALUES ('1', 'repos', '3'); //Exemple
    
        $stmt= $pdo->prepare($sql);
  
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
  
        $stmt->execute([
        ":title" => $_POST["task"],
        ":user_id" => $_POST["user_id"]
        ]);
    }
}


if ((isset($_POST["task"]) && strlen($_POST["task"])<1)) {
    $message = "Veuillez remplir le champ";
}

if(isset($_POST["edit"]) && isset($_POST["user_id"])){
    header("Location: ./edit.php?user_id=" . urlencode($_POST["user_id"]));
  return;
}

if(isset($_POST["delete"]) && isset($_POST["task_id"])){
    $sql= "DELETE FROM tasks WHERE task_id= :id";


    $stmt= $pdo->prepare($sql);

    $stmt->execute([
        ":id" => $_POST["task_id"]
    ]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de Tâches</title>
    
    <style>
        body{
            display: block;
            margin: 8px;
        }
    </style>
</head>
<body class="bg-gray-40">
    <?php
    if (!isset($_GET["name"])){
        die("ACCÈS REFUSÉ");
    }

    if(isset($_POST["logout"])){
    header("Location: ./index.php");
    return;
    }
    ?>

    <div class="container w-11/12 max-w-6xl mx-auto py-4">
        <div class="w-11/12 max-w-xl bg-white rounded shadow-md my-12 mx-auto py-8 px-10">
            <form method="POST">
                <?php
                
                ?>
                <h4 class="text-2xl capitalize font-bold mb-5"><?php echo "tâches à faire de " . $_GET["name"]; ?></h4>
                <div class="flex flex-wrap">
                <input type="text" name="task" class="flex-1 px-3 py-1.5 rounded-tl sm:rounded-bl rounded-tr sm:rounded-tr-none bg-gray-50 border-2 border-gray-200 content-center">
                <input type="submit" name="add" class="flex-1 sm:flex-none cursor-pointer text-white bg-blue-500 border-transparent rounded-bl sm:rounded-bl-none rounded-br sm:rounded-tr tracking-widest px-3 py-1.5 shadow capitalize inline-block transition-all duration-300 hover:bg-blue-700 hover:shadow-md" value="ajouter">
                </div>
            </form>
            <div class="mb-4">
                <div class="flex flex-wrap items-center px-3 py-1.5 mb-4 hover:bg-gray-50 rounded transition-all duration-300">
                    <p class="flex-1 capitalize">
                        <?php
                        $stmt = $pdo->query("SELECT * FROM tasks");
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        echo "<table border='1'>";
                        foreach($rows as $row){
                            $tab= <<<EOL
                            <tr>
                                <td>{$row["title"]}</td>
                                <td>{$row["user_id"]}</td>
                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="user_id" value="{$row["user_id"]}">
                                        <input type="submit" name="edit" value="éditer">
                                    </form>
                                </td>
                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="user_id" value="{$row["user_id"]}">
                                        <input type="submit" name="delete" value="supprimer">
                                    </form>
                                </td>
                            </tr>
                            EOL;
                            echo $tab;
                        }
                        echo "</table>";
                        echo "<br>";
                        if(isset($_POST["edit"]) && isset($_POST["user_id"])){
                            header("Location: ./edit.php?user_id=" . urlencode($_POST["user_id"]));
                            return;
                        }
                        ?>
                    </p>
                    
                </div>
                <form method="POST">
                    <input type="hidden" name="task_id" value="421">
                    <input type="submit" name="clear" class="cursor-pointer text-red-500 transition-all duration-300 hover:text-red-700 capitalize mx-auto" style="display: inherit" value="vider la liste">
                </form>
            </div>
        </div>
        <a href="./logout1.php" class="text-blue-500 transition-all duration-300 hover:text-blue-700 underline capitalize text-center" style="display: inherit">se déconnecter</a>
    </div>
</body>
</html>