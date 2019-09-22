

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
                                                <p class="text-primary m-0 font-weight-bold">Les comptes qu'il gère </p>
                                                <?php include('retour.php') ?>
                                            </div>
                                            <div class="card-body">
                                               <span style="color: black; font-style: oblique;">   Tuteur:  </span> <?= $data->getNom();?> <?= $data->getPrenom();?></br>
                                               <div class="col-md-5">
                                                            <div id="profilPic">
                                                                <img src='<?=$data->getChemin_photo() ;?>'>
                                                            </div>
                                                        </div>
                                                <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table dataTable my-0" id="dataTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Type de tutorat</th>
                                                                <th>Consulter</th>
                                                                <th>Retirer la gestion du compte</th>
                                                                   
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            
                                                             foreach ($donnees as $elt) 
                                                            {
                                                             ?> 
                                                             <form method="post" action="?controller=superadmin&action=show_associated_tutorat"> 
                                                              <tr >
                                          
                                                                  <td> <label><?=$elt['user']->getNom()." ".$elt['user']->getPrenom()?></label></td>
                                                                  <input type="hidden" name="id_type" value="<?=$elt['tutorat']->getId_typeTutorat()?>">
                                                                  <input type="hidden" name="id_admin" value="<?=$elt['user']->getId_user()?>"><!--il s'agit de l'id_admin du compte statique-->
                                                                  <input type="hidden" name="id_u" value="<?=$data->getId_user()?>">
                                                                  
                                                                  <td><button class="btn" type="submit" name="consulter" >Consulter</button> 
                                                                  <td><button class="btn" type="submit" name="retirer" >Retirer</button>                                                       
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

<script type="text/javascript">
        function alert()
        {
            confirm('etes vous sur de vouloir vous inscrir?');
        }

        
    </script>








    