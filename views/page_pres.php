
    <div class="global_container">
         <div class="w3-content w3-section" style="background-size: auto; background-position: center; top">
              <img class="mySlides" src="assets/img/accueil.jpg" style="width:100%">
              <img class="mySlides" src="assets/img/1.jpg" style="width:100%">
              <img class="mySlides" src="assets/img/2.jpg" style="width:100%">
              <img class="mySlides" src="assets/img/3.jpg" style="width:100%">
    </div>

            <script>
                var myIndex = 0;
                carousel();

                function carousel() {
                  var i;
                  var x = document.getElementsByClassName("mySlides");
                  for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";  
                  }
                  myIndex++;
                  if (myIndex > x.length) {myIndex = 1}    
                  x[myIndex-1].style.display = "block";  
                  setTimeout(carousel, 2000); // Change image every 2 seconds
                }
            </script>


        <div class="container">
            <section class="portfolio-block skills">
                <div class="container">
            <div class="heading">
                <h1 id="h1bienvenue">BIENVENUE SUR TUTORAT YNCREA</h1>
                <p id="middleJumboParagraph">Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor
                    sit amet&nbsp;Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet&nbsp;Lorem Ispum dolor sit amet<br><br></p>
                <p id="callToAction" class="text-center"><a class="btn" role="button">En savoir plus</a></p>
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