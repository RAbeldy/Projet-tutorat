

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
                                                <p class="text-primary m-0 font-weight-bold">Affecter la gestion d'un tutorat</p>
                                                <?php include('retour.php') ?>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="?controller=superadmin&action=search&indice=8">
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
                                                            <input type="search1" name="name"class="form-control form-control-sm" aria-controls="dataTable" placeholder="Rechercher"/>
                                                            <input type="search2" name="etat"class="form-control form-control-sm" aria-controls="dataTable" placeholder="Rechercher"/>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-12 text-center rechercher">
                                                        <button class="btn" type="submit">RECHERCHER</button>
                                                    </div>

                                                </div>
                                                </form>
                                                <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table dataTable my-0" id="dataTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Nom</th>
                                                                <th>Prenom</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th>Ville</th>
                                                                <th>Adresse</th>
                                                                <th>Code_postal</th>
                                                                <th>Etat</th>
                                                                <th>Tutorat non affectés</th>
                                                                <th>Action</th>
                                                               

                                                               
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            
                                                             foreach ($donnees as $elt) 
                                                            {
                                                             ?>
                                                             <form method="post" action="?controller=tutorat&action=account_affectation">
                                                              <tr >

                                                                  <td> <label><?=$elt['user']->getNom()?></label></td>
                                                                  <td><label><?=$elt['user']->getPrenom()?></label></td>
                                                                  <td><label><?=$elt['user']->getEmail()?></label></td>
                                                                  <td><label ><?=$elt['user']->getPhone()?></label></td>
                                                                  <td><label ><?=$elt['user']->getVille()?></label></td>
                                                                  <td><label ><?=$elt['user']->getAdress()?></label></td>
                                                                  <td><label ><?=$elt['user']->getCode_postal()?></label></td>
                                                                  <td><label ><?=$elt['etat']?></label></td>
                                                                  <td><select class="form-control" name="id_admin">
                                                                    <?php
                                                                        foreach($data as $tab)
                                                                               {
                                                                                 ?>
                                                                        <option value="<?= $tab['user']->getId_user(); ?>" required> <?= $tab['user']->getNom().' '.$tab['user']->getPrenom();?>
                                                                            <!-- il s'agit des info sur le compte-->
                                                                        </option>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                    </select></td>
                                                                     <td><button class="btn" name="affecter"type="submit">AFFECTER</button></td>
                                                                      <input type="hidden" name="id_u" value="<?=$elt['user']->getId_user();?>"></td>
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










    