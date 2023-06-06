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
                    <a href="news.php">Actualités</a>
                    <a href="wall.php?user_id=<?php echo $_SESSION['connected_id'] ?>">Mur</a>
                    <a href="feed.php?user_id=5">Flux</a>
                    <a href="usurpedpost.php">Among Us</a>
                    <div id="tags">
                        <a id="nomtag" href="tags.php?tag_id=1">Mots-clés</a>
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
                    <a href="#">Profil</a>
                    <ul>
                        <li><a href="login.php">Log In</a></li>
                        <li><a href="registration.php">Sign In</a></li>
                        <li><a href="settings.php?user_id=<?php echo $_SESSION['connected_id'] ?>">Paramètres</a></li>
                        <li><a href="followers.php?user_id=<?php echo $_SESSION['connected_id'] ?>">Mes suiveurs</a></li>
                        <li><a href="subscriptions.php?user_id=<?php echo $_SESSION['connected_id'] ?>">Mes abonnements</a></li>
                        <li><a href='logout.php'>Log out</a></li>
                    </ul>

                </nav>

                <?php
            }
            else
            {
                echo 'You are not logged in. <a href="login.php">Click here</a> to log in.';
            }