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
                                                    Créer un administrateur pour un tutorat donné
                                                    <?php include('retour.php')?>
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="?controller=users&action=create_account" onsubmit="javascript:test_date();javascript:message();">
                                                    <div class="row">
                                                        
                                                        <div class="form-group text-center col-12">
                                                            <label for="lieu">
                                                                <strong>Tutorat</strong><br> 
                                                            </label>
                                                            <select class="form-control" name="id_t">
                                                            <?php
                                                                foreach($donnees as $data)
                                                                {
                                                                 ?>
                                                                <option value="<?= $data[1]; ?>" required> <?= $data[0] ;?>
                                                                    
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>

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

         