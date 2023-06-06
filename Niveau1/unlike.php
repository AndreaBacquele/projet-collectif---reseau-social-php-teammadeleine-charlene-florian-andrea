<?php
// Récupérer l'ID du message à unliker depuis l'URL
$postId = $_GET['post_id'];

// Effectuer les opérations nécessaires pour retirer le like du message avec l'ID $postId
// Par exemple, vous pouvez décrémenter le compteur de likes dans votre base de données

// Rediriger l'utilisateur vers la page du mur ou une autre page appropriée
header("Location: wall.php?user_id={$post['id']}");
exit();
?>
