            <?php
            session_start();
            ?>
            
            <?php
            include 'config.php';
            ?>
            <?php
            if (! empty($_SESSION['connected_id']))
            {
                ?>
                <nav id="menu">
                    <a title="Actualités" href="news.php"><img src="images/news.png"/></a>
                    <a title="Mur"  href="wall.php?user_id=<?php echo $_SESSION['connected_id'] ?>"><img src="images/wall.png"/></a>
                    <a title="Flux" href="feed.php?user_id=<?php echo $_SESSION['connected_id'] ?>"><img src="images/feed.png"/></a>
                    <a title="Among us" href="usurpedpost.php"><img src="images/among_us.png"/></a>
                    <div id="tags">
                        <a title="Mots-clés" id="nomtag" href="tags.php?tag_id=1"><img src="images/tag.png"/></a>
                        <?php 
                            $allTheTags = "SELECT * FROM `tags` LIMIT 50";
                            $lesTags = $mysqli->query($allTheTags);
                        ?>
                            <ul>
                        <?php
                            while ($list = $lesTags->fetch_assoc())
                            {
                            // echo "<pre>" . print_r($list, 1) . "</pre>";
                        ?>
                                    <li><a href="tags.php?tag_id=<?php echo $list['id']?>"><?php echo $list['label']?></a></li>
                                    <?php
                            }
                            ?>
                        </ul>
                    </div>
                    
                </nav>
                <nav id="user">
                    <a title="Profil" href="settings.php?user_id=<?php echo $_SESSION['connected_id'] ?>"><img id="pdp" src="images/pdp.png"/></a>
                    <ul>
                        <li><a title="Paramètres" href="settings.php?user_id=<?php echo $_SESSION['connected_id'] ?>"><img id="sett" src="images/settings.png"/></a></li>
                        <li><a title="Mes abonnés" href="followers.php?user_id=<?php echo $_SESSION['connected_id'] ?>"><img id="abo" src="images/followed.png"/></a></li>
                        <li><a title="Mes abonnements" href="subscriptions.php?user_id=<?php echo $_SESSION['connected_id'] ?>"><img id="abo" src="images/follower.png"/></a></li>
                        <li><a title="Se déconnecter" href='logout.php'><img id="logout" src="images/log_out.png"/></a></li>
                    </ul>

                </nav>

                <?php
                } else if (! isset($_SESSION['connected_id'])){
                    ?>
                        <div id="pdp" id="login_msg">
                            <h3 id="pdp_text">Veuillez créer un compte ou vous connecter pour accéder aux differentes fonctionnalitées !</h3>
                        </div>
                        <nav id="user">
                            <a title="Profil" href="#"><img id="pdp" src="images/pdp.png"></a>
                            <ul>
                        <li><a href="login.php"><img id="sett" title="Se connecter" src="images/log_in.png"/></a></li>
                        <li><a href="registration.php"><img id="sett" title="S'inscrire" src="images/sign_in.png"/></a></li>
                        <?php
                        if($_SERVER['PHP_SELF'] === "/resoc_n1/Niveau1/registration.php" || $_SERVER['PHP_SELF'] === "/resoc_n1/Niveau1/login.php") {
                        } else {
                            header("Location: login.php");
                        exit();
                        }
                    }
                ?>