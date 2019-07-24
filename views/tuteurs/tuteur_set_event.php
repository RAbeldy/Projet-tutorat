
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
                                                    Créer
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="?controller=evenements&action=set_event" onsubmit="javascript:message();">
                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-md-6">
                                                            <label for="date">
                                                                <strong>Date</strong><br>
                                                            </label>
                                                            <input  id = "event" class="form-control" type="datetime-local" name="date_creation"  onchange = 'javascript:test_date();' required/>
                                                        </div>
                                                        <div class="form-group col-xs-12 col-md-6">
                                                            <label for="lieu">
                                                                <strong>Lieu</strong><br> 
                                                            </label>
                                                            <input class="form-control" type="text" placeholder="Lieu" name="lieu" required />
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="tutore">
                                                                <strong>Tutoré</strong><br>
                                                            </label>
                                                            <select class="form-control" name="id_t">
                                                            <?php
                                                                foreach ($donnees as $elt) 
                                                            {
                                                             ?>
                                                                <option value="<?=$elt['user']->getId_user() ;?>" ><?=$elt['user']->getNom().' '.$elt['user']->getPrenom() ; ?></option>
                                                            <?php
                                                            }
                                                            ?>

                                                            </select>
                                                             
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
                                                        <button class="btn" type="submit">CREER</button>
                                                    </div>
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
      function  message()
      {
       alert("l\'évènement a bien été crée. vous le trouverez dans la liste des évènements ");
      }

      var test_date = function()
      {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');// Day config 
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //first month January takes 0. 
        var yyyy = today.getFullYear(); // year takes all e.g: 2019 => 2019

         today = yyyy + '-' + mm + '-' + dd;
         if (document.getElementById('event').value < today) {
            alert(" Entrer une date ultérieure à celle d'aujourd'hui.");
            return -1;
         }

      }
    </script>
    