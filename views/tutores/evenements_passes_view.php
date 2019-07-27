
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
                                                    Historique
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
                                                                <th>Adresse</th>
                                                                <th>Heures</th>
                                                                <th>Validé</th>
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

                                                              <form method="post" action="#">
                                                                
                                                              <tr>

 
                                                                  <td> <label><?=$elt['tutorat']?></label></td>
                                                                  <td><label><?=$elt['evenement']->getDate_evenement()?></label></td>
                                                                  <td><label><?=$elt['evenement']->getLieu()?></label></td>
                                                                    <td><label > 
                                                                      <strong style="color: red;">
                                                                        <?=$elt['planning_event']?>
                                                                      </strong>
                                                                    </label></td>
                                                                  
                                                                  <td><label ><?=$elt['participer_evenement']?></label></td>
                                                                  <?php
                                                                  if( $elt['participer_evenement'] == 'NON' )
                                                                  {
                                                                    ?>
                                                                  <td><button class="btn" onclick="openModal();" id="btnPopup"> Valider</button>
                                                                  </td>
                                                                  <div id= "overlay" class="overlay"> 
                                                                         <div id="popup" class="popup">
                                                                            <h2> Confirmer </h2>
                                                                            <p>
                                                                                <button class="btn" onclick="openModal();" id="close" name="annuler" >annuler</button>
                                                                            <button class="btn" onsubmit="openModal();" id="submit" type="submit" name="valider">valider</button>
                                                                            </p>
                                                                         </div>
                                                                  </div>
                                                                  <?php
                                                                  }
                                                                  else
                                                                  {
                                                                    ?>
                                                                    <td><label title="plus de places disponibles" class="btn" name="s'inscrire">Validé</label> 
                                                                  </td>
                                                                  <?php
                                                                  }
                                                                  ?>
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

<script type="text/javascript">


var btnPopup = document.getElementById('btnPopup');
var close =    document.getElementById('close');
var submit =   document.getElementById('submit');


        function openModal() 
        {
            var overlay = document.getElementById("overlay");
            if (overlay.style.display == 'block') 
            {
                overlay.style.display = 'none' ;
            } 
            else 
            {
                overlay.style.display = 'block';
            }
        }
    </script>
    