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
                                        <div class="col-xs-12 col-md-6 card-container">
                                            <div class="card avenir">
                                                <div class="card-body">
                                                    <h4 class="card-title">Je choisis</h4>
                                                    <a href="?controller=admin&action=Spasts_events_list">
                                                        <button class="btn" type="button">Parmi ceux présents<br/>lors d'évènements passés </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6 card-container">
                                            <div class="card historique">
                                                <div class="card-body">
                                                    <h4 class="card-title">Je consulte</h4>
                                                    <a href="?controller=admin&action=selected_tuteurs">
                                                        <button class="btn" type="button">Ceux que<br/>j'ai choisi</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6 card-container">
                                            <div class="card historique">
                                                <div class="card-body">
                                                    <h4 class="card-title">En attente</h4>
                                                    <a href="?controller=admin&action=show_all_proposal">
                                                        <button class="btn" type="button">ils n'ont pas <br/>encore validé</button>
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