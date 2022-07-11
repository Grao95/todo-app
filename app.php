<?php
session_start();
require_once("./pdo.php");

$message = false;
$_POST["name"]= $_GET["name"];
$name = $_POST["name"];

if(isset($_POST["add"])){
    if(isset($_POST["add"])>0){
        $bdd= "SELECT user_id FROM users WHERE user_id=task_id";
        $sql= "INSERT INTO tasks (task_id, title, user_id) VALUE (:task_id, :title, :user_id)";
        // INSERT INTO `tasks` (`task_id`, `title`, `user_id`) VALUES ('1', 'repos', '3');
    
        $stmt= $pdo->prepare($sql);
  
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
  
        $stmt->execute([
        ":task_id" => MYSQLI_AUTO_INCREMENT_FLAG,
        ":title" => $_POST["task"],
        ":user_id" => $_GET["user_id"]
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



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de Tâches</title>
    <link rel="stylesheet" href="./styles.css">
<style>
        /* ! tailwindcss v3.1.4 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;/*vertical-align:middle*/}img,video{max-width:100%;height:auto}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::-webkit-backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.container{width:100%}@media (min-width: 640px){.container{max-width:640px}}@media (min-width: 768px){.container{max-width:768px}}@media (min-width: 1024px){.container{max-width:1024px}}@media (min-width: 1280px){.container{max-width:1280px}}@media (min-width: 1536px){.container{max-width:1536px}}.mx-auto{margin-left:auto;margin-right:auto}.my-12{margin-top:3rem;margin-bottom:3rem}.mb-5{margin-bottom:1.25rem}.mb-4{margin-bottom:1rem}.mb-2{margin-bottom:0.5rem}.mt-4{margin-top:1rem}.block{display:block}.inline-block{display:inline-block}.w-11\/12{width:91.666667%}.w-full{width:100%}.max-w-6xl{max-width:72rem}.max-w-xl{max-width:36rem}.cursor-pointer{cursor:pointer}.rounded{border-radius:0.25rem}.border-2{border-width:2px}.border-gray-200{--tw-border-opacity:1;border-color:rgb(229 231 235 / var(--tw-border-opacity))}.border-transparent{border-color:transparent}.bg-gray-50{--tw-bg-opacity:1;background-color:rgb(249 250 251 / var(--tw-bg-opacity))}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-blue-500{--tw-bg-opacity:1;background-color:rgb(59 130 246 / var(--tw-bg-opacity))}.py-4{padding-top:1rem;padding-bottom:1rem}.py-8{padding-top:2rem;padding-bottom:2rem}.px-10{padding-left:2.5rem;padding-right:2.5rem}.px-3{padding-left:0.75rem;padding-right:0.75rem}.py-1\.5{padding-top:0.375rem;padding-bottom:0.375rem}.py-1{padding-top:0.25rem;padding-bottom:0.25rem}.text-center{text-align:center}.text-2xl{font-size:1.5rem;line-height:2rem}.text-xs{font-size:0.75rem;line-height:1rem}.font-bold{font-weight:700}.capitalize{text-transform:capitalize}.tracking-widest{letter-spacing:0.1em}.text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.text-blue-500{--tw-text-opacity:1;color:rgb(59 130 246 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.shadow-md{--tw-shadow:0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow{--tw-shadow:0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.transition-all{transition-property:all;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.duration-300{transition-duration:300ms}.hover\:bg-blue-700:hover{--tw-bg-opacity:1;background-color:rgb(29 78 216 / var(--tw-bg-opacity))}.hover\:text-blue-700:hover{--tw-text-opacity:1;color:rgb(29 78 216 / var(--tw-text-opacity))}.hover\:shadow-md:hover{--tw-shadow:0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}
    </style>
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
                <h4 class="text-2xl capitalize font-bold mb-5"><?php echo "tâches à faire de " . $name; ?></h4>
                <div class="flex flex-wrap">
                <input type="text" name="task" class="flex-1 px-3 py-1.5 rounded-tl sm:rounded-bl rounded-tr sm:rounded-tr-none bg-gray-50 border-2 border-gray-200 content-center">
                <input type="submit" name="add" class="flex-1 sm:flex-none cursor-pointer text-white bg-blue-500 border-transparent rounded-bl sm:rounded-bl-none rounded-br sm:rounded-tr tracking-widest px-3 py-1.5 shadow capitalize inline-block transition-all duration-300 hover:bg-blue-700 hover:shadow-md" value="ajouter">
                </div>
            </form>
            <div class="mb-4">
                <div class="flex flex-wrap items-center px-3 py-1.5 mb-4 hover:bg-gray-50 rounded transition-all duration-300">
                    <p class="flex-1 capitalize">
                        <?php
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        echo "<table border='1'>";
    foreach($rows as $row){
        $tab= <<<EOL
            <tr>
                <td>{$row["task"]}</td>
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

                        if(isset($_POST["edit"]) && isset($_POST["user_id"])){
                            header("Location: ./edit.php?user_id=" . urlencode($_POST["user_id"]));
                            return;
                        }
                        ?>
                    </p>
                    <form method="POST">
                        <input type="hidden" name="task_id" value="421">
                        <input type="submit" name="clear" class="cursor-pointer text-red-500 transition-all duration-300 hover:text-red-700 capitalize mx-auto" style="display: inherit" value="vider la liste">
                    </form>
                </div>
            </div>
        </div>
        <a href="./logout1.php" class="text-blue-500 transition-all duration-300 hover:text-blue-700 underline capitalize text-center" style="display: inherit">se déconnecter</a>
    </div>
</body>
</html>