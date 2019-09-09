
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
                                                <?php include('retour.php') ?>
                                                <p class="text-primary m-0 font-weight-bold">
                                                     <div class="row space">
                                                        <div class="col-md-5">
                                                            <div id="profilPic">
                                                                <img src='<?=$data->getChemin_photo() ;?>'>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7 profil-text">
                                                        <p>
                                                    <span style="color: black; font-style: oblique;">   Nom:  </span> <?= $data->getNom();?> <?= $data->getPrenom();?></br>
                                                    <span style="color: black; font-style: oblique; ">  Email: </span>  <?=$data->getEmail();?></br>

                                                    <span  style="color: black; font-style: oblique;">  Ville: </span> <?=$data->getVille();?></br>
                                                    <span  style="color: black; font-style: oblique;">  Adresse: </span> <?=$data->getAdress();?></br>
                                                    <span  style="color: black; font-style: oblique;">  Code psotal: </span> <?=$data->getCode_postal();?></br>
                                                    <span style="color: black; font-style: oblique;">   Ecole: </span> <?=$data->getEcole();?></br>
                                                    <span  style="color: black; font-style: oblique;">  Niveau scolaire:</span> <?=$data->getNiveau();?></br>
                                                    </p>
                                                </div>
                                                     </div>
                                                  
                                                </p>
                                               
                                                
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
                                                                <th>Etat actuel</th>
                                                            </tr>
                                                            
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            
                                                       
                                                             foreach ($donnees as $elt)
                                                            {
                                                             ?>
                                                             
                                                              <tr>
                                                                  
                                                                  <td><label><?=$elt['tutorat'];?></label></td> <!-- nom -->
                                                                  <td><label><?=$elt['evenement']->getDate_evenement();?></label></td> <!-- prenom -->
                                                                  <td><label><?=$elt['evenement']->getLieu();?></label></td> <!-- phone -->
                                                                  <td><input type="number" style="width: 30%;" name="duree" value="<?=$elt['planning_event']?>"></td> <!-- duree de l'évenement -->    
                                                                   
                                                                  <?php 
                                                                  if($elt['participer_evenement'] == 'NON')
                                                                {
                                                                ?>
                                                                      <td><button class="btn" type="submit" name="valider" >à Valider</button></td>
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








    