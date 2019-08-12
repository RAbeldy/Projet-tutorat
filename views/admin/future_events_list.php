

    


                                                                 
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
                                                <p class="text-primary m-0 font-weight-bold">Les evenements à venir</p>
                                                <?php include('retour.php') ?>
                                            </div>
                                            <div class="card-body">
                                                    <div class=" rechercher">
                                                        <td><a href="PHPExcel-1.8/exportTutorat/exportData-xlsx.php"><button class="btn"  name="" > Imprimer</button></a></td>
                                                    </div>
                                                <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table dataTable my-0" id="dataTable">
                                                            <input type="search" class="form-control-sm rechercher" aria-controls="dataTable" placeholder="Rechercher par nom de tutorat" style="width: 30%; " />
                                                            <button type="button" class=" btn-default"> Search </button>
                                                        <thead>
                                                            <tr>
                                                                <th>Tutorat</th>
                                                                <th>Date</th>
                                                                <th>Adresse</th>
                                                                <th>Tuteurs demandés</th>
                                                                <th>Places restantes(tuteurs)</th>
                                                                <th>Horaires</th>
                                                                <th>Modifier</th>
                                                                <th>Supprimer</th>
                                                                <th>Consulter</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            if(!is_null($donnees))
                                                            {
                                                             foreach ($donnees as $elt) 
                                                            {
                                                             ?>

                                                              <form method="post" action="?controller=admin&action=modify_event">
                                                                
                                                              <tr>
                                                                  <td> <label><?=$elt['tutorat']?></label></td>
                                                                  <td><label><?=$elt['evenement']->getDate_evenement()?></label></td>
                                                                  <td><label><?=$elt['evenement']->getLieu()?></label></td>
                                                                  <td><label><?=$elt['evenement']->getNb_tuteurs()?></label></td>
                                                                  <td><label><?=$elt['evenement']->getNb_places()?></label></td>
                                                                  <td><label ><?=$elt['planning_event']?></label></td>
                                                                 

                                                                  <td><button class="btn" type="submit" name="modifier" >Modifier</button>
                                                                  </td>
                                                                  <td><button class="btn" type="submit" name="supprimer" >Supprimer</button>
                                                                  </td>
                                                                  <td><button class="btn" type="submit" name="consulter" >Consulter</button>
                                                                  </td>
                                                                  

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








    