
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
                                                <p class="text-primary m-0 font-weight-bold">
                                                    Historique
                                                </p>
                                                <?php include('retour.php') ?>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 card-body-title">
                                                        <span>RECHERCHER PAR :</span>
                                                    </div>
                                                    <div class="col-md-7 text-nowrap">
                                                        <div class="row text-center">
                                                            <label style="flex: auto;">Période</label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-md-6">
                                                                <label class="col-2">De</label>
                                                                <input class="col-8 offset-2" type="datetime-local"/>
                                                            </div>
                                                            <div class="col-xs-12 col-md-6">
                                                                <label class="col-2">à</label>
                                                                <input class="col-8 offset-2" type="datetime-local"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 offset-1">
                                                        <div class="row text-center">
                                                            <label style="flex: auto;">TUTORAT</label>
                                                        </div>
                                                        <div class="row">
                                                            <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Rechercher"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 text-center rechercher">
                                                        <button class="btn" type="button">RECHERCHER</button>
                                                    </div>
                                                </div>
                                                <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table dataTable my-0" id="dataTable">
                                                        <thead>
                                                            <tr>
                                                              <th>Type_tutorat</th>
                                                                <th>Tutorat</th>
                                                                <th>Date</th>
                                                                <th>Adresse</th>
                                                                <th>Heures</th>
                                                                <th>Validé</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                           
                                                             foreach ($donnees as $elt) 
                                                            {
                                                             ?>

                                                              <form method="post" action="#">
                                                                
                                                              <tr>

                                                                  <td> <label><?=$elt['type_tutorat']?></label></td>
                                                                  <td> <label><?=$elt['tutorat']?></label></td>
                                                                  <td><label><?=$elt['evenement']->getDate_evenement()?></label></td>
                                                                  <td><label><?=$elt['evenement']->getLieu()?></label></td>
                                                                  <?php
                                                                  if( $elt['participer_evenement'] == 'NON' )
                                                                  {
                                                                    ?>
                                                                  <td><label ><strong ><span style="color: red;" ><?=$elt['planning_event']?></span></strong></label></td>

                                                                  <td><label ><strong ><span style="color: red;" ><?=$elt['participer_evenement']?></span></strong></label></td>
                                                                  
                                                                  <td><button class="btn" type="submit" name="réclamer" title="il est conseillé de patienter au moins une semaine pour que l'évènement soit validé. Dès lors, vous pouvez faire une réclamation en toute légitimité" >Pas encore validé</button>
                                                                  </td>
                                                                  <?php
                                                                  }
                                                                  else
                                                                  {
                                                                    ?>
                                                                    <td><label ><strong ><span style="color: green;" ><?=$elt['planning_event']?></span></strong></label></td>

                                                                    <td><label ><strong ><span style="color: green;" ><?=$elt['participer_evenement']?></span></strong></label></td>
                                                                    
                                                                    <td><label title="plus de places disponibles" class="btn" name="s'inscrire">Pris en compte</label>
                                                                  </td>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                                </tr>
                                                                 <input type="hidden" name="id_e"value="<?=$elt['evenement']->getId_evenement()?>" >
                                                                 <input type="hidden" name="id_e"value="<?=$elt['tutorat'];?>" >
                                                      
                                                             </form>
                                                            <?php
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
    
    