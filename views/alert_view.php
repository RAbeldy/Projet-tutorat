<?php 
            if(isset($_SESSION['alert']))
            {
                ?>
                <div style: color="white"> <p> <?= $_SESSION['alert'] ?> </p> </div> 
                <?php
            }
            unset( $_SESSION['alert']); // on détruit la superglobale $_SESSION['alert']vpour la prochaine utilisattion
?>