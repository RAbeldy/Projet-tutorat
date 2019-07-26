<?php 
if(!isset($_SESSION['id_statut']))
 {
    require_once('views/login.php');
  }
  ?>  

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
                                                                <th>Date de naissance</th>
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

                                                              <form method="post" action="?controller=tutores&action=cancel_wish">
                                                                
                                                              <tr >

 
                                                                  <td> <label><?=$elt->getNom()?></label></td>
                                                                  <td><label><?=$elt->getPrenom()?></label></td>
                                                                  <td><label><?=$elt->getDate_naissance()?></label></td>
                                                                  <td><label style="overflow: scroll;"><?=$elt->getEmail()?></label></td>
                                                                  <td><label ><?=$elt->getPhone()?></label></td>
                                                                  <td><label ><?=$elt->getVille()?></label></td>
                                                                  <td><label ><?=$elt->getAdress()?></label></td>
                                                                  <td><label ><?=$elt->getCode_postal()?></label></td>
                                                                  
                                                                  <td><button class="btn" type="submit"name="annuler">Annuler</button>
                                                                  </td>
                                                                  
                                                                </tr>
                                                                 <input type="hidden" name="id_u" value="<?=$elt->getId_user()?>" >
                                                        
                                                      
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










    