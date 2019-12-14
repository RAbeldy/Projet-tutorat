

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
                                                <p class="text-primary m-0 font-weight-bold">A venir</p>
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
                                                                <th>Places</th>
                                                                <th>Horaires</th>
                                                                <th>Inscription</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            
                                                             foreach ($donnees as $elt) 
                                                            {
                                                              if(!preg_match('#TUTORAT_PERSONNALISE#',$elt['tutorat']))
                                                              {
                                                             ?>

                                                              <form method="post" action="?controller=evenements&action=subscribe_to_event">
                                                                
                                                              <tr >

                                                                  <td><label><?=$elt['type_tutorat']?></label></td>
                                                                  <td> <label><?=$elt['tutorat']?></label></td>
                                                                  <td><label><?=$elt['evenement']->getDate_evenement()?></label></td>
                                                                  <td><label><?=$elt['evenement']->getLieu()?></label></td>
                                                                  <td><label><?=$elt['evenement']->getNb_places()?></label></td>
                                                                  <td><label ><?=$elt['planning_event']?></label></td>
                                                                  <?php
                                                                  if( $elt['evenement']->getNb_places() > 0 )
                                                                  {
                                                                    ?>
                                                                  <td><button class="btn" type="submit" title="<?=$elt['evenement']->getNb_places().' place(s) restante(s)' ?>"name="s'inscrire" onclick="alert();">S'inscrire</button>
                                                                  </td>
                                                                  <?php
                                                                  }
                                                                  else
                                                                  {
                                                                    ?>
                                                                    <td><label title="plus de places disponibles" class="btn" name="s'inscrire">Complet</label>
                                                                  </td>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                                </tr>
                                                                 <input type="hidden" name="id_e" value="<?=$elt['evenement']->getId_evenement()?>" >
                                                        
                                                      
                                                             </form>
                                                            <?php
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








    