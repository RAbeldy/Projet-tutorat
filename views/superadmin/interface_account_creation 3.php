 <div class="d-flex flex-column" id="content-wrapper">
  
                <div id="content">
                    <div class="block">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                    <?php include('retour.php') ?>
                                </div>
                                <div class="col-xs-12 col-md-8">
                                    <div class="row">

                                        <?php 
                                        foreach ($donnees as $elt)
                                        {
                                            if(!preg_match('#TUTORAT#', $elt[0]))
                                            {
                                            ?>

                                                <div class="col-xs-12 col-md-6 card-container">
                                                    <div class="card avenir">
                                                        <div class="card-body">
                                                            <h4 class="card-title"><?=$elt[0] ?></h4>
                                                            <a href="?controller=superadmin&action=create_account&id=<?=$elt[1] ?>">
                                                                <button class="btn" type="button">Je crée</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                             <?php
                                            }
                                        }
                                        ?>
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>