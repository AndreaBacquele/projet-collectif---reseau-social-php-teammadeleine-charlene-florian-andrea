<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mur</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
    <header>
            <img src="images/madeleine_pdp.png" alt="Logo de notre réseau social"/>
            <?php include 'header.php';
            ?>
        </header>
        <div id="wrapper">
            <?php

            $userId =intval($_GET['user_id']);
            
            $laQuestionEnSql = "
            SELECT posts.content, posts.created, users.alias as author_name,users.id as id,     
            COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist, 
            GROUP_CONCAT(DISTINCT tags.id) AS tag_id_list 
            FROM posts
            JOIN users ON  users.id=posts.user_id
            LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
            LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
            LEFT JOIN likes      ON likes.post_id  = posts.id 
            WHERE posts.user_id='$userId' 
            GROUP BY posts.id
            ORDER BY posts.created DESC  
            ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            if ( ! $lesInformations)
            {
                echo("Échec de la requete : " . $mysqli->error);
            }
            ?>

            <aside>
                <?php
                /**
                 * Etape 3: récupérer le nom de l'utilisateur
                 */                
                $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $user = $lesInformations->fetch_assoc();
                //@todo: afficher le résultat de la ligne ci dessous, remplacer XXX par l'alias et effacer la ligne ci-dessous
                // echo "<pre>" . print_r($user, 1) . "</pre>";
                // echo "<pre>" . print_r($_SESSION['connected_id'], 1) . "</pre>";
                ?>
                <img src="images/madeleines.png" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez tous les message de l'utilisatrice : <a href="wall.php?user_id=<?php echo $user['id']?>"><?php echo $user['alias'] ?></a>
                        (n° <?php echo $userId ?>)
                        
                        <?php
                        // Permet d'afficher le bouton abonnement si on est sur un mur utilisateur qui n'est pas le nôtre
                        if ($_SESSION['connected_id']!= $userId){

                            $aboCheck = "SELECT followers.followed_user_id
                            FROM followers
                            WHERE following_user_id = " . $_SESSION['connected_id'] . "
                            AND followed_user_id = " . $userId . "";

                            $lesIdDesAbos = $mysqli->query($aboCheck);
                            
                            if ($lesIdDesAbos -> {"num_rows"} === 1)
                            {
                            ?>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?" . $_SERVER['QUERY_STRING']?>">
                                <input type ="submit" id="boutonDesabo" name="boutonDesabo" value ="Se désabonner">
                            <?php
                            }
                            else
                            {
                            ?>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?" . $_SERVER['QUERY_STRING']?>">
                                    <input type ="submit" id="boutonAbo" name="boutonAbo" value ="S'abonner">
                                </form>
                            <?php
                            }


                            $connexionAbonnement = 'INSERT INTO followers (id, followed_user_id, following_user_id)
                            VALUES(NULL, "'.$userId.'" ,"'.$_SESSION['connected_id'].'")';

                            $desabonnement = "DELETE FROM followers WHERE following_user_id = ".$_SESSION['connected_id']." AND followed_user_id = '".$userId."'";

                        if (isset($_POST['boutonAbo']))
                        {
                            $abo = $mysqli->query($connexionAbonnement);
                            echo "Vous êtes abonné à : " . $user['alias'];
                
                        }
                        if (isset($_POST['boutonDesabo']))
                        {
                            $desabo = $mysqli->query($desabonnement);
                            echo "Vous vous êtes desabonné de : " . $user['alias'];
                        
                        }
                    }
                        
                    
                        ?>    
                        
                        </p>
                </section>
            </aside>
            <main>
                <?php
                    $enCoursDeTraitement = isset($_POST['new_post']);
                    if ($enCoursDeTraitement)
                    {
                        // echo "<pre>" . print_r($_POST, 1) . "</pre>";
                        $postContent = $_POST['new_post'];


                        //Etape 3 : Petite sécurité
                        // pour éviter les injection sql : https://www.w3schools.com/sql/sql_injection.asp
                        // $authorId = intval($mysqli->real_escape_string($authorId));
                        $postContent = $mysqli->real_escape_string($postContent);
                        //Etape 4 : construction de la requete
                        $lInstructionSql = "INSERT INTO posts "
                                . "(id, user_id, content, created, parent_id) "
                                . "VALUES (NULL, "
                                . $_SESSION['connected_id'] . ", "
                                . "'" . $postContent . "', "
                                . "NOW(), "
                                . "NULL);";
                        // Etape 5 : execution
                        $ok = $mysqli->query($lInstructionSql);
                        header("Location: news.php");
                    }
                    ?>  

                <?php
                        if($_SESSION['connected_id'] == $userId){
                            ?>
                            <article>
                                <form action="<?php echo $_SERVER['PHP_SELF']."?" . $_SERVER['QUERY_STRING']?>" method="post">
                                    <dl>
                                        <dt><label for="new_post">Avez-vous quelque chose à dire ?</label></dt>
                                        <dd><br>
                                            <textarea name="new_post"></textarea>
                                        </dd>
                                    </dl>
                                    <button type="submit" id="submit_form">Poster</button>
                                </form>
                            </article>
                            <?php
                        }
                        ?>
                        <?php
                while ($post = $lesInformations->fetch_assoc())
                {
                    include 'message.php';            
                    } ?>
            </main>
        </div>
    </body>
</html>

