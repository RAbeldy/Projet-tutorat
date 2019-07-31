

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
                                                                <th>Nom</th>
                                                                <th>Prenom</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th>Ville</th>
                                                                <th>Adresse</th>
                                                                <th>Code_postal</th>

                                                                <th>Action</th>

                                                               
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            if(!is_null($donnees))
                                                            {
                                                             foreach ($donnees as $elt) 
                                                            {
                                                             ?>

                                                              <form method="post" action="?controller=admin&action=choose_tuteur">
                                                                
                                                              <tr >

 
                                                                  <td> <label><?=$elt['user']->getNom()?></label></td>
                                                                  <td><label><?=$elt['user']->getPrenom()?></label></td>
                                                                  <td><label><?=$elt['user']->getEmail()?></label></td>
                                                                  <td><label ><?=$elt['user']->getPhone()?></label></td>
                                                                  <td><label ><?=$elt['user']->getVille()?></label></td>
                                                                  <td><label ><?=$elt['user']->getAdress()?></label></td>
                                                                  <td><label ><?=$elt['user']->getCode_postal()?></label></td>
                                                                  <?php 
                                                                     if(isset($_SESSION['id_statut']) && $_SESSION['id_statut'] == 11 && $elt['tuteurs'] != 'MEF')
                                                                        { // id_u_d ici correspond à déselectionner un tuteur, ne plus travailler avec lui
                                                                            ?>

                                                                     <td><button class="btn" type="submit"name="rompre" >Choisir</button>
                                                                     </td><input type="hidden" name="id_u_c" value="<?=$elt['user']->getId_user()?>" >
                                                                     <?php
                                                                        }
                                                                    elseif(isset($_SESSION['id_statut']) && $_SESSION['id_statut'] == 11 && $elt['tuteurs'] == 'MEF')
                                                                    {  // id_u_c ici correspond à choisir un tuteur
                                                                        ?> 
                                                                        <td><button class="btn" type="submit"name="Se_lier" >Rompre</button>
                                                                     </td><input type="hidden" name="id_u_d" value="<?=$elt['user']->getId_user()?>" > 
                                                                     <?php
                                                                    }
                                                                      ?>
                                                                </tr>
                                                                 
                                                        
                                                      
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










    