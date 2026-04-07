<?php

var_dump($_POST);
include 'PDO.php';

$sql = 'SELECT id, contenu, accompli FROM `tache` ORDER BY id ASC';
$statement = $pdo->query($sql);

$taches = $statement->fetchAll();

foreach($taches as $tache){
    $reference = 'tache_' . $tache['id'];
    echo $reference;
    echo $_POST[$reference];

    if($_POST[$reference] == 'on' && $tache['accompli'] == '0'){
        // case est coche, donc tache accomplie
        // ICI concatenation est safe, la donnee vient de la db
        $sql = 'UPDATE tache SET accompli = 1 WHERE id='.$tache['id'];
        $pdo->query($sql);
    }
    
}

if($_POST['nouvelle'] != ''){
    // ATTENTION !! ici il faut utiliser les prepared statement
    // NE JAMAIS integrer des donnees exterieures au code dans une query
    // https://phpdelusions.net/pdo#prepared
    $sql = 'INSERT INTO tache (contenu) VALUES("'.$_POST['nouvelle'].'")';
    $pdo->query($sql);
}


if($_POST['reset'] == true){
    // CECI EST SAFE SANS PREPARED STATEMENT, le 0 vient du dev
    $sql = 'UPDATE tache SET accompli = 0';
    $pdo->query($sql);
}
?>