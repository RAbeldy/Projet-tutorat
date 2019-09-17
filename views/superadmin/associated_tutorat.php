

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
                                                <p class="text-primary m-0 font-weight-bold">Tous les tutorats associés à ce compte  </p>
                                                <?php include('retour.php') ?>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    
                                                    <div class="col-md-7 text-nowrap">
                                                        <span style="color: black; font-style: oblique;">   Compte:  </span> <?= $data->getNom();?> <?= $data->getPrenom();?></br>

                                                       <span style="color: black; font-style: oblique;"> Mot de passe: </span>   <?= $data->getPassword();?>
                                                        <form method="post" action="?controller=superadmin&action=update_password"> 
                                                            <button class="btn" type="submit">Modifier le mot de passe admin</button>
                                                            <input type="hidden" name="id_admin" value="<?= $data->getId_user();?>">
                                                       </form>
                                                    </div>
                                                    
                                                </div>
                                                <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                                    <form method="post" action="?controller=tutorat&action=add_tutorat"> 
                                                              
                                                                <div class="form-group row">
                                                                    <label class="col-xs-12 col-md-4" style="margin-top: auto;margin-bottom: auto;">
                                                                    <select class="col-12"  name="id_t">
                                                                        <?php
                                                                            foreach($res as $value)
                                                                           {
                                                                             ?>
                                                                            <option value="<?= $value['tutorat']->getId_tutorat(); ?>" required> <?= $value['tutorat']->getLibelle() ;?>
                                                                        
                                                                             </option>
                                                                            <?php
                                                                            }
                                                                            ?>

                                                                    </select></label>
                                                        
                                                                <button class="btn" type="submit">Affecter ce tutorat à ce compte</button>
                                                        </div>
                                                            <input type="hidden" name="id_admin" value="<?= $data->getId_user();?>">
                                                                
                                                        </form>
                                                    <table class="table dataTable my-0" id="dataTable">

                                                        <thead>
                                                            <tr>
                                                                <th>Type de tutorat</th>
                                                                <th>Tutorat</th>
                                                                <th>Adresse</th>
                                                                <th>Code postal</th>
                                                                <th>Retirer la gestion</th>
                                                                   
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            
                                                             foreach ($donnees as $elt) 
                                                            {
                                                             ?> 

                                                             <form method="post" action="?controller=tutorat&action=remove_tutorat"> 
                                                              <tr >
                                                                  
                                                                  <td> <label><?=$elt['type_tutorat']?></label></td>
                                                                  <td> <label><?=$elt['tutorat']->getLibelle()?></label></td>
                                                                  <td><label><?=$elt['tutorat']->getAdresse()?></label></td>
                                                                  <td><label><?=$elt['tutorat']->getCode_postal()?></label></td>
                                                                  
                                                                  
                                                                  <td><button class="btn" type="submit" name="retirer" >Retirer</button>  </td>                                                     
                                                              </tr>
                                                                 <input type="hidden" name="id_t" value="<?=$elt['tutorat']->getId_tutorat()?>" >
                                                                 
                                                                 <input type="hidden" name="id_admin" value="<?= $data->getId_user();?>">
                                                            </form>

                                                            <?php
                                                             
                                                             }
                                                             ?>
                                                             
                                                        </tbody>
                                                        

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








    