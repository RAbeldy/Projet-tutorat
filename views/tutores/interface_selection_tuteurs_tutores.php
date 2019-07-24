 <div class="d-flex flex-column" id="content-wrapper">
    <!-- <?php //include('views/alert_view.php'); ?> -->
                <div id="content">
                    <div class="block">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-xs-12 col-md-8">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6 card-container">
                                            <div class="card avenir">
                                                <div class="card-body">
                                                    
                                                    
                                                    <h4 class="card-title">Liste de tutorés</h4>
                                                    <?php if($_SESSION['etat'] == "LIBRE" )
                                                    {
                                                        ?>
                                                    <a href="?controller=tutores&action=tuteurs_list">
                                                        <button class="btn" type="button">Mes potentiels <br/>matchs</button>
                                                    </a>
                                                    <?php
                                                     }
                                                     else
                                                     {
                                                        ?>
                                                        <a href="#">
                                                        <button class="btn" onclick="javascript:alert();" type="button">Pas <br/>de liaison possible</button>
                                                    </a>
                                                     <?php
                                                     }
                                                     ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6 card-container">
                                            <div class="card historique">
                                                <div class="card-body">
                                                    <h4 class="card-title">Mon tuteur</h4>
                                                    <a href="?controller=tutores&action=working_list">
                                                        <button class="btn" type="button">Je travaille<br/>avec lui</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                function alert()
                {
                    alert('au vu du nombre de vos liaisons avec les tutorés, vous n\'avez la possibilité de lier à d\'autre. Merci ');
                }
            </script>