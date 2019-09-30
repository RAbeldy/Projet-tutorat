
   <div class="d-flex flex-column" id="content-wrapper">
  
                <div id="content">
                    <div class="block">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-xs-12 col-md-8">
								  <label for="date">
                                    <strong>Mes Types de tutorats</strong><br>
                                  </label>
							    <form method="post" action="?controller=admin&action=create_admin" onsubmit="javascript:test_date();javascript:message();">
                                    <div class="row">
									    
                                        
										<?php 
                                              foreach($donnees as $data)
                                                {
                                           ?> 
										  <div class="col-xs-12 col-md-6 card-container">
										   <div class="card avenir">
                                                <div class="card-body">
                                                    <h4 class="card-title"><?= $data['libelle'] ;?></h4>
                                                       <button class="btn" name="tuteur" type="submit">admin</button>
													   <input type="hidden" name="libelle" value="<?= $data['libelle'] ;?>" >
                                                </div>
                                           </div>
										  </div>
									    <?php
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

         