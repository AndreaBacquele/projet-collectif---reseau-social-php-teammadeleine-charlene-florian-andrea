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
            <img src="resoc.jpg" alt="Logo de notre réseau social"/>
            <?php include 'header.php';
            ?>
        </header>
        <div id="wrapper">
            <?php

            $userId =intval($_GET['user_id']);
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
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez tous les message de l'utilisatrice : <a href="wall.php?user_id=<?php echo $user['id']?>"><?php echo $user['alias'] ?></a>
                        (n° <?php echo $userId ?>)
                        <?php
                        if($_SESSION['connected_id'] == $userId){
                            ?>
                            <article>
                                <form action="<?php echo $_SERVER['PHP_SELF']."?" . $_SERVER['QUERY_STRING']?>" method="post">
                                    <dl>
                                        <dt><label for="new_post">Avez-vous quelque chose à dire ?</label></dt>
                                        <dd><textarea name="new_post"></textarea></dd>
                                    </dl>
                                    <button type="submit" id="submit_form">Poster</button>
                                </form>
                            </article>
                            <?php
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
                        // on ne fait ce qui suit que si un formulaire a été soumis.
                        // Etape 2: récupérer ce qu'il y a dans le formulaire @todo: c'est là que votre travaille se situe
                        // observez le résultat de cette ligne de débug (vous l'effacerez ensuite)
                        // echo "<pre>" . print_r($_POST, 1) . "</pre>";
                        // et complétez le code ci dessous en remplaçant les ???
                        // $authorId = $_POST[$user['alias']];
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
                        if ( ! $ok)
                        {
                            echo "Impossible d'ajouter le message: " . $mysqli->error;
                        } else
                        {
                            // echo "Message posté en tant que :" . $listAuteurs[$authorId];
                        }
                    }
                    ?>  
                <?php
                /**
                 * Etape 3: récupérer tous les messages de l'utilisatrice
                 */
                $laQuestionEnSql = "
                    SELECT posts.content, posts.created, users.alias as author_name,users.id as id,     
                    COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist 
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

                /**
                 * Etape 4: @todo Parcourir les messsages et remplir correctement le HTML avec les bonnes valeurs php
                 */
                while ($post = $lesInformations->fetch_assoc())
                {
                    include 'message.php';            
                    } ?>
            </main>
        </div>
    </body>
</html>
