    <div class="login-clean">
        
        <form method="post" action="?controller=users&action=connexion">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <?php  include('views/alert_view.php'); ?>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" id= "myInput" placeholder="Password"></div>
            <p><input type="checkbox" onclick="myFunction()"/>  Show password</p>
            <div class="form-group"><button class="btn-login btn-primary btn-block" type="submit">Log In</button>
            </div>
				<a class="forgot" href="?controller=users&amp;action=forgotPassword">Forgot your email or password ?</a>
				<a class="forgot" href="?controller=users&amp;action=choixStatut">Pas encore inscrit ?</a>
          </form>
    </div>

 <script type="text/javascript">
        function myFunction() 
        {
            var x = document.getElementById("myInput");
            if (x.type === "password") 
            {
                x.type = "text";
            } 
            else 
            {
                x.type = "password";
            }
        }
    </script>
   