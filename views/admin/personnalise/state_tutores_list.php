
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
                                                    
                                                </p>
                                                <?php include('retour.php') ?>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    
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
                                                                <th>Etat</th>
                                                                <th>Nom</th>
                                                                <th>Prénom</th>
                                                                <th>Phone</th>
                                                                <th>Email</th>
                                                                <th>Ecole</th>
                                                                <th>Niveau</th>
                                                                <th>Consulter </th>
                                                                

                                                            </tr>
                                                            
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                             foreach ($donnees as $elt)
                                                            {
                                                              
                                                             ?>
                                                             <form method="post" action="?controller=admin&action=link">
                                                              <tr>
                                                                  <td><label><?=$elt['etat']?></label></td> <!-- statut -->
                                                                  <td><label><?=$elt['user']->getNom();?></label></td> <!-- nom -->
                                                                  <td><label><?=$elt['user']->getPrenom();?></label></td> <!-- prenom -->
                                                                  <td><label><?=$elt['user']->getPhone();?></label></td> <!-- phone -->
                                                                  <td><label ><?=$elt['user']->getEmail();?></label></td> <!-- email-->
                                                                  <td><label ><?=$elt['user']->getNiveau();?></label></td> <!-- niveau -->
                                                                  <td><label ><?=$elt['user']->getEcole();?></label></td> <!-- ecole -->
                                                                    
                                                                  <td><button class="btn" type="submit" name="consulter" >Consulter</button></td>
                                                                  
                                                                  
                                                                  <input type="hidden" name="id_tutore" value="<?=$elt['user']->getId_user();?>" >
                                                                  
                                                                 
                                                                  
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










    