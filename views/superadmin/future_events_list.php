





    <div id="globalContent">
        <div id="wrapper">

            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <div class="block">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-1">
                                </div>
                                <div class="col-xs-12 col-md-10">
                                    <div class="row">
                                        <div class="card debut">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 font-weight-bold">Les évènements à venir</p>
                                                <?php include('retour.php') ?>
                                            </div>
                                            <div class="card-body">
                                                
                                                
                                                
                                                <form method="post" action="?controller=superadmin&action=search&indice=1">
                                                    <div class="row">
                                                        <div class="col-md-7 text-nowrap">
                                                            <div class="row text-center">
                                                                <label style="flex: auto;">Période</label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-12 col-md-6">
                                                                    <div class="row">
                                                                        <label class="col-2">De</label>
                                                                        <input  name="date1" class="col-10 form-control" type="date"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-md-6">
                                                                    <div class="row">
                                                                        <label class="col-2">à</label>
                                                                        <input  name="date2" class="col-10 form-control" type="date"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 offset-1">
                                                            <label class="row" style="flex: auto;">Tutorat</label>
                                                            <input type="search" name="string" class="row form-control-sm rechercher" aria-controls="dataTable" placeholder="Nom du tutorat"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 text-center rechercher">
                                                        <button class="btn" name="search" type="submit">RECHERCHER</button>
                                                    </div>
                                                </form>

                                                <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table dataTable my-0" id="dataTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Type_tutorat</th>
                                                                <th>Tutorat</th>
                                                                <th>Date</th>
                                                                <th>Adresse</th>
                                                                <th>Tuteurs demandés</th>
                                                                <th>Places restantes(tuteurs)</th>
                                                                <th>Horaires</th>
                                                                <th>Suppression</th>
                                                                <th>Consultation</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            if(!is_null($donnees))
                                                            {
                                                             foreach ($donnees as $elt)
                                                            {
                                                              if(!preg_match("#ADMINISTRATION#", $elt['tutorat']) )
                                                                {
                                                             ?>

                                                              <form method="post" action="?controller=superadmin&action=modify_event">

                                                              <tr>
                                                                  <td> <label><?=$elt['type_tutorat']?></label></td>
                                                                  <td> <label><?=$elt['tutorat']?></label></td>
                                                                  <td><label><?=$elt['evenement']->getDate_evenement()?></label></td>
                                                                  <td><label><?=$elt['evenement']->getLieu()?></label></td>
                                                                  <td><label><?=$elt['evenement']->getNb_tuteurs()?></label></td>
                                                                  <td><label><?=$elt['evenement']->getNb_places()?></label></td>
                                                                  <td><label ><?=$elt['planning_event']?></label></td>

                                                                  </td>
                                                                  <td><button class="btn" type="submit" name="supprimer" >Supprimer</button>
                                                                  </td>
                                                                  <td><button class="btn" type="submit" name="consulter" >Consulter</button>
                                                                  </td>
                                                                  
                                                                  </td>


                                                                </tr>
                                                                 <input type="hidden" name="id_e" value="<?=$elt['evenement']->getId_evenement()?>" >
                                                             </form>
                                                            <?php
                                                                }
                                                             }
                                                             }
                                                             ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr></tr>
                                                        </tfoot>
                                                    </table>
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
        </div>
    </div>

<script type="text/javascript">
        function alert()
        {
            confirm('etes vous sur de vouloir vous inscrir?');
        }


    </script>
