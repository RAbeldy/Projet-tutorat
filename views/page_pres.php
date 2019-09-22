
    <div class="global_container">
        <header class="block-intro">
            <div class="jumbotron" id="jumbotron">
                <h1 id="h1bienvenue">BIENVENUE SUR TUTORAT YNCREA</h1>
                <p id="middleJumboParagraph">Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor
                    sit amet&nbsp;Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet<br><br></p>
                <p id="callToAction" class="text-center"><a class="btn" role="button">En savoir plus</a></p>
            </div>
        </header>
		
		<script>
			var i = 0;
			carousel();

			function carousel() {
				var x = document.getElementById("jumbotron");
				x.style.backgroundImage = "url(assets/img/" + i +".jpg)";
				i++;
				if(i >= 4)
					i = 0;
				setTimeout(carousel, 2000); // Change image every 2 seconds
			}
		</script>


        <div class="container">
            <section class="portfolio-block skills">
                <div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="pres_image">
								<img src="assets/img/1.jpg" alt="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="intro_content">
								<div class="intro_title_container">
									<h1 class="pres_title">Tutorat YNCREA</h1>
								</div>
								<div class="pres_text">
									<p>
										Morbi ut dapibus dui. Sed ut iaculis elit, quis varius mauris. Integer ut ultricies orci
										, lobortis egestas sem. Morbi ut dapibus dui. Sed ut iaculis elit.Morbi ut dapibus dui. 
										Sed ut iaculis elit, quis varius mauris. Integer ut ultricies orci, lobo rtis egestas sem. 
										Morbi ut dapibus dui. Sed ut iaculis elit. Morbi ut dapibus dui. Sed ut iaculis elit, quis 
										varius mauris. Integer ut ultricies orci, lobortis egestas sem. Morbi ut dapibus dui. Sed ut 
										iaculis elit.
									</p>
								</div>
								<div class="pres_button">
									<a href="#">En savoir plus ...</a>
								</div>
							</div>
						</div>
					</div>
                    <div class="row">
                        <div class="col-md-4 space">
                            <div class="card special-skill-item border-0">
                                <div class="card-header bg-transparent border-0"><img class="cardImage" src="assets/img/1.jpg"></div>
                                <div class="card-body">
                                    <h3 class="card-title">Tutorés</h3>
                                    <p class="card-text">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 space">
                            <div class="card special-skill-item border-0">
                                <div class="card-header bg-transparent border-0"><img class="cardImage" src="assets/img/2.jpg"></div>
                                <div class="card-body">
                                    <h3 class="card-title">Tuteurs</h3>
                                    <p class="card-text">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 space">
                            <div class="card special-skill-item border-0">
                                <div class="card-header bg-transparent border-0"><img class="cardImage" src="assets/img/3.jpg"></div>
                                <div class="card-body">
                                    <h3 class="card-title">Superviseurs</h3>
                                    <p class="card-text">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 space">
                            <div class="card special-skill-item border-0">
                                <div class="card-header bg-transparent border-0"><img class="cardImage" src="assets/img/1.jpg"></div>
                                <div class="card-body">
                                    <h3 class="card-title">Tutorés</h3>
                                    <p class="card-text">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 space">
                            <div class="card special-skill-item border-0">
                                <div class="card-header bg-transparent border-0"><img class="cardImage" src="assets/img/2.jpg"></div>
                                <div class="card-body">
                                    <h3 class="card-title">Tuteurs</h3>
                                    <p class="card-text">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 space">
                            <div class="card special-skill-item border-0">
                                <div class="card-header bg-transparent border-0"><img class="cardImage" src="assets/img/3.jpg"></div>
                                <div class="card-body">
                                    <h3 class="card-title">Superviseurs</h3>
                                    <p class="card-text">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>