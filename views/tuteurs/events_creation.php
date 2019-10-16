 <div class="d-flex flex-column" id="content-wrapper">
    <!-- <?php //include('views/alert_view.php'); ?> -->
                <div id="content">
                    <div class="block">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                    <?php include('retour.php') ?>
                                </div>
                                <div class="col-xs-12 col-md-8">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6 card-container">
                                            <div class="card avenir">
                                                <div class="card-body">
                                                    <h4 class="card-title">Personnel </h4>
                                                    <a href="?controller=tuteurs&action=tuteur_set_event">
                                                        <button class="btn" type="button">Créer un<br/>évènement</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                          
                                         foreach ($donnees as $elt) 
                                         {
                                            ?>
                                         
                                        <div class="col-xs-12 col-md-6 card-container">
                                            <div class="card historique">
                                                <div class="card-body">
                                                    <h4 class="card-title"> <?= $elt[0]; ?></h4>
                                                    <a href="?controller=tuteurs&action=tuteur_set_event&id=<?=$elt[1];?>">
                                                        <button class="btn" type="button">Créer un<br/>évènement</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>