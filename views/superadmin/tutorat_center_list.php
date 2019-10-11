

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
                                                <p class="text-primary m-0 font-weight-bold">Tous les centres de tutorat </p>
                                                <?php include('retour.php') ?>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="?controller=superadmin&action=search&indice=7">
                                                <div class="row">
                                                    <div class="col-12 card-body-title">
                                                        <span>RECHERCHER PAR :</span>
                                                    </div>
                                                    <div class="col-md-7 text-nowrap">
                                                        
                                                    </div>
                                                    <div class="col-md-4 offset-1">
                                                        <div class="row text-center">
                                                            <label style="flex: auto;">TUTORAT</label>
                                                        </div>
                                                        <div class="row">
                                                            <input type="search" name="tutorat"class="form-control form-control-sm" aria-controls="dataTable" placeholder="Rechercher"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 text-center rechercher">
                                                        <button class="btn" type="button">RECHERCHER</button>
                                                    </div>
                                                </div>
                                            </form>
                                                <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table dataTable my-0" id="dataTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Type de tutorat</th>
                                                                <th>Tutorat</th>
                                                                <th>Adresse</th>
                                                                <th>Code postal</th>
                                                                <th>Supprimer</th>
                                                                   
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            
                                                             foreach ($donnees as $elt) 
                                                            {
                                                                if(!preg_match('#IMMERSION#', $elt['tutorat']->getLibelle()))
                                                                {
                                                             ?> 
                                                             <form method="post" action="?controller=tutorat&action=delete_tutorat"> 
                                                              <tr >
                                                                 
                                                                  <td> <label><?=$elt['type_tutorat']?></label></td>
                                                                  <td> <label><?=$elt['tutorat']->getLibelle()?></label></td>
                                                                  <td><label><?=$elt['tutorat']->getAdresse()?></label></td>
                                                                  <td><label><?=$elt['tutorat']->getCode_postal()?></label></td>
                                                                  <td><button class="btn" type="submit" name="consulter" >Supprimer</button>
                                                                  </td>                                                       
                                                              </tr>
                                                                 <input type="hidden" name="id_t" value="<?=$elt['tutorat']->getId_tutorat()?>" >
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

<script type="text/javascript">
        function alert()
        {
            confirm('etes vous sur de vouloir vous inscrir?');
        }

        
    </script>








    