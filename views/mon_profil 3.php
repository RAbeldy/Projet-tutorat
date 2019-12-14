
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
                                                <p class="text-primary m-0 font-weight-bold">Mon profil </p>
												
                                            </div>
                                            <div class="row space">
												<div class="col-md-5">
													<div id="profilPic">
														<img src="<?=$data->getChemin_photo() ;?>">

														
													</div>
												</div>
												<div class="col-md-7 profil-text">
														<p>
													<span style="color: black; font-style: oblique;">	Nom:  </span> <?= $data->getNom();?> <?= $data->getPrenom();?></br>
													<span style="color: black; font-style: oblique; ">	Email: </span> &nbsp;&nbsp; <?=$data->getEmail();?></br>

													<span  style="color: black; font-style: oblique;">	Ville: </span> &nbsp;&nbsp;<?=$data->getVille();?></br>
													<span  style="color: black; font-style: oblique;">	Adresse: </span>&nbsp;&nbsp; <?=$data->getAdress();?></br>
													<span  style="color: black; font-style: oblique;">	Code psotal: </span>&nbsp;&nbsp; <?=$data->getCode_postal();?></br>
													<span style="color: black; font-style: oblique;">	Ecole: </span>&nbsp;&nbsp;<?=$data->getEcole();?></br>
													<span  style="color: black; font-style: oblique;">	Niveau scolaire:</span>&nbsp;&nbsp; <?=$data->getNiveau();?></br>
													</p>
													</div>
													
													
												</div>
                                            
											<hr style="margin: 0 10%;">
                                           
												<div class="col-12 text-center">
													<a href="?controller=users&action=update_account">
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
    
