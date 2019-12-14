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
                                                   Lier
                                                    <?php include('retour.php') ?>
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="?controller=admin&action=linkAdmin" onsubmit="javascript:test_date();javascript:message();">
                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-md-6">
                                                            <label for="date">
                                                                <strong>Mes tutorats</strong><br>
                                                            </label>
                                                             <select class="form-control" name="id_admin">
                                                                  <?php 
                                                                       foreach($donneesTutorat as $elt)
                                                                       {
																		  
                                                                         ?>
                                                                        <option value="<?=$elt['id_admin'];?>"required> <?= $elt['libelle'] ;?>
																		 
                                                                            
                                                                        </option>
                                                                        
                                                                         <?php
																		 
                                                                       }
                                                                       ?>
                                                            </select>

                                                           
                                                            
                                                        </div>
														<div class="form-group col-xs-12 col-md-6">
                                                            <label for="date">
                                                                <strong>Mes tuteurs</strong><br>
                                                            </label>
                                                             <select class="form-control" name="id_user">
                                                                  <?php 
                                                                       foreach($donneesTuteurs as $data)
                                                                       {
                                                                         ?>
                                                                    
																		 <option value="<?=$data['users']->getId_user();?>"required> <?= $data['users']->getNom() ;?>
                                                                            
                                                                        </option>
                                                                        
                                                                         <?php
                                                                       }
                                                                       ?>
                                                            </select>

                                                           
                                                            
                                                        </div>
                                                        
                                                    </div>
													<?php
													if(isset($donneesTutorat[0]['id_admin']))
													 {
													     if(isset($donneesTuteurs[0]['users']))
														   {
												    ?>
                                                    <div class="form-group text-center col-12">
                                                        <button class="btn" name="lier" type="submit">lier</button>
                                                    </div>
													<?php
													  }
													  
													  }
													  
													?>
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

  

         