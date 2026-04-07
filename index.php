<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tout Doux Liste</title>
</head>
<body>
    <form action="submit.php" method="POST">
        <h1>Corvee</h1>
        <ul>
            <?php
            include 'PDO.php';
            
            $sql = 'SELECT id, contenu, accompli FROM `tache` ORDER BY id ASC';
            $statement = $pdo->query($sql);
            while($tache = $statement->fetch()){

                if($tache['accompli'] == '1'){
                    $checked = 'checked';
                }
                else{
                    $checked = '';
                }
                
            ?>
                <li>
                    <input type="checkbox" <?php echo $checked; ?> name="tache_<?php echo $tache['id']; ?>" id="tache_1">
                    <label for="tache_1"><?php echo $tache['contenu']; ?></label>
                </li>
            <?php
            }
            ?>
        </ul>
                 
        <label for="create">Nouvelle ?</label>
        <input type="text" name="nouvelle" id="create">
        <button type="submit">Go</button>
    </form>
</body>
</html>