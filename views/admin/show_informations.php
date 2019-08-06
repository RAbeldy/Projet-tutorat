
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
                                                <p class="text-primary m-0 font-weight-bold">
                                                 <?=$data->getNom();?> <?=$data->getPrenom();?> </br> EMAIL: <?=$data->getEmail();?>
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
                                                                
                                                                <th>Tutorat</th>
                                                                <th>Date</th>
                                                                <th>Lieu</th>
                                                                <th>Duree</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            
                                                       
                                                             foreach ($donnees as $elt)
                                                            {
                                                             ?>
                                                             <form method="post" action="?controller=admin&action=validate_hours">
                                                              <tr>
                                                                  
                                                                  <td><label><?=$elt['type_tutorat'];?></label></td> <!-- nom -->
                                                                  <td><label><?=$elt['evenement']->getDate_evenement();?></label></td> <!-- prenom -->
                                                                  <td><label><?=$elt['evenement']->getLieu();?></label></td> <!-- phone -->
                                                                  <td><input type="number" name="duree" value="<?=$elt['planning_event']?>"></td> <!-- duree de l'évenement -->    
                                                                   
                                                                  <?php 
                                                                  if($elt['participer_evenement'] == 'NON')
                                                                {
                                                                ?>
                                                                      <td><button class="btn" type="submit" name="valider" onclick="alert();">Valider</button></td>
                                                                      <input type="hidden" name="id_e" value="<?=$elt['evenement']->getId_evenement()?>" >
                                                                      <input type="hidden" name="id_t" value="<?=$data->getId_user();?>" >
                                                                <?php 
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                    <td><label class="btn" name="validé" title="deja validé">Validé</label>  </td>
                                                                      
                                                                    <?php
                                                                } 
                                                                ?>
                                                                  
                                                             </tr>
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
        </div>
    </div>

<script type="text/javascript">
        function alert()
        {
            confirm('etes vous sur de vouloir valider?');
        }
</script>








    