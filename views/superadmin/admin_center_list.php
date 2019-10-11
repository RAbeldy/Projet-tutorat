

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
                                                <p class="text-primary m-0 font-weight-bold">Liste des administrateurs</p>
                                                <?php include('retour.php') ?>
                                            </div>
                                            <div class="card-body">
                                                
                                                <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table dataTable my-0" id="dataTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Nom</th>
                                                                <th>Prénom</th>
                                                                <th>Email</th>
                                                                <th>Téléphone</th>
                                                                <th>Ville</th>
                                                                <th>Adresse</th>
                                                                <th>Code postal</th>
                                                                <th> Consulter</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php

                                                             foreach ($donnees as $elt)
                                                            {
                                                             ?>

                                                              <form method="post" action="?controller=superadmin&action=working_account">

                                                              <tr >


                                                                  <td> <label><?=$elt['user']->getNom()?></label></td>
                                                                  <td><label><?=$elt['user']->getPrenom()?></label></td>
                                                                  <td><label><?=$elt['user']->getEmail()?></label></td>
                                                                  <td><label ><?=$elt['user']->getPhone()?></label></td>
                                                                  <td><label ><?=$elt['user']->getVille()?></label></td>
                                                                  <td><label ><?=$elt['user']->getAdress()?></label></td>
                                                                  <td><label ><?=$elt['user']->getCode_postal()?></label></td>

                                                                  <td><button class="btn" type="submit"name="consulter" >Consulter</button>
                                                                      </td>



                                                                  <input type="hidden" name="id_u" value="<?=$elt['user']->getId_user()?>" >
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
