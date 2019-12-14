<div id="globalContent">
        <div id="wrapper">
            
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <div class="block">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-xs-12 col-md-8">
                                    <div class="row">
                                        <div class="card debut">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 font-weight-bold">
                                                    Création d'un nouveau type de tutorat
                                                    <?php include('retour.php')?>
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="?controller=tutorat&action=create_type_center" >
                                                    <div class="row">
                                                        
                                                        <div class="form-group text-center col-12">
                                                            <label for="lieu">
                                                                <strong>intitulé du type de tutorat</strong><br> 
                                                            </label>
                                                           
                                                            
                                                        </div>
                                                        
                                                       <div class="form-group text-center col-12">
                                                        <td><input type="text" name="type_tutorat" class="form-control" required>
                                                       </div>
                                                    </div>
                                                    <div class="form-group text-center col-12">
                                                        <button class="btn" type="submit">CREER</button>
                                                    </div>
                                                </form>
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


         