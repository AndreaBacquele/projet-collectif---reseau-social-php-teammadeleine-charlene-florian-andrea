<header>
            <?php
            include 'config.php';
            
            ?>
            <img src="resoc.jpg" alt="Logo de notre réseau social"/>
            <nav id="menu">
                <a href="news.php">Actualités</a>
                <a href="wall.php?user_id=5">Mur</a>
                <a href="feed.php?user_id=5">Flux</a>
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
                    <li><a href="settings.php?user_id=5">Paramètres</a></li>
                    <li><a href="followers.php?user_id=5">Mes suiveurs</a></li>
                    <li><a href="subscriptions.php?user_id=5">Mes abonnements</a></li>
                </ul>

            </nav>
        </header>