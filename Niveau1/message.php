<article>
    <h3>
        <time datetime='2020-02-01 11:12:13' ><?php echo $post['created'] ?></time>
    </h3>
        <address>par <a href="wall.php?user_id=<?php echo $post['id']?>"><?php echo $post['author_name'] ?></a></address>
    <div>
        <?php echo $post['content'] ?>
    </div>
    <?php
    // echo "<pre>" . print_r($post, 1) . "</pre>";
    ?>
    <?php 
        $tab = explode(",",$post['taglist']);
        // $toutLesId = [];
        // for ($i=0; $i < count($tab); $i++) {
        //     $request_id = "SELECT id FROM tags WHERE label LIKE '$tab[$i]'";
        //     $lesId = $mysqli->query($request_id);
        //     $id = $lesId->fetch_assoc();
        //     array_push($toutLesId , $id);
        // }
        // echo "<pre>" . print_r($toutLesId, 1) . "</pre>";
    ?>                                            
    <footer>
        <small>♥ <?php echo $post['like_number'] ?></small>
        <?php
        if($tab !== [""]){        
            for ($i=0; $i < count($tab); $i++) { 
        ?>
            <a href="">#<?php echo $tab[$i] ?></a>,
        <?php
            }
        }
        ?>
        </footer>
</article>