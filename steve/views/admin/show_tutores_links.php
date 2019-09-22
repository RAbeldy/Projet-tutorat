
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
                                                
                                                <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table dataTable my-0" id="dataTable">
                                                        <thead>
                                                            <tr>
                                                                
                                                                <th>Nom</th>
                                                                <th>Prénom</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th>Ville</th>
                                                                <th>Adresse</th>
                                                                <th>Code postal</th>
                                                                <th>Ecole</th>
                                                                <th>Niveau</th>
                                                                <th>Supprimer</th>
                                                                
                                                                
                                                            </tr>
                                                            
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            
                                                       
                                                             foreach ($donnees as $elt)
                                                            {
                                                             ?>
                                                                <form method="post" action="?controller=admin&action=link">
                                                              <tr>
                                                                  
                                                                 <td> <label><?=$elt->getNom()?></label></td>
                                                                      <td><label><?=$elt->getPrenom()?></label></td>
                                                                      
                                                                      <td><label style="overflow: scroll;"><?=$elt->getEmail()?></label></td>
                                                                      <td><label ><?=$elt->getPhone()?></label></td>
                                                                      <td><label ><?=$elt->getVille()?></label></td>
                                                                      <td><label ><?=$elt->getAdress()?></label></td>
                                                                      <td><label ><?=$elt->getCode_postal()?></label></td>
                                                                      <td><label ><?=$elt->getEcole()?></label></td>
                                                                      <td><label ><?=$elt->getNiveau()?></label></td>

                                                                  <td><button class="btn" name="supprimer" >Supprimer la liaison</button>
                                                                      </td>
                                                                      
                                                                  <input type="hidden" name="id_tutore" value="<?=$elt->getId_user()?>" >
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








    