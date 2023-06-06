<!doctype html>
<html lang="fr">
    <head>
    </head>
    <body class="madeleines">
    <link rel="stylesheet" href="style.css"/>
        <header>
            
        </header>
    <div class="back">
        <div class="echo">
        <?php
        
        session_start();
        session_destroy();
        
        echo "Vous avez été déconnecté.<br> <a href='login.php'>Reculer d'une page</a>" 
        ?>
        <img src="images/madeleine_pdp.png" alt="Logo de notre réseau social"/>
        </div>
    </div>
                
    </body>
</html>
