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
                                                <form method="post" action="?controller=tutorat&action=create_center" onsubmit="javascript:test_date();javascript:message();">
                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-md-6">
                                                            <label for="date">
                                                                <strong>Type de tutorat</strong><br>
                                                            </label>
                                                             <select class="form-control" name="id_typeTutorat">
                                                                  <?php
                                                                       foreach($donnees as $data)
                                                                       {
                                                                        if(!preg_match('#TUTORAT#', $data[0]))
                                                                        {
                                                                         ?>


                                                                        <option value="<?=$data[1];?>"required> <?= $data[0] ;?>

                                                                        </option>

                                                                         <?php
                                                                       }
                                                                   }
                                                                       ?>
                                                            </select>



                                                        </div>
                                                        <div class="form-group col-xs-12 col-md-6">
                                                            <label for="lieu">
                                                                <strong>Nom du centre (lycée, collège...)</strong><br>
                                                            </label>
                                                             <input type="text" class="form-control" name="libelle">

                                                        </div>
                                                        <div class="form-group col-xs-12 col-md-6">
                                                            <label for="tutore">
                                                                <strong>Nombre de tutorés</strong><br>
                                                            </label>
                                                            <input type="number" class="form-control" name="nb_tutores">


                                                        </div>
                                                        <div class="form-group col-xs-12 col-md-6">
                                                            <label for="tutore">
                                                                <strong>Nombre de tuteurs</strong><br>
                                                            </label>
                                                            <input type="number" class="form-control" name="nb_tuteurs">
                                                        </div>
                                                        <div class="form-group col-xs-12 col-md-6">
                                                            <label for="tutore">
                                                                <strong>Adresse</strong><br>
                                                            </label>
                                                            <input type="text" class="form-control" name="adresse">


                                                        </div>
                                                        <div class="form-group col-xs-12 col-md-6">
                                                            <label for="tutore">
                                                                <strong>Code postal</strong><br>
                                                            </label>
                                                            <input type="number" class="form-control" name="code_postal">
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
