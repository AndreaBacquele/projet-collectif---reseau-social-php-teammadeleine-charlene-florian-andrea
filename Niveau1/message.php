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
        $list_of_tag_id= explode(",", $post['tag_id_list']);
        $last_element=array_pop($list_of_tag_id);
        array_unshift($list_of_tag_id, $last_element);
        
        
     ?>                                            
    <footer>
        <small>♥ <?php echo $post['like_number'] ?></small>
        <?php
        if($tab !== [""]){        
            for ($i=0; $i < count($tab); $i++) { 
        ?>
            
            <a href="tags.php?tag_id=<?php echo $list_of_tag_id[$i] ?>">#<?php echo $tab[$i] ?></a>,
        <?php
            }
        }
        ?>
        </footer>
</article>