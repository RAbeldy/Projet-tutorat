
    <div class="global_container">
        <header class="block-intro">
            <div class="jumbotron" id="jumbotron">
                <h1 id="h1bienvenue">BIENVENUE SUR TUTORAT YNCREA</h1>
                <p id="middleJumboParagraph">
                    Dans le but de venir en aide aux élèves du lycée, du collège et même du supérieur,
                    le groupe Yncréa Hauts-de-France en partenariat avec le programme régional de réussite en études longues (PRREL)
                    ont mis en place un système d’accompagnement des collégiens, lycéens et BTS-IUT.
                </p>
                <p id="callToAction" class="text-center"><a href="#tutorat-yncrea" class="btn" role="button">En savoir plus</a></p>
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
				setTimeout(carousel, 6000); // Change image every 4 seconds
			}
		</script>


        <section id="tutorat-yncrea" class="tutorat-yncrea">
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
                                <p class="pres_paragraph">
                                    Le principe du tutorat du groupe YNCREA est la mise en relation des étudiants du groupe YNCREA avec des élèves.
                                    Les élèves se voient aidés dans plusieurs matières et peuvent se rapprocher pour des conseils ou un partage d’expériences
                                    auprès de nos étudiants en matière d’orientation, de démarches ParcourSup et même pour des ateliers de création de CV ou de lettre de motivation.<br/>
                                    Le tutorat vise à susciter chez l’apprenant le goût de la réussite et de l’ambition post-bac. C'est un système de collaboration entre étudiants et élèves
                                    qui fait intervenir les étudiants des 3 écoles du groupe Yncréa : HEI, ISEN et ISA.
                                </p>
                            </div>
                            <div class="pres_button">
                                <a href="#">En savoir plus ...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="desc-tutorat" class="desc-tutorat">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="type-tutorat">Les types de tutorat</h3>
                        <p class="desc_paragraph">
                            Parmi les 3 écoles du groupe Yncréa, on note principalement deux types de tutorat:
                        </p>
                        <ul class="desc_paragraph">
                            <li>
                                le tutorat de groupe qui consite en un soutien scolaire offert au sein
                                de plusieurs sites (collèges, lycées, associations et école HEI) durant des créneaux horaires précis.
                                Ainsi, nos étudiants viennent en aide aux élèves en difficulté au sein de petits groupes constitués par l’établissement.
                            </li>
                            <li>
                                le tutorat personnalisé qui consite en un soutien scolaire qui permet de venir en aide
                                aux lycéens de la seconde à la terminale (BTS et DUT également) au cours de l'année scolaire.
                                Celui-ci se déroule de manière indépendante et s’oriente vers un suivi personnalisé
                                entre l’élève et l’étudiant avec lequel il a été mis en lien.
                            </li>
                        </ul>

                    </div><!-- Col end -->

                    <div class="col-lg-6">
                        <div id="small-slider" class="small-slider">
                            <div class="slider-nav" id="slider-prev" onclick="sliderLeft()"><i class="fa fa-angle-left"></i></div>
                            <div class="slider-nav" id="slider-next" onclick="sliderRight()"><i class="fa fa-angle-right"></i></div>
                            <div id="slider-text">
                                <h2 id="slider-title">Aide</h2>
                            </div>
                        </div>
                		<script>
                			var j = 0;
                			var x = document.getElementById("small-slider");
                			var sliderTitle = document.getElementById("slider-title");
                            var sliderTitleText = [
                                'Aide',
                                'Entraide',
                                'Réussite',
                                'Ambition'];
                            var change = true;
                            slider();

                			function slider() {
                				j++;
                				if(j >= 4)
                					j = 0;
                                if (change) {
                                    x.style.backgroundImage = "url(assets/img/" + j +".jpg)";
                                    sliderTitle.innerHTML = sliderTitleText[j];
                                } else {
                                    change = true;
                                }
                                setTimeout(slider, 6000); // Change image every 6 seconds
                			}

                			function sliderRight() {
                				j++;
                				if(j >= 4)
                					j = 0;
                				x.style.backgroundImage = "url(assets/img/" + j +".jpg)";
                                sliderTitle.innerHTML = sliderTitleText[j];
                			}

                			function sliderLeft() {
                				j--;
                				if(j < 0)
                					j = 3;
                				x.style.backgroundImage = "url(assets/img/" + j +".jpg)";
                                sliderTitle.innerHTML = sliderTitleText[j];
                			}
                		</script>
                    </div><!-- Col end -->
                </div><!-- Content row end -->
            </div><!-- Container end -->
        </section>
    </div>
