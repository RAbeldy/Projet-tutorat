

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
                                                <p class="text-primary m-0 font-weight-bold">Ils sont disponibles</p>
                                                <?php include('retour.php') ?>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 card-body-title">
                                                        <span>entrez vos critères de recherche :</span>
                                                    </div>
                                                    
                                                    <div class="col-md-4 offset-1">
                                                        <div class="row text-center">
                                                            <label style="flex: auto;">NOM de l'étudiant</label>
                                                            <label style="flex: auto;">Etat de l'étudiant</label>
                                                        </div>
                                                        <div class="row">
                                                            <input type="search1" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Rechercher"/>
                                                            <input type="search2" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Rechercher"/>
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
                                                                <th>Nom</th>
                                                                <th>Prenom</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th>Ville</th>
                                                                <th>Adresse</th>
                                                                <th>Code_postal</th>
                                                                <th>Etat</th>
                                                               

                                                               
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            
                                                             foreach ($donnees as $elt) 
                                                            {
                                                             ?> 
                                                              <tr >
                                                                  <td> <label><?=$elt['type_tutorat']?></label></td>
                                                                  <td> <label><?=$elt['tutorat']?></label></td>
                                                                  <td> <label><?=$elt['user']->getNom()?></label></td>
                                                                  <td><label><?=$elt['user']->getPrenom()?></label></td>
                                                                  <td><label><?=$elt['user']->getEmail()?></label></td>
                                                                  <td><label ><?=$elt['user']->getPhone()?></label></td>
                                                                  <td><label ><?=$elt['user']->getVille()?></label></td>
                                                                  <td><label ><?=$elt['user']->getAdress()?></label></td>
                                                                  <td><label ><?=$elt['user']->getCode_postal()?></label></td>
                                                                  <td><label ><?=$elt['etat']?></label></td>
                                                                     
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










    