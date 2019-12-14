

    


                                                                 
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
                                                <p class="text-primary m-0 font-weight-bold">Détails des heures</p>
                                                <?php include('retour.php') ?>
                                            </div>
                                            <div class="card-body">
                                                    
                                                <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table dataTable my-0" id="dataTable">
                                                          <form method="post" action="?controller=admin&action=future_events_list">
                                                            <div class="col-md-7 text-nowrap">
                                                                <div class="row text-center">
                                                                  <label style="flex: auto;">Période</label>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-6">
                                                                        <label class="col-2">De</label>
                                                                        <input  name="date1" class="form-control" type="datetime-local"/>
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-6">
                                                                        <label class="col-2">à</label>
                                                                        <input  name="date2" class="form-control" type="datetime-local"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                              <input type="search" name="string" class="form-control-sm rechercher" aria-controls="dataTable" placeholder="Rechercher par nom de tutorat" style="width: 30%; " />
                                                              <button type="submit" name="search" class=" btn-default"> Search </button>
                                                          </form>
                                                        <thead>
                                                            <tr>
                                                                <th>Tutorat</th>
                                                                <th>Date</th>
                                                                <th>Adresse</th>
                                                                <th>Horaires</th>
                                                                <th>Consulter</th>
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

                                                              <form method="post" action="#">
                                                                
                                                              <tr>
                                                                  <td> <label><?=$elt['tutorat']?></label></td>
                                                                  <td><label><?=$elt['evenement']->getDate_evenement()?></label></td>
                                                                  <td><label><?=$elt['evenement']->getLieu()?></label></td>
                                                                  <td><label ><?=$elt['planning_event']?></label></td>
                                                                 

                                                                 
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








    