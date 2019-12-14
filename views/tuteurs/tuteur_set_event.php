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
                                                    <?php include('retour.php') ?>
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" class="envoi"action="?controller=evenements&action=tuteur_set_event&id=<?=$id;?>" >
                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-md-6">
                                                            <label for="date">
                                                                <strong>Date</strong><br>
                                                            </label>
                                                            <input  id = "event" class="form-control" type="datetime-local" name="date_creation"   required/>
                                                        </div>
                                                        <div class="form-group col-xs-12 col-md-6">
                                                            <label for="lieu">
                                                                <strong>Lieu</strong><br> 
                                                            </label>
                                                            <input class="form-control" type="text" placeholder="Lieu" name="lieu"  />
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="tutore">
                                                                <strong>Tutoré 1</strong><br>
                                                            </label>
                                                            <select class="form-control" name="id_1" id="id_1" required>
                                                                
                                                            <?php
                                                                foreach ($donnees as $elt) 
                                                            {
                                                             ?>
                                                                <option value="<?= $elt->getId_user(); ?>"> <?= $elt->getNom().' '.$elt->getPrenom() ;?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                                
                                                            </select>
                                                             
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="tutore">
                                                                <strong>Tutoré 2</strong><br>
                                                            </label>
                                                            <select class="form-control"  name="id_2" id="id_2">
                                                                <option value=""> Aucun </option>
                                                            <?php
                                                                foreach ($donnees as $elt) 
                                                            {
                                                             ?>
                                                                <option value="<?= $elt->getId_user(); ?>"> <?= $elt->getNom().' '.$elt->getPrenom() ;?></option>
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
                                                                <option value="8">8 h</option>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready( function () {
    var $id1= $('#id_1'),
       $id2= $('#id_2'),
       parentNode= document.getElementsByClassName('.card-header py-3'),
       $envoi= $('.envoi');
    
       function test_date()
    {
        var today = new Date();
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //first month January takes 0. 
        var yyyy = today.getFullYear(); // year takes all e.g: 2019 => 2019
        var dd = String(today.getDate()).padStart(2, '0');// Day config 
        today = yyyy + '-' + mm + '-' + dd;
        day = dd + '/' + mm + '/' + yyyy; 
        if (document.getElementById('event').value < today) {
            //alert("false");
            return false;
        }
        else{
            //alert("true");
            return true;
        }
    }

    $('.envoi').submit(function( event ) {
        if($id1.val()== $id2.val())
        {
            event.preventDefault();
            alert("vous avez sélectionné deux fois le meme tutoré");
            //$parentNode.append("vous avez sélectionné deux fois le meme tutoré");
        }
        if(!test_date())
        {
            event.preventDefault();
            alert("sélectionnez une date supérieur à la date actuelle")
        }
});
     
      
})  
</script>