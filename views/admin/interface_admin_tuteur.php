
			
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
												<p class="text-primary m-0 font-weight-bold">Tuteurs</p>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-md-3 text-nowrap offset-2">
														<div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
															<button class="btn" onclick="choixStatut();" type="button">Statut</button>
														</div>
													</div>
													<div class="col-md-6">
														<div class="text-md-right dataTables_filter row" id="dataTable_filter">
															<label class="col-3">Tuteurs</label>
															<label class="col-8 offset-1">
																<div class="row">
																	<input type="search" class="form-control form-control-sm col-9" aria-controls="dataTable" placeholder="Search"/>
																	<button class="fa fa-search">
																	</button>
																</div>
															</label>
														</div>
													</div>
												</div>
												<div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
													<table class="table dataTable my-0" id="dataTable">
														<thead>
															<tr>
																<th>Nom</th>
																<th>Prenom</th>
																<th>Detaille</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td><label>Cola</label></td>
																<td><label>Sucre</label></td>
																<td><button class="btn" type="button">Voir</button></td>
															</tr>
															<tr>
																<td><label>Moustik</label></td>
																<td><label>Karismatik</label></td>
																<td><button class="btn" type="button">Voir</button></td>
															</tr>
															<tr>
																<td><label>Yaya</label></td>
																<td><label>Vichenzo</label></td>
																<td><button class="btn" type="button">Voir</button></td>
															</tr>
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
									<p class="card-text">Liste des tutorés encore dispoibles pour le tutorat personnalisé</p>
									<button class="btn" type="button">Visualiser</button>
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
									<button class="btn" type="button">Visualiser</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    