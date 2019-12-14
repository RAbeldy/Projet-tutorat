

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
                                                <p class="text-primary m-0 font-weight-bold">Ils sont inscrits</p>
                                                <?php include('retour.php') ?>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 card-body-title">
                                                        <span>RECHERCHER PAR :</span>
                                                    </div>
                                                    
                                                    <div class="col-md-4 offset-1">
                                                        <div class="row text-center">
                                                            <label style="flex: auto;">TUTORAT</label>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-12 text-center rechercher">
                                                        <button class="btn" type="button">RECHERCHER</button>
                                                    </div>
                                                </div>
                                                <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table dataTable my-0" id="dataTable">

                                                            <input type="search" class=" form-control-sm" aria-controls="dataTable" placeholder="Rechercher"/>
                                                        
                                                        <thead>
                                                            <tr>
                                                                <th>Nom</th>
                                                                <th>Prenom</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th>Ville</th>
                                                                <th>Adresse</th>
                                                                <th>Code_postal</th>
                                                                <th>tuteurs disponibles</th>
                                                                <th> Consulter</th>
                                                                <th> Lier/supprimer</th>
                                                                

                                                               
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            
                                                             foreach ($donnees as $elt) 
                                                            {
                                                             ?>

                                                              <form method="post" action="?controller=admin&action=link">
                                                                
                                                              <tr >

 
                                                                  <td> <label><?=$elt['user']->getNom()?></label></td>
                                                                  <td><label><?=$elt['user']->getPrenom()?></label></td>
                                                                  <td><label><?=$elt['user']->getEmail()?></label></td>
                                                                  <td><label ><?=$elt['user']->getPhone()?></label></td>
                                                                  <td><label ><?=$elt['user']->getVille()?></label></td>
                                                                  <td><label ><?=$elt['user']->getAdress()?></label></td>
                                                                  <td><label ><?=$elt['user']->getCode_postal()?></label></td>
                                                                  <td><label>
                                                                      <select class="form-control" name="id_tuteur">
                                                                           <?php 
                                                                           foreach($data as $tab)
                                                                           {
                                                                             ?>
                                                                            <option value="<?=$tab['user']->getId_user();?>"required> <?= $tab['user']->getNom().' '.$tab['user']->getPrenom();?>
                                                                                
                                                                            </option>
                                                                            
                                                                             <?php
                                                                           }
                                                                           ?>
                                                                     </select>
                                                                  </label></td>
                                                                  <td><button class="btn" type="submit"name="consulter" >consulter</button>
                                                                      </td>
                                                                  <?php
                                                                   if($elt['etat'] == 'LIBRE')
                                                                   {
                                                                    ?>
                                                                      <td><button class="btn" type="submit"name="lier" >lier</button>
                                                                      </td>
                                                                   <?php
                                                                   }
                                                                   else
                                                                   {
                                                                    ?>
                                                                    <td><button class="btn" name="supprimer" >Supprimer la liaison</button>
                                                                      </td>
                                                                      <?php
                                                                   }
                                                                   ?>
                                                                  <input type="hidden" name="id_tutore" value="<?=$elt['user']->getId_user()?>" >
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










    