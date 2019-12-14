<?php 
$backUrl = '';
if (isset($controller_report) && isset($fonction_back)) 
{
    $backUrl = '?controller='.$controller_report.'&action='.$fonction_back;
    foreach ($_GET as $key => $value) {
        if (($key != 'controller') && ($key != 'action')) {
            //Paramètre transmis pour le retour!
            $backUrl .= '&'.$key.'='.$value;
        }
    }
} else {
    $backUrl = 'index.php';
}
?>

<div class="contact-clean">
    <div class="row justify-content-center">
        <div class="col-md-12 justify-content-center">
            <div class="alert alert-success formulaire text-center">
                <h2 class="text-center">Votre mail a bien été envoyé</h2>
                <i class="fa fa-exclamation-triangle fa-5x"></i><br/><br/>
                <p><?php if (isset($error_msg)) {echo $error_msg;}?></p>
                <a href="<?php echo $backUrl;?>"class="form-group"><button name="error_Back" class="btn " type="button">Retour page précédente</button></a>
            </div>
        </div>
    </div>
</div>
