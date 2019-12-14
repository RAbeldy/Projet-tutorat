
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
                                    <div class="row">
									    
                                                
                                        
										<?php 
                                              foreach($donnees as $data)
                                                {
                                           ?> 
										   <div class="col-xs-12 col-md-6 card-container">
										     <div class="card avenir">
										       <div class="card-body"> 
										         <form method="post" action="?controller=admin&action=linkAdmin" onsubmit="javascript:test_date();javascript:message();">
										 
                                                    <h4 class="card-title"><?= $data['libelle'] ;?></h4>
													      <input type="hidden" name="id_typeTutorat" value="<?=$data['id_typeTutorat'];?>" >
													          <button class="btn"  type="submit">admin</button>

										          </form>
										        </div>
										      </div>
										  </div>
									    <?php
                                          }
                                        ?>
                                         
                                          
                                    </div>
								  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

         