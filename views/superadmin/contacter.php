<div id="globalContent">
        <div id="wrapper">
			<div class="d-flex flex-column" id="content-wrapper">
							<div id="content">
								<div class="block">
									<div class="container">
										<div class="row">
											<form class="form-contact col-xs-12 col-md-7" method="post" action="?controller=superadmin&action=message">
												<div class="card-header py-3">
													<p class="text-primary m-0 font-weight-bold">
														NOUS CONTACTER
													</p>
												</div>
												
												<div class="form-group space">
													<select class="form-control" name="email">
														<?php foreach( $data as $elt) 
														{
														 ?>

														   <option value="<?=$elt[0]->getEmail() ;?>"> Destinataire : <?=$elt[1] ;?></option>

														<?php
                                                         }
                                                         ?>
													</select>
													
													<!--<small class="form-text text-danger">Veuillez entrer une adresse e-mail valide.</small> -->
												</div>
												<div class="form-group">
													<textarea class="form-control" name="message" placeholder="Message" rows="14"></textarea>
												</div>
												<div class="form-group text-center">
													<button class="btn" type="submit"> ENVOYER </button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
				</div>
			</div>
		</div>
