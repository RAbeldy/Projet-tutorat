
    <div class="container debut" id="profile">
        <div class="row">
            <div class="col-md-12 alert-col relative">
                <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
            </div>
        </div>
        <form method="post" action="?controller=users&action=modify_account" class="card-container envoi" enctype="multipart/form-data">

            <div class="card" style="display:flex; flex-direction:row; padding-top: 60px; padding-bottom: 60px;">
                <div class="col-md-4">
                    <div class="avatar">
                        <div id="profilPic">
                            <img src='<?=$donnees->getChemin_photo() ;?>' />
                        </div>
                        <input  type="file" name="fileToUpload" title="PNG , JPG ,JPEG , GIF uniquements" id="fileToUpload">
                    </div>
                </div>
                <div class="col-md-8 profil">
                    <h1>Profile </h1>
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Nom</label>
                                <input class="form-control complete" type="text" value="<?php echo $donnees->getNom();?>" name="nom" autofocus>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Prenom</label>
                                <input class="form-control complete" type="text" value="<?php echo $donnees->getPrenom();?>" name="prenom" autofocus>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Adresse</label>
                                <input class="form-control complete" type="text" value="<?php echo $donnees->getAdress();?>" name="adresse" autofocus>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Complément D'Adresse&nbsp;</label>
                                <input class="form-control complete" type="text" value="<?php echo $donnees->getCom_adress();?>"   name="complement_adresse">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Ville</label>
                                <input class="form-control complete" type="text" value="<?php echo $donnees->getVille();?>"  name="ville"   required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Code Postal</label>
                                <input class="form-control complete" type="text" value="<?php echo $donnees->getCode_postal();?>"  name="code_postal"  >
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Niveau scolaire</label>
                                <input class="form-control complete" type="text" value="<?php echo $donnees->getNiveau();?>"  name="niveau"  >
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Ecole</label>
                                <input class="form-control complete" type="text" value="<?php echo $donnees->getEcole();?>"  name="ecole" value="" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Mot de Passe</label>
                                <input class="form-control complete" type="password" name="password" id="password"onkeyup='javascript:checke();' required>
                                <span id='mess'></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Confirmer Mot de Passe&nbsp;</label> <!-- &nbsp permet de forcer un blanc -->
                                <input class="form-control complete" type="password" name="confirmer_password" id="confirm_password" onkeyup='javascript:checke();' required>
                                <span id='mess'></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-3 offset-2" style="text-align: initial;">
                            <a href="#" class="">
                                <button class="btn " type="reset"> Annuler </button>
                            </a>
                        </div>
                        <div class="col-4 offset-2" style="text-align: initial;">
                            <a href="#" class="">
                                <button onclick="alert();" class="btn " name="sauvegarder" type="submit">Sauvegarder</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    //Control password
    $(document).ready(function(){

        
        var complete= document.querySelectorAll(".complete");
        var pwd= document.getElementById('password');
        var cpwd= document.getElementById('cpassword');
        var tel= document.getElementById('tel');
        var bool= true;
      

        var checke = function() {
          if (pwd.value ==  cpwd.value) {
            document.getElementById('mess').style.color = 'green';
            document.getElementById('mess').innerHTML = 'matching';
          } else {
            document.getElementById('mess').style.color = 'red';
            document.getElementById('mess').innerHTML = 'not matching';
          }
        }

        
        
        function completeFields(complete){
            for(let i=0 ; i< complete.length; i++)
            {
                if(complete[i].value == "")
                {
                    complete[i].style.borderColor= "red";
                    complete[i].style.color= "red";
                    //complete[i].placeholder= "veuillez remplir ce champ";
                    bool= false;
                }
    
            }
                if(bool)
                    return true;
                else    
                {
                    bool= true;
                    return false;
                }
            }
            
            $('#cpassword').keyup(e =>{
                checke();
            })
            
            $('.envoi').submit((e)=>{
            if(!completeFields(complete))
            {
                alert("des champs sont incomplets");
                e.preventDefault(); // on annule la fonction par défaut du bouton d'envoi
            }
           
        })
})
</script>
