

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
                                                <p class="text-primary m-0 font-weight-bold">Tous les types de tutorat </p>
                                                <?php include('retour.php') ?>
                                            </div>
                                            <div class="card-body">
                                                
                                                <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                                    <table class="table dataTable my-0" id="dataTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Type de tutorat</th>
                                                                
                                                                <th>Supprimer</th>
                                                                   
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            
                                                             foreach ($donnees as $elt) 
                                                            {
                                                             ?> 
                                                             <form method="post" action="?controller=tutorat&action=delete_typeTutorat"> 
                                                              <tr >
                                          
                                                                  <td> <label><?=$elt[0]?></label></td>
                                                                  <input type="hidden" name="id_type" value="<?=$elt[1]?>">
                                                                  
                                                                  
                                                                  <td><button class="btn" type="submit" name="consulter" >Supprimer</button>                                                       
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








    