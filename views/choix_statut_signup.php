<div class="login-clean">
      <form method="post" action="?controller=users&action=inscription">
        <h2 class="sr-only">Login Form</h2>
          <div class="illustration"><i class="icon ion-person-add"></i></div>
          <?php  include('views/alert_view.php'); ?>
          <div class="form-group">
            <button class="btn-login btn-primary btn-block" name="Tuteur" value="Tuteur" type="submit">Tuteur</button>
          </div>

          <div class="form-group">
            <button class="btn-login btn-primary btn-block" name="Tutore" type="submit">Tutoré</button>
          </div>

      </form>
</div>
