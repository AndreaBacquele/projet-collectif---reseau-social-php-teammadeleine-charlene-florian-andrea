<article>
                <h3>
                    <time datetime='2020-02-01 11:12:13' ><?php echo $post['created'] ?></time>
                </h3>
                    <address>par <?php echo $post['author_name'] ?></address>
                <div>
                    <?php echo $post['content'] ?>
                </div>
                 <?php 
                    $tab = explode(",",$post['taglist'])
                ?>                                            
        <footer>
                <small>♥ <?php echo $post['like_number'] ?></small>
                    <?php
                        for ($i=0; $i < count($tab); $i++) { 
                                ?>
                        <a href="">#<?php echo $tab[$i] ?></a>,
                    <?php
                    }
                    ?>
         </footer>
</article>