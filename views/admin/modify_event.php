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
                                                    Modifier cet évènement
                                                    <?php include('retour.php') ?>
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="?controller=evenements&action=modify_event" onsubmit="javascript:test_date();javascript:message();">
                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-md-12">
                                                            <label for="date">
                                                                <strong>Date</strong><br>
                                                            </label>
                                                            <input  id = "event" class="form-control" type="datetime-local" name="date_creation" value="<?= $tab[0]->getDate_evenement();?>" onchange = 'javascript:test_date();' required/>
                                                        </div>
                                                        
                                                        <div class="form-group col-xs-12 col-md-6">
                                                            <label for="tutore">
                                                                <strong>nombre de Tutorés</strong><br>
                                                            </label>
                                                            <input type="number" class="form-control" name="nb_tutores" value="<?= $tab[0]->getNb_tutores();?>">
                                                            
                                                             
                                                        </div>
                                                        <div class="form-group col-xs-12 col-md-6">
                                                            <label for="tutore">
                                                                <strong>nombre de Tuteurs</strong><br>
                                                            </label>
                                                            <input type="number" class="form-control" name="nb_tuteurs" value="<?= $tab[0]->getNb_tuteurs();?>">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="tutore">
                                                                <strong>Durée</strong><br>
                                                            </label>
                                                            <select class="form-control" name="duree">
                                                                <option value="1">1 h</option>
                                                                <option value="2">2 h</option>
                                                                <option value="3">3 h</option>
                                                                <option value="4">4 h</option>
                                                                <option value="5">5 h</option>
                                                                <option value="6">6 h</option>
                                                                <option value="7">7 h</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center col-12">
                                                        <button class="btn" type="submit">MODIFIER</button>
                                                    </div>

                                                    <input type="hidden" name="id_e" value="<?= $tab[0]->getId_evenement();?>">
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

    <script type="text/javascript">
         function test_date()
          {
            var today = new Date();
           var mm = String(today.getMonth() + 1).padStart(2, '0'); //first month January takes 0. 
            var yyyy = today.getFullYear(); // year takes all e.g: 2019 => 2019
             var dd = String(today.getDate()).padStart(2, '0');// Day config 
             today = yyyy + '-' + mm + '-' + dd;
             day = dd + '/' + mm + '/' + yyyy; 
             if (document.getElementById('event').value < today) {
                alert(" Entrer une date ultérieure à celle d'aujourd'hui: " +day);
                return -1;

                    }
                }         
          </script>

         