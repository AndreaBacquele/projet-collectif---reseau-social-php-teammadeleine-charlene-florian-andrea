<?php
$postId = $_GET['post_id'];

// Exécuter une requête SQL pour incrémenter le compteur de likes dans la base de données
$sql = "INSERT INTO likes "

// Exécuter la requête SQL
$result = $mysqli->query($sql);

header("Location: wall.php?user_id={$post['id']}");
exit();
?>
