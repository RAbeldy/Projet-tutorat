
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
                                                <p class="text-primary m-0 font-weight-bold">Profil tuteur</p>
												<a href="?controller=tuteurs&amp;action=interface_tuteur">
													<button name="error_Back" class="btn" type="button">Retour page précédente</button>
												</a>
                                            </div>
                                            <div class="row space">
												<div class="col-md-5">
													<div id="profilPic">
														<img src="<?=$data->getChemin_photo() ;?>">
													</div>
												</div>
												<div class="col-md-7 profil-text">
													<div class="row" id="profil-name">
														<span> <?=$data->getNom();?> <?=$data->getPrenom();?></span>
													</div>
													<div class="row" id="profil-mail">
														<span> <?=$data->getEmail();?></span>
													</div>
												</div>
                                            </div>
											<hr style="margin: 0 10%;">
                                            <div class="card-body row">
                                                <div class="col-6">
													<div class="row">														
														<div class="col-12 text-center card-title">
															<span> TUTORATS AFFILIES:</span>
														</div>
													</div>
													<div class="row">
														<div id="tableau" class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
															<table class="table dataTable my-0" id="dataTable">
																<thead>
																	<tr>
																		<th>TUTORAT</th>
																		<th>ADMINISTRATEUR</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td><label>VAUBAN ESQUERMES</label></td>
																		<td><label> Rabeldy </label></td>
																	</tr>
																	<tr>
																		<td><label>VAUBAN ESQUERMES</label></td>
																		<td><label> Rabeldy </label></td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
                                                </div>
                                                <div class="col-6">
													<div class="row">														
														<div class="col-12 text-center card-title">
															<span> TUTORES AFFILIES :</span>
														</div>
													</div>
													<div class="row">
														<div id="tableau" class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
															<table class="table dataTable my-0" id="dataTable">
																<thead>
																	<tr>
																		<th>NOM</th>
																		<th>PRENOM</th>
																		<th>ECOLE</th>
																		<th>E-MAIL</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td><label>NKOUKOU</label></td>
																		<td><label> Rabeldy </label></td>
																		<td><label> HEI </label></td>
																		<td><label> email@mail.com </label></td>
																	</tr>
																	<tr>
																		<td><label>NKOUKOU</label></td>
																		<td><label> Rabeldy </label></td>
																		<td><label> HEI </label></td>
																		<td><label> email@mail.com </label></td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
                                                </div>
												<div class="col-12 text-center">
													<a href="">
														<button class="btn" type="button">Modifier mes informations de compte</button>
													</a>
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
	<div id="popup" style="display:none;">
		<div class="container">
			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-xs-12 col-md-10">
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header py-3">
									<p class="text-primary m-0 font-weight-bold">Libre</p>
								</div>
								<div class="card-body text-center">
									<p class="card-text">Liste des tutorés encore disponibles pour le tutorat personnalisé</p>
									<a href="adminTuteurLibre.html"><button class="btn" type="button">Visualiser</button></a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header py-3">
									<p class="text-primary m-0 font-weight-bold">Occupés</p>
								</div>
								<div class="card-body text-center">
									<p class="card-text">Listes des tutorés possédant un nombre maximum de tutorés</p>
									<a href="adminTuteurOccupe.html"><button class="btn" type="button">Visualiser</button></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
