<!-- Js function for control -->
<script type="text/javascript">

    
 function checkEmailt() {
            var email = document.getElementById('numero2');
            var re =/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
            if (!re.test(email.value)) {
            alert("Entrer une adresse email valide");
            email.focus();
            return false;
         }
}

//Control password
var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
  }
}

function validateForm() { 
        if (document.getElementById("j").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("numero2").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("j").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("k").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("c").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("d").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("e").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("f").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("g").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("h").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        } 
        if (document.getElementById("password").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        }   
        if (document.getElementById("k").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        }  
        if (document.getElementById("confirm_password").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        }  
        if (document.getElementById("i").value == "") 
        { 
        alert("Un ou plusieurs champ(s) non rempli(s)"); 
        return false; 
        }                                       
        return true; 
    } 

</script>

<div class="login-dark">
        <form method="post" name="myForm" onsubmit='javascript:validateForm();' action="createAccount.php">
 
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration">
                <i class="icon ion-person-add"></i>
            </div>
 
<!-- TUTORE-->
        <div class="form-group" id="ifYes" style="display:block;">
        
            <div class="form-group">
                <input class="form-control" type="text" name="nom" id="a" placeholder="Nom" >
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="prenom" id="b" placeholder="Prénom" >
            </div>
            <div class="form-group">
                <input class="form-control" type="date" name="date_naiss" id="c" placeholder="Date de naissance" >
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="nationalite" id="d" placeholder="Nationalité" >
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="phone" id="e" placeholder="tel" >
            </div>
            <div class="form-group">
                <input class="form-control"  type="email" name="email" id="numero2" placeholder="Email" >
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" id="password" placeholder="Mot de passe" onkeyup='javascript:check();' >
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="confirmer_password" id="confirm_password" placeholder="Confirmer mot de passe" onkeyup='javascript:check();' >
            <span id='message'></span>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="ecole" id="f" placeholder="École" >
            </div>
            
            <div class= "form-group"> 
                  <input class="form-control" type="text" name="niveau" id="g" placeholder="niveau scolaire" > 
            </div>
            <div class= "form-group">
                <input class="form-control" type="text" name="adresse" id="h" placeholder="Adresse" >
            </div>            
            <div class= "form-group">
                <input class="form-control" type="text" name="complement_adresse" id="i" placeholder="Complément Adresse" >               
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="ville" id="j" placeholder="Ville" >
            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="code_postal" id="k" placeholder="code postal" >
            </div>
                                                             
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" 
                onclick='javascript:checkEmailt();'>sign up</button>
            </div>
            
        </div>
           </form>
</div>